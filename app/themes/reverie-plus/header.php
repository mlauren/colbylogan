<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?> "> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width" />

	<!-- Favicon and Feed -->
	<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

	<!--  iPhone Web App Home Screen Icon -->
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/devices/reverie-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/devices/reverie-icon-retina.png" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/devices/reverie-icon.png" />

	<!-- Enable Startup Image for iOS Home Screen Web App -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/mobile-load.png" />

	<!-- Startup Image iPad Landscape (748x1024) -->
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/img/devices/reverie-load-ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />
	<!-- Startup Image iPad Portrait (768x1004) -->
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/img/devices/reverie-load-ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" />
	<!-- Startup Image iPhone (320x460) -->
	<link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/img/devices/reverie-load.png" media="screen and (max-device-width: 320px)" />

<?php wp_head(); ?>

</head>

<body <?php body_class('antialiased'); ?>>
<div id="body-wrap-top">
  <div id="headerwrap">
    <header class="clearfix header-on-scroll">
      <!-- Starting the Top-Bar -->
      <nav class="navigation-bar" data-topbar>
          <ul class="title-area">
            <li class="toggle-navigation menu-icon"><a id="existing-content-menu" href="#custom-side-menu"><span class="fa fa-bars"></span></a></li>
            <li class="name">
                <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/colbylogan_branding.png" /></a></h1>
              </li>
          </ul>
          <section id="custom-side-menu" class="navigation-bar-section right">
          <?php
              wp_nav_menu( array(
                  'theme_location' => 'primary',
                  'container' => false,
                  'depth' => 0,
                  'items_wrap' => '<ul>%3$s</ul>',
                  'fallback_cb' => 'reverie_menu_fallback', // workaround to show a message to set up a menu
                  'walker' => new reverie_walker( array(
                      'in_top_bar' => true,
                      'item_type' => 'li',
                      'menu_type' => 'main-menu'
                  ) ),
              ) );
          ?>
          </section>
      </nav>
      <!-- End of Top-Bar -->
    </header>
  </div>

  <div class="container" role="document">
    <!-- Start the slides -->
    <?php
      
    if (is_front_page()): ?>
      <div class="small-12 large-12 slide-container">
        <div class="single-item">
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
          } else {
            // no posts found
          }
          /* Restore original Post Data */
          wp_reset_postdata();

          ?>
        </div>
      </div>

      <?php include_once('slideshow-video-media.php'); ?>
    <?php endif; ?>

    <!-- Start the main container -->
    <div class="row">