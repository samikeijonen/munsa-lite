<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Munsa Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php munsa_lite_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
		
		<?php the_content(); ?>
		
		<?php
			wp_link_pages( array(
				'before'    => '<div class="page-links">' . __( 'Pages:', 'munsa-lite' ),
				'after'     => '</div>',
				'pagelink'  => '<span class="screen-reader-text">' . __( 'Page', 'munsa-lite' ) . ' </span>%',
				'separator' => '<span class="screen-reader-text">,</span> ',
			) );
		?>
	
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->

