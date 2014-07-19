<?php get_header(); ?>

<div class="row" id="content" role="main">
    <h3 class="subheader text-center page-header-text"><?php _e('Hear what others have to say about me:'); ?></h3>
    <?php

    $args = array(
      'post_type' => 'slideshow_content',
      'order_by' => 'menu_order',
      'order' => 'ASC',
      'posts_per_page' => 15
    );
    // The Query
    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
      while ( $the_query->have_posts() ) {
        $the_query->the_post();

        //var_dump($positioning);
        $the_image = get_field('testimonial_field_image');
        echo '<div class="small-12 large-12 columns left testamonial-panel radius">';
          echo '<div class="small-5 large-5 hide-for-medium hide-for-small left">';
            echo '<img src="' . $the_image['sizes']['large'] . '" style="width: 100%;" />';
          echo '</div>';
        echo '<div class="content-text-inner small-12 large-7 columns right">';
        echo '<h4 class="slideshow-text-header"><em>' . get_field('slideshow_text') . '</em></h4>';
        echo the_content();
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<h3>' . 'No content found...' . '</h3>';
    }

    ?>
</div>

<?php get_footer(); ?>