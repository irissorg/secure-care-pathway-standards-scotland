<?php
/**
 * secure-care-pathway-standards-scotland Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package secure-care-pathway-standards-scotland
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_SECURE_CARE_PATHWAY_STANDARDS_SCOTLAND_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'secure-care-pathway-standards-scotland-theme-css', get_stylesheet_directory_uri() . '/style.css', array('secure-care-pathway-standards-scotland-theme-js'), CHILD_THEME_SECURE_CARE_PATHWAY_STANDARDS_SCOTLAND_VERSION, 'all' );
	wp_enqueue_script('sec-theme-js', get_stylesheet_directory_uri() . '/script.js', array(), CHILD_THEME_SECURE_CARE_PATHWAY_STANDARDS_SCOTLAND_VERSION, 'all');

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );