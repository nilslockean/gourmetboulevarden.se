<?php
/**
 * Add Typekit Support
 * See: https://typekit.com/
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

if ( ! function_exists( 'ava_typekit_setup' ) ) :
	/**
	 * Enqueue Typekit scripts.
	 */
	function ava_typekit_setup() {

		// Get the theme option from the Customizer > Site Editor > Fonts panel.
		$typekit_id = get_theme_mod( 'typekit_id', ava_defaults( 'typekit_id' ) );

		// If there's no idea. Stop here.
		if ( empty( $typekit_id ) ) {
			return;
		}

		// Enqueue the Typekit Javascript file, using the Typekit ID provided.
		wp_enqueue_script( 'ava-typekit', '//use.typekit.net/'. esc_js( $typekit_id ) .'.js', array(), '1.5.9' );

		// Add the inine script.
		if ( wp_script_is( 'ava-typekit', 'enqueued' ) ) {
			wp_add_inline_script( 'ava-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}
	}
endif;
add_action( 'wp_head', 'ava_typekit_setup', 6 );
