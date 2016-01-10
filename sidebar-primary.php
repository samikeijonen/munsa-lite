<?php
/**
 * Primary Sidebar.
 *
 * @package Munsa Lite
 */
?>

<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

	<button id="sidebar-button" class="sidebar-primary-toggle menu-sidebar-toggle" aria-controls="sidebar-primary"><?php esc_html_e( 'Info', 'munsa-lite' ); ?></button>

	<aside id="sidebar-primary" class="sidebar-primary sidebar animated" role="complementary" <?php hybrid_attr( 'sidebar', 'primary' ); ?>>
		<h2 class="screen-reader-text" id="sidebar-primary-header"><?php echo esc_html_x( 'Primary Sidebar', 'Sidebar aria label', 'munsa-lite' ); ?></h2>
		
		<button id="sidebar-close" class="sidebar-primary-toggle sidebar-primary-close menu-sidebar-close menu-sidebar-toggle" aria-controls="sidebar-primary"><?php esc_html_e( 'Close', 'munsa-lite' ); ?></button>
		
		<div class="wrap animated">
		
			<?php dynamic_sidebar( 'primary' ); ?>
	
		</div><!-- .wrap -->

	</aside><!-- #sidebar-primary .sidebar -->

<?php endif; // End layout check.