<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Munsa Lite
 */

get_header(); ?>

	<?php
		if ( ! is_front_page() && ( is_home() || is_archive() || is_search() ) ) : // If viewing a multi-post page
			locate_template( array( 'misc/archive-header.php' ), true ); // Loads the misc/archive-header.php template.
		endif; // End check for multi-post page.
	?>

	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
			?>

		<?php endwhile; ?>

		<?php
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous page', 'munsa-lite' ),
				'next_text'          => esc_html__( 'Next page', 'munsa-lite' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'munsa-lite' ) . ' </span>',
			) );
		?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>
