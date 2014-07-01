
<!-- Start the slides -->
    <?php

      $args = array(
        'post_type' => 'slideshow_content',
        'order_by' => 'menu_order',
        'order' => 'ASC',
        'posts_per_page' => -1
      );
      // The Query
      $the_query = new WP_Query( $args );

      // The Loop
      if ( $the_query->have_posts() ) {
        echo '<div class="small-12 large-12 slide-container">';
        echo '<div class="single-item">';
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          $positioning = get_field('slide_text_positioning');

          if ($positioning == 'right') $position = 'right';
          if ($positioning == 'left') $position = 'left';

          //var_dump($positioning);
          $the_image = get_field('slideshow_image');
          echo '<div class="slick-slide" style="">';
          echo '<div class="' . $position . ' title-slide-wrapper">';
          echo '<h3 class="slideshow-text-header small-5 large-5"><em>' . get_field('slideshow_text') . '</em></h3>';
          echo '<h4 class="slideshow-text-credit small-5 large-5">' . get_field('slideshow_text_credit') . '</h4>';
          echo '</div>';
          echo '<img src="' . $the_image['sizes']['large'] . '" style="width: 100%;" />';
          echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      /* Restore original Post Data */
      wp_reset_postdata();

    ?>
