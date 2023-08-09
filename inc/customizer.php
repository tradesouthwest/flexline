<?php
/**
 * flexline Customizer functionality
 *
 * @package flexline
 * @subpackage inc/flexline
 * @since 1.0
 * 
 * @see https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
 */

add_action( 'customize_register', 'flexline_register_theme_customizer_setup' );

/**
 * Add section to the Options menu.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @since 1.0.0
*/

function flexline_register_theme_customizer_setup($wp_customize)
{
	$transport = ( $wp_customize->selective_refresh ? 'postMessage' : 'refresh' );
   
    // Theme font choice section
    $wp_customize->add_section( 'flexline_general', array(
        'title'       => __( 'Flexline Theme Settings', 'flexline' ),
        'capability'  => 'edit_theme_options',
		'priority'    => 20
    ) );

    //-----------------Settings and Controls ----------------------------------
	// Add setting & control for font type
     $wp_customize->add_setting( 
        'flexline_fontfamily', array(
		'default' => 'abel',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh'
	));
	$wp_customize->add_control( 'flexline_fontfamily', array(
		'label'   => 'Text Align Style for Content',
		'section'  => 'flexline_general',
		'settings'  => 'flexline_fontfamily',
		'description' => __( 'Choose the font family type.', 'flexline'),
		'type'        => 'select',
    	'choices'     => array(
        	'default' => 'Sans Serif',
			'bruno'    => 'Bruno Sans',
        	'abel'    => 'Abel',
			'roman'   => 'Roman',
        	)
	));

	// Add setting & control for logo height
    $wp_customize->add_setting( 'flexline_logosize', array(
		'default' => '100',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => $transport
	));
	$wp_customize->add_control( 'flexline_logosize', array(
		'label'   => 'Logo Height',
		'section'  => 'flexline_general',
		'settings'  => 'flexline_logosize',
		'type'       => 'number',
		'description' => __( 'Changes height of logo in header.', 'flexline')
	));

	// Add setting & control for text in header
	$wp_customize->add_setting( 'flexline_desctext', array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		'transport' => $transport
	));
	$wp_customize->add_control( 'flexline_desctext', array(
		'label'   => 'Header Text',
		'section'  => 'flexline_general',
		'settings'  => 'flexline_desctext',
		'type'       => 'text',
		'description' => __( 'Add HTML to Header just above description.', 'flexline')
	));

	// Add setting & control for excerpt length
    $wp_customize->add_setting( 'flexline_excerpt_leng', array(
		'default' => '65',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => $transport
	));
	$wp_customize->add_control( 'flexline_excerpt_leng', array(
		'label'   => 'Excerpt Length',
		'section'  => 'flexline_general',
		'settings'  => 'flexline_excerpt_leng',
		'type'       => 'number',
		'description' => __( 'Change number of words to show in an excerpt.', 'flexline')
	));

	/* Colors */
	$wp_customize->add_setting(
		'flexline_bkgrnds_color', array(
		'default'           => '#fafafa',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'flexline_bkgrnds_color',
		array('label'  => __( 'Color of Background in Header Footer and Menu items', 'flexline' ),
			'section'  => 'colors',
			'settings' => 'flexline_bkgrnds_color'
		) ) 
	);
    $wp_customize->add_setting(
		'flexline_gentext_color', array(
		'default'           => '#474849',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'flexline_gentext_color',
		array('label'  => __( 'Color for General Text', 'flexline' ),
			'section'  => 'colors',
			'settings' => 'flexline_gentext_color'
		) ) 
	);
    $wp_customize->add_setting(
		'flexline_anchor_color', array(
		'default'           => '#5d7900',
		'sanitize_callback' => 'sanitize_hex_color',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'flexline_anchor_color',
		array('label'  => __( 'Color for Links', 'flexline' ),
			'section'  => 'colors',
			'settings' => 'flexline_anchor_color'
		) ) 
	);
   
}