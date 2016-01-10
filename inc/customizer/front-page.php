<?php
/**
 * Theme Customizer for Front Page Template.
 *
 * @package Munsa Lite
 */
	
	// Add the front-page section.
	$wp_customize->add_section(
		'front-page',
		array(
			'title'       => esc_html__( 'Front Page', 'munsa-lite' ),
			'description' => esc_html__( 'Select featured pages that will be displayed in Front Page Template.', 'munsa-lite' ),
			'priority'    => 20,
			'panel'       => 'theme'
		)
	);
	
	/**
	 * Fetured Page settings.
	 *
	 */
	 
	// Loop same setting couple of times.
	$k = 1;
	
	while( $k < absint( apply_filters( 'munsa_lite_how_many_pages', 7 ) ) ) {
	
		// Add the 'featured_page_*' setting.
		$wp_customize->add_setting(
			'featured_page_' . $k,
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint'
			)
		);
	
		// Add the 'featured_page_*' control.
		$wp_customize->add_control(
			'featured_page_' . $k,
				array(
					/* Translators: %s stands for number. For example Select page 1. */
					'label'    => sprintf( esc_html__( 'Select page %s', 'munsa-lite' ), $k ),
					'section'  => 'front-page',
					'type'     => 'dropdown-pages',
					'priority' => $k+1
				) 
			);
		
		$k++; // Add one before loop ends.
		
	} // End while loop.
	
	/**
	 * Blog area settings.
	 *
	 */
		
	// Add the blog area title setting.
	$wp_customize->add_setting(
		'blog_area_title',
		array(
			'default'           => esc_html__( 'Articles', 'munsa-lite' ),
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
 	
	// Add the blog area url text control.
	$wp_customize->add_control(
		'blog_area_title',
		array(
			'label'    => esc_html__( 'Blog title', 'munsa-lite' ),
			'section'  => 'front-page',
			'priority' => 10,
			'type'     => 'text'
		)
	);
	
	// Add the blog area link setting.
	$wp_customize->add_setting(
		'blog_area_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
 	
	// Add the blog area link control.
	$wp_customize->add_control(
		'blog_area_url',
		array(
			'label'    => esc_html__( 'Blog URL', 'munsa-lite' ),
			'section'  => 'front-page',
			'priority' => 20,
			'type'     => 'url'
		)
	);
 	
	// Add the blog area url text setting.
	$wp_customize->add_setting(
		'blog_area_url_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
 	
	// Add the blog area url text control.
	$wp_customize->add_control(
		'blog_area_url_text',
		array(
			'label'    => esc_html__( 'Blog URL text', 'munsa-lite' ),
			'section'  => 'front-page',
			'priority' => 30,
			'type'     => 'text'
		)
	);
