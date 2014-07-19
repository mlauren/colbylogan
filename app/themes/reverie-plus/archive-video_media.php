

<?php get_header(); ?>

<!-- Row for main content area -->
<div class="row" id="content" role="main">

	<h3 class="subheader text-center page-header-text"><?php _e('All Video Media'); ?></h3>
	<div>
	<?php

	$args = array(
		'post_type' => 'video_media',
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

			$the_image = get_field('video_preview');
			echo '<div class="small-6 large-4 columns left" style="height: 325px; overflow: hidden;">';
			echo '<div class="bits-wrapper">';
			echo '<a class="youtube-open-video" href="'. get_field('video_url') .'">';
			echo '<img class="video-preview" src="' . $the_image['sizes']['large'] . '" style="width: 100%;" />';
			echo '</a>';
			echo '</div>';
			echo '<a class="youtube-open-video" href="'. get_field('video_url') .'">';
			echo '<h5 class="video-title">'.get_the_title().'</h5>';
			echo '</a>';
			echo '<p>'.get_the_content().'</p>';
			echo '</div>';
		}
	} else {
	echo 'No content found.';
	}

	/* Restore original Post Data */
	wp_reset_postdata();

	?>
</div>

<?php get_footer(); ?>
