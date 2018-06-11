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
require 'gb-customizer.php';
require 'gb-mobile-header.php';

load_theme_textdomain( 'ava-child', get_stylesheet_directory_uri().'/languages' );

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

function ava_site_info() {
  /*
   * Set the variables derived from the Customizer.
   */
  $copyright      = get_theme_mod( 'colophon_copyright', ava_defaults( 'colophon_copyright' ) );
  $copyrighttext  = get_theme_mod( 'colophon_copyright_text', ava_defaults( 'colophon_copyright_text' ) );
  $themeinfo      = get_theme_mod( 'colophon_theme_info', ava_defaults( 'colophon_theme_info' ) );

  /*
   * Check if the copyright or theme info is visible. If so, proceed.
   */
  if ( $copyright || $themeinfo ||  is_customize_preview() ) :

      echo '<div class="site-info">';

          /*
           * Check if the Copyright option is selected in the Customizer.
           * Let's also display it in the Customizer, so we don't have to do a page refresh.
           */
          if ( $copyright || is_customize_preview() ) :

              /**
               * Only display if the option is selected in the Customizer.
               */
              $visibility = ( false == $copyright ) ? ' hidden ' : '';

              echo '<span class="site-copyright'.esc_attr( $visibility ).'">';

                  /*
                   * Copyright Year.
                   */
                  printf( '<span class="%1s" itemscope itemtype="http://schema.org/copyrightYear">&copy; %2s </span>',
                      esc_attr( 'copyright-year' ),
                      esc_html( date("Y") )
                  );

                  /*
                   * Format an array of allowed HTML tags and attributes for the $copyrighttext value.
                   *
                   * @link https://codex.wordpress.org/Function_Reference/wp_kses
                   */
                  $allowed_html_array = array(
                      'a' => array(
                          'href' => array(),
                          'title' => array()
                      ),
                      'br' => array(),
                      'cite' => array(),
                      'em' => array(),
                      'strong' => array(),
                  );

                  /*
                   * Check if the Copyright option is selected in the Customizer.
                   */
                  if ( $copyrighttext || is_customize_preview() ) {
                      printf( '<span class="%1s" itemscope itemtype="http://schema.org/copyrightHolder">%2s</span>',
                          esc_attr( 'copyright-text' ),
                          wp_kses( $copyrighttext, $allowed_html_array )
                      );
                  }

              echo '</span>';

          endif;

          /*
           * Check if the Theme Info option is selected in the Customizer.
           * Let's also display it in the Customizer, so we don't have to do a page refresh.
           */
          if ( $themeinfo || is_customize_preview() ) :
              /**
               * Only display if the option is selected in the Customizer.
               */
              $visibility = ( false == $themeinfo ) ? ' hidden ' : '';

              /*
               * Format an array of allowed HTML tags and attributes for the $copyrighttext value.
               *
               * @link https://codex.wordpress.org/Function_Reference/wp_kses
               */
              $allowed_html_array = array(
                  'a' => array(
                      'href' => array(),
                      'title' => array()
                  ),
                  'span' => array(
                      'class' => array(),
                  )
              );

							$site_id = get_current_blog_id();
							$site_details = get_blog_details($site_id);
							$master_details = get_blog_details(1);

              printf( wp_kses('<span class="%1s%2s"><a href="%3s">%4s | %5s %6s</a></span>', $allowed_html_array ),
                  esc_attr( 'site-theme' ),
                  esc_attr( $visibility ),
                  esc_url( $master_details->siteurl ),
									esc_html( $site_details->blogname ),
									__( 'A part of', 'ava-child' ),
                  esc_html( $master_details->blogname ) // Let's not translate the theme name.
              );

          endif;

      echo '</div>';

  endif;

}
