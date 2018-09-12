<?php
/**
 * Inline style
 */

function jinsy_magazine_inline_style() {

	$custom_css = '';

	$custom_css .= '
		.header-filter::before {
            background-color: rgba(0, 0, 0, 0.2);
		}
	';

	wp_add_inline_style( 'hestia_style', $custom_css );
}

if ( wp_get_theme()->Template === 'hestia' ) {
	add_action( 'wp_enqueue_scripts', 'jinsy_magazine_inline_style', 20 );
}