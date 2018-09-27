<?php
/**
 * Functions for magazine layout
 *
 * @package jinsy-magazine
 */

/**
 * Customizer controls for magazine layout feature
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since 1.0.0
 */
function jinsy_magazine_customize_register( $wp_customize ) {

	/* Magazine layout control */
	$wp_customize->add_setting(
		'jinsy_magazine_magazine_layout',
		array(
			'default' => true,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'jinsy_magazine_magazine_layout',
			array(
				'label'    => esc_html__( 'Enable Magazine Layout', 'jinsy-magazine' ),
				'section'  => 'hestia_blog_layout',
				'type'     => 'checkbox',
				'priority' => 26,
			)
		)
	);

	$object = $wp_customize->get_control( 'hestia_alternative_blog_layout' );

	if ( ! empty( $object ) ) {
		$object->active_callback = 'jinsy_magazine_magazine_layout_active_callback';
	}

	$object = $wp_customize->get_control( 'hestia_pagination_type' );

	if ( ! empty( $object ) ) {
		$object->active_callback = 'jinsy_magazine_magazine_layout_active_callback';
	}
}

/**
 * Hide blog layout controls when magazine layout is enabled
 *
 * @return bool
 */
function jinsy_magazine_magazine_layout_active_callback() {
	if ( get_theme_mod( 'jinsy_magazine_magazine_layout', true ) === true ) {
		return false;
	}
	return true;
}

/**
 * Blog layout when magazine layout is enabled
 *
 * @return string
 */
function jinsy_magazine_grid_layout() {
	return 'blog_alternative_layout2';
}

/**
 * Number of columns for the blog grid when magazine layout is enabled
 *
 * @return int
 */
function jinsy_magazine_grid_layout_columns() {
	return 3;
}

/**
 * Enable masonry when magazine layout is enabled
 *
 * @return bool
 */
function jinsy_magazine_enable_masonry() {
	return true;
}

/**
 * Disable infinite scroll when magazine layout is enabled
 *
 * @return string
 */
function jinsy_magazine_pagination_type() {
	return 'number';
}

/**
 * Set classic blog for header layout while magazine layout is enabled
 */
function jinsy_magazine_classic_blog_header_layout() {
	return 'classic-blog';
}

/**
 * Magazine layout
 */
function jinsy_magazine_enable_magazine_layout() {

	$enable_magazine_layout = get_theme_mod( 'jinsy_magazine_magazine_layout', true );

	if ( $enable_magazine_layout ) {
		add_filter( 'theme_mod_hestia_alternative_blog_layout', 'jinsy_magazine_grid_layout' );
		add_filter( 'theme_mod_hestia_grid_layout', 'jinsy_magazine_grid_layout_columns' );
		add_filter( 'theme_mod_hestia_enable_masonry', 'jinsy_magazine_enable_masonry' );
		add_filter( 'theme_mod_hestia_pagination_type', 'jinsy_magazine_pagination_type' );
		add_filter( 'hestia_header_layout', 'jinsy_magazine_classic_blog_header_layout' );
		remove_all_actions( 'hestia_before_index_content' );
	} else {
		remove_filter( 'theme_mod_hestia_alternative_blog_layout', 'jinsy_magazine_grid_layout' );
		remove_filter( 'theme_mod_hestia_grid_layout', 'jinsy_magazine_grid_layout_columns' );
		remove_filter( 'theme_mod_hestia_enable_masonry', 'jinsy_magazine_enable_masonry' );
		remove_filter( 'theme_mod_hestia_pagination_type', 'jinsy_magazine_pagination_type' );
	}
}

if ( wp_get_theme()->Template === 'hestia' ) {
	add_action( 'wp', 'jinsy_magazine_enable_magazine_layout', 0 );
	add_action( 'customize_register', 'jinsy_magazine_customize_register', 100 );
}
