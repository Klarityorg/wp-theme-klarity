<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package klarity
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
  if (has_post_thumbnail()) { ?>
    <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot valign-wrapper">
      <div class="entry-content">
        <header class="entry-header"><?php
          if (is_singular()) :
            the_title('<h3 class="entry-title">', '</h3>');
          else :
            the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
          endif;
          if ('post' === get_post_type()) :?>
            <div class="entry-meta"><?php
              klarity_posted_on();
              klarity_posted_by(); ?>
            </div><!-- .entry-meta -->
          <?php endif; ?>
        </header><!-- .entry-header -->
      </div>
    </div>
    <div class="parallax"><?php
      the_post_thumbnail('post-thumbnail', [
          'alt' => the_title_attribute(['echo' => false])]
      ); ?>
    </div>
    </div><?php
  } ?>
  <div class="entry-content"><?php
    the_content(
      sprintf(
        wp_kses(
        /* translators: %s: Name of current post. Only visible to screen readers */
          __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'klarity'),
          ['span' => ['class' => []]]
        ),
        get_the_title()
      )
    );
    wp_link_pages([
      'before' => '<div class="page-links">' . esc_html__('Pages:', 'klarity'),
      'after' => '</div>',
    ]);
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
      comments_template();
    endif;
    if (function_exists('A2A_SHARE_SAVE_add_to_content')) {
      echo A2A_SHARE_SAVE_add_to_content('');
    } ?>
  </div><!-- .entry-content -->
  <footer class="entry-footer">
    <?php klarity_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
