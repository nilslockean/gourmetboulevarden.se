<?php
/**
 * Load metabox functionality from CMB2.
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/**
 * Query whether the theme uses CMB2.
 */
function themebeans_is_cmb2() {

	if ( has_action( 'cmb2_admin_init' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Load CMB2 if this theme is compatible and the pre-packaged plugin exists.
 */
function themebeans_meta() {

	if ( themebeans_is_cmb2() && file_exists( get_parent_theme_file_path( '/inc/admin/cmb2/init.php' ) ) ) {
		require get_parent_theme_file_path( '/inc/admin/cmb2/init.php' );
	}

}
add_action( 'init', 'themebeans_meta' );

/**
 * Enqueue a custom stylesheet for CMB2.
 *
 * @todo Ensure this only enqueues on the proper editing screens.
 */
function themebeans_meta_styles() {

	global $pagenow;

	// Only continue on the post editing pages.
	if ( 'post.php' !== $pagenow ) {
		return;
	}

	if ( themebeans_is_cmb2() && file_exists( get_parent_theme_file_path( '/assets/css/metaboxes.css' ) ) ) {
		wp_enqueue_style( 'themebeans-metaboxes', get_parent_theme_file_uri( '/assets/css/metaboxes.css' ), false, '1.5.9', 'all' );
	}

}
add_action( 'admin_enqueue_scripts', 'themebeans_meta_styles' );
