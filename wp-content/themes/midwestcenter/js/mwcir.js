jQuery(document).ready( function($) {

	$('#issuem-leaky-paywall-articles-remaining-subscribe-link').html('<a href="https://investigatemidwest.mwcir.test/subscription-options/">Subscribe now</a>');



	

	$('#issuem-leaky-paywall-articles-remaining-nag #issuem-leaky-paywall-articles-remaining-text').text(' free articles left.');

	$('<div id="issuem-leaky-paywall-articles-remaining-text-contd">Please subscribe to continue reading and to support our mission.</div>').insertAfter( '#issuem-leaky-paywall-articles-remaining-nag #issuem-leaky-paywall-articles-remaining-text' );

	$('#issuem-leaky-paywall-articles-remaining-nag #issuem-leaky-paywall-articles-remaining-close').click(function() {
	  $(this).parent().remove();
	});




	$('#issuem-leaky-paywall-articles-zero-remaining-nag #issuem-leaky-paywall-articles-remaining').empty();

	$('#issuem-leaky-paywall-articles-zero-remaining-nag #issuem-leaky-paywall-articles-remaining').html('<p>We need your support to continue bringing you this content.</p><p>Please consider subscribing today.</p>');
	
});
