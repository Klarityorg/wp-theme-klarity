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

add_action('widgets_init',
  /**
   * Register widget area.
   *
   * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
   */
  function () {
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
);

function klarity_show_copyright() {
	$all_posts = get_posts( 'post_status=publish&order=ASC' );
	if (count($all_posts) === 0) {
	  echo esc_html(date('Y'));
  }
  else {
		$first_post = $all_posts[0];
		$first_date = $first_post->post_date_gmt;
		__('Copyright &copy; ', 'klarity');
		$date = strpos($first_date, date('Y')) === 0
			? date('Y')
			: substr($first_date, 0, 4) . '-' . date('Y');
		echo esc_html($date);
	}
  ?>&nbsp;<strong><?php
    $blogName = get_bloginfo('name');
    echo esc_html(empty($blogName) ? '' : $blogName, 'klarity')?>
  </strong><?php
  esc_html_e( 'All rights reserved.', 'klarity' );
}

add_action('wp_enqueue_scripts',
  /**
   * Enqueue scripts and styles.
   */
  function () {
    wp_enqueue_style( 'klarity-style', get_stylesheet_uri(), [], time() );

    wp_enqueue_script( 'klarity-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), filemtime(get_template_directory() . '/js/navigation.js'), true );

    wp_enqueue_script( 'klarity-materialize', get_template_directory_uri() . '/node_modules/materialize-css/dist/js/materialize.min.js', array('jquery'), filemtime(get_template_directory() . '/node_modules/materialize-css/dist/js/materialize.min.js'), true );

    wp_enqueue_script( 'klarity-init', get_template_directory_uri() . '/js/init.js', array('jquery'), filemtime(get_template_directory() . '/js/init.js'), true );

    wp_enqueue_script( 'klarity-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), filemtime(get_template_directory() . '/js/skip-link-focus-fix.js'), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
);

add_action('enqueue_block_editor_assets',
  function () {
    wp_enqueue_style('klarity-style', get_template_directory_uri() . '/editor.css', [], time());
  }
);

add_action('pre_get_posts',
  // Remove AddToAny : we add it ourselves later
  function() {
    remove_filter( 'the_content', 'A2A_SHARE_SAVE_add_to_content', 98 );
  }
);

/**
 * "Your comment has been sent" message.
 */
require get_template_directory() . '/inc/comment-approval.php';

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

//add font awesome
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
    wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css' );
//    wp_enqueue_style( 'load-lato', 'https://fonts.googleapis.com/css?family=Lato' );
//    wp_enqueue_style( 'load-unna', 'https://fonts.googleapis.com/css?family=Unna' );
}

//short code for all case
add_shortcode( 'all_cases', 'all_cases_shortcode' );
function all_cases_shortcode($attrs = array(), $content = ''){

    $frontpage_id = get_option( 'page_on_front' );
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => $frontpage_id,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    );

    $cases_children = new WP_Query( $args );
    $content = "";
    if ( $cases_children->have_posts() ){
        while ( $cases_children->have_posts() ) {
            $cases_children->the_post();
            //exclude impact
            if(count(get_post_meta(get_the_ID(), 'case_status')) == 0){
                continue;
            }
            $thumbnail = get_the_post_thumbnail(null, 'medium');
            $title = get_the_title();
            $case_num = "Coming soon";
            //get case children
            $pages = get_pages( array( 'child_of' => get_the_ID(), 'post_type' => 'page'));
            $count = count($pages);
            if($count > 0){
                $case_num = $count . " PERSONS INVOLVED";
            }
            //short description
            $short_description = get_the_excerpt();
            //get link
            $link = get_permalink();
            $content .= <<<EOT
            <div class="container-case">
                <div class="thumbnail-img">$thumbnail</div>
                <div class="content-case">
                    <p class="num-of-case">$case_num</p>
                    <h2>$title</h2>
                    <p class="short-description-case">$short_description</p>
                    <p class="case-read-more"><a href="$link">Read more →</a></p>
                </div>        
            </div>
            <div class="line-all-cases"><hr></div>            
EOT;
        }
    }
    wp_reset_postdata();
    return $content;
}

//add excerpt for page
add_post_type_support( 'page', 'excerpt' );

//short code for show comment
add_shortcode( 'show_comments', 'show_comments_shortcode' );
function show_comments_shortcode($attrs = array(), $content = '')
{
    if (comments_open() || get_comments_number()) :
        ob_start();
        comments_template( '/comments.php' );
        $cform = ob_get_contents();
        ob_end_clean();
        return $cform;
    endif;
}

// comment form fields re-defined:
add_filter( 'comment_form_default_fields', 'mo_comment_fields_custom_html' );
function mo_comment_fields_custom_html( $fields ) {
    // first unset the existing fields:
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    // then re-define them as needed:
    $fields = [
        'comment_field' => '<p class="comment-form-comment">' .
            '<textarea id="comment" placeholder="' . __( 'Your Comment*', 'textdomain'  ) .'" name="comment" cols="45" rows="4" maxlength="65525" aria-required="true" required="required"></textarea></p>',
        'author' => '<p class="comment-form-author">' .
            '<input id="author" placeholder="' . __( 'Name*', 'textdomain'  ) .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
        'email'  => '<p class="comment-form-email">' .
            '<input id="email" placeholder="' . __( 'Your Email Address*', 'textdomain'  ) .'" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
    ];
    // done customizing, now return the fields:
    return $fields;
}
// remove default comment form so it won't appear twice
add_filter( 'comment_form_fields', 'mo_remove_default_comment_field', 10, 1 );
function mo_remove_default_comment_field( $fields ) {
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

//short code for all case
add_shortcode( 'explore_more_cases', 'explore_more_cases_shortcode' );
function explore_more_cases_shortcode($attrs = array(), $content = ''){
    if(isset($attrs['title'])){
        $page = get_page_by_title($attrs['title']);
        $title  = get_the_title($page->ID);
        $thumbnail = get_the_post_thumbnail($page->ID, 'medium');
        $link = get_permalink($page->ID);
        $result = <<<EOT
            <div class="container-explore-case">
                <div class="explore-case-thumbnail">$thumbnail</div>
                <div class="explore-case-content">
                    <p class="explore-case-description">Explore more cases</p>
                    <h3 class="explore-case-title">$title</h3>
                    <p class="explore-case-readmore"><a href="$link">Read more</a></p>
                </div>
            </div>
EOT;
        wp_reset_postdata();
        return $result;
    }
}

//short code for all case resolve
add_shortcode( 'cases_overview', 'cases_overview_shortcode' );
function cases_overview_shortcode($attrs = array(), $content = ''){
    $case_tatus = "";
    if(isset($attrs['case_status'])){
        $case_tatus = $attrs['case_status'];
    }

    //load class for css if list is sublist
    $sublist = '';
    if(isset($attrs['sub_list'])){
        $sublist = 'container-sublist-case';
    }

    global $post;
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => $post->ID,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    );

    $cases_children = new WP_Query( $args );
    $content = "";
    if ( $cases_children->have_posts() ){
        while ( $cases_children->have_posts() ) {
            $cases_children->the_post();
            //exclude impact
            if(count(get_post_meta(get_the_ID(), 'case_status')) == 0){
                continue;
            }

            $readmore = esc_html__( 'Read more', 'klarity' );
            if($case_tatus == CASE_STATUS_RESOLVED && get_post_meta(get_the_ID(),'case_status', true) == CASE_STATUS_FIELD_RESOLVED)
            {
                //load case unresolve
                $thumbnail = get_the_post_thumbnail(null, 'medium');
                $title = get_the_title();
                $headline = get_post_meta(get_the_ID(),'headline', true);

                //short description
                $short_description = get_post_meta(get_the_ID(),'short_description', true);//get_the_excerpt();//
                //<p class="case-read-more"><a href="$link">$readmore →</a></p>
                //get link
                $link = get_permalink();
                $resolved = esc_html__( 'solved', 'klarity' );
                $content .= <<<EOT
                <div class="line-all-cases"><hr></div>
                <div class="container-case $sublist">
                    <div class="thumbnail-img">
                        $thumbnail
                        <p class="tag-title-resolved">$resolved</p>
                    </div>
                    <div class="content-case">
                        <p class="num-of-case">$headline</p>
                        <h2>$title</h2>
                        <p class="short-description-case">$short_description</p>
                    </div>
                </div>  
EOT;
            }
            else if($case_tatus == CASE_STATUS_UNRESOLVED && get_post_meta(get_the_ID(),'case_status', true) == CASE_STATUS_FIELD_UNRESOLVED)
            {
                //load case resolve
                if(count(get_post_meta(get_the_ID(),'feature_video_url')) > 0){
                    $attributes = array('link' => get_post_meta(get_the_ID(),'feature_video_url', true), 'videoThumbnail' => get_the_post_thumbnail_url(null, 'medium'), 'isThumbnailFullWidth' => true);
                    $thumbnail = render_video_thumbnail($attributes);
                }
                else
                {
                    $thumbnail = get_the_post_thumbnail(null, 'medium');
                }

                $title = get_the_title();
                $headline = get_post_meta(get_the_ID(),'headline', true);

                //short description
                //$short_description = get_the_excerpt();//get_post_meta(get_the_ID(),'short_description', true);
                //<p class="short-description-case">$short_description</p>
                //<p class="case-read-more"><a href="$link">$readmore →</a></p>
                //
                //$intro_block = substr(get_the_excerpt(), 0, 120);
                //$content_block = substr(get_the_excerpt(), 120);
                $intro_block = sub_words(get_the_excerpt(), 0, 22);
                $content_block = sub_words(get_the_excerpt(), 22);
                $att_read_more_lg = array('introBlock' => $intro_block, 'contentBlock' => $content_block, 'read_more' => $readmore.'<span class="img-arrow"><img src="'. get_template_directory_uri() .'/images/dropdown-arrow-red.svg"></span>');
                $short_description_lg = render_read_more($att_read_more_lg);
                $att_read_more_sm = array('introBlock' => '', 'contentBlock' => get_the_excerpt(), 'read_more' => $readmore.'<span class="img-arrow"><img src="'. get_template_directory_uri() .'/images/dropdown-arrow-red.svg"></span>');
                $short_description_sm = render_read_more($att_read_more_sm);
                //get link
                $link = get_permalink();
                $unresolved = esc_html__( 'unsolved', 'klarity' );
                $content .= <<<EOT
                <div class="container-case $sublist">
                    <div class="thumbnail-img">
                        $thumbnail
                        <p class="tag-title-unresolved">$unresolved</p>
                    </div>
                    <div class="content-case">
                        <p class="num-of-case">$headline</p>
                        <h2>$title</h2>
                        <div class="hide-on-small-only">
                            $short_description_lg                        
                        </div>
                        <div class="show-on-small d-none">
                            $short_description_sm                        
                        </div>
                    </div>
                </div>
                <div class="line-all-cases"><hr></div>        
EOT;
            }
            else if($case_tatus == "" && get_post_meta(get_the_ID(),'case_status', true))
            {
                //load all case
                $thumbnail = get_the_post_thumbnail(null, 'medium');
                $title = get_the_title();
                $headline = get_post_meta(get_the_ID(),'headline', true);
                //short description
                $short_description = get_post_meta(get_the_ID(),'short_description', true);
                //get link
                $link = get_permalink();
                $content .= <<<EOT
                <div class="container-case $sublist">
                    <div class="thumbnail-img">$thumbnail</div>
                    <div class="content-case">
                        <p class="num-of-case">$headline</p>
                        <h2>$title</h2>
                        <p class="short-description-case">$short_description</p>
                        <p class="case-read-more"><a href="$link">$readmore →</a></p>
                    </div>        
                </div>
                <div class="line-all-cases"><hr></div>            
EOT;
            }
        }
    }
    wp_reset_postdata();
    return $content;
}

//short code for all case resolve
add_shortcode( 'news_list', 'news_list_shortcode' );
function news_list_shortcode($attrs = array(), $content = ''){
    $content = <<<EOT
    <div class="container-content-news">
EOT;
    $args = array(
        'post_type' => 'news',
        'post_status' => 'publish',
        'post_password' => '',
        'posts_per_page' => -1
    );
    $posts = new WP_Query($args);
    $read_more = esc_html__( 'Read more', 'klarity' );
    if ($posts->have_posts()) {
        while ($posts->have_posts()) {
            $posts->the_post();

            $content .= '<article id="post-'. get_the_ID().'" class="'.  join( ' ', get_post_class() ).'">';
            $content_data = wp_trim_words(get_the_content(), $num_words = 100);
            $formated_date = get_the_date(get_option('date_format'));
            preg_match('/videoThumbnail":"(.+)"/', $content_data, $matches);
            if (!is_null($matches[1])) {
                $image = $matches[1];
            } else {
                $attachmentImage = wp_get_attachment_image_src(get_post_thumbnail_id($posts->ID), 'single-post-thumbnail')[0];
                if (!is_null($attachmentImage)) {
                    $image = $attachmentImage;
                } else {
                    $image = '';
                }
            }
            $thumbnail = '';
            if($image !== ''){
                $thumbnail = '<img src="'.$image.'"/>';
            }
            //default is news if have custom link news will open another tab to custom link
            $link = get_permalink($posts);
            if(count(get_post_meta(get_the_ID(), 'link_news')) > 0)
            {
                $link = get_post_meta(get_the_ID(), 'link_news', true);
            }
            $categories = "";
            $category_detail = get_the_category();
            foreach($category_detail as $cd){
                //add , for string category
                if($categories != ''){
                    $categories .= ', ';
                }
                $categories .= $cd->cat_name;
            }
            $title = get_the_title();
            $content .= <<<EOT
            <div class="news-item">
                <a href="$link" target="_blank">
                    <div class="news-item-block">
                        <h2 class="title-news">$title</h2>
                        <p class="date-news">$formated_date <span class="category-news"> $categories</span></p>
                        <div class="post-thumbnail">
                            $thumbnail
                        </div>
                        <p class="description-news">$content_data</p>
                        <p class="read-more-news">$read_more →</p>
                    </div>
                </a>
            </div>
        </article><!-- #post-<?php the_ID(); ?> -->
EOT;
        }
    }

    $content .= <<<EOT
    </div>
EOT;
    wp_reset_postdata();
    return $content;
}

//short code for all case resolve
add_shortcode( 'news_categories', 'news_categories_shortcode' );
function news_categories_shortcode($attrs = array(), $content = ''){
    $title_categories = esc_html__( 'Categories', 'klarity' );
    $content = <<<EOT
    <div class="container-category-news">
        <p class="title-category">$title_categories</p>
        <div class="list-categories">
EOT;

            $category = get_category_by_slug( 'news' );
            //$categories = get_categories();
            $args = array(
                'type'                     => 'post',
                'child_of'                 => $category->term_id,
                'orderby'                  => 'name',
                'order'                    => 'ASC',
                'hide_empty'               => FALSE,
                'hierarchical'             => 1,
                'taxonomy'                 => 'category',
            );
            $child_categories = get_categories($args );
            foreach ( $child_categories as $category ) {
                $content .= '<a href="' . get_category_link($category->term_id) . '" class="filter-news" data-category="'. $category->slug .'"><span style="text-decoration: underline;">' . $category->name . '</span></a>';
            }
    $content .= <<<EOT
        </div>
    </div>
EOT;
    wp_reset_postdata();
    return $content;
}

//short code for all case resolve
add_shortcode( 'call_to_action', 'call_to_action_shortcode' );
function call_to_action_shortcode($attrs = array(), $content = ''){
    $content = "";
    $args = array(
        'post_type'    => 'page',
        'post_status' => 'publish',
        'posts_per_page'   => -1
    );

    //load class for css if list is sublist
    $sublist = '';
    if(isset($attrs['sub_list'])){
        $sublist = 'container-sublist-action';
        $args += array('post_parent' => get_the_ID());
    }
    $pages = new WP_Query ( $args );
    if ( $pages->have_posts() ) {

        if(isset($attrs['type']) && $attrs['type'] == ACTION_STATUS_OPEN){
            while ($pages->have_posts()) {
                $pages->the_post();
                if(count(get_post_meta(get_the_ID(), 'action_status')) == 0){
                    continue;
                }

                //load all action status is closed
                if(get_post_meta(get_the_ID(), 'action_status',true) == ACTION_STATUS_OPEN){
                    $thumbnail = get_the_post_thumbnail(null, 'medium');
                    $title = get_the_title();
                    $headline = get_post_meta(get_the_ID(),'headline', true);
                    //short description
                    $short_description = get_the_excerpt();//get_post_meta(get_the_ID(),'short_description', true);
                    //get link
//                    $link = get_permalink();
                    $action_types = explode(',', get_post_meta(get_the_ID(), 'action_type',true));
                    $can_help = esc_html__( 'How can you help', 'klarity' );
                    foreach ($action_types as $action_type)
                    {
                        $tag = "";
                        if(trim($action_type) == ACTION_TYPE_EMAIL){
                            $tag = '<p class="tag-title-action-email"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAbCAYAAABiFp9rAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHySURBVHgBvVb9dYJADD98/b/nBrdB7QSyQbtB6QTiBOAGbqAbSCeoTlCdAJxAOkGalLs2xDtA+5H3fo8zyeWLJKLUP1E0VBEAYnw8IAxCM9EecUBsoyiq1DWExjUiQ5xgGK0Q5hIfnxkgSriOMmkvCjghxVywa0SB2NkzgUo4QUwRsdAn3WcsZ61CTkR0VLacyqi6K2AQG1nKkHIsFEvERF1ANihOqVTQ0H4nlIlRVxDeexV2NBdmIpLEY4CCSa0h2Ylv0HSd9lQm5UZKXjKPkycY1ubGY69wRuKubDzZOjrLit1Zc72R5T+KBLbsQqzOW32BGCPuBX/HzhU76xt7uGPMWqwS2aJzlC9tEMEAJY08vL072GwMk704J5amP3HESc5QIX7H3InYArxKe58j0+GocgdoBpnrHlQ4iC9HR8bkq0buKS6bCVnNgpgJ3YUTpKJN4wC/tLwVnFNpxyQT/O9mojIIYW75GrqHtG+AaVu0lzEE9hM+k4CREpqNvQ7I19xJxBwlqj0zS+yiuZUZfNC+ukW8q6bDCnHXtfrRyrcqRCIrokz9BdlSnH7DGTTvXfcpnDzvI4Ge/ycbaMbu504W+magYdyo9kA6ohVFM1MxnhtemQHtzbEaEF2oo4ZQCZ4/zz6HSxj26UUlW4EdeE4f4EQAgIVN0wUAAAAASUVORK5CYII="> '.esc_html__( 'Email Campaign', 'klarity' ).'</p>';
                            //get link
                            $link = get_post_meta(get_the_ID(), 'email_action_url',true);
                        }
                        else{
                            $tag = '<p class="tag-title-action-petition"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACUAAAAoCAYAAAB5ADPdAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAGjSURBVHgB7ZiBbYMwEEV/qgxANyATlA3SbNAR2gmaToC6QUegE6QbkE5ANigbhA3cu+JKLhhizgYaiSedHMCYn7PvfAClVEp2VtOQwoEV98SErIhLfW7wD1lEubLuuVZCTqRNRkeUfMATGiO3Dexyb5en7uj+hNoKcmIIWVKCK4soV7oWekn2BHla4HRwgHCxd4qi9XiEBxQ/JwhF9UUfDypNCeypxPpAh+hbUoIrV7chZ5DDa+oBUkbckLPQG/KW7t/DL/q2ELJEnw3ySUQWm+dmFaXFFGS5Kaxv+ir4rSlbOVzR7N0aonJq7vVhSbaj62VX9BXwxFIOn3U1+zNluo3Jvow+/Dta9wwashzmcdgLJz1NLDij41dqd3ys+7Mnqy5PhcT0UNMzqXH+oLQHxxbVJ+iPMJMxo681ZbDXV5vWGTUOLh5iMtu/gQr/GchPEOo8xbv5M8Lx4jBl79TnEVNDooqhHhpTzG9iTFR7aWSYGmMNpRZhGeaAHrw3vGIKe8NcqDorq6awoYROns13vQ0EXKwCh6Dq6oIz+SfZUfqW/Q3+XurIW+hIOQAAAABJRU5ErkJggg=="> '.esc_html__( 'Petition', 'klarity' ).'</p>';
                            $link = get_post_meta(get_the_ID(), 'petition_action_url',true);
                        }
                        $content .= <<<EOT
                    <div class="container-action $sublist">
                        <div class="thumbnail-img">$thumbnail</div>
                        <div class="content-action">
                            <p class="action-headline">$headline</p>
                            <h2>$title</h2>
                            <p class="short-description-action">$short_description</p>
                            <p class="action-read-more"><a href="$link">$can_help →</a></p>                          
                        </div>
                        $tag                        
                    </div>
                    <div class="line-action"><hr></div>            
EOT;
                    }
                }
            }
        }
        else
        {
            while ($pages->have_posts()) {
                $pages->the_post();
                if(count(get_post_meta(get_the_ID(), 'action_status')) == 0){
                    continue;
                }

                //load all action status is closed
                if(get_post_meta(get_the_ID(), 'action_status',true) == ACTION_STATUS_CLOSED){
                    $thumbnail = get_the_post_thumbnail(null, 'medium');
                    $title = get_the_title();
                    $headline = get_post_meta(get_the_ID(),'headline', true);
                    //short description
                    $short_description = get_the_excerpt();//get_post_meta(get_the_ID(),'short_description', true);
                    //get link
                    //$link = get_permalink();
                    $action_types = explode(',', get_post_meta(get_the_ID(), 'action_type',true));
                    $readmore = esc_html__( 'Read more', 'klarity' );
                    foreach ($action_types as $action_type)
                    {
                        $tag = "";
                        if(trim($action_type) == ACTION_TYPE_EMAIL){
                            $tag = '<p class="tag-title-action-email"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAbCAYAAABiFp9rAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHySURBVHgBvVb9dYJADD98/b/nBrdB7QSyQbtB6QTiBOAGbqAbSCeoTlCdAJxAOkGalLs2xDtA+5H3fo8zyeWLJKLUP1E0VBEAYnw8IAxCM9EecUBsoyiq1DWExjUiQ5xgGK0Q5hIfnxkgSriOMmkvCjghxVywa0SB2NkzgUo4QUwRsdAn3WcsZ61CTkR0VLacyqi6K2AQG1nKkHIsFEvERF1ANihOqVTQ0H4nlIlRVxDeexV2NBdmIpLEY4CCSa0h2Ylv0HSd9lQm5UZKXjKPkycY1ubGY69wRuKubDzZOjrLit1Zc72R5T+KBLbsQqzOW32BGCPuBX/HzhU76xt7uGPMWqwS2aJzlC9tEMEAJY08vL072GwMk704J5amP3HESc5QIX7H3InYArxKe58j0+GocgdoBpnrHlQ4iC9HR8bkq0buKS6bCVnNgpgJ3YUTpKJN4wC/tLwVnFNpxyQT/O9mojIIYW75GrqHtG+AaVu0lzEE9hM+k4CREpqNvQ7I19xJxBwlqj0zS+yiuZUZfNC+ukW8q6bDCnHXtfrRyrcqRCIrokz9BdlSnH7DGTTvXfcpnDzvI4Ge/ycbaMbu504W+magYdyo9kA6ohVFM1MxnhtemQHtzbEaEF2oo4ZQCZ4/zz6HSxj26UUlW4EdeE4f4EQAgIVN0wUAAAAASUVORK5CYII="> '.esc_html__( 'Closed Action', 'klarity' ).'</p>';
                            //get link
                            $link = get_post_meta(get_the_ID(), 'email_action_url',true);
                        }
                        else{
                            $tag = '<p class="tag-title-action-petition"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACUAAAAoCAYAAAB5ADPdAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAGjSURBVHgB7ZiBbYMwEEV/qgxANyATlA3SbNAR2gmaToC6QUegE6QbkE5ANigbhA3cu+JKLhhizgYaiSedHMCYn7PvfAClVEp2VtOQwoEV98SErIhLfW7wD1lEubLuuVZCTqRNRkeUfMATGiO3Dexyb5en7uj+hNoKcmIIWVKCK4soV7oWekn2BHla4HRwgHCxd4qi9XiEBxQ/JwhF9UUfDypNCeypxPpAh+hbUoIrV7chZ5DDa+oBUkbckLPQG/KW7t/DL/q2ELJEnw3ySUQWm+dmFaXFFGS5Kaxv+ir4rSlbOVzR7N0aonJq7vVhSbaj62VX9BXwxFIOn3U1+zNluo3Jvow+/Dta9wwashzmcdgLJz1NLDij41dqd3ys+7Mnqy5PhcT0UNMzqXH+oLQHxxbVJ+iPMJMxo681ZbDXV5vWGTUOLh5iMtu/gQr/GchPEOo8xbv5M8Lx4jBl79TnEVNDooqhHhpTzG9iTFR7aWSYGmMNpRZhGeaAHrw3vGIKe8NcqDorq6awoYROns13vQ0EXKwCh6Dq6oIz+SfZUfqW/Q3+XurIW+hIOQAAAABJRU5ErkJggg=="> '.esc_html__( 'Closed Action', 'klarity' ).'</p>';
                            //get link
                            $link = get_post_meta(get_the_ID(), 'petition_action_url',true);
                        }
                        $img_arrow = get_template_directory_uri() .'/images/dropdown-arrow-red.svg';
                        $content .= <<<EOT
                    <div class="container-action $sublist">
                        <div class="thumbnail-img">$thumbnail</div>
                        <div class="content-action">
                            <p class="action-headline">$headline</p>
                            <h2>$title</h2>
                            <p class="short-description-action">$short_description</p>
                            <p class="action-read-more"><a href="$link" class="after-angle-down">$readmore<span class="img-arrow"><img src="$img_arrow"></span></a></p>                          
                        </div>
                        $tag                        
                    </div>
                    <div class="line-action"><hr></div>            
EOT;
                    }
                }
            }
        }
    }
    wp_reset_postdata();
    return $content;
}

add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
    global $post;
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
           var post_id = "'. $post->ID .'";
         </script>';
}

//add to cart ajax
add_action( 'wp_ajax_count_all_tabs', 'count_all_tabs' );
add_action( 'wp_ajax_nopriv_count_all_tabs', 'count_all_tabs' );

function count_all_tabs() {
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
            if (count(get_post_meta(get_the_ID(), 'case_status')) == 0) {
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
            if(count(get_post_meta(get_the_ID(), 'action_status')) == 0){
                continue;
            }
            //load all action status is closed
            if(get_post_meta(get_the_ID(), 'action_status',true) == ACTION_STATUS_CLOSED){
                $action_types = explode(',', get_post_meta(get_the_ID(), 'action_type',true));
                foreach ($action_types as $action_type)
                {
                    $number_actions++;
                }
            }
        }
    }
    wp_reset_postdata();



    if($number_personal_involved == 0)
        $number_personal_involved = '';
    if($number_actions == 0)
        $number_actions = '';

    $result = array('personal_involved' => $number_personal_involved, 'number_actions' => $number_actions, 'comments' => get_comments_number($post_id));
    echo json_encode($result);
    die();
}

function sub_words($str, $start = 0, $length = 0){
    $words = explode(' ', $str);
    $len_word = count($words);
    $result = "";
    if($length == 0){
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