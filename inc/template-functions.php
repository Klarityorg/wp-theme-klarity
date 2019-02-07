<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package klarity
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function klarity_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'klarity_body_classes' );

function mce_formats($init) {
    $formats = [
        'h1' => __('Heading 1', 'klarity'),
        'h2' => __('Heading 2', 'klarity'),
        'h3' => __('Heading 3', 'klarity'),
        'h4' => __('Heading 4', 'klarity'),
        'h5' => __('Sub-header', 'klarity'),
        'p' => __('Paragraph', 'klarity')
    ];
    array_walk($formats, function ($key, $val) use (&$block_formats) {
        $block_formats .= esc_attr($key) . '=' . esc_attr($val) . ';';
    }, $block_formats = '');
    $init['block_formats'] = $block_formats;
    return $init;
}

add_filter('tiny_mce_before_init', 'mce_formats');
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function klarity_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'klarity_pingback_header' );
