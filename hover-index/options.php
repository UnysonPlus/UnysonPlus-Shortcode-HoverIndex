<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	/* ========================== CONTENT ========================== */
	'tab_content' => array(
		'title'   => __( 'Content', 'fw' ),
		'type'    => 'tab',
		'options' => array(
			'group' => array(
				'type'    => 'group',
				'options' => array(
					'items' => array(
						'type'          => 'addable-popup',
						'label'         => __( 'Items', 'fw' ),
						'popup-title'   => __( 'Add / Edit Item', 'fw' ),
						'template'      => '{{= title || "Untitled" }}',
						'popup-options' => array(
							'title' => array(
								'type'  => 'text',
								'label' => __( 'Title', 'fw' ),
								'value' => __( 'Project title', 'fw' ),
							),
							'meta' => array(
								'type'  => 'text',
								'label' => __( 'Category', 'fw' ),
								'desc'  => __( 'Optional small label, e.g. "Fashion film".', 'fw' ),
							),
							'year' => array(
								'type'  => 'text',
								'label' => __( 'Year', 'fw' ),
								'desc'  => __( 'Optional, shown at the end of the row.', 'fw' ),
							),
							'image' => array(
								'type'  => 'upload',
								'label' => __( 'Preview Image', 'fw' ),
								'desc'  => __( 'Shown floating beside the cursor on hover (and inline on touch).', 'fw' ),
							),
							'link_url' => array(
								'type'  => 'text',
								'label' => __( 'Link URL', 'fw' ),
								'desc'  => __( 'Optional — where the row links to.', 'fw' ),
							),
							'link_target' => array(
								'type'         => 'switch',
								'label'        => __( 'Open in New Tab', 'fw' ),
								'right-choice' => array( 'value' => '_blank', 'label' => __( 'Yes', 'fw' ) ),
								'left-choice'  => array( 'value' => '_self', 'label' => __( 'No', 'fw' ) ),
								'value'        => '_self',
							),
						),
					),
				),
			),
		),
	),

	/* ========================== DESIGN ========================== */
	'tab_design' => array(
		'title'   => __( 'Design', 'fw' ),
		'type'    => 'tab',
		'options' => array(
			'group_design' => array(
				'type'    => 'group',
				'options' => array(
					'size' => array(
						'type'    => 'select',
						'label'   => __( 'Title Size', 'fw' ),
						'value'   => 'lg',
						'choices' => array(
							'md' => __( 'Medium', 'fw' ),
							'lg' => __( 'Large', 'fw' ),
							'xl' => __( 'Extra Large', 'fw' ),
						),
					),
					'preview_ratio' => array(
						'type'    => 'select',
						'label'   => __( 'Preview Shape', 'fw' ),
						'value'   => 'portrait',
						'choices' => array(
							'portrait'  => __( 'Portrait (4:5)', 'fw' ),
							'landscape' => __( 'Landscape (3:2)', 'fw' ),
							'square'    => __( 'Square', 'fw' ),
						),
					),
					'show_numbers' => array(
						'type'         => 'switch',
						'label'        => __( 'Show Numbers', 'fw' ),
						'desc'         => __( 'Prefix each row with 01, 02, …', 'fw' ),
						'right-choice' => array( 'value' => 'yes', 'label' => __( 'Yes', 'fw' ) ),
						'left-choice'  => array( 'value' => 'no',  'label' => __( 'No', 'fw' ) ),
						'value'        => 'yes',
					),
					'dividers' => array(
						'type'         => 'switch',
						'label'        => __( 'Row Dividers', 'fw' ),
						'right-choice' => array( 'value' => 'yes', 'label' => __( 'Yes', 'fw' ) ),
						'left-choice'  => array( 'value' => 'no',  'label' => __( 'No', 'fw' ) ),
						'value'        => 'yes',
					),
				),
			),
		),
	),

	/* ========================== STYLING ========================== */
	'tab_styling' => array(
		'title'   => __( 'Styling', 'fw' ),
		'type'    => 'tab',
		'options' => array(
			'group_colors' => array(
				'type'    => 'group',
				'options' => array(
					'text_color'  => function_exists( 'sc_color_field_compact' ) ? sc_color_field_compact( array( 'label' => __( 'Title Color', 'fw' ) ) ) : array( 'type' => 'color-picker', 'label' => __( 'Title Color', 'fw' ), 'value' => '' ),
					'hover_color' => function_exists( 'sc_color_field_compact' ) ? sc_color_field_compact( array( 'label' => __( 'Hover Color', 'fw' ) ) ) : array( 'type' => 'color-picker', 'label' => __( 'Hover Color', 'fw' ), 'value' => '' ),
					'meta_color'  => function_exists( 'sc_color_field_compact' ) ? sc_color_field_compact( array( 'label' => __( 'Meta Color', 'fw' ) ) ) : array( 'type' => 'color-picker', 'label' => __( 'Meta Color', 'fw' ), 'value' => '' ),
					'font_size_preset' => function_exists( 'sc_font_size_field' ) ? sc_font_size_field() : array( 'type' => 'select', 'label' => __( 'Font Size', 'fw' ), 'choices' => array( '' => __( 'Default', 'fw' ) ) ),
				),
			),
			'group_spacings' => array(
				'type'    => 'group',
				'options' => array(
					'spacing' => array(
						'type'  => 'spacing',
						'label' => __( 'Margin & Padding', 'fw' ),
						'help'  => function_exists( 'sc_styling_help_text' ) ? sc_styling_help_text( 'spacing' ) : '',
					),
				),
			),
		),
	),

	'tab_animation' => array(
		'title'   => __( 'Animations', 'fw' ),
		'type'    => 'tab',
		'options' => function_exists( 'sc_get_animation_fields' ) ? sc_get_animation_fields() : array(),
	),
	'tab_advanced' => array(
		'title'   => __( 'Advanced', 'fw' ),
		'type'    => 'tab',
		'options' => array(
			'advanced_settings' => array(
				'type'    => 'group',
				'options' => function_exists( 'sc_get_advanced_tab' ) ? sc_get_advanced_tab() : array(),
			),
		),
	),
);
