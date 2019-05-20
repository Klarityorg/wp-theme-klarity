<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package klarity
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    $content = wp_trim_words($post->post_content, $num_words = 100 );
    $formated_date = get_the_date( get_option( 'date_format' ), $post);
    preg_match('/videoThumbnail":"(.+)"/', $post->post_content, $matches);
    if (!is_null($matches[1])) {
		  $image = $matches[1];
    }
    else {
      $attachmentImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0];
      if (!is_null($attachmentImage)) {
		    $image = $attachmentImage;
      }
      else {
        $image = '';
      }
    }
 ?>
 <div class="post-list-container">
    <a href="<?php echo esc_html(get_permalink($post)) ?>">
      <div class="post">
        <div class="post-thumbnail">
          <?php if($image !== '') {
            ?><img src="<?php echo esc_html($image) ?>"/><?php
          } ?>
        </div>
        <div class="post-content">
          <div class="left-align">
            <p class="meta-data"><?php echo esc_html__( 'Created ', 'klarity' ).esc_html($formated_date) ?> - <?php echo esc_html( get_the_author_meta('display_name',$post->post_author)) ?></p>
          </div>
          <h3 class="left-align"><?php echo esc_html($post->post_title) ?></h3>
          <p><?php echo esc_html($content) ?></p>
          <div class="action">
            <p>Read more</p>
          </div>
        </div>
      </div>
    </a>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
