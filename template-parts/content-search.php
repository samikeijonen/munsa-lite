<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Munsa Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
	
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
	</header><!-- .entry-header-info -->
		
	<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
</article><!-- #post-## -->

