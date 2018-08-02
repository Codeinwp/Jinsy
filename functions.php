<?php
/**
 * Jinsy functions and definitions.
 *
 * @package jinsy
 * @since 1.0.0
 */

define( 'JINSY_VERSION', '1.0.0' );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'jinsy_parent_css' ) ) :
	/**
	 * Enqueue parent style
	 *
	 * @since 1.0.0
	 */
	function jinsy_parent_css() {
		wp_enqueue_style( 'jinsy_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap' ), JINSY_VERSION );
		wp_style_add_data( 'jinsy_parent', 'rtl', 'replace' );
		wp_style_add_data( 'hestia_style', 'rtl', 'replace' );
	}

endif;
add_action( 'wp_enqueue_scripts', 'jinsy_parent_css', 10 );

/* Enqueue files */
if ( file_exists( get_stylesheet_directory() . '/inc/customizer/customizer.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/customizer/customizer.php';
}

if ( file_exists( get_stylesheet_directory() . '/inc/inline-style.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/inline-style.php';
}

/**
 * Import options from Hestia
 *
 * @since 1.0.0
 */
function jinsy_import_hestia_options() {
	$hestia_mods = get_option( 'theme_mods_hestia' );
	if ( ! empty( $hestia_mods ) ) {
		foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
			set_theme_mod( $hestia_mod_k, $hestia_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'jinsy_import_hestia_options' );

/**
 * Change default welcome notice that appears after theme first installed
 */
function jinsy_welcome_notice_filter() {

	$theme = wp_get_theme();

	$theme_name = $theme->get( 'Name' );
	$theme      = $theme->parent();

	$theme_slug = $theme->get_template();

	$var = '<p>' . sprintf( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$swelcome page%3$s.', $theme_name, '<a href="' . esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-welcome' ) ) . '">', '</a>' ) . '</p><p><a href="' . esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-welcome' ) ) . '" class="button" style="text-decoration: none;">' . sprintf( 'Get started with %s', $theme_name ) . '</a></p>';

	return wp_kses_post( $var );
}
add_filter( 'hestia_welcome_notice_filter', 'jinsy_welcome_notice_filter' );

/**
 * Change About page defaults
 *
 * @param string $old_value Old value beeing filtered.
 * @param string $parameter Specific parameter for filtering.
 */
function jinsy_about_page_filter( $old_value, $parameter ) {

	switch ( $parameter ) {
		case 'menu_name':
		case 'pro_menu_name':
			$return = esc_html__( 'About jinsy', 'jinsy' );
			break;
		case 'page_name':
		case 'pro_page_name':
			$return = esc_html__( 'About jinsy', 'jinsy' );
			break;
		case 'welcome_title':
		case 'pro_welcome_title':
			/* translators: s - theme name */
			$return = sprintf( esc_html__( 'Welcome to %s! - Version ', 'jinsy' ), 'jinsy' );
			break;
		case 'welcome_content':
		case 'pro_welcome_content':
			$return = esc_html__( 'jinsy is a responsive WordPress theme, built to fit all kinds of businesses. Its multipurpose design is great for small businesses, startups, corporate businesses, freelancers, portfolios, WooCommerce, creative agencies, or niche websites (medical, restaurants, sports, fashion). jinsy was created on top of Now UI Kit and displays an elegant one-page layout, complemented by the smooth parallax effect. The theme comes with a clean look, but it also provides subtle hover animations. Moreover, jinsy offers Sendinblue newsletter integration, a flexible interface via Live Customizer, a widgetized footer, full compatibility with Elementor and Beaver Builder, a full-width featured slider, and even more functionality based on the latest WordPress trends. Last but not least, the theme is lightweight and SEO-friendly.', 'jinsy' );
			break;
		default:
			$return = '';
	}
	return $return;
}
add_filter( 'hestia_about_page_filter', 'jinsy_about_page_filter', 0, 3 );

/**
 * Declare text domain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function jinsy_theme_setup() {
	load_child_theme_textdomain( 'jinsy', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'jinsy_theme_setup' );
