<?php
/**
 * hikaru functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hikaru
 */
if ( !defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'hikaru_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hikaru_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hikaru, use a find and replace
		 * to change 'hikaru' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hikaru', get_template_directory() . '/languages' );

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

		add_image_size( 'post', 1400, 9999);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hikaru' ),
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
		add_theme_support( 'custom-background', apply_filters( 'hikaru_custom_background_args', array(
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
add_action( 'after_setup_theme', 'hikaru_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hikaru_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hikaru_content_width', 640 );
}
add_action( 'after_setup_theme', 'hikaru_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hikaru_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets 1', 'hikaru' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'hikaru' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets 2', 'hikaru' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'hikaru' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets 3', 'hikaru' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'hikaru' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hikaru_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hikaru_scripts() {

	wp_enqueue_style( 'google-fonts',  "https://fonts.googleapis.com/css?family=Cinzel:400,700,900|Raleway:100,200,300i,400,500,600");

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome/all.css');
	
	wp_enqueue_style( 'hikaru-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hikaru-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '201513455', true );
	
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hikaru_scripts' );
/**
 * Custom excerpt length.
 */

function hikaru_excerpt_length(){
	return 40;
}
add_filter( 'excerpt_length', 'hikaru_excerpt_length' );
/**
 * Custom excerpt more.
 */
function hikaru_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'hikaru' )
    );
}
add_filter( 'excerpt_more', 'hikaru_excerpt_more' );

/**
 * Add editor styles
 */

function hikaru_add_editor_styles() {
	add_editor_style( array( 
		'hikaru-editor-styles.css', 
		'https://fonts.googleapis.com/css?family=Libre+Franklin:300,400,400i,500,700,700i&amp;subset=latin-ext' 
	) );
}
add_action( 'init', 'hikaru_add_editor_styles' );

/**
 * Set default size for galleries
 */
add_filter( 'media_view_settings', 'hikaru_gallery_defaults', 10, 2 );

function hikaru_gallery_defaults( $settings, $post ) {
    $defaults = ! empty( $settings['galleryDefaults'] ) && is_array( $settings['galleryDefaults'] ) ? $settings['galleryDefaults'] : array();
    $settings['galleryDefaults'] = array_merge( $defaults, array(
        'columns'   => 5,
        'size'      => 'large',
        'link'      => 'file'
    ) );
    return $settings;
}

// logo
function kirki_demo_configuration_sample_styling( $config ) {
	return wp_parse_args( array(
		'logo_image'   => get_template_directory_uri().'/assets/images/hikaru_logo.png',
		'description'  => esc_attr__( 'Awesome and clean wordpress theme', 'hikaru' ),
		'color_accent' => '#0091EA',
		'color_back'   => '#FFFFFF',
		'disable_loader'=> true,
	), $config );
}
add_filter( 'kirki_config', 'kirki_demo_configuration_sample_styling' );


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
 * Hooks.
 */
require get_template_directory() . '/inc/theme-hooks.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

