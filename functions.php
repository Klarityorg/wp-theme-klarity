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
			'menu-1' => __( 'Primary', 'klarity' ),
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

add_action('after_setup_theme',
  /**
   * Set the content width in pixels, based on the theme's design and stylesheet.
   * Priority 0 to make it available to lower priority callbacks.
   * @global int $content_width
   */
  function () {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'klarity_content_width', 640 );
  }, 0
);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function klarity_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Left', 'klarity' ),
        'id'            => 'first-footer-widget-area',
        'description'   => __( 'Add widgets here.', 'klarity' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Center', 'klarity' ),
        'id'            => 'second-footer-widget-area',
        'description'   => __( 'Add widgets here.', 'klarity' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Right', 'klarity' ),
        'id'            => 'third-footer-widget-area',
        'description'   => __( 'Add widgets here.', 'klarity' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action('widgets_init', 'klarity_widgets_init');

function klarity_show_copyright() {
	$all_posts = get_posts( 'post_status=publish&order=ASC' );
	if (count($all_posts) === 0) {
	  echo date('Y');
  }
  else {
		$first_post = $all_posts[0];
		$first_date = $first_post->post_date_gmt;
		__('Copyright &copy; ', 'klarity');
		$date = strpos($first_date, date('Y')) === 0
			? date('Y')
			: substr($first_date, 0, 4) . '-' . date('Y');
		echo $date;
	}
  ?>&nbsp;<strong><?php
    $blogName = get_bloginfo('name');
    echo esc_html(empty($blogName) ? '' : $blogName, 'klarity')?>
  </strong><?php
  esc_html_e( 'All rights reserved.', 'klarity' );
}


/**
 * Enqueue scripts and styles.
 */
function klarity_enqueue_scripts() {
    wp_enqueue_style( 'klarity-style', get_stylesheet_uri(), [], time() );

    wp_enqueue_script( 'klarity-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), filemtime(get_template_directory() . '/js/navigation.js'), true );

    //wp_enqueue_script( 'klarity-materialize', get_template_directory_uri() . '/node_modules/materialize-css/dist/js/materialize.min.js', array('jquery'), filemtime(get_template_directory() . '/node_modules/materialize-css/dist/js/materialize.min.js'), true );
    wp_enqueue_script( 'klarity-materialize', get_template_directory_uri() . '/js/materialize.min.js', array('jquery'), filemtime(get_template_directory() . '/js/materialize.min.js'), true );

    wp_enqueue_script( 'klarity-init', get_template_directory_uri() . '/js/init.js', array('jquery'), filemtime(get_template_directory() . '/js/init.js'), true );

    wp_enqueue_script( 'klarity-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), filemtime(get_template_directory() . '/js/skip-link-focus-fix.js'), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action('wp_enqueue_scripts', 'klarity_enqueue_scripts');


function klarity_editor_assets() {
    wp_enqueue_style('klarity-style', get_template_directory_uri() . '/editor.css', [], time());
}
add_action('enqueue_block_editor_assets', 'klarity_editor_assets');

// Remove AddToAny : we add it ourselves later
function klarity_remove_add_to_any() {
    remove_filter( 'the_content', 'A2A_SHARE_SAVE_add_to_content', 98 );
}
add_action('pre_get_posts', 'klarity_remove_add_to_any');

/**
 * "Your comment has been sent" message.
 */
//require get_template_directory() . '/inc/comment-approval.php';

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

require_once get_template_directory() . '/TGMPA/auto-install-plugins.php';

function klarity_mytheme_setup_options ()
{
    //doing a thing...
    if (version_compare(PHP_VERSION, '7.0.0') < 0) {
        $msg1 = esc_html__('Warning: Your current PHP version ', 'klarity');
        $msg2 = esc_html__(' is lower than 7.0, which is not suitable for Klarity theme', 'klarity');
        echo "<script type='text/javascript'>alert('". $msg1. PHP_VERSION . $msg2. "');</script>";
    }
}
add_action('after_switch_theme', 'klarity_mytheme_setup_options');

/*--------------------------------------------------------------
# Custom code new design 2019/05/10
--------------------------------------------------------------*/

const CASE_STATUS_RESOLVED = "resolved";
const CASE_STATUS_UNRESOLVED = "unresolved";

const CASE_STATUS_FIELD_UNRESOLVED = "ongoing";
const CASE_STATUS_FIELD_RESOLVED = "resolved";

const ACTION_STATUS_OPEN = "open";
const ACTION_STATUS_CLOSED = "closed";
const ACTION_TYPE_EMAIL = "email";
const ACTION_TYPE_PETITION = "petition";

//definied action network api key in wp-config, use document for implement this
if (!defined('ACTION_NETWORK_API_KEY')) {
    define( 'ACTION_NETWORK_API_KEY', '' );
}

//add font awesome
add_action( 'wp_enqueue_scripts', 'klarity_enqueue_load_fa' );
function klarity_enqueue_load_fa() {
    wp_enqueue_style( 'load-fa', get_template_directory_uri() . '/css/font-awesome/all.min.css' );
}
//add excerpt for page
add_post_type_support( 'page', 'excerpt' );

// comment form fields re-defined:
add_filter( 'comment_form_default_fields', 'klarity_mo_comment_fields_custom_html' );
function klarity_mo_comment_fields_custom_html( $fields ) {
    if(isset($commenter) && isset($aria_req) && isset($html_req) && isset($html5))
    {
        // first unset the existing fields:
        unset( $fields['comment'] );
        unset( $fields['author'] );
        unset( $fields['email'] );
        // then re-define them as needed:
        $fields = [
            'comment_field' => '<p class="comment-form-comment">' .
                '<textarea id="comment" placeholder="' . __( 'Your Comment*', 'klarity'  ) .'" name="comment" cols="45" rows="4" maxlength="65525" aria-required="true" required="required"></textarea></p>',
            'author' => '<p class="comment-form-author">' .
                '<input id="author" placeholder="' . __( 'Name*', 'klarity'  ) .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
            'email'  => '<p class="comment-form-email">' .
                '<input id="email" placeholder="' . __( 'Your Email Address*', 'klarity'  ) .'" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
        ];
    }
    // done customizing, now return the fields:
    return $fields;
}
// remove default comment form so it won't appear twice
add_filter( 'comment_form_fields', 'klarity_mo_remove_default_comment_field', 10, 1 );
function klarity_mo_remove_default_comment_field( $fields ) {
    if ( isset( $fields[ 'comment_field' ] ) ) {
        if(!is_user_logged_in()){
            unset($fields['comment']);
        }
        else{
            $fields['comment'] = $fields[ 'comment_field' ];
        }
    }
    return $fields;
}

function klarity_container_action($sublist, $thumbnail, $headline, $title, $short_description, $link, $readmore, $tag){
    $content = <<<EOT
                    <div class="container-action $sublist">
                        <div class="thumbnail-img">$thumbnail</div>
                        <div class="content-action">
                            <p class="action-headline">$headline</p>
                            <h2>$title</h2>
                            <p class="short-description-action">$short_description</p>
                            <p class="action-read-more"><a href="$link" class="after-angle-down">$readmore &#8594;</a></p>                          
                        </div>
                        $tag                        
                    </div>
                    <div class="line-action"><hr></div>            
EOT;
    return $content;
}

add_action('wp_head', 'klarity_ajaxurl');
function klarity_ajaxurl() {
    global $post;
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
           var post_id = "'. $post->ID .'";
         </script>';
}

//add to cart ajax
add_action( 'wp_ajax_klarity_count_all_tabs', 'klarity_count_all_tabs' );
add_action( 'wp_ajax_nopriv_klarity_count_all_tabs', 'klarity_count_all_tabs' );

function klarity_count_all_tabs() {
    if(isset($_POST['post_id']))
    {
        $post_id = $_POST['post_id'];
    }
    else
    {
        global $post;
        $post_id = $post->ID;
    }
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => $post_id,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    );
    $cases_children = new WP_Query( $args );
    $number_personal_involved = 0;
    if ( $cases_children->have_posts() ) {
        while ($cases_children->have_posts()) {
            $cases_children->the_post();
            //exclude impact
            if (count(get_post_meta(get_the_ID(), 'case_status')) === 0) {
                continue;
            }
            $number_personal_involved++;
        }
    }
    wp_reset_postdata();

    //load number action
    $args = array(
        'post_type'    => 'page',
        'post_status' => 'publish',
        'post_parent'    => $post_id,
        'posts_per_page'   => -1
    );
    $number_actions = 0;
    $pages = new WP_Query ( $args );
    if ( $pages->have_posts() ) {
        while ($pages->have_posts()) {
            $pages->the_post();
            if(count(get_post_meta(get_the_ID(), 'action_status')) === 0){
                continue;
            }
            //load all action status is closed
            if(get_post_meta(get_the_ID(), 'action_status',true) === ACTION_STATUS_CLOSED){
                $action_types = explode(',', get_post_meta(get_the_ID(), 'action_type',true));
                $number_actions+=count($action_types);
            }
        }
    }
    wp_reset_postdata();



    if($number_personal_involved === 0)
        $number_personal_involved = '';
    if($number_actions === 0)
        $number_actions = '';

    $result = array('personal_involved' => $number_personal_involved, 'number_actions' => $number_actions, 'comments' => get_comments_number($post_id));
    echo json_encode($result);
    wp_die();
}

function klarity_sub_words($str, $start = 0, $length = 0){
    $words = explode(' ', $str);
    $len_word = count($words);
    $result = "";
    if($length === 0){
        $length = $len_word;
    } elseif ($length > $len_word){
        $length = $len_word;
    }
    if($len_word < $start)
    {
        return "";
    }
    elseif ($len_word > $start)
    {
        for($i = $start; $i < $length; $i++){
            $result .= $words[$i]. " ";
        }
        return $result;
    }
}

//add to cart ajax
add_action( 'wp_ajax_klarity_get_signature_after_load', 'klarity_get_signature_after_load' );
add_action( 'wp_ajax_nopriv_klarity_get_signature_after_load', 'klarity_get_signature_after_load' );

function klarity_get_signature_after_load() {
    if(isset($_POST['api_endpoint']))
    {
        $api_endpoint = $_POST['api_endpoint'];
        $result = klarity_get_signature_from_action_network($api_endpoint);
        echo $result['body'];
        wp_die();
    }
}

function klarity_get_signature_from_action_network($api_endpoint){
    $args = array(
        'headers'     => array(
            'OSDI-API-Token' => ACTION_NETWORK_API_KEY,
            'Content-Type' => 'application/json'
        ),
        'method' => 'GET'
    );
    $result = wp_remote_get( $api_endpoint.'signatures', $args );
    return $result;
}