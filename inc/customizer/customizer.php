<?php
/**
 * Customizer functionality for the theme
 *
 * @package jinsy
 * @since 1.0.0
 */

function jinsy_customize_register( $wp_customize ) {

	/* Jinsy Options Panel */
	$wp_customize->add_panel(
		'jinsy_options',
		array(
			'priority' => 50,
			'title'    => esc_html__( 'Jinsy Options', 'jinsy' ),
		)
	);

	/* Features section */
	$wp_customize->add_section(
		'jinsy_features_settings',
		array(
			'priority' => 5,
			'title'    => esc_html__( 'Features Section', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Features color control */
	$wp_customize->add_setting(
		'jinsy_features_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_features_background_color',
			array(
				'priority' => 5,
				'label'    => 'Features Background Color',
				'section'  => 'jinsy_features_settings',
			)
		)
	);

	/* Shop section */
	$wp_customize->add_section(
		'jinsy_shop_settings',
		array(
			'priority' => 10,
			'title'    => esc_html__( 'Shop Section ', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Shop color control */
	$wp_customize->add_setting(
		'jinsy_shop_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_shop_background_color',
			array(
				'priority' => 5,
				'label'    => 'Shop Background Color',
				'section'  => 'jinsy_shop_settings',
			)
		)
	);

	/* Portfolio section */
	$wp_customize->add_section(
		'jinsy_portfolio_settings',
		array(
			'priority' => 15,
			'title'    => esc_html__( 'Portfolio Section ', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Portfolio color control */
	$wp_customize->add_setting(
		'jinsy_portfolio_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_portfolio_background_color',
			array(
				'priority' => 5,
				'label'    => 'Portfolio Background Color',
				'section'  => 'jinsy_portfolio_settings',
			)
		)
	);

	/* Team section */
	$wp_customize->add_section(
		'jinsy_team_settings',
		array(
			'priority' => 20,
			'title'    => esc_html__( 'Team Section ', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Team color control */
	$wp_customize->add_setting(
		'jinsy_team_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_team_background_color',
			array(
				'priority' => 5,
				'label'    => 'Team Background Color',
				'section'  => 'jinsy_team_settings',
			)
		)
	);

	/* Pricing section */
	$wp_customize->add_section(
		'jinsy_pricing_settings',
		array(
			'priority' => 25,
			'title'    => esc_html__( 'Pricing Section ', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Pricing color control */
	$wp_customize->add_setting(
		'jinsy_pricing_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_pricing_background_color',
			array(
				'priority' => 5,
				'label'    => 'Pricing Background Color',
				'section'  => 'jinsy_pricing_settings',
			)
		)
	);

	/* Testimonials section */
	$wp_customize->add_section(
		'jinsy_testimonials_settings',
		array(
			'priority' => 30,
			'title'    => esc_html__( 'Testimonials Section ', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Testimonials color control */
	$wp_customize->add_setting(
		'jinsy_testimonials_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_testimonials_background_color',
			array(
				'priority' => 5,
				'label'    => 'Testimonials Background Color',
				'section'  => 'jinsy_testimonials_settings',
			)
		)
	);

	/* Clients Bar section */
	$wp_customize->add_section(
		'jinsy_clients_bar_settings',
		array(
			'priority' => 35,
			'title'    => esc_html__( 'Clients Bar Section ', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Clients Bar color control */
	$wp_customize->add_setting(
		'jinsy_clients_bar_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_clients_bar_background_color',
			array(
				'priority' => 5,
				'label'    => 'Clients Bar Background Color',
				'section'  => 'jinsy_clients_bar_settings',
			)
		)
	);

	/* Blog section */
	$wp_customize->add_section(
		'jinsy_blog_settings',
		array(
			'priority' => 40,
			'title'    => esc_html__( 'Blog Section ', 'jinsy' ),
			'panel'    => 'jinsy_options',
		)
	);
	/* Blog color control */
	$wp_customize->add_setting(
		'jinsy_blog_background_color',
		array(
			'default' => '#ffffff',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jinsy_blog_background_color',
			array(
				'priority' => 5,
				'label'    => 'Blog Background Color',
				'section'  => 'jinsy_blog_settings',
			)
		)
	);

}

add_action( 'customize_register', 'jinsy_customize_register', 99 );
