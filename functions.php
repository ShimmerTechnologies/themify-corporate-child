<?php
define( 'TEMPPATH', get_stylesheet_directory_uri());
define( 'IMAGES', TEMPPATH . "/images");


function wp_enqueue_css_styles(){

	$parent_style = 'parent-style';

	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/media-queries.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/rtl.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/lightbox.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/fontawesome/css/font-awesome.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/fontawesome/css/font-awesome.min.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/themify.common.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/themify.framework.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/themify.ui.css');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/themify.ui-rtl.css');

}

add_action('wp_enqueue_scripts', 'wp_enqueue_css_styles');

function child_theme_txtdomain(){

	load_child_theme_textdomain('themify-child', get_stylesheet_directory_uri() . '/languages');

}
add_action('after_setup_theme', 'child_theme_txtdomain');

add_action( 'widgets_init', 'child_register_sidebar' );

function child_register_sidebar(){

	if ( function_exists( 'register_sidebar' ) ) 
		{ 
		register_sidebar( array(
			'name' => 'Contact Us',
			'id' => 'contact-us',
			'description' => 'Widgets here are on the contact us page',
			'before_widget' => '<div id="contact-%1$s" class="widget contact-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title'=> '</h4>'
		) );
		register_sidebar( array(
			'name' => 'About Us',
			'id' => 'about-us',
			'description' => 'Widgets here are on the about us page',
			'before_widget' => '<div id="about-%1$s" class="widget contact-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title'=> '</h4>'
		) );
	}

}


?>
