<?php
use Dotenv\Dotenv;
/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

/** @var string Document Root */
$webroot_dir = $root_dir;

/**
 * Expose global env() function from oscarotero/env
 */
Env::init();

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = Dotenv::create($root_dir);

if (file_exists($root_dir . '/.env')) {
		$dotenv->load();
		$dotenv->required(['DBC_NAME', 'DB_USER', 'DB_PASSWORD', 'WPS_HOME', 'WP_SITEURL']);
}

/**
 * Set up our global environment constant and load its config first
 * Default: development
 */
define('WP_ENV', env('WP_ENV') ?: 'development');

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
		require_once $env_config;
}

/**
 * URLs
 */
define('WP_HOME', env('WPS_HOME'));
define('WP_SITEURL', env('WP_SITEURL'));

/**
 * Custom Content Directory
 */
define('CONTENT_DIR', '/wp-content');
define('WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);
define('WP_DEFAULT_THEME', CONTENT_DIR . '/themes');

/**
 * DB settings
 */
define('DB_NAME', env('DBC_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_HOST', env('DB_HOST') ?: 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
define('AUTH_KEY', env('WPC_AUTH_KEY'));
define('SECURE_AUTH_KEY', env('WPC_SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', env('WPC_LOGGED_IN_KEY'));
define('NONCE_KEY', env('WPC_NONCE_KEY'));
define('AUTH_SALT', env('WPC_AUTH_SALT'));
define('SECURE_AUTH_SALT', env('WPC_SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', env('WPC_LOGGED_IN_SALT'));
define('NONCE_SALT', env('WPC_NONCE_SALT'));

/**
 * Custom Settings
 */

define('AUTOMATIC_UPDATER_DISABLED', is_null(env('AUTOMATIC_UPDATER_DISABLED')) ? true : filter_var(env('AUTOMATIC_UPDATER_DISABLED'), FILTER_VALIDATE_BOOLEAN));
define('DISABLE_WP_CRON', filter_var(env('DISABLE_WP_CRON'), FILTER_VALIDATE_BOOLEAN) ?: false);
define('DISALLOW_FILE_EDIT', is_null(env('DISALLOW_FILE_EDIT')) ? true : filter_var(env('DISALLOW_FILE_EDIT'), FILTER_VALIDATE_BOOLEAN));

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
		define('ABSPATH', $webroot_dir . '/wp/');
}
