<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package klarity
 */

/**
 * @param string $comment
 * @param array $args
 * @param integer $depth
 */
function format_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>

    <li class="<?=implode(' ', [$depth === 1 ? 'card' :  ''] + get_comment_class())?>" id="comment-<?php comment_ID() ?>">

        <div class="comment-intro">
            <div class="comment-author"><?=$comment->comment_author?>
            </div>
            <div class="comment-time">
                <?php printf(_x('%s ago', '%s = human-readable time difference', 'your-text-domain'), human_time_diff(get_comment_time('U'), current_time('timestamp'))); ?>
            </div>
        </div>

        <?php if ($comment->comment_approved === '0') { ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em><br/>
        <?php } ?>

        <?php comment_text(); ?>

        <div class="reply">
            <?php comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']])) ?>
        </div>

    <?php }
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>
<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
        ?>
        <h4 class="comments-title">
            <?=__('Share your thoughts')?>
        </h4>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'callback' => 'format_comment',
                'style'      => 'ol',
                'short_ping' => true,
            ) );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'klarity' ); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().

    comment_form([
        'label_submit' => __('Comment'),
        'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="btn %3$s" value="%4$s" />',
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') . ' *</label> <textarea id="comment" class="materialize-textarea" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>'
    ]);
    ?>

</div><!-- #comments -->
