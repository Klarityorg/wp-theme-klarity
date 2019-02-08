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

<div class="col s12">
   <div class="card horizontal">
      <div class="card-image" style="margin: 10px;">
        <?php the_post_thumbnail('thumbnail'); ?>
      </div>
      <div class="card-stacked">
        <div class="card-content">
        <div class="entry-meta left-align">
            <?php
            klarity_posted_on();
            klarity_posted_by();
            ?>
        </div>
        <h3 class="header left-align"> <?php the_title( ) ?></h3>
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
