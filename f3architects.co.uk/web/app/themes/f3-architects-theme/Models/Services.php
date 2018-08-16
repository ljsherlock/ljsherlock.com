<?php

namespace Models;

use Includes\Classes\CMB2 as CMB2;

class Services extends Page
{
    public function __construct($args) {
        // run the parent constructor
        parent::__construct($args);
    }

    public function get() {
      // fetch the cmb2 group
      $this->servicesPosts = get_post_meta( $this->post->ID, CMB2::$prefix . 'services_post_group', true );

      // use this from frontpage model to get posts
      array_walk($this->servicesPosts, function(&$service, $key) {

        if ( !empty($service['posts']) ) {
          $archive = new \Controllers\Archive( array( 'query' => array( 'post_type' => 'work', 'post__in' => $service['posts'] ) ) );
          $service['posts'] = $archive->returnData('posts');

          $service['link'] = new \TimberTerm( $service['link'] );
          $service['link']->permalink = get_term_link( $service['link']->term_id, 'type');
        }
      });

      $this->timber->addContext(array(
        // 'posts' => array( 'postsArray' =>  $terms ),
        'services' => $this->servicesPosts
      ));

      return parent::get();
    }
}
