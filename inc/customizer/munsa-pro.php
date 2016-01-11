<?php
/**
 * Link to Munsa (Pro) site.
 *
 * @package Munsa Lite
 */
 
	// Add the Munsa Pro section.
	$wp_customize->add_section(
		'munsa_pro',
		array(
			'title'       => esc_html__( 'More Features', 'munsa-lite' ),
			'description' => sprintf( __( '<a href="%s" target="_blank">Upgrade to Munsa (Pro)</a> for additional features.', 'munsa-lite' ), esc_url( 'https://foxland.fi/downloads/munsa/' ) ),
			'priority'    => 20,
			'panel'       => 'theme'
		)
	);

	// Add the Munsa Pro setting.
	$wp_customize->add_setting(
		'munsa_lite_pro_section',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	
	// Add the Munsa Pro control.
	$wp_customize->add_control(
		new Munsa_Lite_Customize_Control_Info_Text(
			$wp_customize,
			'munsa_lite_pro_section',
				array(
					'label'       => esc_html__( 'Munsa (Pro) Features', 'munsa-lite' ),
					'description' => esc_html__( 'Hide or change footer text, several addiotional page templates, new widgets, and support.', 'munsa-lite' ),
					'section'     => 'munsa_pro',
					'type'        => 'info-text'
				)
			)
		);