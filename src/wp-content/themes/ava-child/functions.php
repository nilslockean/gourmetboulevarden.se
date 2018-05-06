<?php
/**
 * Ava child theme functions
 *
 * @package Ava
 * @author  Rich Tabor <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

function add_tracking_codes() {
	// Don't track admins
	if ( is_user_logged_in() ) {
		return;
	}
	
	$site_id = get_current_blog_id();
	$site_details = get_blog_details($site_id);
	$site_domain = $site_details->domain;
	
	// Declare Google Analytics and Hotjar tracking IDs
	switch ( $site_domain ) {
		case 'bagerileve.se':
			$gaid = 'UA-99819439-1';
			$hjid = 838538;
			break;
		default:
			$gaid = 'UA-99819439-2';
			$hjid = 838537;
			break;
	}
	?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gaid; ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', '<?php echo $gaid; ?>');
	</script>
	
	<!-- Hotjar Tracking Code -->
	<script>
	    (function(h,o,t,j,a,r){
	        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	        h._hjSettings={hjid:<?php echo $hjid; ?>,hjsv:6};
	        a=o.getElementsByTagName('head')[0];
	        r=o.createElement('script');r.async=1;
	        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	        a.appendChild(r);
	    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
	<?php
}
add_action('wp_head', 'add_tracking_codes');
