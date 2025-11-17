<?php
/**
 * Frida Zinema functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Frida_Zinema
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function frida_zinema_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Frida Zinema, use a find and replace
		* to change 'frida-zinema' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'frida-zinema', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'frida-zinema' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'frida_zinema_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'frida_zinema_setup' );

/**
 * Add the compiled main.css stylesheet to the site.
 */
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style( 'custom-styling', get_stylesheet_directory_uri() . '/main.css' );
});

/**
 * Add page tear elements for use
 */
add_action( 'wp_body_open', function() {
    ?>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="d-none">
            <symbol viewBox="0 0 1408 44" id="shape-rip"><path d="M224 1459.1c-6-9-28-17-53-19-36-3-41-1-31 11 7 9 8 15 2 15-5 0-15-6-21-14-9-11-21-12-53-4-23 5-60 8.8-68 5.8v-427.8h14080v54.8c-11 3-53 6.2-72 5.2-18 0-51 2-73 5s-59 8-82 11c-29 4-43 10-43 20 0 8-5 12-10 9-6-4-18-1-26 6-11 9-18 9-32-3-18-15-66-23-57-8 3 4-12 11-33 16-52 10-65 11-79 0-8-5-13-4-13 2 0 13-162 11-172-3-5-6-11-6-16 2-7 11-81 27-107 23-5 0-59-3-118-5-81-2-115-8-135-21-44-29-110-41-176-32-33 5-69 5-80 2-11-4-41-8-66-10-90-6-125-17-134-40-3-8-13-14-21-14-9 0-14 4-11 9s-20 7-52 6c-32-2-64 0-72 5-7 4-27 2-46-6-30-13-38-12-63 0-16 9-31 13-34 10s-14 1-26 8c-17 10-25 10-41 0-15-9-26-10-40-2-11 6-24 9-28 6-9-5-150-18-188-17-12 0-35 6-50 12-16 7-42 12-58 11-16 0-38 4-48 9-26 14-279 13-338-2-8-2-18-8-22-14-6-8-87-11-208-5-62 3-142 21-156 35-7 6-33 12-58 13-26 1-79 7-117 12-39 6-75 8-80 4-5-3-9-1-9 4 0 19-57 31-133 29-43-2-80-1-83 2s-15 6-28 7c-13 0-32 4-42 9-10 4-34 9-53 11s-39 8-45 14c-11 11-40 14-33 2 5-7-42-7-123-1-19 1-41 7-47 12-7 5-22 7-33 4s-18-1-14 4c4 8-24 14-48 10-4 0-18 3-32 8-13 6-27 7-31 3-3-4-18-7-33-8-121-7-198-16-209-26-9-7-13-7-13 1 0 6 5 11 12 11 9 0 9 3 1 11s-17 8-29 1-23-6-35 1c-9 6-24 7-35 2-11-4-24-7-30-6-6 0-29-6-50-15-48-21-85-26-99-14-7 6-24 6-42 1-16-5-43-7-59-4-16 2-57 6-90 7-34 2-66 6-72 10-6 3-12 0-15-6-3-9-8-10-18-2-8 5-35 9-61 9-27-1-48 1-48 4s-39 7-88 9c-117 3-138 6-156 22-12 9-26 10-58 2s-44-8-50 1c-5 9-16 7-43-7-24-13-50-19-78-16-127 9-321-3-344-22-10-8-13-6-13 6 0 20 0 20-37 1-27-14-60-18-128-16h-58c-20 0-42 3-49 7-22 14-70 13-64-1 2-7-4-15-14-18-11-3-21 0-22 5-2 5-16 11-31 11-28 2-36 12-15 20 7 2 10 8 6 12-6 7-30 8-70 3-7-1-22 2-34 6-15 4-29-1-47-18-15-14-27-23-27-20s-10 0-21-7c-15-8-19-8-15 0 4 7-1 11-13 11-28 0-52-11-45-21 9-15-13-10-26 6-7 8-25 15-40 15-16 0-30 6-32 12-6 17-58-17-58-37 0-8-3-15-7-16-5 0-16-2-26-4-14-3-16 1-12 16 6 18 2 19-55 17-37-2-64-8-67-15-6-16-75-4-89 15-9 13-13 12-25-6-16-22-26-22-69-5-23 10-84 22-137 29-12 1-26 5-32 8-21 13-121 18-135 7-11-9-15-9-18 0-3 8-9 9-17 5-11-7-11-10 0-17 9-6 4-8-16-6-17 2-37 7-45 12-9 6-12 4-8-6 5-12-6-13-59-9-36 3-67 2-69-2-5-7-40-5-64 4-75 30-122 39-152 29-40-14-51-14-42 1 5 8 2 9-12 3-25-10-123-14-129-5-5 8-56 4-89-6-11-4-16-2-12 4 4 7-17 10-61 10-38 0-81 3-98 6-43 10-76 8-91-5-10-8-14-8-14-1s-10 8-29 2c-16-4-32-5-36-2-3 4-23 7-43 9-20 1-41 3-47 3-5 1-23-2-40-5-16-3-46-7-65-9-19-3-48-11-64-19-27-15-30-14-51 9-18 19-30 23-53 19-18-3-34 0-41 8-7 9-37 14-91 14-75 1-83-1-107-25-16-17-23-21-20-10 5 15-3 16-71 14-42-1-87-8-99-14-20-11-23-10-23 6 0 22-39 37-54 22s-26-12-20 5c7 17-13 20-36 5-9-6-19-5-28 2-10 9-16 8-22-1-5-10-13-11-26-3-13 7-24 6-40-4-20-14-23-13-41 9-12 16-29 24-51 25-19 0-39 6-47 12-9 8-17 7-27-3-12-12-16-12-27 0-17 19-35 12-39-16-3-18-6-20-17-11s-22 7-50-10c-20-12-39-19-43-15s-2 10 5 12 10 10 7 16c-2 8-24 11-57 10-28 0-57 3-64 8-11 10-41 14-133 21-25 2-48 7-52 12-4 6-13 4-23-4s-29-15-44-16c-14 0-41-2-59-2-18-1-31-6-28-10 2-4-10-6-27-4-23 3-38-2-50-16-17-19-51-21-130-7-17 3-26 1-22-5 8-13-1-13-26 1-27 14-81 20-94 9-5-5-39-12-74-16-53-6-63-5-56 7 7 11 5 11-10-1-11-9-16-10-11-2 4 6 2 12-3 12-6 0-11-6-11-12-1-9-4-8-13 2-8 10-35 16-82 18-38 2-72 7-73 13-2 5-8 9-13 9-6 0-8-4-5-8 2-4-7-7-22-6s-38 2-51 3c-13 0-22 4-18 7 11 11-17 30-43 29-14-1-41-9-59-18-42-21-45-21-37-1 4 11 1 14-13 9-85-27-169-45-225-49-37-3-71-8-76-11s-11-1-14 4c-8 13-208 6-234-8-11-6-22-8-25-4-4 3-13 0-22-7-8-7-21-10-29-7s-22-1-33-8c-23-18-37-19-30-1s-23 45-43 39c-10-3-8 1 4 11 11 9 15 17 8 17-7 1-16 3-22 4-5 1-18 3-27 4-16 1-16 3-3 11 8 5 10 10 4 10-5 0-15-5-20-10-13-13-114-30-114-20 0 5-19 10-43 13-23 3-55 9-72 12-16 4-49 7-73 7-25 0-40 3-36 9 9 15-16 39-41 39-13 0-26 6-29 13-4 8-8 8-11 1-4-6-23-8-54-4-38 5-51 3-59-10-5-8-20-16-32-17-17-2-20 1-11 10 16 16 14 30-4 24-8-4-17-2-21 4-9 15-173 9-213-8-33-14-34-14-21 2 14 16 13 17-9 10-14-4-38-16-54-25-16-10-35-16-43-13-7 2-22 0-33-6-12-7-22-7-26-2-3 6-22 8-41 5-33-4-34-3-19 12 27 27 2 44-58 39-29-2-52-5-52-5 0-3-49-9-89-11-22-1-41 2-43 7s-18 8-36 7c-17-2-48-4-67-6s-40-6-46-10c-10-6-58 6-94 23-9 4-24 2-35-6s-32-12-49-10c-17 3-33 1-36-5-4-6-20-4-43 6-20 8-43 12-51 9s-21-2-28 2c-7 5-24 10-38 12s-29 7-34 12c-6 6-15 5-23-2-10-8-20-8-36-1-18 9-26 8-33-4z" transform="matrix(.1 0 0 -.1 0 147)"></path></symbol>
        </svg>
    <?php
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function frida_zinema_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'frida_zinema_content_width', 640 );
}
add_action( 'after_setup_theme', 'frida_zinema_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function frida_zinema_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'frida-zinema' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'frida-zinema' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'frida_zinema_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function frida_zinema_scripts() {
    // Preconnects
    wp_enqueue_style(
        'google-fonts-preconnect-1',
        'https://fonts.googleapis.com',
        [],
        null
    );
    wp_enqueue_style(
        'google-fonts-preconnect-2',
        'https://fonts.gstatic.com',
        [],
        null
    );


    // The actual Google Fonts stylesheet
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Special+Elite&display=swap',
        [],
        null
    );

	wp_enqueue_style( 'frida-zinema-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'frida-zinema-style', 'rtl', 'replace' );
	wp_enqueue_script( 'frida-zinema-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'frida_zinema_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

