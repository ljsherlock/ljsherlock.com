<?php

require_once 'includes/include.php';

Redwire\App::setup();

add_action('wp_ajax_archivesFilterSearch', array('Redwire\ArchivesFilter', 'search_ajax') );
add_action('wp_ajax_nopriv_archivesFilterSearch', array('Redwire\ArchivesFilter', 'search_ajax') );




//Making jQuery Google API and no conflict with plugins
function modify_jquery() {
    if (!is_admin()) {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', false, '2.1.1');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'modify_jquery');

wp_register_script('slider', get_stylesheet_directory_uri() . '/js/slider.js', array('jquery'));
wp_enqueue_script('slider');



// Add support


add_theme_support('post-thumbnails');
add_theme_support('menus');


add_theme_support( 'html5', array( 'search-form' ) );

if ( !is_admin() ) {
    add_filter('show_admin_bar', '__return_false');
}




function twentyten_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );





/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
    return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
    add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case '' :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">

            <div class="comment-info">
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, 40 ); ?>
                    <?php //printf( __( '%s', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) );
                        echo preg_replace("/\([^)]*\) ?/", "", get_comment_author());
                        //echo get_comment_author_link();
                    ?>
                </div><!-- .comment-author .vcard -->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->
            </div><!-- .comment-info -->

            <div class="comment-body"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </div><!-- #comment-##  -->

    <?php
            break;
        case 'pingback'  :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
    <?php
            break;
    endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {


    // Area 1, located at the top of the sidebar.
    register_sidebar( array(
        'name' => __( 'Blog sidebar', 'twentyten' ),
        'id' => 'primary-widget-area',
        'description' => __( 'The primary widget area', 'twentyten' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 id="follow">',
        'after_title' => '</h2>',
    ) );

    // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => __( 'Insights', 'twentyten' ),
        'id' => 'secondary-widget-area',
        'description' => __( 'The secondary widget area', 'twentyten' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<li>',
        'after_title' => '</li>',
    ) );


    register_sidebar( array(
        'name' => __( 'Useful Links', 'twentyten' ),
        'id' => 'useful-links',
        'description' => __( 'Useful Links', 'twentyten' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<li>',
        'after_title' => '</li>',
    ) );


}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
    add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
    printf( __( '<span class="%1$s">Posted on</span> %2$s', 'twentyten' ),
        'meta-prep meta-prep-author',
        sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
            get_permalink(),
            esc_attr( get_the_time() ),
            get_the_date()
        ),
        sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
            get_author_posts_url( get_the_author_meta( 'ID' ) ),
            sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
            get_the_author()
        )
    );
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
    // Retrieves tag list of current post, separated by commas.
    $tag_list = get_the_tag_list( '', ', ' );
    if ( $tag_list ) {
        $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
    } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
        $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
    } else {
        $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
    }
    // Prints the string, replacing the placeholders.
    printf(
        $posted_in,
        get_the_category_list( ', ' ),
        $tag_list,
        get_permalink(),
        the_title_attribute( 'echo=0' )
    );
}
endif;


// add_filter( $filter, 'sanitize_text_field' );
// add_filter( $filter, 'wp_filter_kses' );
// add_filter( $filter, '_wp_specialchars', 30 );

add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id )
{
    $company = wp_filter_kses($_POST[ 'company' ]);
    add_comment_meta( $comment_id, 'company', $company );
}


add_filter( 'get_comment_author', 'attach_company_to_author' );
function attach_company_to_author( $author )
{
    $company = get_comment_meta( get_comment_ID(), 'company', true );
    if ($company)
    {
        $author .= " ($company)";
    }
    return $author;
}

add_image_size( 'rw-thumb', 150, 9999 ); //300 pixels wide (and unlimited height)

// redwire : return all tags
function wp_get_all_tags( $args = '' ) {

  $tags = get_terms('post_tag');
  foreach ( $tags as $key => $tag ) {
      if ( 'edit' == 'view' )
          $link = get_edit_tag_link( $tag->term_id, 'post_tag' );
      else
          $link = get_term_link( intval($tag->term_id), 'post_tag' );
      if ( is_wp_error( $link ) )
          return false;

      $tags[ $key ]->link = $link;
      $tags[ $key ]->id = $tag->term_id;
      $tags[ $key ]->name = $tag->name;
//      echo ' <a href="'. $link .'">' . $tag->name . '</a>';
      }
  return $tags;
}


// redwire : get list of tags and categories
function wp_get_tags_cats ($args = '')
{
    $return     = array();
    $tags       = wp_get_all_tags();
    $categories = get_categories( $args );

    foreach($tags as $tag)
    {
        $return[strtoupper($tag->name)] = $tag;
    }

    foreach($categories as $cat)
    {
        $return[strtoupper($cat->name)] = $cat;
    }

    ksort($return);

    return $return;
}




/**
 * COSTUM POST TYPES
 */

add_action( 'init', 'create_post_type' );
function create_post_type() {

    register_post_type( 'cases',
        array(
            'labels' => array(
                'name' => __( 'Case Studies'),
                'singular_name' => __( 'Case' )
            ),
        'public' => true,
        'menu_icon' => '',
        'has_archive' => false,
        'supports' => array( 'title', 'thumbnail', 'editor')
        )
    );
}




add_action( 'init', 'create_cases_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_cases_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Area', 'taxonomy general name' ),
        'singular_name'     => _x( 'Area', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Area' ),
        'all_items'         => __( 'All Areas' ),
        'parent_item'       => __( 'Parent Area' ),
        'parent_item_colon' => __( 'Parent Area:' ),
        'edit_item'         => __( 'Edit Area' ),
        'update_item'       => __( 'Update Area' ),
        'add_new_item'      => __( 'Add New Area' ),
        'new_item_name'     => __( 'New Area Name' ),
        'menu_name'         => __( 'Area' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
    );

    register_taxonomy( 'area', array( 'cases' ), $args );


}


/**
 *LOAD MENU ADMIN ICONS
 */

add_action( 'wp_enqueue_scripts', 'jk_load_dashicons' );
function jk_load_dashicons() {
    wp_enqueue_style( 'dashicons' );
}


/**
 * ..... ADD THE STYLE
 */

function add_menu_icons_styles(){
?>

<style>



#adminmenu .menu-icon-cases div.wp-menu-image:before { content: "\f237"; }

</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}



// Content in Columns

function my_multi_col_v2($content){
    // run through a couple of essential tasks to prepare the content
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

    // the first "more" is converted to a span with ID
    $columns = preg_split('/(<span id="more-\d+"><\/span>)|(<!--more-->)<\/p>/', $content);
    $col_count = count($columns);

    if($col_count > 1) {
        for($i=0; $i<$col_count; $i++) {
            // check to see if there is a final </p>, if not add it
            if(!preg_match('/<\/p>\s?$/', $columns[$i]) )  {
                $columns[$i] .= '</p>';
            }
            // check to see if there is an appending </p>, if there is, remove
            $columns[$i] = preg_replace('/^\s?<\/p>/', '', $columns[$i]);
            // now add the div wrapper
            $columns[$i] = '<div class="dynamic-col-'.($i+1).'">'.$columns[$i].'</div>';
        }
        $content = join($columns, "\n").'<div class="clear"></div>';
    }
    else {
        // this page does not have dynamic columns
        $content = wpautop($content);
    }
    // remove any left over empty <p> tags
    $content = str_replace('<p></p>', '', $content);
    return $content;
}
