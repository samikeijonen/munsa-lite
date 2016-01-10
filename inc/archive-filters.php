<?php
/**
 * Filters archive title and description.
 *
 * @package Munsa Lite
 */

/**
 * Filters `get_the_archve_title` to add better archive titles than core.
 *
 * @since  1.0.0
 *
 * @param  string  $title
 * @return string
 */
function munsa_lite_archive_title_filter( $title ) {

	if ( is_home() && ! is_front_page() ) {
		$title = get_post_field( 'post_title', get_queried_object_id() );
	}

	elseif ( is_category() ) {
		$title = single_cat_title( '', false );
	}

	elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	}

	elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	elseif ( is_author() ) {
		$title = get_the_author_meta( 'display_name', absint( get_query_var( 'author' ) ) );
	}
	
	elseif ( is_search() ) {
		$title = sprintf( esc_html__( 'Search results for &#8220;%s&#8221;', 'munsa' ), get_search_query() );
	}

	elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	elseif ( is_month() ) {
		$title = single_month_title( ' ', false );
	}

	return apply_filters( 'munsa_lite_archive_title', $title );
}
add_filter( 'get_the_archive_title', 'munsa_lite_archive_title_filter', 5 );

/**
 * Filters `get_the_archve_description` to add better archive descriptions than core.
 *
 * @since  1.0.0
 *
 * @param  string  $desc
 * @return string
 */
function munsa_lite_archive_description_filter( $desc ) {

	if ( is_home() && ! is_front_page() ) {
		$desc = get_post_field( 'post_content', get_queried_object_id(), 'raw' );
	}

	elseif ( is_category() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), 'category', 'raw' );
	}

	elseif ( is_tag() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), 'post_tag', 'raw' );
	}

	elseif ( is_tax() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), get_query_var( 'taxonomy' ), 'raw' );
	}
	
	elseif ( is_author() ) {
		$desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	}

	elseif ( is_post_type_archive() ) {
		$desc = get_post_type_object( get_query_var( 'post_type' ) )->description;
	}

	return apply_filters( 'munsa_lite_archive_description', $desc );
}
add_filter( 'get_the_archive_description', 'munsa_lite_archive_description_filter', 5 );