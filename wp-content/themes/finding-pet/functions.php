<?php
/**
 * Finding Pet functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Finding_Pet
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'finding_pet_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function finding_pet_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Finding Pet, use a find and replace
		 * to change 'finding-pet' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'finding-pet', get_template_directory() . '/languages' );

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
				'main-menu' => esc_html__( 'Main menu', 'finding-pet' ),
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
				'finding_pet_custom_background_args',
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

        // add_image_size('highlight-box', 350, 350, true);
	}
endif;
add_action( 'after_setup_theme', 'finding_pet_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function finding_pet_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'finding_pet_content_width', 640 );
}
add_action( 'after_setup_theme', 'finding_pet_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function finding_pet_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'finding-pet' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'finding-pet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'finding_pet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function finding_pet_scripts() {
	wp_enqueue_style( 'finding-pet-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'finding-pet-style', 'rtl', 'replace' );

	wp_enqueue_script( 'google-apis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBNwPIgwhl_-FhU5FNw2wOgxn40xT96JQk', array(), _S_VERSION, true );
	wp_enqueue_script( 'finding-pet-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'finding-pet-scripts', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'finding_pet_scripts' );

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
 * Custom post types
 */
require get_template_directory() . '/inc/cpt-pet.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyBNwPIgwhl_-FhU5FNw2wOgxn40xT96JQk');
}
add_action('acf/init', 'my_acf_init');

// returns longitude and latitude from a location
function YOUR_THEME_NAME_get_lat_and_lng($origin){
    $api_key = 'AIzaSyBNwPIgwhl_-FhU5FNw2wOgxn40xT96JQk';
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($origin).'&key='.$api_key;
    // https://maps.googleapis.com/maps/api/geocode/json?latlng=38.7174,-9.1321&key=AIzaSyBNwPIgwhl_-FhU5FNw2wOgxn40xT96JQk
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    $result1[]=$result['results'][0];
    $result2[]=$result1[0]['geometry'];
    $result3[]=$result2[0]['location'];
    return $result3[0];
}

// returns distance between two locations
function YOUR_THEME_NAME_get_distance($origin, $address_lat, $address_lng, $unit){

    // get lat and lng from provided location
    $origin_coords = YOUR_THEME_NAME_get_lat_and_lng($origin);
    $lat1 = $origin_coords['lat'];
    $lng1 = $origin_coords['lng'];

    // get lat and lng from the address field on the custom post type
    $lat2 = $address_lat;
    $lng2 = $address_lng;

    // calculate distance between locations
    $theta=$lng1-$lng2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    // adjust calculation depending on unit
    if ($unit == "K"){
        return ($miles * 1.609344);
    }
    else if ($unit =="N"){
        return ($miles * 0.8684);
    }
    else{
        return $miles;
    }
}

function finding_pet_get_distance($origin_lat, $origin_lng, $address_lat, $address_lng, $unit){

    // get lat and lng from provided location
    $lat1 = $origin_lat;
    $lng1 = $origin_lng;

    // get lat and lng from the address field on the custom post type
    $lat2 = $address_lat;
    $lng2 = $address_lng;

    // calculate distance between locations
    $theta=$lng1-$lng2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    // adjust calculation depending on unit
    if ($unit == "K"){
        return ($miles * 1.609344);
    }
    else if ($unit =="N"){
        return ($miles * 0.8684);
    }
    else{
        return $miles;
    }
}

function remove_admin_bar() {
    // if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    // }
}
add_action('after_setup_theme', 'remove_admin_bar');