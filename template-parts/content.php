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

  <?php if(function_exists('bcn_display'))
  { ?>
    <div class="container breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
    <?php bcn_display(); ?>
    </div><?php
  }?>
  <div class="entry-content">
    <header class="entry-header">
      <?php
      if ( is_singular() ) :
        the_title( '<h3 class="entry-title">', '</h3>' );
      else :
        the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
      endif;

      if ( 'post' === get_post_type() ) :
        ?>
        <div class="entry-meta shade" style="text-align: center">
          <?php
          klarity_posted_on();
          klarity_entry_footer();
          klarity_posted_by();
          ?>
        </div><!-- .entry-meta -->
      <?php endif; ?>
    </header><!-- .entry-header -->

		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'klarity' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
      comments_template();
    endif;

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'klarity' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->


