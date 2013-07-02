<?php

/**
 * Customize the theme scustomization settings you see when previewing
 *
 * This will allow you to register customizable settings for your theme.
 * To use in your theme, use the get_theme_mod( 'setting_name' ) function.
 * http://codex.wordpress.org/Theme_Customization_API
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function ZEROTHEME_customize_register( $wp_customize ) {
	// Add a section to the theme preview page
	// http://codex.wordpress.org/Class_Reference%5CWP_Customize_Manager%5Cadd_section

	// $wp_customize->add_section( 'mytheme_new_section_name' , array(
	// 	'title'       => __( 'Visible Section Name','ZEROTHEME' ),
	// 	'priority'    => 30,
	//  'description' => __( 'Optional description','ZEROTHEME' ),
	// ) );


	// Add a theme setting (does not render field)
	// http://codex.wordpress.org/Class_Reference%5CWP_Customize_Manager%5Cadd_setting

	// $wp_customize->add_setting( 'header_textcolor' , array(
	// 	'default'     => '#000000', // Default value
	// 	'transport'   => 'refresh', // 'refresh' or 'postMessage' for Javascript
	// 	'type'        => 'theme_mod', // What type of setting: 'option' or 'theme_mod',
	// 	'capability'  => null, // Capability a user must have to modify setting
	// ) );


	// Add a color setting field to the theme preview page
	// http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
	//  * WP_Customize_Control() - Creates a control that allows users to enter plain text. This is also the parent class for the classes that follow. 
	//  * WP_Customize_Color_Control() - Creates a control that allows users to select a color from a color wheel. 
	//  * WP_Customize_Upload_Control() - Creates a control that allows users to upload media. 
	//  * WP_Customize_Image_Control() - Creates a control that allows users to select or upload an image. 
	//  * WP_Customize_Background_Image_Control() - Creates a control that allows users to select a new background image.
	//  * WP_Customize_Header_Image_Control() - Creates a control that allows users to select a new header image.
	// Custom controller http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/

	// $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
	// 	'label'        => __( 'Header Color', 'ZEROTHEME' ),
	// 	'section'    => 'your_section_id',
	// 	'settings'   => 'your_setting_id',
	// ) ) );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';


	$wp_customize->add_section( 'mytheme_new_section_name' , array(
		'title'       => __( 'Visible Section Name','ZEROTHEME' ),
		'priority'    => 30,
	 'description' => __( 'Optional description','ZEROTHEME' ),
	) );


	// Add a theme setting (does not render field)
	// http://codex.wordpress.org/Class_Reference%5CWP_Customize_Manager%5Cadd_setting

	$wp_customize->add_setting( 'header_textcolor' , array(
		'default'     => '#000000', // Default value
		'transport'   => 'refresh', // 'refresh' or 'postMessage' for Javascript
		'type'        => 'theme_mod', // What type of setting: 'option' or 'theme_mod',
		'capability'  => null, // Capability a user must have to modify setting
	) );


	// Add a color setting field to the theme preview page
	// http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
	//  * WP_Customize_Control() - Creates a control that allows users to enter plain text. This is also the parent class for the classes that follow. 
	//  * WP_Customize_Color_Control() - Creates a control that allows users to select a color from a color wheel. 
	//  * WP_Customize_Upload_Control() - Creates a control that allows users to upload media. 
	//  * WP_Customize_Image_Control() - Creates a control that allows users to select or upload an image. 
	//  * WP_Customize_Background_Image_Control() - Creates a control that allows users to select a new background image.
	//  * WP_Customize_Header_Image_Control() - Creates a control that allows users to select a new header image.
	// Custom controller http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'        => __( 'Header Color', 'ZEROTHEME' ),
		'section'    => 'your_section_id',
		'settings'   => 'your_setting_id',
	) ) );
}
add_action( 'customize_register', 'ZEROTHEME_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ZEROTHEME_customize_preview_js() {
	wp_enqueue_script( 'ZEROTHEME-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'ZEROTHEME_customize_preview_js' );
