<?php
/*
 * Plugin Name: Metro Buttons
 * Plugin URI: http://satrya.me/metro-buttons/
 * Description: Easily display catchy looking Metro style button using shortcode in your posts, pages and widgets.
 * Version: 1.3
 * Author: Satrya
 * Author URI: http://satrya.me
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @author    Satrya
 * @copyright Copyright (c) 2013, Satrya
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Metro_Buttons {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		add_action( 'init', array( &$this, 'init' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 1.0
	 */
	public function constants() {

		define( 'METRO_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		define( 'METRO_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

	}

	/**
	 * Sets up actions/filters.
	 *
	 * @since 1.0
	 */
	public function init() {

		/* Enqueue stylesheets on 'wp_enqueue_scripts'. */
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_styles' ) );

		/* Register shortcodes. */
		add_shortcode( 'button', array( &$this, 'setup_shortcode' ) );

		/* Make text widgets shortcode aware. */
		add_filter( 'widget_text', 'do_shortcode' );

	}

	/**
	 * Enqueue stylesheet.
	 *
	 * @since 1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'metro-buttons-style', METRO_URI . 'button.css', false, '1.0' );
	}

	/**
	 * Setup the button shortcode.
	 *
	 * @since 1.0
	 */
	public function setup_shortcode( $atts, $content = "" ) {
		extract( shortcode_atts( array(
			'link'		=> '',
			'size'		=> 'medium',
			'color'		=> 'teal',
			'type'		=> 'square',
			'align'		=> 'none',
			'target'	=> '_self',
			'title'		=> ''
	    ), $atts ) );
	
		return '<a class="metro-button mtr-' . sanitize_html_class( $size ) . ' mtr-' . sanitize_html_class( $color ) . ' mtr-' . sanitize_html_class( $type ) . ' mtr-align' . sanitize_html_class( $align ) . '" href="' . esc_url( $link ) . '" title="' . strip_tags( $title ) . '" target="' . $target . '">' . do_shortcode( $content ) . '</a>';
	}

}

new Metro_Buttons();
?>