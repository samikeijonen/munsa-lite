<?php
/**
 * Template part for displaying archive headers.
 *
 * @package Munsa Lite
 */

?>

<?php
	// Archive title and description.
	$archive_title = get_the_archive_title();
	$desc          = get_the_archive_description();	
?>

<header class="archive-header" <?php hybrid_attr( 'archive-header' ); ?>>

	<h1 class="archive-title" <?php hybrid_attr( 'archive-title' ); ?>><?php echo $archive_title; ?></h1>

	<?php if ( ! is_paged() && $desc ) : // Check if we're on page/1. ?>

		<div class="archive-description" <?php hybrid_attr( 'archive-description' ); ?>>
			<?php echo $desc; ?>
		</div><!-- .archive-description -->

	<?php endif; // End paged check. ?>

</header><!-- .archive-header -->