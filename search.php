<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Munsa Lite
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<header class="archive-header" <?php hybrid_attr( 'archive-header' ); ?>>
			<h1 class="archive-title" <?php hybrid_attr( 'archive-title' ); ?>><?php printf( esc_html__( 'Search Results for: %s', 'munsa-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .archive-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );
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
