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
 * @param string  $comment
 * @param array   $args
 * @param integer $depth
 */
function klarity_format_comment($comment, $args, $depth) {
  ?>
  <li class="<?php echo esc_attr(implode(' ', [$depth === 1 ? 'card' : ''] + get_comment_class())) ?>" id="comment-<?php comment_ID() ?>">

    <div class="comment-intro">
      <div class="comment-author"><?php echo esc_html($comment->comment_author) ?>
      </div>
      <div class="comment-time">
        <?php printf('%s ago', esc_html(human_time_diff(get_comment_time('U'), current_time('timestamp')))); ?>
      </div>
    </div>

    <?php if ($comment->comment_approved === '0') { ?>
      <em><?php esc_html_e('Your comment is awaiting moderation.', 'klarity') ?></em><br/>
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
if (post_password_required()) {
  return;
} ?>
<div id="comments" class="comments-area">
  <h3 class="comments-title">
    <?php esc_html_e('Leave a comment', 'klarity') ?>
  </h3><?php
  // You can start editing here -- including this comment!
  if (have_comments()) : ?>
    <div>
      <ol class="comment-list">
        <?php
        wp_list_comments([
          'callback' => 'klarity_format_comment',
          'style' => 'ol',
          'short_ping' => true,
          'reverse_top_level' => true,
        ]);
        ?>
      </ol><!-- .comment-list -->
      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <div class="comments-navigation">
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'klarity' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'klarity' ) ); ?></div>
      </div>
      <?php endif; // Check for comment navigation ?>

      <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'klarity' ); ?></p>
      <?php endif; ?>
    </div>
    <?php
    if (!comments_open()) :?>
      <p class="no-comments"><?php esc_html_e('Comments are closed.', 'klarity'); ?></p><?php
    endif;
  endif; // Check for have_comments().
  comment_form([
    'label_submit' => __('Comment', 'klarity'),
    'submit_button' => '
      <p class="comment-notes">
        <span id="email-notes">' . __('Your email address will not be published.', 'klarity') . '</span> '
        .__('Required fields are marked <span class="required">*</span>', 'klarity')
    .'</p>
      <input name="%1$s" type="submit" id="%2$s" class="btn %3$s" value="%4$s" />',
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __('Comment', 'klarity') . ' *</label> <textarea id="comment" class="materialize-textarea" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
    'comment_notes_before' => '',
  ]);
  ?>

</div><!-- #comments -->
