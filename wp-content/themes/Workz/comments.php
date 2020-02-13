<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','workz'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ( comments_open() ) : ?>
<div id="commentsbox">
    <h3 id="comments">
        <?php _e('This Post Has', 'workz'); ?> <?php comments_number(__('0 Comments', 'workz'), __('1 Comment', 'workz'), __('% Comments', 'workz') );?>
    </h3>

<?php if ( have_comments() ) : ?>
<ol class="commentlist">
<?php wp_list_comments(
	array(
		'avatar_size' => 40,
	));
?>
</ol>

<div class="comment-nav">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>

<?php endif; ?>
<?php else :
// comments are closed ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="comment-form">

<div id="respond" >

<h3 id="comments-respond"><?php _e('Leave A Reply','workz') ?></h3>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php _e('You must be','workz'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','workz'); ?></a><?php _e(' to post a comment.','workz'); ?></p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p id="comments-respond-meta"><?php _e('Logged in as','workz'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','workz'); ?>"><?php _e('Log out','workz'); ?> &raquo;</a></p>

<?php else : ?>
<input type="text" name="author" id="author" value="<?php if ($comment_author == '') { echo _e('Username', 'workz' ); echo '*'; } elseif ($comment_author >= '') { echo $comment_author; } ?>" onfocus="if(this.value=='<?php _e('Username', 'workz' ); ?>*')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Username', 'workz' ); ?>*';" size="22" tabindex="1" />
<br />
<input type="text" name="email" id="email" value="<?php if ($comment_author_email == '') { echo _e('Email', 'workz' ); echo '*'; } elseif ($comment_author_email >= '') { echo $comment_author_email; } ?>" onfocus="if(this.value=='<?php _e('Email', 'workz' ); ?>*')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Email', 'workz' ); ?>*';" size="2" tabindex="2" />
<br />
<input type="text" name="url" id="url" value="<?php if ($comment_author_url == '') { echo _e('Website', 'workz' ); } elseif ($comment_author_url >= '') { echo $comment_author_url; } ?>" onfocus="if(this.value=='<?php _e('Website', 'workz' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Website', 'workz' ); ?>';" size="2" tabindex="3" />
<br />

<?php endif; ?>

<textarea name="comment" id="comment" rows="10" tabindex="4"></textarea><br />

<button type="submit" id="commentSubmit" class="button light-gray"><span><?php _e('Add Comment', 'workz' ); ?></span></button>
<input name="submit" type="hidden" tabindex="5" value="<?php _e('Add Comment', 'workz' ); ?>" />

<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif;
// registration required and not logged in ?>

</div>
</div>
</div>
<?php else :
// comments are closed ?>
<?php endif;
// delete me and the sky will fall on your head ?>