<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// End of Composer autoloader

 // Autoload Lune Includes.
 foreach ( glob( __DIR__ . '/inc/*.php' ) as $module ) {
	if ( ! $modulepath = $module ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'nix' ), $module ), E_USER_ERROR );
	}
	require_once( $modulepath );
}
unset( $module, $filepath );

class nixSiteClass {

	function __construct() {
		$this->add_actions();
		$this->add_filters();

		//add_image_size( 'post-800', 800, 600 );
		//add_image_size( 'homepage-thumb', 500, 400 );
		//add_image_size( 'fullpage-thumb', 300, 200 );
	}

	/**
	 * Add actions to theme
	 *
	 * @return void
	 */
	public function add_actions() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
		add_action( 'after_setup_theme', array( $this, 'nix_load_theme_textdomain' ) );
	}

	public function nix_load_theme_textdomain() {
		load_theme_textdomain( 'nix', get_template_directory() . '/languages' );
	}

	/**
	 * Add filters to theme
	 *
	 * @return void
	 */
	public function add_filters() {

	}

	/**
	 * Load theme assets
	 *
	 * @return void
	 */
	public function load_assets() {
		wp_enqueue_script( 'common-scripts', asset_path('scripts/common.js'), ['jquery'], null, true );

		if ( is_page() ) {
			wp_enqueue_script( 'pages-scripts', asset_path('scripts/pages.js'), ['jquery'], null, true );
		}

		if ( is_home() ) {
			wp_enqueue_script( 'blog-scripts', asset_path('scripts/blog.js'), ['jquery'], null, true );
		}

		wp_enqueue_style( 'theme-style', asset_path('styles/style.css'), false, null );
	}

}

$nix_site_class = new nixSiteClass();
