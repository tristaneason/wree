<?php
// Add stylesheet and scripts file
function add_theme_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri(), [], wp_rand(333, 999));
    wp_enqueue_script('script', get_template_directory_uri() . '/scripts/index.js', '', wp_rand(333, 999), true);
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

// Add widgets
function widget_sidebar() {
    register_sidebar([
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<section>',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);
}
add_action('widgets_init', 'widget_sidebar');

// Add thumbnail support
add_theme_support('post-thumbnails', ['post', 'page']);

// Disable Editor for Custom Templates
function remove_editor() {
    if (isset($_GET['post'])) {
        $template = get_post_meta($_GET['post'], '_wp_page_template', true);
        switch ($template) {
            case 'template-home.php':
            case 'template-contact.php':
            case 'template-articles.php':
            case 'template-donate.php':
                remove_post_type_support('page', 'editor');
            break;
        }
    }
}
add_action('init', 'remove_editor');

// Use a better function name for theme root
function theme_root($path) {
    return get_template_directory() . $path;
}

// Disable admin bar on mobile
if (wp_is_mobile()) {
    add_filter('show_admin_bar', '__return_false');
}

// Add ACF Options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'WREE Contact Information',
        'menu_title' => 'Contact Info',
        'menu_slug' => 'contact-info',
        'capability' => 'edit_posts',
        'redirect' => false,
    ]);
    // acf_add_options_page([
    //     'page_title' => '',
    //     'menu_title' => '',
    //     'menu_slug' => '',
    //     'capability' => 'edit_posts',
    //     'redirect' => false,
    // ]);
}
