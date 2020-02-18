<?php
    /* ======================================================================
        EXTERNAL MODULES AND FILES BELOW
    Note: commenting out for now, not sure we need this for the Workz theme
	====================================================================== */
    //require get_parent_theme_file_path('inc/metabox/metabox.php');

    /* ======================================================================
        THEME SETTINGS
	====================================================================== */


    if (function_exists('add_theme_support')) {

        // Add Menu Support
        add_theme_support('menus');

        // Add Thumbnail Theme Support
        add_theme_support('post-thumbnails');
        add_image_size('large', 700, '', true); // Large Thumbnail
        add_image_size('medium', 250, '', true); // Medium Thumbnail
        add_image_size('small', 120, '', true); // Small Thumbnail

        add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
        add_image_size('slider_image', 920, 500, true); // Header custom size

        // Enables post and comment RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Localisation Support
        load_theme_textdomain('ar', get_stylesheet_directory() . '/languages');
    }

    /* ======================================================================
        LOAD ASSETS (CSS, JS)
    ====================================================================== */
    function enqueue_style_after_wc() {

        // Set this style below others

        $parent_style = 'arTheme_parent_style';
        $parent_base_dir = 'Workz';

        wp_enqueue_style( $parent_style,
            get_template_directory_uri() . '/style.css',
            array(),
            wp_get_theme( $parent_base_dir ) ? wp_get_theme( $parent_base_dir )->get('Version') : ''
        );

//        wp_enqueue_style( $parent_style . '_child_style',
//            get_stylesheet_directory_uri() . '/style.css',
//            array( $parent_style ),
//            wp_get_theme()->get('Version')
//        );

        function arTheme_styles() {
            // Normalize is loaded in Bootstrap and both are imported into the style.css via Sass
            wp_register_style('arBootstrapCss', get_stylesheet_directory_uri() . '/dist/style.min.css', array(), '1.0.0', 'all');
            wp_register_style('arThemeCss', get_stylesheet_directory_uri() . '/dist/main.style.css', array(), '1.0.0', 'all');
            wp_enqueue_style('arBootstrapCss'); // Enqueue it!
            wp_enqueue_style('arThemeCss'); // Enqueue it!
        }
    }
    add_action('wp_enqueue_scripts', 'enqueue_style_after_wc', 10 );

    // Remove 'text/css' from our enqueued stylesheet
    function arTheme_styles_remove($tag) {
        return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
    }


    // Load theme js
    function arTheme_scripts() {
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
            $ver =  time();
            wp_register_script('arThemeJs', get_stylesheet_directory_uri() . '/dist/main.bundle.js', array('jquery'), $ver, true);
            wp_enqueue_script( array('arThemeJs') );

        }
    }

    // Load conditional scripts
    function arTheme_conditional_scripts() {
        if (is_page('pagenamehere')) {
            $ver =  time();
            wp_register_script('scriptname', get_stylesheet_directory_uri() . '/js/scriptname.js', array('jquery'), $ver);
            wp_enqueue_script('scriptname'); // Enqueue it!
        }
    }

    // Async scripts
    function arTheme_add_script_tag_attributes($tag, $handle) {
        switch ($handle) {
            case ('arThemeJs'):
                return str_replace( ' src', ' async="async" src', $tag );
            break;

            // example adding CDN integrity and crossorigin attributes
            // Note: popper.js is loaded into the main.bundle.js from npm
            // Below are just examples
            case ('popper-js'):
                return str_replace( ' min.js', 'min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"', $tag );
            break;

            case ('bootstrap-js'):
                return str_replace( ' min.js', 'min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"', $tag );
            break;

            default:
                return $tag;

        }
    }

    // Remove all query strings
    function arTheme_script_version($src){
        $parts = explode('?ver', $src);
        return $parts[0];
    }

    // Remove jQuery migrate
    function arTheme_remove_jquery_migrate($scripts) {
        if (!is_admin() && isset($scripts->registered['jquery'])) {
            $script = $scripts->registered['jquery'];

            if ($script->deps) { // Check whether the script has any dependencies
                $script->deps = array_diff($script->deps, array(
                    'jquery-migrate'
                ));
            }
        }
    }



    // Remove the <div> surrounding the dynamic navigation to cleanup markup
    function arTheme_nav_menu_args($args = '') {
        $args['container'] = false;
        return $args;
    }

    // Remove Injected classes, ID's and Page ID's from Navigation <li> items
    function my_css_attributes_filter($var) {
        return is_array($var) ? array() : '';
    }

    function arTheme_widgets_init() {
        register_sidebar(
            array(
                'name'          => 'Footer column 1',
                'id'            => 'footer_col_1',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<h4>',
                'after_title'   => '</h4>',
            )
        );

        register_sidebar(
            array(
                'name'          => 'Footer column 2',
                'id'            => 'footer_col_2',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<h4>',
                'after_title'   => '</h4>',
            )
        );

        register_sidebar(
            array(
                'name'          => 'Footer column 3',
                'id'            => 'footer_col_3',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<h4>',
                'after_title'   => '</h4>',
            )
        );

    }

    /* ======================================================================
        ADD SLUG TO BODY CLASS
	====================================================================== */
    function arTheme_add_slug_to_body_class($classes) {
        global $post;
        if (is_home()) {
            $key = array_search('blog', $classes);
            if ($key > -1) {
                unset($classes[$key]);
            }
        } elseif (is_page()) {
            $classes[] = sanitize_html_class($post->post_name);
        } elseif (is_singular()) {
            $classes[] = sanitize_html_class($post->post_name);
        }

        return $classes;
    }

    /* ======================================================================
        REMOVE ADMIN BAR
	====================================================================== */
//    function arTheme_remove_admin_bar() {
//        return false;
//    }

    /* ======================================================================
        CUSTOM EXCERPTS
	====================================================================== */
    // Create 20 Word Callback for Index page Excerpts, call using arTheme_excerpt('arTheme_index');
    function arTheme_index($length) {
        return 20;
    }

    // Create 40 Word Callback for Custom Post Excerpts, call using arTheme_excerpt('arTheme_custom_post');
    function arTheme_custom_post($length) {
        return 40;
    }

    // Create the Custom Excerpts callback
    function arTheme_excerpt($length_callback = '', $more_callback = '') {
        global $post;
        if (function_exists($length_callback)) {
            add_filter('excerpt_length', $length_callback);
        }
        if (function_exists($more_callback)) {
            add_filter('excerpt_more', $more_callback);
        }
        $output = get_the_excerpt();
        $output = apply_filters('wptexturize', $output);
        $output = apply_filters('convert_chars', $output);
        $output = '<p>' . $output . '</p>';
        echo $output;
    }

    /* ======================================================================
        CUSTOM EXCERPTS
        Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
	====================================================================== */
    function arTheme_pagination() {
        global $wp_query;
        $big = 999999999;
        $links = paginate_links(array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '<span class="border p-1">&lt;</span>',
            'next_text' => '<span class="border p-1">&gt;</span>',
            'before_page_number' => '<span class="border p-1">',
            'after_page_number' => '</span>',
        ));
        if ( $links ) :
            echo $links;
        endif;
    }

    /* ======================================================================
        ENABLE THREADED COMMENTS
	====================================================================== */
    function arTheme_enable_threaded_comments() {
        if (!is_admin()) {
            if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
                wp_enqueue_script('comment-reply');
            }
        }
    }

    /* ======================================================================
        ADD BOOTSTRAP 4 .img-fluid CLASS TO IMAGES INSIDE POST CONTENT
	====================================================================== */

function arTheme_add_img_post_class( $content ) {
    // Bail if there is no content to work with.

    if ( ! $content ) {
        return $content;
    }

    // Create an instance of DOMDocument.
    $dom = new \DOMDocument();

    // Supress errors due to malformed HTML.
    // See http://stackoverflow.com/a/17559716/3059883
    $libxml_previous_state = libxml_use_internal_errors( true );

    // Populate $dom with $content, making sure to handle UTF-8.
    // Also, make sure that the doctype and HTML tags are not added to our
    // HTML fragment. http://stackoverflow.com/a/22490902/3059883
    $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ),
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

    // Restore previous state of libxml_use_internal_errors() now that we're done.
    libxml_use_internal_errors( $libxml_previous_state );

    // Create an instance of DOMXpath.
    $xpath = new \DOMXpath( $dom );

    // Get images then loop through and add additional classes.
    $imgs = $xpath->query( "//img" );
    foreach ( $imgs as $img ) {
        $existing_class = $img->getAttribute( 'class' );
        $img->setAttribute( 'class', "{$existing_class} img-fluid" );
    }

    // Save and return updated HTML.
    $new_content = $dom->saveHTML();
    return $new_content;
}

    // Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
    function arTheme_remove_thumbnail_dimensions($html) {
        $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
        return $html;
    }

    // Featured image behaviour on posts and pages
    if (!function_exists( 'arTheme_featured_image_behaviour')) :
        function arTheme_featured_image_behaviour() {
            $meta = get_post_meta(get_the_ID(), 'theme_options_featured-image-behaviour', true);
            echo $meta;
        }
    endif;

    /* ======================================================================
        ADD NATIVE LAZYLOAD SUPPORT
	====================================================================== */
//    function arTheme_lazy_load_attributes($content) {
//        /* Add loading="lazy" to all images filtered by the_content */
//        $content = str_replace('<img','<img loading="lazy"', $content);
//        /* Add loading="lazy" to all iframes filtered by the_content */
//        $content = str_replace('<iframe','<iframe loading="lazy"', $content);
//        return $content;
//    }

    /* ======================================================================
        REMOVE RECENT COMMENT STYLES
	====================================================================== */
    function arTheme_remove_recent_comments_style() {
        global $wp_widget_factory;
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }

    /* ======================================================================
        DELETE ALL YOAST PLUGIN SPAM
    ====================================================================== */
    if (defined('WPSEO_VERSION')) {
        add_action('get_header', function() {
            ob_start(function($o) {
                return preg_replace('/\n?<.*?yoast.*?>/mi','',$o);
            });
        });

        add_action('wp_head',function() {
            ob_end_flush();
        }, 999);
    }

    function arTheme_remove_yoast_json($data){
        $data = array();
        return $data;
    }

    /* ======================================================================
        STOP CONTACTFORM7 ADDING OWN STYLES
    ====================================================================== */
    add_filter('wpcf7_form_elements', function($content) {
        $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i',
            '\2',
            $content);
        return $content;
    });

    /* ======================================================================
        ACTIONS AND CLEANING
	====================================================================== */
    // Add Actions
    add_action('wp_enqueue_scripts', 'arTheme_styles'); // Add Theme Stylesheet
    add_action('init', 'arTheme_scripts'); // Add Custom Scripts to wp_head
    // add_action('wp_print_scripts', 'arTheme_conditional_scripts'); // Add Conditional Page Scripts
    add_action('wp_default_scripts', 'arTheme_remove_jquery_migrate'); // Remove jQuery migrate
    add_action('get_header', 'arTheme_enable_threaded_comments'); // Enable Threaded Comments
   // add_action('init', 'arTheme_register_menu'); // Add WP Bootstrap Sass Menu
    add_action('widgets_init', 'arTheme_widgets_init'); // Register all widget areas
    add_action('widgets_init', 'arTheme_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
    add_action('init', 'arTheme_pagination'); // Add our ar Pagination

    // Remove Actions
    remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
    remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
    remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
    remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
    remove_action('wp_head', 'index_rel_link'); // Index link
    remove_action('wp_head', 'parent_post_rel_link', 10); // Prev link
    remove_action('wp_head', 'start_post_rel_link', 10); // Start link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10); // Display relational links for the posts adjacent to the current post.
    remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'rel_canonical');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);

    // Add Filters
    // add_filter('script_loader_tag', 'arTheme_add_script_tag_attributes', 10, 2); // Add attributes to CDN script tag
    // add_filter('avatar_defaults', 'arThemegravatar'); // Custom Gravatar in Settings > Discussion
    add_filter( 'the_content', 'arTheme_add_img_post_class' );
    add_filter('body_class', 'arTheme_add_slug_to_body_class'); // Add slug to body class (Starkers build)
    add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
    add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
    add_filter('wp_nav_menu_args', 'arTheme_nav_menu_args'); // Remove surrounding <div> from WP Navigation
    // add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
    // add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
    // add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
    add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
    add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
    add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
    // add_filter('excerpt_more', 'arTheme_view_article'); // Add 'View Article' button instead of [...] for Excerpts
  //  add_filter('show_admin_bar', 'arTheme_remove_admin_bar'); // Remove Admin bar
    add_filter('style_loader_tag', 'arTheme_styles_remove'); // Remove 'text/css' from enqueued stylesheet
    add_filter('post_thumbnail_html', 'arTheme_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
    add_filter('image_send_to_editor', 'arTheme_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
   // add_filter('the_content', 'arTheme_add_class_to_image_in_content'); // Add .img-fluid class to images in the content
  //  add_filter('the_content','arTheme_lazy_load_attributes'); // Native lazyoad images for browsers with lazyload support
    add_filter('wpseo_json_ld_output', 'arTheme_remove_yoast_json', 10, 1); // Rwmove Yoast spam
    add_filter( 'wpcf7_load_js', '__return_false' ); // Remove contactform7 js if no form on page
    add_filter( 'wpcf7_load_css', '__return_false' ); // Remove contactform7 css if no form on page
    add_filter('script_loader_src', 'arTheme_script_version', 15, 1); // Remove query strings
    add_filter('style_loader_src', 'arTheme_script_version', 15, 1); // Remove query strings

    // Remove Filters
    remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
