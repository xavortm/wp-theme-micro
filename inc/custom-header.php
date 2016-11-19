<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Micro
 */

function micro_customiser_settings( $wp_customize ) {

	// Remove the default color settings.
	// $wp_customize->remove_section( 'colors' );
	// $wp_customize->remove_section( 'header_image' );

	$wp_customize->add_section( 'micro_color_settings' , array(
		'title'      => __( 'Micro colors', 'micro' ),
		'priority'   => 30,
	) );

	$wp_customize->add_setting( 'micro_text_color' , array(
		'default'     => '#b2df82',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'micro_text_color', array(
		'label'        => __( 'Primary color', 'micro' ),
		'section'    => 'micro_color_settings',
		'settings'   => 'micro_text_color',
	) ) );

	$wp_customize->add_setting( 'micro_background_color' , array(
		'default'     => '#0f110c',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'micro_background_color', array(
		'label'        => __( 'Secondary color', 'micro' ),
		'section'    => 'micro_color_settings',
		'settings'   => 'micro_background_color',
	) ) );

}
add_action( 'customize_register', 'micro_customiser_settings' );

function micro_customize_css() {
	?>
	<style type="text/css">
		body, code, kbd, tt, var { 
			color:<?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>; 
			background-color:<?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
		}

		a,
		.main-navigation .menu-item a,
		button, input  {
			color:<?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>; 
		}

		.entry,
		input,
		.site-footer {
			border-color:<?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>; 
		}

		.entry .entry-title {
			color:<?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>; 
			background-color:<?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>; 
		}

		.entry .entry-title a {
			color:<?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
		}

		.entry .entry-title a:hover {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
		}

		a:hover {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
			background-color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		pre {
			color:<?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
			background-color:<?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'micro_customize_css');
