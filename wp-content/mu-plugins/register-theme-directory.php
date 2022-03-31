<?php
/**
 * Plugin Name: Register Theme Directory
 * Plugin URI: https://www.ab2web.com/
 * Description: Register default theme directory
 * Version: 1.0.0
 * Author: Ab2Web Team
 * Author URI: http://www.ab2web.com
 * License: GPLv2+
 */

if ( defined( 'WP_DEFAULT_THEME' ) ) {
    register_theme_directory( ABSPATH . 'wp-content/themes' );
}
