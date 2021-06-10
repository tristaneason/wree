<?php
/**
 * Education Minimal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Education_Minimal
 */
if ( ! function_exists( 'education_minimal_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function education_minimal_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Education Minimal , use a find and replace
		 * to change 'education-minimal' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'education-minimal', get_template_directory() . '/languages' );

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
		add_image_size('education-minimal-banner-image', 1500, 750 , true);
		add_image_size('education-minimal-image', 400, 600, true);
		add_image_size('education-minimal-team-image', 264 , 350, true);
		add_image_size( 'education-minimal-isotope', 360, 520, true);
		add_image_size( 'education-minimal-isotope-thumb', 360, 247, true);
		add_image_size('education-minimal-blog-image', 372 , 269, true);
		add_image_size('education-minimal-pro-image', 1000 , 502, true);
		add_image_size('education-minimal-archive-image', 1200, 700, true);
		add_image_size('education-minimal-single-image', 1280, 887, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'education-minimal' ),
			'social-media'  => esc_html__( 'Social Media', 'education-minimal' ),
			'download-menu'  => esc_html__( 'Download Menu', 'education-minimal' ),
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
		add_theme_support( 'custom-background', apply_filters( 'education_minimal_custom_background_args', array(
			'default-color' => 'ffffff',
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
add_action( 'after_setup_theme', 'education_minimal_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function education_minimal_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'education_minimal_content_width', 640 );
}
add_action( 'after_setup_theme', 'education_minimal_content_width', 0 );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function education_minimal_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'education-minimal' ),
		'id'            => 'education-minimal-sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'education-minimal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		)
    );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'education-minimal' ),
		'id'            => 'education-minimal-sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'education-minimal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		)
	 );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Top Footer One', 'education-minimal' ),
		'id'            => 'education-minimal-top-footer',
		'description'   => esc_html__( 'Add widgets here.', 'education-minimal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) 
	);
	register_sidebar( array(
		'name'          => esc_html__( 'Home Top Footer Two', 'education-minimal' ),
		'id'            => 'education-minimal-top-two-footer',
		'description'   => esc_html__( 'Add widgets here.', 'education-minimal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) 
	);
	register_sidebar( array(
		/* translators: Footer Id */
		'name' =>sprintf( esc_html__( 'Footer %d', 'education-minimal' ), 1 ),
		'id' => 'footer-1',
		'description' => esc_html__('Appears in the buttom of footer area','education-minimal'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		)
	);
    register_sidebar( array(
    	/* translators: Footer Id */
        'name' => sprintf( esc_html__( 'Footer  %d', 'education-minimal' ), 2 ),
        'id' => 'footer-2',
        'description' => esc_html__('Appears in the buttom of footer area','education-minimal'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
   		 )
     );
    register_sidebar( array(
    	/* translators: Footer Id */
        'name' => sprintf( esc_html__( 'Footer  %d', 'education-minimal' ), 3 ),
        'id' => 'footer-3',
        'description' => esc_html__('Appears in the buttom of footer area','education-minimal'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
   		 )
     );
    register_sidebar( array(
    	/* translators: Footer Id */
        'name' => sprintf( esc_html__( 'Footer %d', 'education-minimal' ), 4),
        'id' => 'footer-4',
        'description' => esc_html__('Appears in the buttom of footer area','education-minimal'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
   		 )
     );
}
add_action( 'widgets_init', 'education_minimal_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function education_minimal_scripts() {
	$education_minimal_font_args = array(

		'family' => 'Fauna+One|Roboto+Condensed:300,300i,400,400i,700,700i',
	);

    wp_enqueue_style( 'education-minimal-google-fonts', add_query_arg( $education_minimal_font_args, "//fonts.googleapis.com/css" ) );

	// Load Slick Css
    wp_enqueue_style( 'slick-css', get_template_directory_uri().'/assets/css/slick.css',array(), ' 1.9.0', 'all' );

    // Load Slick Theme Css
    wp_enqueue_style( 'slick-theme-css', get_template_directory_uri().'/assets/css/slick-theme.css',array(), ' 1.9.0', 'all' );

    // Font Awesome  CSS
    wp_enqueue_style( 'font-awesome-min-css', get_template_directory_uri().'/assets/css/font-awesome.min.css',array(), '4.7.0 ', 'all' );

    // Meanmenu CSS
    wp_enqueue_style( 'meanmenu-css', get_template_directory_uri().'/assets/css/meanmenu.css',array(), '2.0.7 ', 'all' );

    // Magnific CSs
    wp_enqueue_style( 'magnific-popup-css', get_template_directory_uri().'/assets/css/magnific-popup.min.css',array(), ' v2.3.4', 'all' );

    // Load Animate Css
    wp_enqueue_style( 'animate-css', get_template_directory_uri().'/assets/css/animate.css',array(), ' 3.7.0', 'all' );
    
	wp_enqueue_style( 'education-minimal-style', get_stylesheet_uri() );

	// Load Slick
	wp_enqueue_script( 'jquery-slick-js', get_template_directory_uri().'/assets/js/slick.min.js', array( 'jquery' ), '1.9.0', true );

	// Magnific Js
	wp_enqueue_script( 'jquery-magnific-popup-js', get_template_directory_uri().'/assets/js/jquery.magnific-popup.js', array( 'jquery' ), ' v2.3.4', true );

    // Mean Menu JS
   	wp_enqueue_script( 'jquery-meanmenu-js', get_template_directory_uri().'/assets/js/jquery.meanmenu.js', array( 'jquery' ), 'v2.0.8', true );

   	// Wow JS
   	wp_enqueue_script( 'jquery-wow-js', get_template_directory_uri().'/assets/js/wow.min.js', array( 'jquery' ), 'v1.3.0', true );

   	// Ticker JS
   	wp_enqueue_script( 'jquery-ticker-min-js', get_template_directory_uri().'/assets/js/jquery.ticker.js', array( 'jquery' ), '0.1.0', true );

	// Isotop JS
   	wp_enqueue_script( 'isotope-min-js', get_template_directory_uri().'/assets/js/isotope.min.js', array( 'jquery' ), 'v3.0.6', true );

   		// Image Loaded  JS
   	wp_enqueue_script( 'jquery-imagesloaded-js', get_template_directory_uri().'/assets/js/imagesloaded.js', array( 'jquery' ), 'v2.0.8', true );

   	// Custom  JS
   	wp_enqueue_script( 'education-minimal-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery'), '1.0.0', true );

	wp_enqueue_script( 'education-minimal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'education-minimal-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_localize_script('education-minimal-custom', 'education_minimal_script_vars', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'education_minimal_scripts' );
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
/**
 * Load Custom Customizer file.
 */
require get_template_directory() . '/inc/customizer/customizer-options.php';
/**
 * Education Minimal Metabox
 */
require  get_template_directory()  . '/inc/metabox.php';
/** Widget Fields **/
require get_template_directory() . '/inc/widgets/widgets-field.php'; 

/** Widget Fields **/
require get_template_directory() . '/inc/widgets/widgets-recent-post.php'; 

/** Widget Footer **/
require get_template_directory() . '/inc/widgets/widgets-footer.php'; 
/**
 * Load Custom functions file.
 */
require get_template_directory() . '/inc/custom-function.php';
/**
 * Load Custom functions file.
 */
require get_template_directory() . '/inc/hook/layout-one-hook.php';
/**
 * Load Custom functions file.
 */
require get_template_directory() . '/inc/hook/footer-hook.php';
/**
 * Load Custom functions file.
 */
require get_template_directory() . '/inc/hook/footer-last-hook.php';
/** TGM Plugins Activations  **/

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
/**
 * Load Custom functions file.
 */
require get_template_directory() . '/inc/hook/header-breadcrumb.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}