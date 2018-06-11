<?php

function gourmetboulevarden_customize_register( $wp_customize ) {
  // Settings
  $wp_customize -> add_setting('phone_number', array(
    'default' => '',
    'transport' => 'refresh'
  ));
  $wp_customize -> add_setting('mobile_header_phone_icon_color', array(
    'default' => '#444444',
    'transport' => 'refresh'
  ));


  // Sections
  $wp_customize -> add_section('gourmetboulevarden_contact_section', array(
    'title' => 'Kontaktuppgifter'
  ));

  // Controls
  $wp_customize -> add_control('phone_number_control', array(
    'label' => 'Telefonnummer',
    'description' => 'Visas i sidhuvudet på mobiltelefoner. Ange utan mellanrum och bindestreck, med landskod (t.ex. +4640123456).',
    'section' => 'gourmetboulevarden_contact_section',
    'type' => 'text',
    'settings' => 'phone_number'
  ));
  $wp_customize->add_control(
  	new WP_Customize_Color_Control(
  	$wp_customize,
  	'nils_colooor',
  	array(
  		'label'      => 'Färg på ikonen',
  		'section'    => 'gourmetboulevarden_contact_section',
  		'settings'   => 'mobile_header_phone_icon_color',
  	))
  );

}
add_action( 'customize_register', 'gourmetboulevarden_customize_register' );

?>
