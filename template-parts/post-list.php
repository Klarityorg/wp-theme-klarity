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
<div class="col s12" style="margin-top: 24px;">
<div class="card horizontal" onclick="window.location.href = '<?= esc_url( get_permalink() )?>'">
      <div class="card-stacked">
        <div class="card-content">
            <?php

              if ( 'post' === get_post_type() ) :
                ?>
                  <div class="entry-meta left-align hide-on-med-and-down shade">
                  <?php
                    klarity_posted_on();
                    klarity_posted_by();
                  ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        <h3 class="header left-align" style="margin-top: 0px; margin-bottom: 0px;"> <?php the_title( ) ?></h3>
        <?php
        	if ( 'post' === get_post_type() ) :
                ?>
             
                <?php 
                endif; 
                the_excerpt()
        
		?>
        </div>
      </div>
    </div>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
