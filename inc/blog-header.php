<?php
/**
 * Blog header layouts
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
