<article <?php comment_class() ?> id="comment-<?php comment_ID() ?>">

	<header class="author-meta">
		<span class="author-thumb"><?php print get_avatar( $comment, '38'); ?></span>
		<span class="meta">
			<a class="author" rel="author" href="#"><?php print $comment->comment_author; ?> </a>
			<time datetime="<?php echo $comment->comment_date; ?>"><?php print timeAgo($comment->comment_date); ?> ago</time>
		</span>
	</header>

	<?php comment_text(); ?>

<?php if ( is_user_logged_in() ) : ?>
    <footer class="comment-footer">
        <?php comment_reply_link( array( 'add_below' => 'comment', 'depth' => '1', 'max_depth' => '2' ) ); ?>
        <?php edit_comment_link( __( 'Edit' ), '  ', '' ); ?>
    </footer>
<?php endif; ?>

</article>
