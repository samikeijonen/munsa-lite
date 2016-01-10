<?php
/**
 * Primary menu.
 *
 * @package Munsa Lite
 */
?>
	
<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<button id="menu-button" class="main-navigation-toggle menu-sidebar-toggle" aria-controls="menu-primary"><?php esc_html_e( 'Menu', 'munsa-lite' ); ?></button>

	<nav id="menu-primary" class="menu main-navigation menu-primary animated" role="navigation" aria-label="<?php esc_html_e( 'Primary Menu', 'munsa-lite' ); ?>" <?php hybrid_attr( 'menu', 'primary' ); ?>>
		
		<button id="menu-close" class="main-navigation-toggle main-navigation-close menu-sidebar-close menu-sidebar-toggle" aria-controls="menu-primary"><?php esc_html_e( 'Close', 'munsa-lite' ); ?></button>

			<div class="wrap animated">
			
				<?php

					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'menu_id'         => 'primary-menu',
							'container_class' => 'primary-menu-container',
							'depth'           => 2,
							'fallback_cb'     => ''
						)
					);
			
				?>
		
			</div><!-- .wrap -->

	</nav><!-- #menu-primary -->

<?php endif; // End check for main menu. ?>