<div class="row">
  <div id="slide-videos-container" class="small-12 small-centered large-12 large-centered columns">
    <h3><?php _e('Latest Videos'); ?></h3>
    <div class="single-item-videos">
      <?php

      $args = array(
        'post_type' => 'video_media',
        'order_by' => 'menu_order',
        'order' => 'ASC',
        'posts_per_page' => 5
      );
      // The Query
      $the_query = new WP_Query( $args );

      // The Loop
      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();

          $the_image = get_field('video_preview');
          echo '<div class="slick-slide">';
          echo '<div class="video-overlay-wrapper">';
          echo '<div class="bits-wrapper">';
          echo '<a class="youtube-open-video" href="'. get_field('video_url') .'">';
          echo '<i class="fa fa-youtube-play fa-6"></i>';
          echo '</a>';
          echo '<h5 class="white video-title">'.get_the_title().'</h5>';
          echo '</div>';
          echo '<img class="video-preview" src="' . $the_image['sizes']['large'] . '" style="width: 100%;" />';
          echo '</div>';
          echo '</div>';
        }
      } else {
        // no posts found
      }

      /* Restore original Post Data */
      wp_reset_postdata();

      ?>
    </div>
  </div>
</div>