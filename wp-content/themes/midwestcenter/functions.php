<?php
/**
 * Child theme funcitons for mwcir
 */
 define('INN_MEMBER',true);


/**
 * get other scripts
 */
 function mwcir_enqueue() {
	wp_enqueue_script( 'inn-tools', get_stylesheet_directory_uri() . '/js/mwcir.js', array( 'jquery' ), '1.1', true );
}
add_action( 'wp_enqueue_scripts', 'mwcir_enqueue' );


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
}



/* don't allow users to access WordPress admin */
add_action('admin_init', 'endo_hide_dashboard');
function endo_hide_dashboard() {
 if ( ! current_user_can( 'manage_options' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
  	wp_redirect(home_url()); exit;
  }
}


/* remove admin bar from non admin users */
add_action('after_setup_theme', 'endo_remove_admin_bar');
function endo_remove_admin_bar() {
	if (!current_user_can('manage_options') && !is_admin()) {
		show_admin_bar(false);
	}
}

/* Add extra text to subscription card options */
add_filter( 'leaky_paywall_subscription_options_allowed_content', 'zeen101_show_level_benefits_on_card', 10, 3 );
function zeen101_show_level_benefits_on_card( $allowed_content, $level_id, $level ) {
	switch ( $level_id ) {
		case 0:
			$output = '<ul>';
			$output .= '<li>Access to all InvestigateMidwest stories.</li>';
			$output .= '</ul>';
			break;
		case 1:
			$output = '<ul>';
			$output .= '<li>Access to all InvestigateMidwest stories.</li>';
			$output .= '<li>Platinum Benefit #2</li>';
			$output .= '<li>Platinum Benefit #3</li>';
			$output .= '</ul>';
			break;
		
		default:
			$output = $allowed_content;
			break;
	}
	return $output;
}