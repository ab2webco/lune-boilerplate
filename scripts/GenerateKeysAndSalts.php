<?php

class GenerateKeysAndSalts {

	public function run() {
		$keys_and_salts = [
			'HOME',
			'NAME',
			'AUTH_KEY',
			'SECURE_AUTH_KEY',
			'LOGGED_IN_KEY',
			'NONCE_KEY',
			'AUTH_SALT',
			'SECURE_AUTH_SALT',
			'LOGGED_IN_SALT',
			'NONCE_SALT',
			'WP_CACHE_KEY_SALT',
		];

		$envFile = fopen( __DIR__ . '/../.env', 'r' );
		$tmpFile = fopen( 'php://temp', 'w+' );
		while ( ( $line = fgets( $envFile ) ) !== false ) {
			$line     = trim( $line );
			$varName  = explode( '=', trim( $line ) . '=', 2 )[0];
			$varValue = trim( explode( '=', trim( $line ) . '=' )[1], '\'"' );
			$prefix   = substr( $varName, 0, 4 );
			if ( $prefix === 'WPC_' ) {
				if ( in_array( substr( $varName, 4 ), $keys_and_salts ) && ! $varValue ) {
					$varValue = substr( base64_encode( random_bytes( 96 ) ), 8, 48 );
					$line     = "$varName='$varValue'";
				}
			} elseif ( $prefix === 'DBC_' ) {
				if ( in_array( substr( $varName, 4 ), $keys_and_salts ) && ! $varValue ) {
					$site_name = explode( '.', $_SERVER['SERVER_NAME'] )[0];
					$varValue = $site_name;
					$line     = "$varName=$varValue";
				}
			} elseif ( $prefix === 'WPS_' ) {
				if ( in_array( substr( $varName, 4 ), $keys_and_salts ) && ! $varValue ) {
					$varValue = 'https://' . $_SERVER['SERVER_NAME'];
					$line     = "$varName=$varValue";
				}
			}
			fwrite( $tmpFile, $line . PHP_EOL );
		}
		fclose( $envFile );
		rewind( $tmpFile );
		$envFile = fopen( __DIR__ . '/../.env', 'w' );
		stream_copy_to_stream( $tmpFile, $envFile );
	}

}