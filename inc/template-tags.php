<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Munsa Lite
 */

if ( ! function_exists( 'munsa_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function munsa_lite_posted_on() {

	// Set up entry date.
	printf( '<span class="entry-date"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" ' . hybrid_get_attr( 'entry-published' ) . '>%4$s</time></a></span>',
		esc_html_x( 'Posted on', 'Used before publish date.', 'munsa' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	
	// Set up byline.
	printf( '<span class="byline"><span class="entry-author" ' . hybrid_get_attr( 'entry-author' ) . '><span class="screen-reader-text">%1$s </span><a class="entry-author-link" href="%2$s" rel="author" itemprop="url"><span itemprop="name">%3$s</span></a></span></span>',
		esc_html_x( 'Author', 'Used before post author name.', 'munsa' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);

}
endif;

/**
 * This template tag is meant to replace template tags like `the_category()`, `the_terms()`, etc.  These core 
 * WordPress template tags don't offer proper translation and RTL support without having to write a lot of 
 * messy code within the theme's templates.  This is why theme developers often have to resort to custom 
 * functions to handle this (even the default WordPress themes do this). Particularly, the core functions 
 * don't allow for theme developers to add the terms as placeholders in the accompanying text (ex: "Posted in %s"). 
 * This funcion is a wrapper for the WordPress `get_the_terms_list()` function.  It uses that to build a 
 * better post terms list.
 *
 * @author  Justin Tadlock
 * @link    https://github.com/justintadlock/hybrid-core/blob/2.0/functions/template-post.php
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since   1.0.0
 * @param   array   $args
 * @return  string
 */
function munsa_lite_get_post_terms( $args = array() ) {

	$html = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'items_wrap' => '<span %s>%s</span>',
		/* Translators: Separates tags, categories, etc. when displaying a post. */
		'sep'        => _x( ' #', 'taxonomy terms separator', 'munsa' )
	);

	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	if ( !empty( $terms ) ) {
		$html .= $args['before'];
		$html .= sprintf( $args['items_wrap'], 'class="entry-terms ' . $args['taxonomy'] . '" ' . hybrid_get_attr( 'entry-terms', $args['taxonomy'] ) . '', sprintf( $args['text'], $terms ) );
		$html .= $args['after'];
	}

	return $html;
}

/**
 * Outputs a post's taxonomy terms.
 *
 * @since  1.0.0
 * @access public
 * @param  array   $args
 * @return void
 */
function munsa_lite_post_terms( $args = array() ) {
	echo munsa_lite_get_post_terms( $args );
}

if ( ! function_exists( 'munsa_lite_get_post_thumbnail' ) ) :
/**
 * Get post thumbnail URL.
 *
 * @since 1.0.0
 */
function munsa_lite_get_post_thumbnail( $post_thumbnail = null, $id = null ) {
	
	// Set default size.
	if ( null === $post_thumbnail ) {
		$post_thumbnail = 'post-thumbnail';
	}
	
	// Set default ID.
	if ( null === $id ) {
		$id = get_the_ID();
	}
	
	// Return post thumbnail url if it's set, else return false.
	if ( has_post_thumbnail( $id ) ) {
		$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), esc_attr( $post_thumbnail ), true );
		$bg              = $thumb_url_array[0];
	} else {
		$bg = false;
	}
	
	return $bg;
}
endif;

if ( ! function_exists( 'munsa_lite_post_thumbnail' ) ) :
/**
 * Display a post thumbnail if it is set.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since 1.0.0
 */
function munsa_lite_post_thumbnail( $post_thumbnail = null ) {
	
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	
	// Set default size.
	if ( null === $post_thumbnail ) {
		$post_thumbnail = 'post-thumbnail';
	}

	if ( is_singular() && ! is_page_template( 'pages/contact-info.php' ) && ! is_page_template( 'pages/child-pages.php' ) ) :
	?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail( esc_attr( $post_thumbnail ) ); ?>
		</div><!-- .post-thumbnail -->

	<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( esc_attr( $post_thumbnail ), array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</a>

	<?php endif; // End is_singular()
}
endif;

/**
 * Returns featured pages selected from the Customizer.
 *
 * @since  1.0.0
 *
 * @return array
 */
function munsa_lite_featured_pages() {
	
	$k = 1;
	
	// Set empty array of featured pages.
	$munsa_lite_featured_pages = array();
	
	// Loop all the featured pages.
	while ( $k < apply_filters( 'munsa_lite_how_many_pages', 7 ) ) { // Begins the loop through found pages from customize settings. 
	
		$munsa_lite_page_id = absint( get_theme_mod( 'featured_page_' . $k ) );
			
			// Add selected featured pages in array.
			if ( 0 != $munsa_lite_page_id || ! empty( $munsa_lite_page_id ) ) { // Check if page is selected.
				$munsa_lite_featured_pages[] = $munsa_lite_page_id;
			}
	
		$k++;
	
	}
	
	// Return featured pages.
	return $munsa_lite_featured_pages;
	
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function munsa_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'munsa_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'munsa_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so munsa_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so munsa_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in munsa_lite_categorized_blog.
 */
function munsa_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'munsa_lite_categories' );
}
add_action( 'edit_category', 'munsa_lite_category_transient_flusher' );
add_action( 'save_post',     'munsa_lite_category_transient_flusher' );
