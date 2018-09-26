<?php
/**
 * Disable Header controls and functions
 *
 * @package jinsy-magazine
 */

/**
 * Disable Header customizer controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jinsy_magazine_disable_header_controls( $wp_customize ) {
	$wp_customize->add_setting(
		'jinsy_magazine_disable_header_layout',
		array(
			'default' => true,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'jinsy_magazine_disable_header_layout',
			array(
				'label'    => esc_html__( 'Disable Header', 'jinsy-magazine' ),
				'section'  => 'header_image',
				'type'     => 'checkbox',
				'priority' => 10,
			)
		)
	);

	$object = $wp_customize->get_control( 'hestia_header_layout' );

	if ( ! empty( $object ) ) {
		$object->active_callback = 'jinsy_magazine_disable_header_active_callback';
	}
}
add_action( 'customize_register', 'jinsy_magazine_disable_header_controls', 101 );

/**
 * Hide header layout controls if header is disabled
 */
function jinsy_magazine_disable_header_active_callback() {
	if ( get_theme_mod( 'jinsy_magazine_disable_header_layout', true ) === true ) {
		return false;
	}
	return true;
}

/**
 * Third option of header layout control
 */
function jinsy_magazine_third_header_layout() {
	return 'classic-blog';
}

/**
 * Filter header layout in order to disable the header
 */
function jinsy_magazine_disable_header() {

	$disable_header = get_theme_mod( 'jinsy_magazine_disable_header_layout', true );

	if ( $disable_header ) {
		add_filter( 'theme_mod_hestia_header_layout', 'jinsy_magazine_third_header_layout' );
		remove_all_actions( 'hestia_before_index_content' );
	} else {
		remove_filter( 'theme_mod_hestia_header_layout', 'jinsy_magazine_third_header_layout' );
	}
}
add_action( 'wp', 'jinsy_magazine_disable_header', 0 );
