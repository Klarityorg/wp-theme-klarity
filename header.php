<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package klarity
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="navbar-fixed">
    <nav class="primary-background" role="navigation">
        <div class="nav-wrapper container">
            <?php the_custom_logo() ?>


            <ul id="nav-mobile" class="sidenav">
            <li class="nav-close-list-item"><a class="sidenav-close right" href="#!"><?php esc_html_e('close', 'klarity')?></a></li>
            <li><a href="/"><?php esc_html_e('Home', 'klarity')?></a></li>
                <?php
                    wp_nav_menu( [
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
												'link_after'			=> '<div class="nav-item-after-link"></div>',
                    ] );
                    ?>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger right"><?php esc_html_e('menu', 'klarity')?></a>
        </div>
      </nav>
    </div>
