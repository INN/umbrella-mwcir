<?php
/**
 * Child theme funcitons for mwcir
 */
 define('INN_MEMBER',true);

add_filter( 'leaky_paywall_login_form_args', 'zeen101_login_referrer_redirect' );

function zeen101_login_referrer_redirect( $args ) {

	$referrer = $_SERVER['HTTP_REFERER'];

	if ( !$referrer ) {
		return $args;
	}

	$args['redirect'] = $referrer;

	return $args;
}