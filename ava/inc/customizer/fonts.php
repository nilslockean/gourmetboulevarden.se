<?php
/**
 * Fonts functionality
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/**
 * Returns an array of Google Font options
 *
 * @return array of font styles.
 */
function ava_get_fonts() {

	$fonts = array(
		'Abril Fatface'         => 'Abril Fatface',
		'georgia'               => 'Georgia',
		'helvetica'             => 'Helvetica',
		'Lato'                  => 'Lato',
		'Lora'                  => 'Lora',
		'Karla'                 => 'Karla',
		'Josefin Sans'          => 'Josefin Sans',
		'Montserrat'            => 'Montserrat',
		'Open Sans'             => 'Open Sans',
		'Oswald'                => 'Oswald',
		'Overpass'              => 'Overpass',
		'Poppins'               => 'Poppins',
		'PT Sans'               => 'PT Sans',
		'Roboto'                => 'Roboto',
		'Fira Sans Condensed'   => 'Fira Sans',
		'times'                 => 'Times New Roman',
		'Nunito'                => 'Nunito',
		'Merriweather'          => 'Merriweather',
		'Rubik'                 => 'Rubik',
		'Playfair Display'      => 'Playfair Display',
		'Spectral'              => 'Spectral',
	);

	return apply_filters( 'ava_site_editor_fonts', $fonts );

}

/**
 * Prepends the Typekit enabled fonts added to the Customizer.
 *
 * @param  array $fonts Default fonts from the ava_get_fonts function.
 * @return array of default fonts, plus the new typekit additions.
 */
function ava_typekit_fonts( $fonts ) {
	/*
	 * Customizer options.
	 */
	$typekit_font_1 = get_theme_mod( 'typekit_font_1', ava_defaults( 'typekit_font_1' ) );
	$typekit_font_2 = get_theme_mod( 'typekit_font_2', ava_defaults( 'typekit_font_2' ) );

	if ( false === $typekit_font_1 ) {
		return false;
	}

	$typekit_font_1_slug = strtolower( preg_replace( '#[^a-zA-Z]#', '-', $typekit_font_1 ) );
	$typekit_font_2_slug = strtolower( preg_replace( '#[^a-zA-Z]#', '-', $typekit_font_2 ) );

	$typekit_fonts = array(
		$typekit_font_1_slug => $typekit_font_1,
		$typekit_font_2_slug => $typekit_font_2,
	);

	// Combine the two arrays.
	$fonts = array_merge( $typekit_fonts, $fonts );

	return $fonts;
}

add_filter( 'ava_site_editor_fonts', 'ava_typekit_fonts' );
