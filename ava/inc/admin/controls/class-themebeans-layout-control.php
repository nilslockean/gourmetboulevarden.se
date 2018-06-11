<?php
/**
 * Layout Customizer Control.
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
 * This class is for the layout control in the Customizer.
 *
 * @access public
 */
class ThemeBeans_Layout_Control extends WP_Customize_Control {

	/**
	 * The type of customize control.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'themebeans-layout';

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue() {

		$control = 'layout';

		if ( AVA_DEBUG ) {
			$dir = '/src/';
		} else {
			$dir = '/dist/';
		}

		wp_enqueue_style( 'themebeans-' . $control . '-control', get_parent_theme_file_uri( 'inc/admin/controls/assets/css' . $dir . $control . AVA_ASSET_SUFFIX . '.css' ), false, '1.5.9', 'all' );
		wp_enqueue_script( 'themebeans-' . $control . '-control', get_parent_theme_file_uri( 'inc/admin/controls/assets/js' . $dir . $control . AVA_ASSET_SUFFIX . '.js' ), array( 'jquery' ), '1.5.9', true );

		// Localization.
		$themebeans_layout_control_l10n['open']  = esc_html__( 'Layout', 'ava' );
		$themebeans_layout_control_l10n['close'] = esc_html__( 'Close', 'ava' );

		wp_localize_script( 'themebeans-' . $control . '-control', 'themebeansLocalization', $themebeans_layout_control_l10n );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		// The setting value.
		$this->json['id']      = $this->id;
		$this->json['value']   = $this->value();
		$this->json['link']    = $this->get_link();
		$this->json['choices'] = $this->choices;

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

		<# if ( ! data.choices ) {
			return;
		} #>

		<# if ( data.description ) { #>
			<span class="customize-control-description">{{ data.description }}</span>
		<# } #>

		<button id="layout-switcher" class="button layout-switcher"><?php esc_html_e( 'Layout', 'ava' ); ?></button>

		<div class="layout-switcher__wrapper">

			<# for ( choice in data.choices ) { #>

				<input type="radio" value="{{ choice }}" name="_customize-{{ data.id }}" id="{{ data.id }}-{{ choice }}" class="layout" {{{ data.link }}} <# if ( data.value === choice ) { #> checked="checked" <# } #> />

				<label for="{{ data.id }}-{{ choice }}" class="login-designer-templates__label">

					<div class="intrinsic">
						<div class="layout-screenshot" style="background-image: url( {{ data.choices[ choice ] }} );"></div>
					</div>

				</label>

			<# } #>

		</div>

		<?php
	}
}
