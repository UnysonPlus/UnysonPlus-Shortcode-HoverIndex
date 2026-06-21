<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/** @var array $atts */

if ( ! function_exists( 'sc_hvx_get' ) ) {
	function sc_hvx_get( $path, $atts, $default = '' ) {
		if ( function_exists( 'fw_akg' ) ) {
			$v = fw_akg( $path, $atts, null );
			if ( $v !== null ) { return $v; }
		}
		return isset( $atts[ $path ] ) ? $atts[ $path ] : $default;
	}
}

if ( ! function_exists( 'sc_hvx_render' ) ) {
	function sc_hvx_render( $atts ) {
		$items = sc_hvx_get( 'items', $atts, array() );
		if ( ! is_array( $items ) || empty( $items ) ) {
			if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
				return '<div class="fw-hvx__empty">' . esc_html__( 'Add at least one item.', 'fw' ) . '</div>';
			}
			return '';
		}

		$size    = sanitize_html_class( (string) sc_hvx_get( 'size', $atts, 'lg' ) );
		$ratio   = sanitize_html_class( (string) sc_hvx_get( 'preview_ratio', $atts, 'portrait' ) );
		$numbers = sc_hvx_get( 'show_numbers', $atts, 'yes' ) === 'yes';
		$divide  = sc_hvx_get( 'dividers', $atts, 'yes' ) === 'yes';

		// Compact preset-color fields store { custom: '#hex' / var(...) }.
		$var = function ( $key, $name ) use ( $atts ) {
			$raw = sc_hvx_get( $key, $atts, '' );
			if ( is_array( $raw ) && ! empty( $raw['custom'] ) ) {
				$c = preg_replace( '/[^#0-9a-zA-Z(),.%\s-]/', '', (string) $raw['custom'] );
				if ( $c !== '' ) { return $name . ':' . $c . ';'; }
			}
			return '';
		};
		$style_var  = $var( 'text_color', '--hvx-text' );
		$style_var .= $var( 'hover_color', '--hvx-accent' );
		$style_var .= $var( 'meta_color', '--hvx-meta' );

		$classes = array( 'fw-hvx', 'fw-hvx--size-' . $size, 'fw-hvx--ratio-' . $ratio );
		if ( $divide ) { $classes[] = 'fw-hvx--dividers'; }

		$atts['base_class']       = 'hover-index';
		$atts['unique_id_prefix'] = 'hvx-';
		$atts['css_class']        = trim( implode( ' ', $classes ) . ' ' . ( isset( $atts['css_class'] ) ? $atts['css_class'] : '' ) );

		// sc_build_wrapper_attr also stamps the Animations-tab effects (incl. the
		// GSAP Scroll Motion data-attributes) when the framework provides it.
		if ( function_exists( 'sc_build_wrapper_attr' ) ) {
			$attr = sc_build_wrapper_attr( $atts );
		} else {
			$attr = array( 'class' => esc_attr( $atts['css_class'] ) );
		}
		if ( $style_var !== '' ) {
			$attr['style'] = ( isset( $attr['style'] ) && $attr['style'] !== '' ? rtrim( $attr['style'], ';' ) . ';' : '' ) . $style_var;
		}
		$attr_html = function_exists( 'fw_attr_to_html' ) ? fw_attr_to_html( $attr ) : '';

		ob_start();
		echo '<div ' . $attr_html . '>';
		echo '<div class="fw-hvx__list">';
		$i = 0;
		foreach ( $items as $it ) {
			$i++;
			$title = esc_html( trim( (string) ( isset( $it['title'] ) ? $it['title'] : '' ) ) );
			$meta  = esc_html( trim( (string) ( isset( $it['meta'] ) ? $it['meta'] : '' ) ) );
			$year  = esc_html( trim( (string) ( isset( $it['year'] ) ? $it['year'] : '' ) ) );
			$img   = ( isset( $it['image'] ) && is_array( $it['image'] ) && ! empty( $it['image']['url'] ) ) ? (string) $it['image']['url'] : '';
			$lu    = trim( (string) ( isset( $it['link_url'] ) ? $it['link_url'] : '' ) );
			$lt    = ( isset( $it['link_target'] ) && $it['link_target'] === '_blank' ) ? '_blank' : '_self';
			$href  = $lu !== '' ? esc_url( $lu ) : '#';

			echo '<a class="fw-hvx__row" href="' . $href . '"'
				. ( $lt === '_blank' ? ' target="_blank" rel="noopener noreferrer"' : '' )
				. ( $img !== '' ? ' data-hvx-img="' . esc_url( $img ) . '"' : '' ) . '>';
			if ( $numbers ) { echo '<span class="fw-hvx__n">' . sprintf( '%02d', $i ) . '</span>'; }
			echo '<span class="fw-hvx__t">' . $title . '</span>';
			echo '<span class="fw-hvx__meta">' . $meta . '</span>';
			echo '<span class="fw-hvx__yr">' . $year . '</span>';
			if ( $img !== '' ) { echo '<img class="fw-hvx__thumb" src="' . esc_url( $img ) . '" alt="" loading="lazy" />'; }
			echo '</a>';
		}
		echo '</div>';
		echo '<div class="fw-hvx__peek" aria-hidden="true"><img alt="" src="" /></div>';
		echo '</div>';
		return ob_get_clean();
	}
}

echo sc_hvx_render( $atts );
