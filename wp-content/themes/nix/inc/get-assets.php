<?php

/**
 * Get paths for assets
 */

function asset_path( $filename, $get_dir = false ) {
	$dist_path = get_stylesheet_directory_uri() . '/dist/';
	$dist_path_dir = get_stylesheet_directory() . '/inc/assets/';
	static $manifest;

	if (empty($manifest)) {
		$manifest_path = get_stylesheet_directory() . '/dist/' . 'assets.json';
		$manifest = new luneAssets($manifest_path);
	}

	if (array_key_exists($filename, $manifest->get())) {
		if ($get_dir) {
			return $dist_path_dir . $manifest->get()[$filename];
		}
		return $dist_path . $manifest->get()[$filename];
	}
	if ($get_dir) {
		return $dist_path_dir . $filename;
	}
	return $dist_path . $filename;
}
