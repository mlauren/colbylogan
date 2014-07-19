<?php get_header(); ?>

  <!-- Row for main content area -->
  <div class="small-12 large-12 columns" id="content" role="main">

    <?php if ( have_posts() ) : ?>

      <?php /* Start the Loop */ ?>
      <?php
        query_posts( array ( 'category_name' => 'featured_front', 'posts_per_page' => 15 ) );
      ?>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content' ); ?>
      <?php endwhile; ?>

      <?php wp_reset_query(); ?>

    <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>

    <?php endif; // end have_posts() check ?>

    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php if ( function_exists('reverie_pagination') ) { reverie_pagination(); } else if ( is_paged() ) { ?>
      <nav id="post-nav">
        <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'reverie' ) ); ?></div>
        <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'reverie' ) ); ?></div>
      </nav>
    <?php } ?>

  </div>

<?php get_footer(); ?>