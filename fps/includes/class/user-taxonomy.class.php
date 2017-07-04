<?php

namespace Redwire;

class FPS_user_taxonomies
{
	private static $taxonomies	= array();

	/**
	 * Register all the hooks and filters we can in advance
	 * Some will need to be registered later on, as they require knowledge of the taxonomy name
	 */
	public static function setup() {
		// Taxonomies
        add_action('registered_taxonomy',		array(__CLASS__, 'registered_taxonomy'), 10, 3);

		// Menus
		add_action('admin_menu',				array(__CLASS__, 'admin_menu'));
		add_filter('parent_file',				array(__CLASS__, 'parent_menu'));

		// User Profiles
		add_action('show_user_profile',			array(__CLASS__, 'user_profile'));
		add_action('edit_user_profile',			array(__CLASS__, 'user_profile'));
		add_action('personal_options_update',	array(__CLASS__, 'save_profile'));
		add_action('edit_user_profile_update',	array(__CLASS__, 'save_profile'));
		add_filter('sanitize_user',				array(__CLASS__, 'restrict_username'));
	}

	/**
	 * This is our way into manipulating registered taxonomies
	 * It's fired at the end of the register_taxonomy function
	 *
	 * @param String $taxonomy	- The name of the taxonomy being registered
	 * @param String $object	- The object type the taxonomy is for; We only care if this is "user"
	 * @param Array $args		- The user supplied + default arguments for registering the taxonomy
	 */
	public static function registered_taxonomy($taxonomy, $object, $args) {
		global $wp_taxonomies;

		// Only modify user taxonomies, everything else can stay as is
		if($object != 'user') return;

		// We're given an array, but expected to work with an object later on
		$args	= (object) $args;

		// Register any hooks/filters that rely on knowing the taxonomy now
		add_filter("manage_edit-{$taxonomy}_columns",	array(__CLASS__, 'set_user_column'));
		add_action("manage_{$taxonomy}_custom_column",	array(__CLASS__, 'set_user_column_values'), 10, 3);

		// Set the callback to update the count if not already set
		// if(empty($args->update_count_callback)) {
		// 	$args->update_count_callback	= array($this, 'update_count');
		// }

		// We're finished, make sure we save out changes
		$wp_taxonomies[$taxonomy]		= $args;
		self::$taxonomies[$taxonomy]	= $args;
	}

	/**
	 * We need to manually update the number of users for a taxonomy term
	 *
	 * @see	_update_post_term_count()
	 * @param Array $terms		- List of Term taxonomy IDs
	 * @param Object $taxonomy	- Current taxonomy object of terms
	 */
	public static function update_count($terms, $taxonomy) {
		global $wpdb;

		foreach((array) $terms as $term) {
			$count	= $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term));

			do_action('edit_term_taxonomy', $term, $taxonomy);
			$wpdb->update($wpdb->term_taxonomy, compact('count'), array('term_taxonomy_id'=>$term));
			do_action('edited_term_taxonomy', $term, $taxonomy);
		}
	}

	/**
	 * Add each of the taxonomies to the Users menu
	 * They will behave in the same was as post taxonomies under the Posts menu item
	 * Taxonomies will appear in alphabetical order
	 */
	public static function admin_menu() {
		// Put the taxonomies in alphabetical order
		$taxonomies	= self::$taxonomies;
		ksort($taxonomies);

		foreach($taxonomies as $key=>$taxonomy) {
			 add_users_page(
				$taxonomy->labels->menu_name,
				$taxonomy->labels->menu_name,
				$taxonomy->cap->manage_terms,
				"edit-tags.php?taxonomy={$key}"
			);
		}
	}

	/**
	 * Fix a bug with highlighting the parent menu item
	 * By default, when on the edit taxonomy page for a user taxonomy, the Posts tab is highlighted
	 * This will correct that bug
	 */
	public static function parent_menu($parent = '') {
		global $pagenow;

		// If we're editing one of the user taxonomies
		// We must be within the users menu, so highlight that
		if(!empty($_GET['taxonomy']) && $pagenow == 'edit-tags.php' && isset(self::$taxonomies[$_GET['taxonomy']])) {
			$parent	= 'users.php';
		}

		return $parent;
	}

	/**
	 * Correct the column names for user taxonomies
	 * Need to replace "Posts" with "Users"
	 */
	public static function set_user_column($columns) {
		unset($columns['posts']);
		$columns['users']	= __('Users');
		return $columns;
	}

	/**
	 * Set values for custom columns in user taxonomies
	 */
	public static function set_user_column_values($display, $column, $term_id) {
		if('users' === $column) {
			$term	= get_term($term_id, $_GET['taxonomy']);
			echo $term->count;
		}
	}

	/**
	 * Add the taxonomies to the user view/edit screen
	 *
	 * @param Object $user	- The user of the view/edit screen
	 */
	public static function user_profile($user) {
		// Using output buffering as we need to make sure we have something before outputting the header
		// But we can't rely on the number of taxonomies, as capabilities may vary
		ob_start();
		foreach(self::$taxonomies as $key=>$taxonomy):
			// Check the current user can assign terms for this taxonomy
			// if(!current_user_can($taxonomy->cap->assign_terms)) continue;

			// Get all the terms in this taxonomy
			$terms = get_terms($key, array('hide_empty'=>false,'parent'=>'0'));


			?>
            <div id="systemsdiv" class="postbox ">
                <div class="inside">
                    <h2 class="hndle ui-sortable-handle"><span><?= $taxonomy->labels->name; ?></span></h2>
                </div>
                <div class="inside">
                    <div id="taxonomy-systems" class="categorydiv">
                        <div id="systems-all" class="tabs-panel">
                            <div class="inside">
                            <table>
                                <tr>
                                    <td>
                                        <?php if(!empty($terms)) { ?>
                                            <?php foreach($terms as $term) { ?>
											<table>
                                                <tr>
                                                    <td>
                                                        <?php $termchildren = get_term_children( $term->term_id,$term->taxonomy ); ?>
                                                        <label for="<?php echo "{$key}-{$term->slug}"?>">
                                                        <input type="checkbox" name="<?php echo $key?>[]" id="<?php echo "{$key}-{$term->slug}"?>" value="<?php echo $term->slug?>" <?php checked(true, is_object_in_term($user->ID, $key, $term->term_id))?> />
                                                        <?php echo $term->name?>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <?php if ( !empty( $termchildren ) ) { ?>
                                                    <?php foreach ( $termchildren as $child ) { ?>
                                                        <tr>
															<td>
                                                        <?php $tchild = get_term_by('id',$child,$term->taxonomy);?>
                                                        <label for="<?php echo "{$key}-{$tchild->slug}"?>">
                                                        <input type="checkbox" style="margin-left: 15px;" name="<?php echo $key?>[]" id="<?php echo "{$key}-{$tchild->slug}"?>" value="<?php echo $tchild->slug?>" <?php checked(true, is_object_in_term($user->ID, $key, $tchild->term_id))?> />
                                                        <?php echo $tchild->name?></label>
                                                        	</td>
														</tr>
                                                    <?php } // Children ?>

                                                <?php } ?>
                                            </table>
                                            <?php } // Terms?>
                                        <?php } else {?>
                                            <?php _e("There are no {$taxonomy->labels->name} available.")?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <input type="hidden" id="_ajax_nonce-add-systems" name="_ajax_nonce-add-systems" value="daee13dee5">
                    </div>
                </div>
            </div>
			<?php
		endforeach; // Taxonomies

		// Output the above if we have anything, with a heading
		$output	= ob_get_clean();
		if(!empty($output)) {
			echo $output;
		}
	}

/**
 * Save the custom user taxonomies when saving a users profile
 *
 * @param Integer $user_id	- The ID of the user to update
 */
public static function save_profile($user_id) {
	foreach(self::$taxonomies as $key => $taxonomy) {
		// Check the current user can edit this user and assign terms for this taxonomy
		if(!current_user_can('edit_user', $user_id) && current_user_can($taxonomy->cap->assign_terms)) return false;
		// Save the data
		$user_terms = ! is_array($_POST[$key]) ? array($_POST[$key]) : $_POST[$key];
		wp_set_object_terms($user_id, $user_terms, $key, false);
		clean_object_term_cache($user_id, $key);
	}
}

	/**
	 * Usernames can't match any of our user taxonomies
	 * As otherwise it will cause a URL conflict
	 * This method prevents that happening
	 */
	public static function restrict_username($username) {
		if(isset(self::$taxonomies[$username])) return '';

		return $username;
	}
}
