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
	public $services = [
		'service' => [
			'id' => '#service\.com/video/(?<id>[0-9]+)#i',
			'url' => 'http://service.com/player/%s',
			'map' => [
				'autoPlay' => 'play',
				'showInfos' => ['title', 'author'],
				'highlightColor' => 'color'
			]
		]
	];



	/**
	 *
	 */
	public function setUp() {
		$this->Multiplayer = new Multiplayer($this->services, function($url) {
			return $url;
		});
	}



	/**
	 *
	 */
	public function testTemplate() {
		$expected = <<<HTML
			<iframe
				src="http://foo.bar"
				frameborder="0"
				webkitAllowFullScreen
				mozallowfullscreen
				allowFullScreen
			></iframe>
HTML;

		$this->assertEquals(
			$expected,
			$this->Multiplayer->template('http://foo.bar')
		);
	}



	/**
	 *
	 */
	public function testHtml() {
		$this->assertEquals(
			'http://service.com/player/42',
			$this->Multiplayer->html('service.com/video/42', [])
		);
	}



	/**
	 *
	 */
	public function testHtmlWithParam() {
		$this->assertEquals(
			'http://service.com/player/42?foo=bar',
			$this->Multiplayer->html('service.com/video/42', ['foo' => 'bar'])
		);
	}



	/**
	 *
	 */
	public function testHtmlWithMappedParam() {
		$this->assertEquals(
			'http://service.com/player/42?play=1',
			$this->Multiplayer->html('service.com/video/42', ['autoPlay' => true])
		);

		$this->assertEquals(
			'http://service.com/player/42?title=1&author=1',
			$this->Multiplayer->html('service.com/video/42', ['showInfos' => true])
		);
	}



	/**
	 *
	 */
	public function testWithTemplate() {
		$expected = '<iframe />';
		$template = function($url) use ($expected) {
			return $expected;
		};

		$this->assertEquals(
			$expected,
			$this->Multiplayer->html('service.com/video/42', [], $template)
		);
	}
}
