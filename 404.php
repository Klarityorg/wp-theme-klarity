<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package klarity
 */

get_header();
?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main">

      <section class="error-404 not-found">
        <div class="page-content entry-content">
          <h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'klarity' ); ?></h2>
          <p><a href="/"><?php __('Go Home', 'klarity'); ?></a></p>

        </div><!-- .page-content -->
      </section><!-- .error-404 -->

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
