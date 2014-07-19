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
        'name' => __( 'Slideshow Testimonial' ),
        'singular_name' => __( 'Slideshow Testimonial' ),
        'new_item' => __('Add New Item')
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_nav_menus' => false,
      'menu_position' => 0,
      'supports' => array('title', 'editor', 'excerpt'),
      'rewrite' => array( 'slug' => 'testimonials' ),
      'taxonomies' => array('category'),
      'hierarchical' => true
    )
  );

  register_post_type( 'video_media',
    array(
      'labels' => array(
        'name' => __( 'Video' ),
        'singular_name' => __( 'Video' ),
        'new_item' => __('Add New Item')
      ),
      'public' => true,
      'has_archive' => true,
      'show_in_nav_menus' => false,
      'menu_position' => 1,
      'supports' => array('title', 'editor', 'excerpt'),
      'rewrite' => array( 'slug' => 'videos' ),
      'taxonomies' => array('category'),
      'hierarchical' => true
    )
  );

}

// Customize default post type.
add_action( 'init', 'post_the_default_post_type');
function post_the_default_post_type() {

    register_post_type( 'post', array(
        'labels' => array(
            'name_admin_bar' => _x( 'Post', 'add new on admin bar' ),
        ),
        'public'  => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'has_archive' => true,
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => 'blogposts' ),
        'query_var' => false,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' ),
    ) );
}
