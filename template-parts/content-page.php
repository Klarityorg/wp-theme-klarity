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
  if (has_post_thumbnail() ) {
  ?>
    <div id="index-banner" class="parallax-container">
      <div class="section no-pad-bot valign-wrapper">
        <div class="entry-content">
          <header class="entry-header">
            <?php
            if ( is_singular() ) :
              the_title( '<h1 class="entry-title">', '</h1>' );
            else :
              the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ( 'post' === get_post_type() ) :
              ?>
              <div class="entry-meta">
                <?php
                klarity_posted_on();
                klarity_posted_by();
                ?>
              </div><!-- .entry-meta -->
            <?php endif; ?>
          </header><!-- .entry-header -->
        </div>
      </div>
      <div class="parallax">
      <?php
        the_post_thumbnail( 'post-thumbnail', array(
            'alt' => the_title_attribute(array('echo' => false)))
          );
        ?></div>
    </div>
  <?php
  }
  ?>

  <div class="entry-content">
    <?php
      $post_content = get_the_content( get_the_ID() ); // Get the post_content

      the_content(
        sprintf(
          wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'klarity' ),
            array(
              'span' => array('class' => array()),
            )
          ),
          get_the_title()
        )
      );

      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'klarity' ),
        'after'  => '</div>',
      ) );
    ?>
  </div><!-- .entry-content -->
  <footer class="entry-footer">
    <?php klarity_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
