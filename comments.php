<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 * @package Flexline
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() )
    return;
        ?><ol id="flexlineComm" class="commentlist" itemscope="commentText" 
                                  itemtype="https://schema.org/UserComments">
        <?php
            wp_list_comments( array(
                'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) );
        ?></ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

	<ul id="comment-nav-below" class="navigation comment-navigation">
		<ul class="pager">
			<li class="previous"><?php previous_comments_link( esc_attr__("&laquo; Older Comments", "flexline") ); ?></li>
			<li class="next"><?php next_comments_link( esc_attr__("Newer Comments &raquo;", "flexline") ); ?></li>
		</ul>
	</ul>
	
<?php endif; ?>

    <?php do_action( 'flexline_comment_login' ); ?> 
