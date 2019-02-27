<?php

// "Comment has been sent" section : set a cookie if a cookie is pending approval
add_action('set_comment_cookies',
  function($comment, $user) {
    if (!$comment->comment_approved) {
      setcookie( 'ta_comment_wait_approval', '1' );
    }
  }, 10, 2
);

// "Comment has been sent" section : if a cookie is set, add a text saying it
add_action('init',
  function() {
    if(isset($_COOKIE['ta_comment_wait_approval']) && $_COOKIE['ta_comment_wait_approval'] === '1' ) {
      setcookie( 'ta_comment_wait_approval', null, time() - 3600, '/' );
      add_action( 'comment_form_before', function() {
        echo '<p id="wait-approval" class="commment-wait-approval"><strong>'.__('Your comment has been sent successfully.', 'klarity').'</strong></p>';
      });
    }
  }
);

// "Comment has been sent" section : add the anchor of the text to the URL
add_filter( 'comment_post_redirect', function($location, $comment ) {
  if (!$comment->comment_approved) {
    $location = get_permalink( $comment->comment_post_ID ).'#wait-approval';
  }
  return $location;
}, 10, 2 );
