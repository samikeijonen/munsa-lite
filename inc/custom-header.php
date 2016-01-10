<?php
/**
 * Custom Header feature
 *
 * @package Munsa Lite
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses munsa_lite_header_style()
 */
function munsa_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'munsa_lite_custom_header_args', array(
		'default-image'      => '',
		'default-text-color' => '000000',
		'width'              => 1420,
		'height'             => 500,
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'munsa_lite_header_style'
	) ) );

}
add_action( 'after_setup_theme', 'munsa_lite_custom_header_setup', 15 );

if ( ! function_exists( 'munsa_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see munsa_lite_custom_header_setup().
 */
function munsa_lite_header_style() {
	
	// Header text color.
	$header_color = get_header_textcolor();
	
	// Header image.
	$header_image = esc_url( get_header_image() );
	
	// Start header styles.
	$style = '';
	
	// Site title styles.
	if ( display_header_text() ) {
		$style .= ".site-title, .site-title a, .site-description, .site-description a { color: #{$header_color} }";
	}
	
	if ( ! display_header_text() ) {
		$style .= ".site-title, .site-description { clip: rect(1px, 1px, 1px, 1px); position: absolute; }";	
	}
	
	// Echo styles if it's not empty.
	if ( ! empty( $style ) ) {
		echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
	}

}
endif; // munsa_lite_header_style
