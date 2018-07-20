jQuery(document).ready( function($) {

	$('#issuem-leaky-paywall-articles-remaining-subscribe-link').html('<a href="/subscription-options/">Subscribe now</a>');



	

	$('#issuem-leaky-paywall-articles-remaining-nag #issuem-leaky-paywall-articles-remaining-text').text(' free articles left.');

	$('<div id="issuem-leaky-paywall-articles-remaining-text-contd">Please subscribe to continue reading and to support our mission.</div>').insertAfter( '#issuem-leaky-paywall-articles-remaining-nag #issuem-leaky-paywall-articles-remaining-text' );

	$('#issuem-leaky-paywall-articles-remaining-nag #issuem-leaky-paywall-articles-remaining-close').click(function() {
	  $(this).parent().remove();
	});

	$('#issuem-leaky-paywall-articles-remaining-login-link a').append('.');




	$('#issuem-leaky-paywall-articles-zero-remaining-nag #issuem-leaky-paywall-articles-remaining').empty();

	$('#issuem-leaky-paywall-articles-zero-remaining-nag #issuem-leaky-paywall-articles-remaining').html('<p>Hey there. You\'ve reached the maximum number of freebies we have to offer today. To continue reading, please log in.</p><p>Not a subscriber? Join today for more access to stories, data and maps. </p>');



	$('#option-2 .leaky_paywall_subscription_price p strong').append('— discounted from $96/year');



	$('.donate-btn').html('<a href="/subscription-options/">SUBSCRIBE</a>');
	
});
