<?php
/**
 * jeremy-wordpress-theme Theme Customizer
 *
 * @package jeremy-wordpress-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jeremy_wordpress_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'jeremy_wordpress_theme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'jeremy_wordpress_theme_customize_partial_blogdescription',
		) );
	}

    $wp_customize->add_setting( 'copyright_holder', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'copyright_holder_control', array(
        'label' => __( 'Copyright Holder', 'jeremy-wordpress-theme' ),
        'section' => 'title_tagline',
        'settings' => 'copyright_holder',
    ) );
}
add_action( 'customize_register', 'jeremy_wordpress_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function jeremy_wordpress_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function jeremy_wordpress_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jeremy_wordpress_theme_customize_preview_js() {
	wp_enqueue_script( 'jeremy-wordpress-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'jeremy_wordpress_theme_customize_preview_js' );
