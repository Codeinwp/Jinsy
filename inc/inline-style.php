<?php
/**
 * Inline style
 *
 * @package jinsy-magazine
 */

/**
 * Inline style when parent theme is Hestia
 */
function jinsy_magazine_inline_style() {

	$accent_color = get_theme_mod( 'accent_color', '#5e72e4' );

	$custom_css = '';

	$custom_css .= '
		.header-filter::before {
            background-color: rgba(0, 0, 0, 0.2);
		}
	';
	if ( ! empty( $accent_color ) && function_exists( 'hestia_hex_rgba' ) ) {
		$custom_css .= '
			.hestia-scroll-to-top,
			.hestia-scroll-to-top:hover {
				background-color: ' . esc_html( $accent_color ) . ';
			}
		';
		$custom_css .= '
			.hestia-scroll-to-top {
				-webkit-box-shadow: 0 2px 2px 0 ' . hestia_hex_rgba( $accent_color, '0.14' ) . ',0 3px 1px -2px ' . hestia_hex_rgba( $accent_color, '0.2' ) . ',0 1px 5px 0 ' . hestia_hex_rgba( $accent_color, '0.12' ) . ';
		    box-shadow: 0 2px 2px 0 ' . hestia_hex_rgba( $accent_color, '0.14' ) . ',0 3px 1px -2px ' . hestia_hex_rgba( $accent_color, '0.2' ) . ',0 1px 5px 0 ' . hestia_hex_rgba( $accent_color, '0.12' ) . ';
			}
		';
		$custom_css .= '
			.hestia-scroll-to-top:hover {
				-webkit-box-shadow: 0 14px 26px -12px' . hestia_hex_rgba( $accent_color, '0.42' ) . ',0 4px 23px 0 rgba(0,0,0,0.12),0 8px 10px -5px ' . hestia_hex_rgba( $accent_color, '0.2' ) . ';
		    box-shadow: 0 14px 26px -12px ' . hestia_hex_rgba( $accent_color, '0.42' ) . ',0 4px 23px 0 rgba(0,0,0,0.12),0 8px 10px -5px ' . hestia_hex_rgba( $accent_color, '0.2' ) . ';
			}
		';
	}

	if ( ! empty( $accent_color ) ) {
		$custom_css .= '
			.hestia-top-bar {
				background-color: ' . esc_html( $accent_color ) . ';
			}
		';
	}

	wp_add_inline_style( 'hestia_style', $custom_css );
}

if ( wp_get_theme()->Template === 'hestia' ) {
	add_action( 'wp_enqueue_scripts', 'jinsy_magazine_inline_style', 20 );
}
