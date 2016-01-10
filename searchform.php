<?php
/**
 * Template for displaying search forms.
 *
 * @package Munsa Lite
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'munsa-lite' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'munsa-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'munsa-lite' ); ?>" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'munsa-lite' ); ?></span></button>
</form>
