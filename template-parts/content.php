<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Munsa Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular() ) : // If single. ?>
	
		<?php munsa_lite_post_thumbnail(); ?>
	
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
			<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
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
		
		<footer class="entry-footer">
			<div class="footer-wrap">
				<?php /* Translators: #%s means text before category or tag. */ ?>
				<?php munsa_lite_post_terms( array( 'taxonomy' => 'category', 'text' => esc_html__( '#%s', 'munsa-lite' ), 'before' => '<div class="entry-categories"><span class="terms-title categories-title">' . esc_html__( 'Categories', 'munsa-lite' ) . '</span>', 'after' => '</div>' ) ); ?>
				<?php munsa_lite_post_terms( array( 'taxonomy' => 'post_tag', 'text' => esc_html__( '#%s', 'munsa-lite' ), 'before' => '<div class="entry-tags"><span class="terms-title tags-title">' . esc_html__( 'Tags', 'munsa-lite' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div><!-- .footer-wrap -->
		</footer><!-- .entry-footer -->
		
	<?php else : ?>
	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<?php munsa_lite_post_thumbnail( $post_thumbnail = 'munsa-medium' ); ?>
			</div><!-- .entry-thumbnail -->
		<?php endif; ?>
		
		<div class="entry-inner">
		
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
			</header><!-- .entry-header-info -->
		
			<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			
		</div><!-- .entry-inner -->

	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->