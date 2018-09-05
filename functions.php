<?php
/**
 * Jinsy Magazine functions and definitions.
 *
 * @package jinsy-magazine
 * @since 1.0.0
 */

define( 'JINSY_MAGAZINE_VERSION', '1.0.0' );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'jinsy_magazine_parent_css' ) ) :
	/**
	 * Enqueue parent style
	 *
	 * @since 1.0.0
	 */
	function jinsy_magazine_parent_css() {
		wp_enqueue_style( 'jinsy_magazine_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap' ), JINSY_MAGAZINE_VERSION );
		wp_style_add_data( 'jinsy_magazine_parent', 'rtl', 'replace' );
		wp_style_add_data( 'hestia_style', 'rtl', 'replace' );
	}

endif;
add_action( 'wp_enqueue_scripts', 'jinsy_magazine_parent_css', 10 );

/**
 * Default accent color
 */
function jinsy_magazine_accent_color_default() {
	return '#5e72e4';
}
add_filter( 'hestia_accent_color_default', 'jinsy_magazine_accent_color_default' );

/**
 * Default header gradient color
 */
function jinsy_magazine_header_gradient_default() {
	return '#8965e0';
}
add_filter( 'hestia_header_gradient_default', 'jinsy_magazine_header_gradient_default' );

/**
 * Default font
 */
function jinsy_magazine_font_deafult() {
	return 'Open Sans';
}
add_filter( 'hestia_headings_default', 'jinsy_magazine_font_deafult' );
add_filter( 'hestia_body_font_default', 'jinsy_magazine_font_deafult' );

/**
 * Default boxed-layout
 */
function jinsy_magazine_boxed_layout_default() {
	set_theme_mod( 'hestia_general_layout', 0 );
}
add_action( 'after_switch_theme', 'jinsy_magazine_boxed_layout_default' );

/**
 * Default padding for buttons styling
 */
function jinsy_magazine_button_padding_dimension_default() {
	return  json_encode(
		array(
			'desktop' => json_encode(
				array(
					'desktop_vertical'   => 10,
					'desktop_horizontal' => 20,
				)
			),
		)
	);
}
add_filter( 'hestia_button_padding_dimensions_default', 'jinsy_magazine_button_padding_dimension_default' );

/**
 * Default border-radius for buttons styling
 */
function jinsy_magazine_buttons_border_radius_default() {
	return 4;
}
add_filter( 'hestia_buttons_border_radius_default', 'jinsy_magazine_buttons_border_radius_default' );

/**
 * Import options from Hestia
 *
 * @since 1.0.0
 */
function jinsy_magazine_import_hestia_options() {
	$hestia_mods = get_option( 'theme_mods_hestia' );
	if ( ! empty( $hestia_mods ) ) {
		foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
			set_theme_mod( $hestia_mod_k, $hestia_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'jinsy_magazine_import_hestia_options' );

/**
 * Change default welcome notice that appears after theme first installed
 */
function jinsy_magazine_welcome_notice_filter() {

	$theme = wp_get_theme();

	$theme_name = $theme->get( 'Name' );
	$theme      = $theme->parent();

	$theme_slug = $theme->get_template();

	$var = '<p>' . sprintf( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$swelcome page%3$s.', $theme_name, '<a href="' . esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-welcome' ) ) . '">', '</a>' ) . '</p><p><a href="' . esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-welcome' ) ) . '" class="button" style="text-decoration: none;">' . sprintf( 'Get started with %s', $theme_name ) . '</a></p>';

	return wp_kses_post( $var );
}
add_filter( 'hestia_welcome_notice_filter', 'jinsy_magazine_welcome_notice_filter' );

/**
 * Change About page defaults
 *
 * @param string $old_value Old value beeing filtered.
 * @param string $parameter Specific parameter for filtering.
 */
function jinsy_magazine_about_page_filter( $old_value, $parameter ) {

	switch ( $parameter ) {
		case 'menu_name':
		case 'pro_menu_name':
			$return = esc_html__( 'About Jinsy Magazine', 'jinsy-magazine' );
			break;
		case 'page_name':
		case 'pro_page_name':
			$return = esc_html__( 'About Jinsy Magazine', 'jinsy-magazine' );
			break;
		case 'welcome_title':
		case 'pro_welcome_title':
			/* translators: s - theme name */
			$return = sprintf( esc_html__( 'Welcome to %s! - Version ', 'jinsy-magazine' ), 'Jinsy Magazine' );
			break;
		case 'welcome_content':
		case 'pro_welcome_content':
			$return = esc_html__( 'Jinsy Magazine is a multipurpose WordPress theme built on Argon design. The theme is fully responsive and provides a ton of customization options that give you the flexibility you need for a unique brand. To keep pace with the latest technology, Jinsy Magazine is fully compatible with the popular Elementor and Gutenberg page builders, and will work seamlessly if you plan to use it for Ecommerce. The theme was created on a single-page layout and comes with elegant parallax scrolling. The blog page has a grid system and lets you set from 1 to 4 columns with articles, also multiple articles from the same category can be set as featured posts. Jinsy Magazine is an optimal choice for startups, small businesses, agencies, magazines, news sites, and online shops. Overall, a friendly and modern theme providing custom sections and typography, catchy animations, call-to-action forms, and a lightweight interface. Moreover, it was built with SEO in mind.', 'jinsy-magazine' );
			break;
		default:
			$return = '';
	}
	return $return;
}
add_filter( 'hestia_about_page_filter', 'jinsy_magazine_about_page_filter', 0, 3 );

/**
 * Declare text domain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function jinsy_magazine_theme_setup() {
	load_child_theme_textdomain( 'jinsy-magazine', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'jinsy_magazine_theme_setup' );
