<?php

if( !file_exists('.env') ) {
    require(__DIR__ . '/scripts/GenerateKeysAndSalts.php');
    copy( '.env.example', '.env' );
    $generate_keys_and_salts = new GenerateKeysAndSalts();
    $generate_keys_and_salts->run();
}

/** WordPress view bootstrapper */
define('WP_USE_THEMES', true);
require(__DIR__ . '/wp/wp-blog-header.php');
