<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="main">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Munsa Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head <?php hybrid_attr( 'head' ); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>

<div id="site-wrapper" class="site-wrapper">
	<div id="page" class="site">
	
	<!-- Preloader -->
	<div id="preloader" class="preloader">
		<div id="status" class="status">
			<span class="screen-reader-text"><?php esc_html_e( 'Site is loading', 'munsa-lite' ); ?></span>
			<div class="sk-three-bounce">
				<div class="sk-child sk-bounce1"></div>
				<div class="sk-child sk-bounce2"></div>
				<div class="sk-child sk-bounce3"></div>
			</div>
		</div>
	</div>
		
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'munsa-lite' ); ?></a>
		
		<?php
			// Get Featured image.
			$munsa_lite_bg = munsa_lite_get_post_thumbnail( $post_thumbnail = 'full' );
		?>

		<?php if ( is_page_template( 'pages/front-page.php' ) ) : ?>
			<div class="featured-content"<?php if ( has_post_thumbnail() ) echo ' style="background-image:url(' . esc_url( $munsa_lite_bg ) . ');"' ?>>
		<?php endif; ?>
		
		<header id="masthead" class="site-header" role="banner" <?php hybrid_attr( 'header' ); ?>>
		
			<div class="site-branding">
			
				<?php do_action( 'munsa_lite_open_branding' ); ?>
			
				<?php munsa_lite_the_custom_logo() ?>
			
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title" <?php hybrid_attr( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title" <?php hybrid_attr( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
				
				<p class="site-description" <?php hybrid_attr( 'site-description' ); ?>><?php bloginfo( 'description' ); ?></p>
			
				<?php do_action( 'munsa_lite_close_branding' ); ?>
			
			</div><!-- .site-branding -->
			
		</header><!-- #masthead -->

		<?php get_template_part( 'menus/menu', 'primary' ); // Loads the menus/menu-primary.php template. ?>
		
		<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
		
		<?php if ( get_header_image() && ! is_page_template( 'pages/front-page.php' ) ) : ?>
			<div class="munsa-header-wrapper">
				<a class="munsa-header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			</div><!-- .munsa-header-wrapper -->
		<?php endif; // End header image check. ?>
		
		<div id="content" class="site-content">
		
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>
