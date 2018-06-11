<?php
/**
 * Theme Customizer functionality
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/**
 * Register the control types that we're using as JavaScript controls.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function themebeans_register_control_types( $wp_customize ) {

	if ( class_exists( 'ThemeBeans_Toggle_Control' ) ) {
		$wp_customize->register_control_type( 'ThemeBeans_Toggle_Control' );
	}

	if ( class_exists( 'ThemeBeans_Title_Control' ) ) {
		$wp_customize->register_control_type( 'ThemeBeans_Title_Control' );
	}

	if ( class_exists( 'ThemeBeans_Range_Control' ) ) {
		$wp_customize->register_control_type( 'ThemeBeans_Range_Control' );
	}

	if ( class_exists( 'ThemeBeans_Layout_Control' ) ) {
		$wp_customize->register_control_type( 'ThemeBeans_Layout_Control' );
	}

	if ( class_exists( 'ThemeBeans_License_Control' ) ) {
		$wp_customize->register_control_type( 'ThemeBeans_License_Control' );
	}
}

add_action( 'customize_register', 'themebeans_register_control_types', 11 );
