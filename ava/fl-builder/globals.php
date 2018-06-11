<?php
/**
 * Beaver Builder Global Settings
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/**
 * Filter the default Beaver Builder global settings, and add our own.
 *
 * @param array $form The form.
 * @param array $id The id of the form.
 */
function ava_bb_register_global_settings_form( $form, $id ) {

	if ( 'global' == $id ) {
		$form =
		array(
			'title' => esc_html__( 'Global Settings', 'ava' ),
			'tabs' => array(
				'general'  => array(
					'title'         => esc_html__( 'General', 'ava' ),
					'description'   => esc_html__( '<strong>Note</strong>: These settings apply to all posts and pages.', 'ava' ),
					'sections'      => array(
							'page_heading'  => array(
								'title'         => esc_html__( 'Default Page Heading', 'ava' ),
								'fields'        => array(
									'show_default_heading' => array(
										'type'                 => 'select',
										'label'                => _x( 'Show', 'General settings form field label. Intended meaning: "Show page heading?"', 'ava' ),
										'default'              => '0',
										'options'              => array(
											'0'                     => esc_html__( 'No', 'ava' ),
											'1'                     => esc_html__( 'Yes', 'ava' ),
										),
										'toggle'               => array(
											'0'                    => array(
												'fields'               => array( 'default_heading_selector' ),
											),
										),
										'help'                     => esc_html__( 'Choosing no will hide the default theme heading for the "Page" post type. You will also be required to enter some basic CSS for this to work if you choose no.', 'ava' ),
									),
									'default_heading_selector' => array(
										'type'                     => 'text',
										'label'                    => esc_html__( 'CSS Selector', 'ava' ),
										'default'                  => '.fl-post-header',
										'help'                     => esc_html__( 'Enter a CSS selector for the default page heading to hide it.', 'ava' ),
									),
								),
							),
							'rows'          => array(
								'title'         => esc_html__( 'Rows', 'ava' ),
								'fields'        => array(
								'row_margins'       => array(
									'type'              => 'unit',
									'label'             => esc_html__( 'Margins', 'ava' ),
									'default'           => '0',
									'placeholder'       => '0',
									'responsive'        => true,
									'description'       => 'px',
								),
								'row_padding'       => array(
									'type'              => 'unit',
									'label'             => esc_html__( 'Padding', 'ava' ),
									'default'           => '0',
									'placeholder'       => '0',
									'responsive'        => true,
									'description'       => 'px',
								),
								'row_width'         => array(
									'type'              => 'text',
									'label'             => esc_html__( 'Max Width', 'ava' ),
									'default'           => '1100',
									'maxlength'         => '4',
									'size'              => '5',
									'description'       => 'px',
									'help'              => esc_html__( 'All rows will default to this width.', 'ava' ),
								),
								'row_width_default' => array(
									'type'    => 'select',
									'label'   => esc_html__( 'Default Row Width', 'ava' ),
									'default' => 'full',
									'options' => array(
										'fixed' => esc_html__( 'Fixed', 'ava' ),
										'full'  => esc_html__( 'Full Width', 'ava' ),
									),
									'toggle'        => array(
										'full'         => array(
											'fields'        => array( 'row_content_width_default' ),
										),
									),
								),
								'row_content_width_default' => array(
									'type'    => 'select',
									'label'   => esc_html__( 'Default Row Content Width', 'ava' ),
									'default' => 'full',
									'options' => array(
										'fixed' => esc_html__( 'Fixed', 'ava' ),
										'full'  => esc_html__( 'Full Width', 'ava' ),
									),
								),
							),
						),
						'modules'       => array(
							'title'         => esc_html__( 'Modules', 'ava' ),
							'fields'        => array(
								'module_margins'    => array(
									'type'              => 'unit',
									'label'             => esc_html__( 'Margins', 'ava' ),
									'default'           => '20',
									'placeholder'       => '0',
									'responsive'        => true,
									'description'       => 'px',
								),
							),
						),
						'responsive'    => array(
							'title'         => esc_html__( 'Responsive Layout', 'ava' ),
							'fields'        => array(
								'responsive_enabled'   => array(
									'type'                 => 'select',
									'label'                => _x( 'Enabled', 'General settings form field label. Intended meaning: "Responsive layout enabled?"', 'ava' ),
									'default'              => '1',
									'options'              => array(
										'0'                     => esc_html__( 'No', 'ava' ),
										'1'                     => esc_html__( 'Yes', 'ava' ),
									),
									'toggle'               => array(
										'1'                    => array(
											'fields'               => array( 'auto_spacing', 'responsive_breakpoint', 'medium_breakpoint' ),
										),
									),
								),
								'auto_spacing'         => array(
									'type'                 => 'select',
									'label'                => _x( 'Enable Auto Spacing', 'General settings form field label. Intended meaning: "Enable auto spacing for responsive layouts?"', 'ava' ),
									'default'              => '1',
									'options'              => array(
										'0'                     => esc_html__( 'No', 'ava' ),
										'1'                     => esc_html__( 'Yes', 'ava' ),
									),
									'help'              => esc_html__( 'When auto spacing is enabled, the builder will automatically adjust the margins and padding in your layout once the small device breakpoint is reached. Most users will want to leave this enabled.', 'ava' ),
								),
								'medium_breakpoint' => array(
									'type'              => 'text',
									'label'             => esc_html__( 'Medium Device Breakpoint', 'ava' ),
									'default'           => '992',
									'maxlength'         => '4',
									'size'              => '5',
									'description'       => 'px',
									'help'              => esc_html__( 'The browser width at which the layout will adjust for medium devices such as tablets.', 'ava' ),
								),
								'responsive_breakpoint' => array(
									'type'              => 'text',
									'label'             => esc_html__( 'Small Device Breakpoint', 'ava' ),
									'default'           => '768',
									'maxlength'         => '4',
									'size'              => '5',
									'description'       => 'px',
									'help'              => esc_html__( 'The browser width at which the layout will adjust for small devices such as phones.', 'ava' ),
								),
							),
						),
					),
				),
				'css'  => array(
					'title'         => esc_html__( 'CSS', 'ava' ),
					'sections'      => array(
						'css'  			=> array(
							'title'         => '',
							'fields'        => array(
								'css' 			=> array(
									'type'          => 'code',
									'label'         => '',
									'editor'        => 'css',
									'rows'          => '19',
									'preview'           => array(
										'type'              => 'none',
									),
								),
							),
						),
					),
				),
				'js'  	=> array(
					'title'         => esc_html__( 'JavaScript', 'ava' ),
					'sections'      => array(
						'js'  			=> array(
							'title'         => '',
							'fields'        => array(
								'js' 			=> array(
									'type'          => 'code',
									'label'         => '',
									'editor'        => 'javascript',
									'rows'          => '19',
									'preview'           => array(
										'type'              => 'none',
									),
								),
							),
						),
					),
				),
			),
		);
	}

	return $form;
}
add_filter( 'fl_builder_register_settings_form', 'ava_bb_register_global_settings_form', 10, 2 );
