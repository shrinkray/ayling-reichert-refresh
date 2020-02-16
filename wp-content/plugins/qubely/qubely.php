<?php
/*
 * Plugin Name:       Qubely - Advanced Gutenberg Blocks 
 * Plugin URI:        https://www.themeum.com/
 * Description:       The one and only Gutenberg block plugin you will ever need.
 * Version: 		  1.3.2
 * Author:            Themeum.com
 * Author URI:        https://themeum.com/
 * Text Domain:       qubely
 * Requires at least: 5.0
 * Tested up to: 	  5.3
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Language Load
add_action('init', 'qubely_language_load');
function qubely_language_load()
{
    load_plugin_textdomain('qubely', false,  basename(dirname(__FILE__)) . '/languages/');
}

// Define Version
define('QUBELY_VERSION', '1.3.2');

// Define License
define('QUBELY_LICENSE', 'free');

// Define Dir URL
define('QUBELY_DIR_URL', plugin_dir_url(__FILE__));

// Define Physical Path
define('QUBELY_DIR_PATH', plugin_dir_path(__FILE__));

// Include Require File
require_once QUBELY_DIR_PATH . 'core/initial-setup.php'; // Initial Setup Data

/**
 * Add qubely admin options page
 */
require_once QUBELY_DIR_PATH . 'core/Options.php';   // Loading QUBELY Blocks Main Files

// Page Template Added
require_once QUBELY_DIR_PATH.'core/Template.php';

if (class_exists('QUBELY_Options')){
    new QUBELY_Options();
}

// Version Check & Include Core
if (!version_compare(PHP_VERSION, '5.4', '>=')) {
    add_action('admin_notices', array('QUBELY_Initial_Setup', 'php_error_notice')); // PHP Version Check
} elseif (!version_compare(get_bloginfo('version'), '4.5', '>=')) {
    add_action('admin_notices', array('QUBELY_Initial_Setup', 'wordpress_error_notice')); // WordPress Version Check
} else {
    require_once QUBELY_DIR_PATH . 'core/QUBELY.php';   // Loading QUBELY Blocks Main Files
}

/**
 * Create API fields for additional info
 *
 * @since 1.0.9
 */
function qubely_register_rest_fields()
{
    $post_types = get_post_types();

    //featured image
    register_rest_field(
        $post_types,
        'qubely_featured_image_url',
        array(
            'get_callback' => 'qubely_get_featured_image_url',
            'update_callback' => null,
            'schema' => array(
                'description' => __('Different sized featured images'),
                'type' => 'array',
            ),
        )
    );
    // author info
    register_rest_field(
        'post',
        'qubely_author',
        array(
            'get_callback'    => 'qubely_get_author_info',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    // Add comment info.
    register_rest_field(
        'post',
        'qubely_comment',
        array(
            'get_callback'    => 'qubely_get_comment_info',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    // Category links.
    register_rest_field(
        'post',
        'qubely_category',
        array(
            'get_callback' => 'qubely_get_category_list',
            'update_callback' => null,
            'schema' => array(
                'description' => __('Category list links'),
                'type' => 'string',
            ),
        )
    );
}

//author
function qubely_get_author_info($object)
{
    $author['display_name'] = get_the_author_meta('display_name', $object['author']);
    $author['author_link'] = get_author_posts_url($object['author']);
    return $author;
}

//comment
function qubely_get_comment_info($object)
{
    $comments_count = wp_count_comments($object['id']);
    return $comments_count->total_comments;
}

//category list
if (!function_exists('qubely_get_category_list')) {
    function qubely_get_category_list($object)
    {
        return get_the_category_list(esc_html__(' '), '', $object['id']);
    }
}

//feature image
function qubely_get_featured_image_url($object)
{
    

    $featured_images = array();
    if (!isset($object['featured_media'])) {
        return $featured_images;
    } else {
        $image = wp_get_attachment_image_src($object['featured_media'], 'full', false);
        if (is_array($image)) {
            $featured_images['full'] = $image;
            $featured_images['landscape'] = wp_get_attachment_image_src($object['featured_media'], 'qubely_landscape', false);
            $featured_images['portraits'] = wp_get_attachment_image_src($object['featured_media'], 'qubely_portrait', false);
            $featured_images['thumbnail'] =  wp_get_attachment_image_src($object['featured_media'], 'qubely_thumbnail', false);
            
            $image_sizes = QUBELY::get_all_image_sizes();
            foreach ($image_sizes as $key => $value) {
                $size = $value['value'];
                $featured_images[$size] = wp_get_attachment_image_src(
                    $object['featured_media'],
                    $size,
                    false
                );
            }
            return $featured_images;
        }
    }
}
add_action('rest_api_init', 'qubely_register_rest_fields');

function qubely_blog_posts_image_sizes()
{
    add_image_size('qubely_landscape', 1200, 750, true);
    add_image_size('qubely_portrait', 540, 320, true);
    add_image_size('qubely_thumbnail', 140, 100, true);
}
add_action('after_setup_theme', 'qubely_blog_posts_image_sizes');
