<?php
/**
 * Social links menu.
 *
 * @package Munsa Lite
 */
?>

<?php if ( has_nav_menu( 'social' ) ) : // Check if there's a menu assigned to the 'social' location. ?>
	
	<nav class="menu-social social-navigation menu" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'munsa-lite' ); ?>" <?php hybrid_attr( 'menu', 'social' ); ?>>
		<h2 class="screen-reader-text"><?php esc_attr_e( 'Social Menu', 'munsa-lite' ); ?></h2>
		
		<?php wp_nav_menu(
			array(
				'theme_location' => 'social',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>',
				'fallback_cb'    => '',
			)
		); ?>
	</nav><!-- .menu-social -->

<?php endif; // End check for menu. ?>