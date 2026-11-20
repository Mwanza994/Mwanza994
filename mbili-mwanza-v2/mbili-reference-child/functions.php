<?php
if (!defined('ABSPATH')) exit;
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('mbili-reference', get_stylesheet_uri(), ['mbili-editorial'], '2.0.0');
}, 30);
// Match the new palette without overwriting a saved Customizer preference.
add_action('wp_head', function () {
    $color = get_theme_mod('mbili_accent', '#e26050');
    if (sanitize_hex_color($color)) echo '<style>:root{--accent:'.esc_html($color).'}</style>';
}, 40);
