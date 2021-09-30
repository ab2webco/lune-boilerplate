<?php
/**
 * Plugin Name: Lune Tunnel
 * Plugin URI: https://www.ab2web.com/
 * Description: Expose local server to the web using ngrok.
 * Version: 0.1
 * Author: Ab2Web Team
 * Author URI: http://www.ab2web.com
 * License: GPLv2+
 */

add_action("template_redirect", "start_buffer");
add_action("shutdown", "end_buffer", 999);

function filter_buffer($buffer) {
	$buffer = replace_insecure_links($buffer);
	return $buffer;
}
function start_buffer(){
	ob_start("filter_buffer");
}

function end_buffer(){
	if (ob_get_length()) ob_end_flush();
}

function replace_insecure_links($str) {

	$str = str_replace ( array( home_url() . '/' ) , array("/", "/"), $str);
	return apply_filters("rsssl_fixer_output", $str);

}

function add_cors_http_header(){
	header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');