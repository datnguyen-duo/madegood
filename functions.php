<?php 

function load_stylesheets()
{
	wp_enqueue_style('fonts', '//webfonts3.radimpesko.com/RP-W-ff9519f0-8b59-41be-9ba0-3ff43e58d308', array(), false, 'all');
    wp_enqueue_style( 'stylesheet-inline', get_stylesheet_directory_uri() . '/style-inline.css', array(), filemtime(get_stylesheet_directory() . '/style-inline.css') );
	wp_enqueue_style( 'stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css') );
}

function load_scripts()
{
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', [], false, array(
        'strategy' => 'defer'
    ));
    // wp_enqueue_script('jquery-validate', get_theme_file_uri('/scripts/plugins/jquery.validate.min.js'), NULL, '1', true);
    // wp_enqueue_script('select2', get_theme_file_uri('/scripts/plugins/select2.js'), NULL, '1', true);
	wp_enqueue_script('images-loaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', [], false, array(
        'strategy' => 'defer'
    ));
    wp_enqueue_script('scroll-smoother', get_template_directory_uri() . '/scripts/gsap-lib/ScrollSmoother.min.js', [], false, array(
        'strategy' => 'defer'
    ));
	wp_enqueue_script('gsap', get_template_directory_uri() . '/scripts/gsap-lib/gsap.min.js', [], false, array(
    'strategy' => 'defer'
    ));
	wp_enqueue_script('split-text', get_template_directory_uri() . '/scripts/gsap-lib/SplitText.min.js', [], false, array(
        'strategy' => 'defer'
    ));
	wp_enqueue_script('scrolltrigger', get_template_directory_uri() . '/scripts/gsap-lib/ScrollTrigger.min.js', [], false, array(
        'strategy' => 'defer'
    ));
	wp_enqueue_script('morphsvg', get_template_directory_uri() . '/scripts/gsap-lib/ScrollToPlugin.min.js', [], false, array(
        'strategy' => 'defer'
    ));
    wp_enqueue_script('motionpath', get_template_directory_uri() . '/scripts/gsap-lib/MotionPathPlugin.min.js', [], false, array(
        'strategy' => 'defer'
    ));
	wp_enqueue_script('scrollto', get_template_directory_uri() . '/scripts/gsap-lib/MorphSVGPlugin.min.js', [], false, array(
        'strategy' => 'defer'
    ));
    wp_enqueue_script('slick-js','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array(), [], false, array(
        'strategy' => 'defer'
    ));
	wp_enqueue_script('barba','https://unpkg.com/@barba/core', array(), [], false, array(
        'strategy' => 'defer'
    ));
    wp_enqueue_script('global-scripts', get_template_directory_uri() . '/scripts/global.min.js', array('jquery'), [], false, array(
        'strategy' => 'defer'
    ));
	wp_enqueue_script('page-scripts', get_template_directory_uri() . '/scripts/page.min.js', [], false, array(
        'strategy' => 'defer'
    ));
    wp_enqueue_script('woocommerce-custom-cart', get_theme_file_uri('/scripts/woocommerce-custom-cart.js'), NULL, '1.0', [], false, array(
        'strategy' => 'defer'
    ));
}

add_action('wp_enqueue_scripts', 'load_stylesheets');
add_action('wp_enqueue_scripts', 'load_scripts');
add_theme_support("menus");
add_theme_support('post-thumbnails');
add_theme_support( 'woocommerce' );

register_nav_menus(

    array(

        'main' => __('Main Menu'),
        'footer-nav' => __('Footer Menu'),

    )

);

add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
  wp_register_style( 'admin_css', get_template_directory_uri() . '/editor.css', false, '1.0.0' );

  wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/editor.css', false, '1.0.0' );
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	
}

function register_post_types() {
    register_post_type('case_studies',array(
        'labels' => array(
            'name' => _x('Case Studies', 'post type general name'),
            'singular_name' => _x('Case Study', 'post type singular name'),
            'menu_name' => 'Case Studies'
        ),
        'rewrite' => array(
            'slug' => 'case-studies',
            'with_front' => false
        ),
		'taxonomies' => array('category', 'post_tag'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => false,
        'hierarchical' => true,
        'supports' => array('title','thumbnail'),
        'menu_icon' => 'dashicons-format-gallery',
    ));

    register_post_type('services',array(
        'labels' => array(
            'name' => _x('Services', 'post type general name'),
            'singular_name' => _x('Service', 'post type singular name'),
            'menu_name' => 'Services'
        ),
        'rewrite' => array(
            'slug' => 'services',
            'with_front' => false
        ),
		'taxonomies' => array('category', 'post_tag'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => false,
        'hierarchical' => true,
        'supports' => array('title','thumbnail'),
        'menu_icon' => 'dashicons-star-filled',
    ));
	
	register_post_type('works',array(
        'labels' => array(
            'name' => _x('Works', 'post type general name'),
            'singular_name' => _x('Works', 'post type singular name'),
            'menu_name' => 'Works'
        ),
        'rewrite' => array(
            'slug' => 'works',
            'with_front' => false
        ),
		'taxonomies' => array('category', 'post_tag'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => false,
        'hierarchical' => true,
        'supports' => array('title','thumbnail', 'editor'),
        'menu_icon' => 'dashicons-portfolio',
    ));

}
add_action('init','register_post_types');

require_once("inc/woocommerce-custom-cart.php");
require_once("inc/woocommerce-custom-product-fields.php");
require_once("inc/products-filter.php");

add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
    wp_dequeue_style( 'wp-block-library' ); // Wordpress core
    wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
    wp_dequeue_style( 'wc-block-style' ); // WooCommerce
    wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
    wp_dequeue_style( 'classic-theme-styles' );
}