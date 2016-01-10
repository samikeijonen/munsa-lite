<?php
/**
 * Custom background feature
 *
 * @package Munsa Lite
 */

/**
 * Adds support for the WordPress 'custom-background' theme feature.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function munsa_lite_custom_background_setup() {

	add_theme_support( 'custom-background',
		apply_filters( 'munsa_lite_custom_background_args',
			array(
				'default-color'    => 'ffffff',
				'default-image'    => '',
			) 
		)
	);
}
add_action( 'after_setup_theme', 'munsa_lite_custom_background_setup', 15 );
