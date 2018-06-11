<?php
/**
 * hikaru Theme Customizer
 *
 * @package hikaru
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( !defined( 'ABSPATH' ) ) { exit; }

function hikaru_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'hikaru_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'hikaru_customize_partial_blogdescription',
		) );
	}

	if ( class_exists( 'WP_Customize_Control' ) ) {
		
		require_once( get_template_directory() . '/inc/customize-controls/class-customizer-toggle-control.php' );
		require_once( get_template_directory() . '/inc/customize-controls/separator-control.php' );
	}
	
	
	$wp_customize->add_section( 'hikaru_options', array(
		'title' 		=> esc_html__( 'hikaru Theme Options', 'hikaru' ),
		'priority' 		=> 35,
		'capability' 	=> 'edit_theme_options',
		'description' 	=> esc_html__( 'Customize the hikaru theme.', 'hikaru' ),
	) );

	
	// Fallback image setting
	$wp_customize->add_setting( 'hikaru_fallback_image', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'       => get_template_directory_uri().'/assets/images/placeholder.jpg',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hikaru_fallback_image', array(
		'label'			=> esc_html__( 'Fallback image', 'hikaru' ),
		'description'	=> esc_html__( 'The selected image will be used when a post is missing a featured image. A default fallback image included in the theme will be used if no image is set.', 'hikaru' ),
		'section' 		=> 'hikaru_options',
		'settings'      => 'hikaru_fallback_image',
		
	) ) );

	
	$wp_customize->add_control( new Separator_Custom_control( $wp_customize, 'hikaru_separator_1', array(
		'section' 		=> 'hikaru_options',
		'settings'      => 'hikaru_fallback_image',
	) ) );

	// sticky main menu
	$wp_customize->add_setting( 'hikaru_sticky_menu', array(
		'sanitize_callback' => 'hikaru_sanitize_checkbox',
		'default'       => false,
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'hikaru_sticky_menu_control', array(
		'label' => esc_html__('Sticky navigation menu','hikaru'),
        'section' => 'hikaru_options',
        'settings'=>'hikaru_sticky_menu',
        'type'        => 'ios',// light, ios, flat
	) ) );
	
	/* $wp_customize->add_control('hikaru_sticky_menu' , array(
        'label' => esc_html__('Sticky navigation menu','hikaru'),
        'section' => 'hikaru_options',
        'settings'=>'hikaru_sticky_menu',
        'description' => esc_html__('Set Sticky navigation menu','hikaru'),
        'type' => 'checkbox'
        
	));
 */
	$wp_customize->add_control( new Separator_Custom_control( $wp_customize, 'hikaru_separator_2', array(
		'section' 		=> 'hikaru_options',
		'settings'      => 'hikaru_sticky_menu',		
	) ) );

	// Related Posts
	$wp_customize->add_setting( 'hikaru_related_posts', array(
		'sanitize_callback' => 'hikaru_sanitize_checkbox',
		'default'       => false,
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'hikaru_related_posts_control', array(
		'label' => esc_html__('Show/Hide Related Posts','hikaru'),
        'section' => 'hikaru_options',
        'settings'=>'hikaru_related_posts',
        'description' => esc_html__('Show/Hide Related Posts on single post','hikaru'),
        'type'        => 'ios',// light, ios, flat
	) ) );

	/* $wp_customize->add_control('hikaru_related_posts' , array(
        'label' => esc_html__('Show/Hide Related Posts','hikaru'),
        'section' => 'hikaru_options',
        'setting'=>'hikaru_related_posts',
        'description' => esc_html__('Show/Hide Related Posts on single post','hikaru'),
        'type' => 'checkbox'
        
	)); */

	$wp_customize->add_control( new Separator_Custom_control( $wp_customize, 'hikaru_separator_3', array(
		'section' 		=> 'hikaru_options',
		'settings'      => 'hikaru_related_posts',		
	) ) );

	// Breadcrumbs
	$wp_customize->add_setting( 'hikaru_breadcrumbs', array(
		'sanitize_callback' => 'hikaru_sanitize_checkbox',
		'default'       => true,
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'hikaru_breadcrumbs_control', array(
		'label' => esc_html__('Show/Hide breadcrumbs','hikaru'),
        'section' => 'hikaru_options',
        'settings'=>'hikaru_breadcrumbs',
        'description' => esc_html__('Show/Hide breadcrumbs ','hikaru'),
        'type'        => 'ios',// light, ios, flat
	) ) );

	/* $wp_customize->add_control('hikaru_breadcrumbs' , array(
        'label' => esc_html__('Show/Hide breadcrumbs','hikaru'),
        'section' => 'hikaru_options',
        'setting'=>'hikaru_breadcrumbs',
        'description' => esc_html__('Show/Hide breadcrumbs ','hikaru'),
        'type' => 'checkbox'
        
	)); */

	$wp_customize->add_control( new Separator_Custom_control( $wp_customize, 'hikaru_separator_4', array(
		'section' 		=> 'hikaru_options',
		'settings'      => 'hikaru_breadcrumbs',		
	) ) );

	// social network menu
	$wp_customize->add_setting( 'hikaru_show_menu_social', array(
		'sanitize_callback' => 'hikaru_sanitize_checkbox',
		'default'       => false,
	) );

	$wp_customize->add_control( new Customizer_Toggle_Control( $wp_customize, 'hikaru_show_menu_social_control', array(
		'label' => esc_html__('Network menu social Show/hidde','hikaru'),
        'section' => 'hikaru_options',
        'settings'=>'hikaru_show_menu_social',
        'description' => esc_html__('Show or hide Network menu social, For show icons leave url with social network','hikaru'),
        'type'        => 'ios',// light, ios, flat
	) ) );

	/* $wp_customize->add_control('hikaru_show_menu_social' , array(
        'label' => esc_html__('Network menu social Show/hidde','hikaru'),
        'section' => 'hikaru_options',
        'setting'=>'hikaru_show_menu_social',
        'description' => esc_html__('show or hide Network menu social, For show icons leave url with social network','hikaru'),
        'type' => 'checkbox'
        
	)); */

	/* Social networks menu*/

	/* Pinterest*/
	$wp_customize->add_setting( 'hikaru_pinterest_url', 
		array( 
			'sanitize_callback' => 'esc_url_raw'
		) 
	);

	$wp_customize->add_control( 'hikaru_pinterest_url_control', array(
		'label'      => esc_html__( 'Pinterest Url', 'hikaru' ),
        'section'    => 'hikaru_options',
        'settings'    => 'hikaru_pinterest_url',
		
    ));

	/* Facebook*/
	$wp_customize->add_setting( 'hikaru_facebook_url', 
		array( 
			'sanitize_callback' => 'esc_url_raw'
		) 
	);

	$wp_customize->add_control( 'hikaru_facebook_url_control', array(
		'label'      => esc_html__( 'Facebook Url', 'hikaru' ),
        'section'    => 'hikaru_options',
        'settings'    => 'hikaru_facebook_url',
		
    ));

	/* Twitter*/
	$wp_customize->add_setting( 'hikaru_twitter_url', 
	array( 
		'sanitize_callback' => 'esc_url_raw') );

	$wp_customize->add_control( 'hikaru_twitter_url_control', array(
	'label'      => esc_html__( 'Twitter Url', 'hikaru' ),
	'section'    => 'hikaru_options',
	'settings'    => 'hikaru_twitter_url',

	));

	/* Linkedin*/
	$wp_customize->add_setting( 'hikaru_linkedin_url', 
	array( 
		'sanitize_callback' => 'esc_url_raw') );

	$wp_customize->add_control( 'hikaru_linkedin_url_control', array(
	'label'      => esc_html__( 'Linkedin Url', 'hikaru' ),
	'section'    => 'hikaru_options',
	'settings'    => 'hikaru_linkedin_url',

	));

	/* google+*/
	$wp_customize->add_setting( 'hikaru_google+_url', 
	array( 
		'sanitize_callback' => 'esc_url_raw') );

	$wp_customize->add_control( 'hikaru_google_url_control', array(
	'label'      => esc_html__( 'google+ Url', 'hikaru' ),
	'section'    => 'hikaru_options',
	'settings'    => 'hikaru_google+_url',

	));

	/* Whatsapp*/
	$wp_customize->add_setting( 'hikaru_whatsapp_number', 
	array( 
		'sanitize_callback' => 'absint'
	) 
	);

	$wp_customize->add_control( 'hikaru_whatsapp_number_control', array(
	'label'      => esc_html__( 'Whatsapp Phone number', 'hikaru' ),
	'section'    => 'hikaru_options',
	'settings'    => 'hikaru_whatsapp_number',

	));

}
add_action( 'customize_register', 'hikaru_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function hikaru_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function hikaru_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hikaru_customize_preview_js() {
	wp_enqueue_script( 'hikaru-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'hikaru_customize_preview_js' );

/**
 * Binds JS handlers with manage controls of cutomizer.
 */
function hikaru_customize_controls_js(){

    wp_enqueue_script( 'hikaru-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array( 'jquery' ), '20151215', true );

}

add_action( 'customize_controls_enqueue_scripts', 'hikaru_customize_controls_js' );

/**
 * Sanitize checkbox
 */
function hikaru_sanitize_checkbox( $checked ){
    //returns true if checkbox is checked
	if( '1'== $checked){
		return true;
	}
	return false;
}