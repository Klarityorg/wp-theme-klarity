<?php
/**
 * Requires the WP-SCSS plugin to be installed and activated.
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

// Check if WP-SCSS plugin is active.
//if ( ! is_plugin_active( 'wp-scss/wp-scss.php' ) ) {
//
//    return;
//
//}
// Always recompile the customizer.
if (is_customize_preview() && !defined('WP_SCSS_ALWAYS_RECOMPILE')) {
    define('WP_SCSS_ALWAYS_RECOMPILE', true);
}
// Update the default paths to match theme.
$wpscss_options = get_option('wpscss_options');
if ($wpscss_options['scss_dir'] !== '/sass/' || $wpscss_options['css_dir'] !== '/') {
    // Alter the options array appropriately.
    $wpscss_options['scss_dir'] = '/sass/';
    $wpscss_options['css_dir'] = '/';

    // Update entire array
    update_option('wpscss_options', $wpscss_options);
}

$default_variables = [
    'primary-color' => '#E41414',
    'primary-color-text' => '#FFFFFF',
    'secondary-color' => '#32323C',
    'secondary-color-text' => '#FFFFFF',
    'tertiary-color' => '#EFF1F3',
    'tertiary-color-text' => '#000000',
];

function prefix_set_variables() {
    global $default_variables;
    $variables = [];
    // Loop through each variable and get theme_mod.
    foreach ($default_variables as $key => $value) {
        $variables[$key] = get_theme_mod($key, $value);
    }
    $variables['color__background-body'] = get_theme_mod('background_color');
    if (preg_match('~#?(.+)$~', $variables['color__background-body'], $match)) {
      $variables['color__background-body'] = "#{$match[1]}";
    }
    return $variables;
}
add_filter('wp_scss_variables', 'prefix_set_variables');

function prefix_customizer_register() {
    global $wp_customize;
    global $default_variables;
    foreach ($default_variables as $key => $value) {
        $wp_customize->add_setting($key, [
            'default' => $value,
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        // Add control for each variable.
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $key,
                [
                    'label' => ucfirst(str_replace('-', ' ', $key)),
                    'section' => 'colors',
                    'settings' => $key,
                ])
        );
    }
}
add_action('customize_register', 'prefix_customizer_register');


function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


function wpdocs_excerpt_more( $more ) {
    return '... <a href="' . esc_url( get_permalink() ) . '">read more</a>';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
