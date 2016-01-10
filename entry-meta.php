<?php
/**
 * Entry meta.
 *
 * @package Munsa Lite
 */
?>

<?php if ( 'post' == get_post_type() || is_search() ) : ?>
	<div class="entry-meta">
		<?php munsa_lite_posted_on(); ?>
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( false, false, false, 'comments-link', false ); ?></span>
		<?php endif; ?>
	</div><!-- .entry-meta -->
<?php endif;