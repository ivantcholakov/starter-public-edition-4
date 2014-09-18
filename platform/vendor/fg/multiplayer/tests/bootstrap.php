<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */



/**
 *	Library path.
 */

define(
	'MULTIPLAYER_LIB',
	dirname( dirname( __FILE__ )) . DIRECTORY_SEPARATOR . 'lib'
);



/**
 *	Autoloads lib files.
 */

spl_autoload_register( function( $className ) {
	$path = MULTIPLAYER_LIB
		. DIRECTORY_SEPARATOR
		. str_replace( '\\', DIRECTORY_SEPARATOR, $className )
		. '.php';

	if ( file_exists( $path )) {
		require_once $path;
	}
});
