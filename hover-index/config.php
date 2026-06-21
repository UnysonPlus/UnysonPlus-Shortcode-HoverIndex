<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Hover Index — an installable UnysonPlus shortcode (add-on, not bundled in core).
 * Install from the Shortcodes screen: paste the GitHub repo URL, or upload the zip.
 */

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => __( 'Hover Index', 'fw' ),
	'description' => __( 'A list of links where hovering a row floats a preview image that follows the cursor — the award-portfolio "selected work" index.', 'fw' ),
	'tab'         => __( 'Interactive', 'fw' ),
	'popup_size'  => 'large',

	'title_template' => '
		{{ if ( o && o["items"] && o["items"].length ) { }}
			<ul style="margin:.4rem 0 0;padding-left:1.1rem;">
				{{ for ( var i = 0; i < Math.min(o["items"].length,5); i++ ) { }}
					<li>{{- o["items"][i].title || "Untitled" }}</li>
				{{ } }}
			</ul>
		{{ } else { }}
			<em>No items added</em>
		{{ } }}
	',
);
