<?php
/**
 * Child theme funcitons for mwcir
 */
 define('INN_MEMBER',true);



/* return user to previous page after they've logged in */

add_filter( 'leaky_paywall_login_form_args', 'zeen101_login_referrer_redirect' );

function zeen101_login_referrer_redirect( $args ) {

	$referrer = $_SERVER['HTTP_REFERER'];

	if ( !$referrer ) {
		return $args;
	}

	$args['redirect'] = $referrer;

	return $args;
}



/* use email address as username */

add_filter('leaky_paywall_userdata_before_user_create', 'zeen101_force_email_for_new_user' );
function zeen101_force_email_for_new_user( $userdata ) {
	$userdata['user_login'] = $userdata['user_email'];
	return $userdata;




// don't allow users to access WordPress admin
add_action('admin_init', 'endo_hide_dashboard');
function endo_hide_dashboard() {
 if ( ! current_user_can( 'manage_options' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
  	wp_redirect(home_url()); exit;
  }
}
// remove admin bar from non admin users
add_action('after_setup_theme', 'endo_remove_admin_bar');
function endo_remove_admin_bar() {
	if (!current_user_can('manage_options') && !is_admin()) {
		show_admin_bar(false);
	}
}