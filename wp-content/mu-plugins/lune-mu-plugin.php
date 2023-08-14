<?php
/*
Plugin Name: Lune Builder Compatibility Filters Plugin
Description: Improved support for aggressive performance optimization plugins, such as caching.
Version: 1.0.1
Author: Fabian Altahona
Author URI: https://www.ab2web.com
*/

add_filter("option_active_plugins", function ($plugins) {
  if ( ( isset( $_GET["lune_page_editing_mode"] ) || isset( $_GET["lune_action_launch_editing"] ) ) ) {

    $lune_plugin_dir = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'lune-core';
    $lune_filter_list_file = $lune_plugin_dir . DIRECTORY_SEPARATOR . 'mu' . DIRECTORY_SEPARATOR . 'lune-disabled-plugins-list.txt';

    //default and known incompatible plugins
    $targets = [
      "ewww-image-optimizer/ewww-image-optimizer.php",
      "litespeed-cache/litespeed-cache.php",
      //add new ones in txt file
    ];

    //get updated list if any
    if ( file_exists( $lune_filter_list_file ) ) {
      $targets = array_map( 'trim', array_unique( array_merge( $targets, array_filter( file( $lune_filter_list_file ) ) ) ) );
    }

    foreach ( $targets as $target ) {
      $foundKey = array_search( $target, $plugins, true );
      if ( $foundKey !== null && gettype($foundKey) != 'boolean' ) {
        unset( $plugins[$foundKey] );
      }
    }
  }
  return array_values( $plugins );
});