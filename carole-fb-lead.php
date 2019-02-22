<?php

/*
  Plugin Name: Applyivy Track Lead
  Plugin URI: http://www.applyivy.com/
  Description: Put tracking js script on every contact form 7 submission
  Version: 1.0.0
  Author: Agus Suroyo
 */

if (!function_exists('carole_dependecy_scripts')) {

    function carole_dependecy_scripts()
    {
	wp_enqueue_script('jquery');
    }

    add_action('wp_enqueue_scripts', 'carole_dependecy_scripts');
}

if (!function_exists('carole_fb_lead')) {

    function carole_fb_lead()
    {
	?>
	<script type="text/javascript">
	    (function ($) {

		"use strict"

		$(function () {

		    // For cf7
		    var selector = '.wpcf7', button = $(selector);
		    if (button.length > 0) {
			var btn = document.querySelector(selector);
			btn.addEventListener('wpcf7submit', function (event) {
			    if (typeof (fbq) !== "undefined") {
				fbq('track', 'Lead');
			    }
			}, false);
		    }


		    // For avia form
		    $(document).on('click', 'form input[type="submit"]', function () {
			if (typeof (fbq) !== "undefined") {
			    fbq('track', 'Lead');
			}
		    });
		});

	    })(jQuery);
	</script>
	<?php

    }

    add_action('wp_footer', 'carole_fb_lead', 20);
}

