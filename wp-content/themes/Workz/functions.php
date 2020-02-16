<?php

/**
* @package WordPress
 * @subpackage workz Theme
*/


// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) 
    $content_width = 620;
/*-----------------------------------------------------------------------------------*/
/*	Include functions
/*-----------------------------------------------------------------------------------*/
require(get_template_directory() .'/admin/theme-admin.php');
require(get_template_directory() .'/functions/pagination.php');
require(get_template_directory() .'/functions/better-excerpts.php');
require(get_template_directory() .'/functions/shortcodes.php');
require(get_template_directory() .'/functions/meta/meta-box-class.php');
require(get_template_directory() .'/functions/meta/meta-box-usage.php');
//require(get_template_directory() .'/functions/flickr-widget.php'); // Commenting out this function. Is throwing errors in Query Monitor, there is a deprecated constructor


/*-----------------------------------------------------------------------------------*/
/*	Images
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'full-size',  9999, 9999, false );
	add_image_size( 'nivo-slider',  920, 360, true );
	add_image_size( 'post-image',  660, 220, true );
	add_image_size( 'portfolio-thumb',  215, 140, true );
	add_image_size( 'portfolio-single',  500, 9999, false );
}
/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts','wpex_theme_scripts_function');
function wpex_theme_scripts_function() {
	// CSS
	wp_enqueue_style('prettyPhoto',get_template_directory_uri() . '/css/prettyPhoto.css');
	wp_enqueue_style('arvo-g-font', '//fonts.googleapis.com/css?family=Arvo:400,700,700italic');
	wp_enqueue_style('droid-serif-g-font','//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700italic');
	// Load jQuery
	wp_enqueue_script('jquery');	
	// Site wide js
	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', array('jquery'), '', true);
	wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '', true);
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true);
	//portfolio main
	if(is_page_template('template-portfolio.php')) {
		wp_enqueue_script('portfolio', get_template_directory_uri() . '/js/portfolio.js', array('jquery'), '', true);
	}
	//portfolio single
	if( get_post_type() == 'portfolio') {
		wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '', true);
	}
	//homepage js
	if(is_front_page()) {	
		wp_enqueue_script('nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'), '', true);
	}
}
/*-----------------------------------------------------------------------------------*/
/*	Sidebars
/*-----------------------------------------------------------------------------------*/
//Register Sidebars
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => 'Widgets in this area will be shown in the sidebar.',
		'before_widget' => '<div class="sidebar-box clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4><span>',
		'after_title' => '</span></h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Left',
		'id' => 'footer-left',
		'description' => 'Widgets in this area will be shown in the footer left area.',
		'before_widget' => '<div class="footer-widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Middle',
		'id' => 'footer-middle',
		'description' => 'Widgets in this area will be shown in the footer middle area.',
		'before_widget' => '<div class="footer-widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Right',
		'id' => 'footer-right',
		'description' => 'Widgets in this area will be shown in the footer right area.',
		'before_widget' => '<div class="footer-widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
));
/*-----------------------------------------------------------------------------------*/
/*	Custom Post Types & Taxonomies
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'wpex_create_post_types' );
function wpex_create_post_types() {
	//slider post type
	register_post_type( 'Slides',
		array(
		  'labels' => array(
			'name' => __( 'HP Slides', 'workz' ),
			'singular_name' => __( 'Slide', 'workz' ),		
			'add_new' => _x( 'Add New', 'Slide', 'workz' ),
			'add_new_item' => __( 'Add New Slide', 'workz' ),
			'edit_item' => __( 'Edit Slide', 'workz' ),
			'new_item' => __( 'New Slide', 'workz' ),
			'view_item' => __( 'View Slide', 'workz' ),
			'search_items' => __( 'Search Slides', 'workz' ),
			'not_found' =>  __( 'No Slides found', 'workz' ),
			'not_found_in_trash' => __( 'No Slides found in Trash', 'workz' ),
			'parent_item_colon' => ''
		  ),
		  'public' => true,
		  'supports' => array('title','thumbnail'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'slides' ),
		)
	  );
	//hp highlights
	register_post_type( 'hp_highlights',
		array(
		  'labels' => array(
			'name' => __( 'HP Highlights', 'workz' ),
			'singular_name' => __( 'Highlight', 'workz' ),		
			'add_new' => _x( 'Add New', 'Highlight', 'workz' ),
			'add_new_item' => __( 'Add New Highlight', 'workz' ),
			'edit_item' => __( 'Edit Highlight', 'workz' ),
			'new_item' => __( 'New Highlight', 'workz' ),
			'view_item' => __( 'View Highlight', 'workz' ),
			'search_items' => __( 'Search Highlights', 'workz' ),
			'not_found' =>  __( 'No Highlights found', 'workz' ),
			'not_found_in_trash' => __( 'No Highlights found in Trash', 'workz' ),
			'parent_item_colon' => ''
		  ),
		  'public' => true,
		  'supports' => array('title','editor'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'hp-highlights' ),
		)
	  );
	//portfolio post type
	register_post_type( 'Portfolio',
		array(
		  'labels' => array(
			'name' => __( 'Portfolio', 'workz' ),
			'singular_name' => __( 'Portfolio', 'workz' ),		
			'add_new' => _x( 'Add New', 'Portfolio Project', 'workz' ),
			'add_new_item' => __( 'Add New Portfolio Project', 'workz' ),
			'edit_item' => __( 'Edit Portfolio Project', 'workz' ),
			'new_item' => __( 'New Portfolio Project', 'workz' ),
			'view_item' => __( 'View Portfolio Project', 'workz' ),
			'search_items' => __( 'Search Portfolio Projects', 'workz' ),
			'not_found' =>  __( 'No Portfolio Projects found', 'workz' ),
			'not_found_in_trash' => __( 'No Portfolio Projects found in Trash', 'workz' ),
			'parent_item_colon' => ''
		  ),
		  'public' => true,
		  'supports' => array('title','editor','thumbnail'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'portfolio' ),
		)
	  );
}
// Add taxonomies
add_action( 'init', 'wpex_create_taxonomies' );
function wpex_create_taxonomies() {
// portfolio taxonomies
	$cat_labels = array(
		'name' => __( 'Portfolio Categories', 'workz' ),
		'singular_name' => __( 'Portfolio Category', 'workz' ),
		'search_items' =>  __( 'Search Portfolio Categories', 'workz' ),
		'all_items' => __( 'All Portfolio Categories', 'workz' ),
		'parent_item' => __( 'Parent Portfolio Category', 'workz' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'workz' ),
		'edit_item' => __( 'Edit Portfolio Category', 'workz' ),
		'update_item' => __( 'Update Portfolio Category', 'workz' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'workz' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'workz' ),
		'choose_from_most_used'	=> __( 'Choose from the most used portfolio categories', 'workz' )
	); 	
	register_taxonomy('portfolio_cats','portfolio',array(
		'hierarchical' => false,
		'labels' => $cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	));
}
/*-----------------------------------------------------------------------------------*/
/*	Portfolio Cat Pagination
/*-----------------------------------------------------------------------------------*/
// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
	global $option_posts_per_page;
    if ( is_tax( 'portfolio_cats') ) {
        return 8;
    }
	else {
        return $option_posts_per_page;
    }
}
/*-----------------------------------------------------------------------------------*/
/*	Other functions
/*-----------------------------------------------------------------------------------*/
// Limit Post Word Count
function wpex_new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'wpex_new_excerpt_length');
//Replace Excerpt Link
function wpex_new_excerpt_more($more) {
       global $post;
	return '...';
}
add_filter('excerpt_more', 'wpex_new_excerpt_more');
// Enable Custom Background
add_theme_support( 'custom-background' );
// register navigation menus
register_nav_menus(
	array(
	'menu'=>__('Menu'),
	)
);
/// add home link to menu
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
// menu fallback
function default_menu() {
	require_once (TEMPLATEPATH . '/includes/default-menu.php');
}
// Localization Support
load_theme_textdomain( 'workz', TEMPLATEPATH.'/lang' );
// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}
?>