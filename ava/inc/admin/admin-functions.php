<?php
/**
 * Dashboard functions
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/**
 * Retrieve the current theme's name or URL slug.
 *
 * @param string|string $url URL or not.
 */
function themebeans_get_theme( $url ) {

	// Get the parent theme's name.
	$theme = esc_attr( wp_get_theme( get_template() )->get( 'Name' ) );

	// Replace spaces with hypens, and makes it lowercase for links.
	if ( true === $url ) {
		$theme = strtolower( $theme );
		$theme = str_replace( ' ', '-', $theme );
		$theme = preg_replace( '#[ -]+#', '-', $theme );
	} else {
		$theme = str_replace( '_', ' ', $theme );
	}

	return $theme;
}

/**
 * Query whether this is an instance of Envato Hosted.
 */
function themebeans_is_envato_hosted() {
	if ( defined( 'ENVATO_HOSTED_SITE' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Add the theme version to the front end.
 */
function themebeans_meta_generator() {

	// Get the parent theme's name.
	$theme = themebeans_get_theme( false );

	// Get the parent theme's current version number.
	$version = wp_get_theme( get_template() )->get( 'Version' );

	echo '<meta name="generator" content="' . esc_attr( $theme ) . ' v' . esc_attr( $version ) . '" />' . "\n";
}

/**
 * Add the changelog within the admin footer.
 */
function themebeans_dashboard_link() {

	// Remove if this is an Envato hosted environment.
	if ( themebeans_is_envato_hosted() ) {
		return;
	}

	global $submenu;

	$submenu['index.php'][500] = array( 'ThemeBeans', 'manage_options', 'https://themebeans.com/?utm_source=Admin%20Dashboard%20Link&utm_medium=wp-admin-link&utm_campaign=WP%20Dashboard%20Link&utm_content=' . esc_attr( themebeans_get_theme( true ) ) );
}

/**
 * Theme changelog in footer admin.
 *
 * @param string|string $html WordPress version.
 */
function themebeans_dashboard_footer_version( $html ) {

	// Get the parent theme's current version number.
	$version = wp_get_theme( get_template() )->get( 'Version' );
	$html   .= ' | <a href="http://demo.themebeans.com/wp-content/themes/' . esc_attr( themebeans_get_theme( true ) ) . '/changelog.txt" target="_blank">' . esc_html( themebeans_get_theme( false ) . '&nbsp;' . $version ) . '</a>';

	return $html;
}

/**
 * Dashboard help guide.
 */
if ( ! function_exists( 'themebeans_guide' ) ) :
	/**
	 * Initiate the inline dashboard help guide.
	 *
	 * Add the following in your child theme to disable the inline docs:
	 *
	 * function themebeans_guide() {}
	 *
	 * Note that this does not disable the theme updater or the inline docs.
	 *
	 * @link https://gist.github.com/richtabor/7a7da34f9db5b1eddae9976445e29ca3
	 */
	function themebeans_guide() {

		require get_parent_theme_file_path( '/inc/admin/guide/class-themebeans-guide.php' );

		if ( ! class_exists( 'ThemeBeans_Guide' ) ) {
			return;
		}

		if ( themebeans_is_envato_hosted() ) {
			return;
		}

		global $pagenow;

		// No inline-docs on the post editing screens, as Gutenberg causes issues.
		if ( 'post.php' === $pagenow || 'post-new.php' === $pagenow && function_exists( 'register_block_type' ) ) {
			return;
		}

		$markdown_url = 'https://raw.githubusercontent.com/richtabor/theme-docs/master/' . esc_attr( themebeans_get_theme( true ) ) . '/readme.md';

		$huh = new ThemeBeans_Guide();
		$huh->init( $markdown_url );
	}
endif;
add_action( 'admin_init', 'themebeans_guide' );

/**
 * Modify the upgrade URL in Beaver Builder Lite to add an affiliate ID.
 *
 * @link http://kb.wpbeaverbuilder.com/article/117-plugin-filter-reference
 */
function themebeans_bb_upgrade_link() {
	return 'https://www.wpbeaverbuilder.com/?fla=1173';
}
add_filter( 'fl_builder_upgrade_url', 'themebeans_bb_upgrade_link' );
