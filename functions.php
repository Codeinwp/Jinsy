<?php
/**
 * Jinsy Magazine functions and definitions.
 *
 * @package jinsy-magazine
 * @since 1.0.0
 */

define( 'JINSY_MAGAZINE_VERSION', '1.0.2' );

$vendor_file = trailingslashit( get_stylesheet_directory() ) . 'vendor/autoload.php';
if ( is_readable( $vendor_file ) ) {
	require_once $vendor_file;
}
add_filter(
	'themeisle_sdk_products',
	function ( $products ) {
		$products[] = get_stylesheet_directory() . '/style.css';
		return $products;
	}
);

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

if ( file_exists( get_stylesheet_directory() . '/inc/magazine-layout.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/magazine-layout.php';
}

if ( file_exists( get_stylesheet_directory() . '/inc/blog-header.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/blog-header.php';
}

if ( file_exists( get_stylesheet_directory() . '/inc/inline-style.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/inline-style.php';
}

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
 * Default header alignment - center
 */
function jinsy_magazine_header_alignemnt_default() {
	return 'center';
}
add_filter( 'hestia_header_alignment_default', 'jinsy_magazine_header_alignemnt_default' );

/**
 * Default padding for buttons styling
 */
function jinsy_magazine_button_padding_dimension_default() {
	return json_encode(
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
 * Default background type for Big Title section
 */
function jinsy_magazine_big_title_background_default() {
	set_theme_mod( 'hestia_slider_type', 'parallax' );
}

add_action( 'after_switch_theme', 'jinsy_magazine_big_title_background_default' );

/**
 * Default image for parallax layer1 in Big Title section background
 *
 * @return string
 */
function jinsy_magazine_parallax_layer1_default() {
	return get_stylesheet_directory_uri() . '/assets/img/parallax_layer1.jpg';
}

add_action( 'hestia_parallax_layer1_default', 'jinsy_magazine_parallax_layer1_default' );

/**
 * Default image for parallax layer2 in Big Title section background
 *
 * @return string
 */
function jinsy_magazine_parallax_layer2_default() {
	return get_stylesheet_directory_uri() . '/assets/img/parallax_layer2.png';
}

add_action( 'hestia_parallax_layer2_default', 'jinsy_magazine_parallax_layer2_default' );

/**
 * Default color for header overlay
 *
 * @return string
 */
function jinsy_magazine_header_overlay_color_default() {
	return 'rgba(0,0,0,0.2)';
}
add_action( 'header_overlay_color', 'jinsy_magazine_header_overlay_color_default' );

/**
 * Enable scroll to top by default
 */
function jinsy_magazine_enable_scroll_to_top() {
	set_theme_mod( 'hestia_enable_scroll_to_top', true );
}
add_action( 'after_switch_theme', 'jinsy_magazine_enable_scroll_to_top' );

/**
 * Import options from Hestia
 *
 * @since 1.0.0
 */
function jinsy_magazine_import_hestia_options() {

	$previous_theme = strtolower( get_option( 'theme_switched' ) );
	$child_template = wp_get_theme()->Template;

	if ( $previous_theme !== $child_template ) {
		return;
	}

	$allowed_themes = array( 'hestia', 'hestia-pro' );
	if ( ! in_array( $previous_theme, $allowed_themes ) ) {
		return;
	}

	$hestia_mods = get_option( 'theme_mods_' . $child_template );
	if ( empty( $hestia_mods ) ) {
		return;
	}

	foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
		set_theme_mod( $hestia_mod_k, $hestia_mod_v );
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

function jinsy_magazine_blog_header_structure() {

}

//function header_layout_markup() {
//
//	return 'classic-blog';
//
//}
//
//function jinsy_empty_content() {
//	return '';
//}

function tmp() {

	$disable_blog_header = get_theme_mod( 'jinsy_magazine_blog_header_layout', true );

	if ( $disable_blog_header ) {

		remove_all_actions( 'hestia_before_archive_content' );
		$header_layout = new Hestia_Header_Layout_Manager();
//		add_action( 'hestia_before_archive_content', array( $header_layout, 'post_page_header' ) );
//		remove_all_actions( 'hestia_before_index_wrapper' );
//		remove_all_actions( 'hestia_before_archive_content' );
//		add_filter( 'hestia_header_layout', 'header_layout_markup' );
//		add_filter( 'hestia_header_title_structure', 'jinsy_empty_content', 100 );
//
	}
//	remove_all_actions( 'hestia_before_index_wrapper' );
}
add_action( 'init', 'tmp' );

/**
 * Add class on body tag to enable the third layout on blog-home and archive page
 */
function jinsy_magazine_header_layout_body_classes( $layout ) {
	if( is_home() || is_archive() ){
		return 'classic-blog';
	}
	return $layout;
}
add_filter( 'hestia_header_layout', 'jinsy_magazine_header_layout_body_classes', 30 );

/**
 * Add classes on wrapper element for enabling the third layout option
 */
function jinsy_header_layout_body_classes( $input ) {

	if ( is_home() || ( is_archive() && ! is_woocommerce() ) ) {
		return 'wrapper classic-blog';
	}

	return $input;
}
add_filter( 'hestia_page_wrapper_class', 'jinsy_header_layout_body_classes' );


function zuzu() {
//	if ( is_front_page() && is_home() ) {
//		var_dump('latest posts');
//		// Default homepage
//	} elseif ( is_front_page() ) {
//		var_dump('fp');
//		// static homepage
//	} elseif ( is_home() ) {
//		var_dump('blog');
//		// blog page
//	} else {
//		var_dump('altceva');
//		//everything else
//	}

	var_dump( is_archive() );
	var_dump( ( class_exists( 'WooCommerce' ) &&  is_product_category() ) );
}
add_action( 'wp_enqueue_scripts', 'zuzu' );

