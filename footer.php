<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package klarity
 */

?>

<footer class="page-footer">
    <div class="container">
      <div class="row">
        <div class="col l4 s12">
        <?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
            <div id="first" class="widget-area">
                    <ul class="widget-list">
                            <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
                    </ul>
            </div><!-- #first .widget-area -->
	      <?php endif; ?>
        </div>
        <div class="col l4 s12">
        <?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
            <div id="second" class="widget-area">
                    <ul class="widget-list">
                            <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
                    </ul>
            </div><!-- #second .widget-area -->
	      <?php endif; ?>
        </div>
        <div class="col l4 s12">
        <?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
            <div id="third" class="widget-area">
                    <ul class="widget-list">
                            <?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
                    </ul>
            </div><!-- #third .widget-area -->
	      <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        <div class="row">
        <div class="col l6 s12">
          <?php create_copyright(); ?>
        </div>
        <div class="col l6 s12 power-link">
          <a href="https://www.klarity.org">Powered by Klarity</a>
        </div>
        </div>
      </div>
    </div>
  </footer>


  <?php wp_footer(); ?>

  </body>
</html>
