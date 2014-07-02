<?php

/*
Plugin Name: Custom Post Types and Custom Post Meta
Description: Adds all the post type filters.
Author: Lauren Maxwell
Version: 1.0
*/

add_action( 'init', 'create_post_type' );

function create_post_type() {


  /*****************************************************?
   * Galleries
   */
  register_post_type( 'slideshow_content',
    array(
      'labels' => array(
        'name' => __( 'Slideshow' ),
        'singular_name' => __( 'Slideshow' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_nav_menus' => false,
      'menu_position' => 0,
      'supports' => array('title'),
      'rewrite' => array( 'slug' => 'slides' ),
      'taxonomies' => array('category'),
      'hierarchical' => true
    )
  );

  register_post_type( 'video_media',
    array(
      'labels' => array(
        'name' => __( 'Video' ),
        'singular_name' => __( 'Video' )
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_nav_menus' => false,
      'menu_position' => 1,
      'supports' => array('title'),
      'rewrite' => array( 'slug' => 'videos' ),
      'taxonomies' => array('category'),
      'hierarchical' => true
    )
  );

}
