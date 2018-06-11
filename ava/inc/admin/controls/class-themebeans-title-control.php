<?php
/**
 * Title Customizer Control.
 *
 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * This class is for the title control in the Customizer.
 *
 * @access public
 */
class ThemeBeans_Title_Control extends WP_Customize_Control {

	/**
	 * The type of customize control.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'themebeans-title';

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue() {

		$control = 'title';

		if ( AVA_DEBUG ) {
			$dir = '/src/';
		} else {
			$dir = '/dist/';
		}

		wp_enqueue_style( 'themebeans-' . $control . '-control', get_parent_theme_file_uri( 'inc/admin/controls/assets/css' . $dir . $control . AVA_ASSET_SUFFIX . '.css' ), false, '1.5.9', 'all' );
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {}

	/**
	 * Render a JS template for the content of the control.
	 */
	protected function content_template() {
		?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<div class="customize-control-tooltip-wrapper"><span class="customize-control-tooltip hint hint--top" data-hint="{{ data.description }}"><span class="customize-control-tooltip-icon"></span></span></div>
		<# } #>

		<?php
	}
}
