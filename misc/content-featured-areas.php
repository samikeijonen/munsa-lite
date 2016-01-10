<?php
/**
 * Featured areas in Front Page Template. This file is called in footer.php.
 *
 * @package Munsa Lite
 */

?>

<div id="featured-area" class="featured-area">

<?php

// Blog Posts Query. 
$blog_content = new WP_Query( apply_filters( 'munsa_lite_blog_posts_arguments', array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'no_found_rows'  => true,
) ) );

// Get featured pages.
$munsa_lite_featured_pages = munsa_lite_featured_pages();
	
// Check if there is content we want to show.
if ( $blog_content->have_posts() || ! empty( $munsa_lite_featured_pages ) ) :
	
	// Check do we have featured pages. This function returns page ID:s in an array.
	if ( ! empty( $munsa_lite_featured_pages ) ) :
?>

		<div id="featured-pages-area" class="featured-pages-area front-page-area">
			<div class="featured-pages-wrapper">

				<?php
	
				foreach ( $munsa_lite_featured_pages as $munsa_lite_page_id ) : // Begins the loop through found pages from customize settings. ?>
	
					<?php $munsa_lite_bg = munsa_lite_get_post_thumbnail( $post_thumbnail = 'munsa-medium', $id = $munsa_lite_page_id )?>
			
					<article id="post-<?php echo $munsa_lite_page_id; ?>" <?php post_class( $class = '', $post_id = $munsa_lite_page_id ); ?> <?php hybrid_attr( 'post' ); ?>>
					
						<div class="entry-wrapper">
					
							<a href="<?php echo esc_url( get_permalink( $munsa_lite_page_id ) ); ?>" rel="bookmark">
								<div class="entry-bg-image"<?php if ( has_post_thumbnail( $munsa_lite_page_id ) ) echo ' style="background-image:url(' . esc_url( $munsa_lite_bg ) . ');"' ?>>
									<header class="entry-header">
										<h2 class="entry-title" <?php echo hybrid_get_attr( 'entry-title' ); ?>><?php echo get_the_title( $munsa_lite_page_id ); ?></h2>
									</header><!-- .entry-header -->
								</div><!-- .entry-bg-image -->
							</a>
							
						</div><!-- .entry-wrapper -->
					
					</article><!-- .post-## -->
		
				<?php endforeach; ?>

			</div><!-- .featured-pages-wrapper -->
		</div><!-- .featured-pages-area -->

	<?php endif; // End check for featured pages. ?>

	<?php if ( $blog_content->have_posts() ) : ?>

		<div id="blog-content-area" class="blog-content-area front-page-area">
			<div class="blog-wrapper">
					
				<?php // Blog area title and link.
					if( get_theme_mod( 'blog_area_title', esc_html__( 'Articles', 'munsa-lite' ) ) || ( get_theme_mod( 'blog_area_url' ) && get_theme_mod( 'blog_area_url_text' ) ) ) :
						
						echo '<div class="blog-title-wrapper">';
							
							// Featured are title.
							if( get_theme_mod( 'blog_area_title', esc_html__( 'Articles', 'munsa-lite' ) ) ) :
								echo '<h2 class="blog-title entry-title">' . get_theme_mod( 'blog_area_title', esc_html__( 'Articles', 'munsa-lite' ) ) . '</h2>';
							endif;
							
							// Featured are link
							if( get_theme_mod( 'blog_area_url' ) && get_theme_mod( 'blog_area_url_text' ) ) :
								echo '<a class="munsa-button blog-link" href="' . esc_url( get_theme_mod( 'blog_area_url' ) ) . '">' . esc_html( get_theme_mod( 'blog_area_url_text' ) ) . '</a>';
							endif;
							
						echo '</div><!-- .blog-title-wrapper -->';
							
					endif; // End featured are title and link
				?>
						
				<div class="blog-posts-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog">
					<?php while ( $blog_content->have_posts() ) : $blog_content->the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
							
							<?php if ( has_post_thumbnail() ) : ?>
								
								<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
									<?php the_post_thumbnail( 'munsa-smaller', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
								</a>
										
							<?php endif;  ?>
								
							<header class="entry-header">
								<?php the_title( sprintf( '<h3 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
								<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
							</header><!-- .entry-header -->
								
						</article><!-- #post-## -->
			
					<?php endwhile; ?>
				</div><!-- .blog-posts-wrapper -->

			</div><!-- .blog-wrapper -->
		</div><!-- .blog-content-area -->

	<?php
		endif; // End loop.
		wp_reset_postdata(); // Reset post data.
	?>

<?php elseif( current_user_can( 'publish_posts' ) ) : // If there are no content ?>
	<p class="no-content">
		<?php printf( wp_kses( __( 'Set Front Page Template content in the Customizer. Or <a href="%1$s">publish your first post here</a>.', 'munsa-lite' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
	</p>
<?php endif; ?>

</div><!-- .featured-area -->