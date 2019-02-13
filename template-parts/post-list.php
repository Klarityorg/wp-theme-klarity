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
    $formated_date = get_the_date( 'j F Y', $post);
    preg_match('/videoThumbnail":"(.+)"/', $post->post_content, $matches);
    $image = $matches[1] ?? wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0] ?? '';
    if($image === '') $imageTag = ''; else $imageTag = '<img src="'.$image.'"/>';
 ?>
 <div class="post-list-container">
    <a href="<?php echo get_permalink($post) ?>">
      <div class="post">
        <div class="post-thumbnail">
          <?php echo $imageTag ?>
        </div>
        <div class="post-content">
          <div class="left-align">
            <p class="meta-data">Created <?php echo $formated_date ?> - <?php echo get_the_author_meta('display_name',$post->post_author) ?></p>
          </div>
          <h3 class="left-align"><?php echo $post->post_title ?></h3>
          <p><?php echo $content?></p>
        </div>
      </div>
    </a>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
