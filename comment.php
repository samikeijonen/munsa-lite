<?php
/**
 * The template for displaying comment.
 *
 * @package Munsa Lite
 */
?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> <?php hybrid_attr( 'comment' ); ?>>

	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

		<div class="comment-content" <?php hybrid_attr( 'comment-content' ); ?>>
			
			<?php if ( get_option( 'show_avatars' ) ) : ?>
				<div class="comment-avatar-wrapper">
					<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
			<?php endif; ?>
			
			<div class="comment-content-wrapper">
			
				<p class="comment-meta">
					<cite class="comment-author" <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite>
					<a class="comment-permalink" <?php hybrid_attr( 'comment-permalink' ); ?> href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>"><time class="comment-published" datetime="<?php comment_time( 'c' ); ?>" <?php hybrid_attr( 'comment-published' ); ?>><?php printf( _x( '%1$s', '%1%s is for comment date', 'munsa-lite' ), get_comment_date() ); ?></time></a>
				</p><!-- .comment-meta -->
			
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p>	
						<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'munsa-lite' ); ?></em>
					</p>
				<?php endif; ?>
				
				<?php comment_text(); ?>
				
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<p class="reply comment-meta">', 'after' => '</p><!-- .reply -->' ) ) ); ?>
				
				<?php edit_comment_link( null, '<p class="comment-meta">', '</p>' ); ?>
		
			</div><!-- .comment-content-wrapper -->
			
		</div><!-- .comment-content -->
		
	</article><!-- .comment-body -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>