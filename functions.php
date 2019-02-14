<?php
/**
 * klarity functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package klarity
 */

if ( ! function_exists( 'klarity_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function klarity_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on klarity, use a find and replace
		 * to change 'klarity' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'klarity', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'klarity' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'klarity_custom_background_args', array(
			'default-color' => 'FFFCFC',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'klarity_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function klarity_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'klarity_content_width', 640 );
}
add_action( 'after_setup_theme', 'klarity_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function klarity_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left', 'klarity' ),
		'id'            => 'first-footer-widget-area',
		'description'   => esc_html__( 'Add widgets here.', 'klarity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Center', 'klarity' ),
		'id'            => 'second-footer-widget-area',
		'description'   => esc_html__( 'Add widgets here.', 'klarity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right', 'klarity' ),
		'id'            => 'third-footer-widget-area',
		'description'   => esc_html__( 'Add widgets here.', 'klarity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'klarity_widgets_init' );


function create_copyright() {
	$all_posts = get_posts( 'post_status=publish&order=ASC' );
	$first_post = $all_posts[0];
	$first_date = $first_post->post_date_gmt;
	_e( 'Copyright &copy; ', 'klarity');
	if (strpos($first_date, date('Y')) === 0) {
	    echo date( 'Y' );
	} else {
	    echo substr( $first_date, 0, 4 ) . '-' . date( 'Y' );
	}
	echo ' <strong>' . get_bloginfo( 'name' ) . '</strong> ';
	_e( 'All rights reserved.', 'klarity' );
}

/**
 * Enqueue scripts and styles.
 */
function klarity_scripts() {
	wp_enqueue_style( 'klarity-style', get_stylesheet_uri(), [], time() );

	wp_enqueue_script( 'klarity-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

    wp_enqueue_script( 'klarity-materialize', get_template_directory_uri() . '/node_modules/materialize-css/dist/js/materialize.min.js', array('jquery'), false, true );

    wp_enqueue_script( 'klarity-init', get_template_directory_uri() . '/js/init.js', array('jquery'), time(), true );

    wp_enqueue_script( 'klarity-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'klarity_scripts' );

function add_theme_scripts() {
    wp_enqueue_style('klarity-style', get_template_directory_uri() . '/editor.css', [], time());
}
add_action('enqueue_block_editor_assets', 'add_theme_scripts');

// Remove AddToAny this we add it ourselves later
function addtoany_remove() {
    remove_filter( 'the_content', 'A2A_SHARE_SAVE_add_to_content', 98 );
}
add_action( 'pre_get_posts', 'addtoany_remove');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/scss_customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
