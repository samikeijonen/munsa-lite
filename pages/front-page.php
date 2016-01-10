<?php
/**
 * Template Name: Front Page
 *
 * This is the page template for Front Page.
 *
 * @package Munsa Lite
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="entry-outer">
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
					<?php the_content(); ?>
				</div><!-- .entry-content -->

			</article><!-- #post-## -->
	
			<?php
				get_template_part( 'menus/menu', 'social' ); // Loads the menus/menu-social.php template.
			?>
			
			<a id="scroll-to-content" class="scroll-to-content" data-scroll href="#featured-area">
				<span class="screen-reader-text"><?php esc_html_e( 'Scroll to Content', 'munsa-lite' ); ?></span>
			</a>
		
		</div><!-- .entry-outer -->

	</div><!-- .featured-content -->

	<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
