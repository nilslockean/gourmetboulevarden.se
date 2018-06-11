<?php
/**
 * License Customizer Control.
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
 * This class is for the license control in the Customizer.
 *
 * @access public
 */
class ThemeBeans_License_Control extends WP_Customize_Control {

	/**
	 * The type of customize control.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'themebeans-license';

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue() {

		$control = 'license';

		if ( AVA_DEBUG ) {
			$dir = '/src/';
		} else {
			$dir = '/dist/';
		}

		wp_enqueue_style( 'themebeans-' . $control . '-control', get_parent_theme_file_uri( 'inc/admin/controls/assets/css' . $dir . $control . AVA_ASSET_SUFFIX . '.css' ), false, '1.5.9', 'all' );
		wp_enqueue_script( 'themebeans-' . $control . '-control', get_parent_theme_file_uri( 'inc/admin/controls/assets/js' . $dir . $control . AVA_ASSET_SUFFIX . '.js' ), array( 'jquery' ), '1.5.9', true );

		// Localization.
		$localize = array(
			'nonce'   => array(
				'activate'   => wp_create_nonce( 'themebeans-activate-license' ),
				'deactivate' => wp_create_nonce( 'themebeans-deactivate-license' ),
			),
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);

		wp_localize_script( 'themebeans-' . $control . '-control', 'themebeans_license_control', $localize );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		// Retrieve the license class.
		$customizer = new ThemeBeans_License();

		// Check the validity of the license.
		$is_valid   = $customizer->is_valid_license();
		$visibility = ( true === $is_valid ) ? 'is-valid' : 'is-not-valid';

		// The setting value.
		$this->json['value']                       = $this->value();
		$this->json['link']                        = $this->get_link();
		$this->json['status']                      = $customizer->status();
		$this->json['visibility']                  = $visibility;
		$this->json['input_attrs']['tooltip']      = ( isset( $this->input_attrs['tooltip'] ) ) ? $this->input_attrs['tooltip'] : null;
		$this->json['input_attrs']['tooltip_link'] = ( isset( $this->input_attrs['tooltip_link'] ) ) ? $this->input_attrs['tooltip_link'] : null;
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

			<span class="customize-control-title">

				{{ data.label }}

				<# if ( data.input_attrs['tooltip'] ) { #>
					<# if ( data.input_attrs['tooltip_link'] ) { #>
						<a class="themebeans-tooltip " href="{{ data.input_attrs['tooltip_link'] }}" alt="{{ data.input_attrs['tooltip'] }}" target="_blank">
							<span class="screen-reader-text">{{ data.input_attrs['tooltip'] }}</span>
					<# } #>
						<span class="hint--top" aria-label="{{ data.input_attrs['tooltip'] }}">
							<span class="themebeans-tooltip__icon dashicons dashicons-editor-help"></span>
						</span>
					<# if ( data.input_attrs['tooltip_link'] ) { #>
						</a>
					<# } #>
				<# } #>

			</span>

		<# } #>

		<# if ( data.description ) { #>
			<span class="customize-control-description">{{ data.description }}</span>
		<# } #>

		<div id="theme-license-form" class="license-form">
			<input id="theme-license-key" class="license" name="theme-license-key" spellcheck="false" type="text" value="{{ data.value }}" {{{ data.input_attrs }}} {{{ data.link }}} />
			<input type="submit" name="themebeans-license" id="themebeans-activate-license" value="<?php esc_attr_e( 'Activate', 'ava' ); ?>" class="button-secondary button {{ data.visibility }}">
			<input type="submit" name="themebeans-deactivate-license" id="themebeans-deactivate-license" value="<?php esc_attr_e( 'Deactivate', 'ava' ); ?>" class="button-secondary button {{ data.visibility }}">
			<div class="spinner"></div>
		</div>

		<div id="theme-license-error"></div>

		<ul id="theme-license-info" class="{{ data.visibility }}">
			<li><strong><?php esc_html_e( 'Status:', 'ava' ); ?></strong> <span id="theme-license-status">{{ data.status }}</span></li>
		</ul>

		<?php
	}
}
