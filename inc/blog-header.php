<?php
/**
 * Blog header layouts
 *
 * @package jinsy-magazine
 */

/**
 * Disable Blog Header
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jinsy_magazine_blog_header_layout_controls( $wp_customize ) {

	/* Blog header layout control */
	$wp_customize->add_setting(
		'jinsy_magazine_blog_header_layout',
		array(
			'default' => true,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'jinsy_magazine_blog_header_layout',
			array(
				'label'    => esc_html__( 'Disable Blog Header', 'jinsy-magazine' ),
				'section'  => 'hestia_blog_layout',
				'type'     => 'checkbox',
				'priority' => 27,
			)
		)
	);
}

if ( wp_get_theme()->Template === 'hestia' ) {
	add_action( 'customize_register', 'jinsy_magazine_blog_header_layout_controls', 101 );
}

/**
 * Check if blog header should bne hidden
 */
function jinsy_magazine_blog_header_hidden() {

	$disable_blog_header = get_theme_mod( 'jinsy_magazine_blog_header_layout', true );

	return $disable_blog_header;
}

/**
 * Add class on body tag for the third layout on blog-home and archive page
 */
function jinsy_magazine_header_layout_body_classes() {
	return 'classic-blog';
}

/**
 * Add classes on wrapper element for enabling the third layout option
 */
function jinsy_header_layout_body_classes() {
	return 'wrapper classic-blog';
}

/**
 * Disable header from blog and archive pages
 */
function jinsy_magazine_disable_blog_header() {

	if ( jinsy_magazine_blog_header_hidden() ) {

		/* Change header on archive pages */
		remove_all_actions( 'hestia_before_archive_content' );
		$header_layout = new Hestia_Header_Layout_Manager();
		add_action( 'hestia_before_archive_content', array( $header_layout, 'post_page_header' ) );

		/* Change header on blog page */
		remove_all_actions( 'hestia_before_index_content' );
	}
}
add_action( 'wp_enqueue_scripts', 'jinsy_magazine_disable_blog_header', 90 );


/**
 * Add compatibility with the third header layout when blog header is disabled
 * Filtering body and .wrapper classes to have the proper style on pages without header
 */
function jinsy_magazine_blog_without_header_style() {

	if ( jinsy_magazine_blog_header_hidden() ) {
		if ( is_home() || ( is_archive() && ! ( class_exists( 'WooCommerce' ) && is_product_category() ) ) ) {
			add_filter( 'hestia_header_layout', 'jinsy_magazine_header_layout_body_classes', 30 );
			add_filter( 'hestia_page_wrapper_class', 'jinsy_header_layout_body_classes' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'jinsy_magazine_blog_without_header_style', 100 );
