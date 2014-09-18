<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace Multiplayer;

use PHPUnit_Framework_TestCase;



/**
 *	Test case for Multiplayer.
 */

class MultiplayerTest extends PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Multiplayer = null;



	/**
	 *
	 */

	public $services = array(
		'service' => array(
			'id' => '#service\.com/video/(?<id>[0-9]+)#i',
			'url' => 'http://service.com/player/%s',
			'map' => array(
				'autoPlay' => 'play',
				'showInfos' => array( 'title', 'author' ),
				'highlightColor' => 'color'
			)
		)
	);



	/**
	 *
	 */

	public function setUp( ) {

		$this->Multiplayer = new Multiplayer( $this->services );
	}



	/**
	 *
	 */

	public function testHtml( ) {

		$this->assertEquals(
			'http://service.com/player/42',
			$this->Multiplayer->html( 'service.com/video/42', array( ), '%s' )
		);
	}



	/**
	 *
	 */

	public function testHtmlWithParam( ) {

		$this->assertEquals(
			'http://service.com/player/42?foo=bar',
			$this->Multiplayer->html( 'service.com/video/42', array( 'foo' => 'bar' ), '%s' )
		);
	}



	/**
	 *
	 */

	public function testHtmlWithMappedParam( ) {

		$this->assertEquals(
			'http://service.com/player/42?play=1',
			$this->Multiplayer->html( 'service.com/video/42', array( 'autoPlay' => true ), '%s' )
		);

		$this->assertEquals(
			'http://service.com/player/42?title=1&author=1',
			$this->Multiplayer->html( 'service.com/video/42', array( 'showInfos' => true ), '%s' )
		);
	}
}
