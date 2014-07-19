	</div><!-- Row End -->
</div><!-- Container End -->

<div class="full-width footer-widget">
	<div class="row">
		<?php dynamic_sidebar("Footer"); ?>
	</div>
</div>

<footer class="full-width" role="contentinfo">
	<div class="row">
		<div class="large-6 columns">
			<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'inline-list')); ?>
		</div>
		<div class="large-6 columns">
			<ul class="inline-list right">
				<li><h5 class="subheader">Connect with Colby:</h5></li>
				<li><i class="fa fa-facebook-square"></i></li>
				<li><i class="fa fa-youtube"></i></li>
			</ul>
		</div>
	</div>
	<div class="row love-reverie">
		<div class="large-12 columns">
			<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<script>
	(function($) {
		$(document).foundation();
	})(jQuery);
</script>
</div>
</body>
</html>