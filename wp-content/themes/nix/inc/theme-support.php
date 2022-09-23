<?php
/**
 * Essential theme supports
 *
 * @package lune by Ab2Web
 */

if ( ! function_exists( 'lune_theme_support' ) ) {
	function lune_theme_support(){
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails', array( 'post', 'members', 'reviews' ) ); // Posts only

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary', 'lune-core' )
			)
		);
	}
	$defaults = array(
		// 'height'               => 65,
		// 'width'                => 178,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => false,
	);

	add_theme_support( 'custom-logo', $defaults );

	function add_li_to_nav($items, $args) {
		remove_filter('wp_nav_menu_items', 'add_li_to_nav', 10, 2);
		$items = '<button class="close-navbar"><i class="ti-close"></i></button>'.$items;
		return $items;
	}
	add_filter('wp_nav_menu_items', 'add_li_to_nav', 10, 2);

}

add_action('after_setup_theme','lune_theme_support');
