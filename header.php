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
            <?php echo the_custom_logo() ?>

             <ul class="right hide-on-med-and-down">
                <?php
                    wp_nav_menu( [
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                    ] );
                    ?>
             </ul>

            <ul id="nav-mobile" class="sidenav" style="padding-top: 10px;">
            <li><a class="sidenav-close right" href="#!"  style="width: 40px; margin-right: 35px;"><i class="material-icons">close</i></a></li>
            <li>&nbsp;</li>
            <li><a href="/">Home</a></li>
                <?php
                    wp_nav_menu( [
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                    ] );
                    ?>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
        </div>
      </nav>
    </div>
