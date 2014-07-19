<?php
/**
* Plugin Name: Ajax contact form
* Description: Ajax Based Contact Form with Shortcode
* Version: 1.0
* Author: Luran
*/

define( 'CONTACT_FORM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CONTACT_FORM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function basic_contact_form_scripts() {
	/* Register our script. */
	wp_enqueue_script( 'simple-contact-form', CONTACT_FORM_PLUGIN_URL . 'simple-contact-form.js', array( 'jquery' ) );
	wp_localize_script( 'simple-contact-form', 'simple_contact_form_ajax', array( 'simple_contact_form_ajaxurl' => admin_url( 'admin-ajax.php' )));
}
add_action('wp_enqueue_scripts', 'basic_contact_form_scripts');

function basic_contact_form() { 
	global $content;

	$output = '
	<div class="panel small-12 large-12 columns">
		<form id="simple-contact" name="simple-contact" method="POST" class="small-12 large-12 columns">
			<div class="row">
					<div class="large-12 columns">
						<label for="name">Name: <small required>required</small>
							<input type="text" name="contact_form_name" id="contact-form-name" required placeholder="Your Name" value=""/>
						</label>
	    		</div>
	  		</div>
	  		<div class="row">
					<div class="large-12 columns">
						<label for="email" id="email_label">Email: <small required>required</small>
							<input type="text" name="contact_form_email" id="contact-form-email" required placeholder="Your Email" value=""/>
						</label>
	    		</div>
	  		</div>
				<div class="row">
					<div class="large-12 columns">
						<label for="msg" id="mgs_label">Your Message: <small required>required</small>
							<textarea name="contact_form_mgs" id="contact-form-mgs" placeholder="Write your message" required value=""> </textarea>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<a href="#" class="button radius" id="contact-form-submit"> Submit</a>
					</div>
				</div>
		</form>
	</div>';
	return $output;
}
add_shortcode('basic_contact_form', 'basic_contact_form');

function simple_contact_form_send() {
	$name = sanitize_text_field($_POST['name']);
	$email = sanitize_email($_POST['email']);
	$mgs = sanitize_text_field($_POST['mgs']);	
	$to = get_option('admin_email');

	mail( $to, "Name:" . $name, $mgs, "From:" . $email );

	die(); 
}

add_action('wp_ajax_simple_contact_form_send', 'simple_contact_form_send');
add_action('wp_ajax_nopriv_simple_contact_form_send', 'simple_contact_form_send');
