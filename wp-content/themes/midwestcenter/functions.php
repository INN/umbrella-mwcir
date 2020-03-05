<?php
/**
 * Child theme funcitons for mwcir
 */
 define('INN_MEMBER',true);

/**
 * Include theme files
 *
 * Based off of how Largo loads files: https://github.com/INN/Largo/blob/master/functions.php#L358
 *
 * 1. hook function Largo() on after_setup_theme
 * 2. function Largo() runs Largo::get_instance()
 * 3. Largo::get_instance() runs Largo::require_files()
 *
 * This function is intended to be easily copied between child themes, and for that reason is not prefixed with this child theme's normal prefix.
 *
 * @link https://github.com/INN/Largo/blob/master/functions.php#L145
 */
function largo_child_require_files() {

	$includes = array(
		// blocks and modifications
		'/blocks/core-group.php',
	);

	foreach ( $includes as $include ) {
		require_once( get_stylesheet_directory() . $include );
	}

}
add_action( 'after_setup_theme', 'largo_child_require_files' );



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
			$output = '<p>Register for free to access most of our stories, receive alerts and newsletters.</p>';
			break;
		case 1:
			$output = '<ul>';
			$output .= '<li>Access to all Investigate Midwest stories.</li>';
			$output .= '<li>Access to all datasets.</li>';
			$output .= '<li>Special subscriber-only Investigate Midwest newsletter.</li>';
			$output .= '</ul>';
			break;
		case 2:
			$output = '<ul>';
			$output .= '<li>Access to all Investigate Midwest stories.</li>';
			$output .= '<li>Access to all datasets.</li>';
			$output .= '<li>Special subscriber-only Investigate Midwest newsletter.</li>';
			$output .= '<li>Access to invitation-only events and early previews of stories.</li>';
			$output .= '</ul>';
			break;
		case 3:
			$output = '<p>Donate $100 or more to receive 1 year of access to premium level content and datasets.</p>';

		default:
			$output = $allowed_content;
			break;
	}
	return $output;
}


/* paywall ignores editors and authors */
add_filter( 'leaky_paywall_current_user_can_view_all_content', 'zeen101_allow_access_leaky_paywall_content_by_cap' );
function zeen101_allow_access_leaky_paywall_content_by_cap( $capability ) {
	// for contributors
	$capability = 'delete_posts';
	// for authors
	// $capability = 'publish_posts';
	// for editors
	// $capability = 'delete_others_posts';
	return $capability;
}
 /**
 * Enqueue specific styles and scripts for midwestcenter child theme
 */
function midwestcenter_enqueue_styles(){
	wp_enqueue_style(
		'largo-child-styles',
		get_stylesheet_directory_uri() . '/css/child-style.css',
		array( 'largo-stylesheet' ),
		filemtime( get_stylesheet_directory() . '/css/child-style.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'midwestcenter_enqueue_styles' );

/**
 * Display a subscribe button in the navbars
 * 
 * @param str $location The location that this button is placed
 * 
 * @return str The formatted subscribe button
 */
function midwestcenter_subscribe_button( $location = null ) {

    if( 'sticky' === $location ) {

        printf( '<a class="subscribe-link" href="%1$s"><span>%2$s</span></a>',
            esc_url( '\/subscription-options\/' ),
            esc_html( 'Subscribe' )
        );

    } else {

        printf( '<div class="subscribe-btn"><a href="%1$s">%2$s</a></div>',
            esc_url( '\/subscription-options\/' ),
            esc_html( 'Subscribe' )
        );

    }
}
