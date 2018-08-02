<?php
/**
 * Inline style for the theme
 *
 * @package jinsy
 * @since 1.0.0
 */

function jinsy_inline_style() {

	$custom_css = '';

	$features_bg_color = get_theme_mod( 'jinsy_features_background_color', '#ffffff' );
	$shop_bg_color = get_theme_mod( 'jinsy_shop_background_color', '#ffffff' );
	$portfolio_bg_color = get_theme_mod( 'jinsy_portfolio_background_color', '#ffffff' );
	$team_bg_color = get_theme_mod( 'jinsy_team_background_color', '#ffffff' );
	$pricing_bg_color = get_theme_mod( 'jinsy_pricing_background_color', '#ffffff' );
	$testimonials_bg_color = get_theme_mod( 'jinsy_testimonials_background_color', '#ffffff' );
	$clients_bar_bg_color = get_theme_mod( 'jinsy_clients_bar_background_color', '#ffffff' );
	$blog_bg_color = get_theme_mod( 'jinsy_blog_background_color', '#ffffff' );

	if ( ! empty( $features_bg_color ) ) {
		$custom_css .= '
			.hestia-features {
				background-color: ' . esc_attr( $features_bg_color ) . '; 
			 }
		';
	}

	if ( ! empty( $shop_bg_color ) ) {
		$custom_css .= '
			.hestia-shop {
				background-color: ' . esc_attr( $shop_bg_color ) . '; 
			 }
		';
	}

	if ( ! empty( $portfolio_bg_color ) ) {
		$custom_css .= '
			.hestia-work {
				background-color: ' . esc_attr( $portfolio_bg_color ) . '; 
			 }
		';
	}

	if ( ! empty( $team_bg_color ) ) {
		$custom_css .= '
			.hestia-team {
				background-color: ' . esc_attr( $team_bg_color ) . '; 
			 }
		';
	}

	if ( ! empty( $pricing_bg_color ) ) {
		$custom_css .= '
			.hestia-pricing {
				background-color: ' . esc_attr( $pricing_bg_color ) . '; 
			 }
		';
	}

	if ( ! empty( $testimonials_bg_color ) ) {
		$custom_css .= '
			.hestia-testimonials {
				background-color: ' . esc_attr( $testimonials_bg_color ) . '; 
			 }
		';
	}

	if ( ! empty( $clients_bar_bg_color ) ) {
		$custom_css .= '
			.hestia-clients-bar {
				background-color: ' . esc_attr( $clients_bar_bg_color ) . '; 
			 }
		';
	}

	if ( ! empty( $blog_bg_color ) ) {
		$custom_css .= '
			.hestia-blogs {
				background-color: ' . esc_attr( $blog_bg_color ) . '; 
			 }
		';
	}

	wp_add_inline_style( 'jinsy_parent', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'jinsy_inline_style', 10 );
