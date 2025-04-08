<?php
/**
 * Plugin Name: Elementor Carousels
 * Description: Pure CSS carousel widgets for Elementor.
 * Version: 1.0.0
 * Author:  Rami Yushuvaev
 * Author URI: https://ChartsCSS.org/
 * Requires Plugins: elementor
 * Elementor tested up to: 3.28.0
 * Text Domain: elementor-carousels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Register widget assets.
function elementor_carousels_register_assets(): void {
	wp_register_style( 'css-carousel', plugins_url( 'assets/css/css-carousel.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'elementor_carousels_register_assets' );

// Register Elementor widget.
function elementor_carousels_register_widget( $widgets_manager ): void {
	require_once( __DIR__ . '/widgets/css-carousel.php' );
	$widgets_manager->register( new \CSS_Carousel_Widget() );
}
add_action( 'elementor/widgets/register', 'elementor_carousels_register_widget' );
