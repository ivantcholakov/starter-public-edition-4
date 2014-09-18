<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace Multiplayer;



/**
 *	Builds HTML embed codes for videos.
 */

class Multiplayer {

	/**
	 *	A HTML code to wrap a player URL.
	 *
	 *	@var string
	 */

	const wrapper = '<iframe src="%s" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';



	/**
	 *	A set of generic parameters.
	 *
	 *	### Options
	 *
	 *	- 'autoPlay' boolean Whether or not to start the video when it is loaded.
	 *	- 'showInfos' boolean
	 *	- 'showBranding' boolean
	 *	- 'showRelated' boolean Whether or not to show related videos at the end.
	 *	- 'backgroundColor' string Hex code of the player's background color.
	 *	- 'foregroundColor' string Hex code of the player's foreground color.
	 *	- 'highlightColor' string Hex code of the player's highlight color.
	 *	- 'start' int The number of seconds at which the video must start.
	 *
	 *	@var array
	 */

	protected $_params = array(
		'autoPlay' => null,
		'showInfos' => null,
		'showBranding' => null,
		'showRelated' => null,
		'backgroundColor' => null,
		'foregroundColor' => null,
		'highlightColor' => null,
		'start' => null
	);



	/**
	 *	A set of configurations indexed by service name.
	 *
	 *	### options
	 *
	 *	- string Name of the service.
	 *		- 'id' string A regex to find a video id.
	 *		- 'url' string Base URL of the player.
	 *		- 'map' array A map of parameters to translate from generic ones
	 *			to service-specific ones.
	 *
	 *	@var array
	 */

	protected $_services = array(
		'dailymotion' => array(
			'id' => '#dailymotion\.com/(?:embed/)?video/(?<id>[a-z0-9]+)#i',
			'url' => 'http://www.dailymotion.com/embed/video/%s',
			'map' => array(
				'autoPlay' => 'autoplay',
				'showInfos' => 'info',
				'showBranding' => 'logo',
				'showRelated' => 'related',
				'backgroundColor' => array(
					'prefix' => '#',
					'param' => 'background'
				),
				'foregroundColor' => array(
					'prefix' => '#',
					'param' => 'foreground'
				),
				'highlightColor' => array(
					'prefix' => '#',
					'param' => 'highlight'
				),
			)
		),
		'vimeo' => array(
			'id' => '#vimeo\.com/(?:video/)?(?<id>[0-9]+)#i',
			'url' => 'http://player.vimeo.com/video/%s',
			'map' => array(
				'autoPlay' => 'autoplay',
				'showInfos' => array( 'byline', 'portrait' ),
				'foregroundColor' => 'color'
			)
		),
		'youtube' => array(
			'id' => '#(?:youtu\.be/|youtube.com/(?:v/|embed/|watch\?v=))(?<id>[a-z0-9_-]+)#i',
			'url' => 'http://www.youtube-nocookie.com/embed/%s',
			'map' => array(
				'autoPlay' => 'autoplay',
				'showInfos' => 'showinfo',
				'showRelated' => 'rel'
			)
		)
	);



	/**
	 *	Constructor.
	 *
	 *	@param array $services A set of services to be merged with the
	 *		default ones.
	 */

	public function __construct( array $services = array( )) {

		$this->_services = array_merge( $this->_services, $services );
	}



	/**
	 *	Builds and returns an HTML embed code.
	 *
	 *	@param string $source URL or HTML code.
	 *	@param array $params Player configuration.
	 *	@param string $wrapper HTML code surrounding the player URL.
	 *	@return string Prepared HTML code.
	 */

	public function html( $source, array $params = array( ), $wrapper = self::wrapper ) {

		$params += $this->_params;
		$id = null;

		foreach ( $this->_services as $service => $config ) {
			if ( preg_match( $config['id'], $source, $matches )) {
				$id = $matches['id'];
				break;
			}
		}

		if ( $id ) {
			$params = $this->_mapped( $this->_services[ $service ]['map'], $params );
			$url = sprintf( $this->_services[ $service ]['url'], $id );

			if ( $params ) {
				$url .= '?' . http_build_query( $params );
			}

			$source = sprintf( $wrapper, $url );
		}

		return $source;
	}



	/**
	 *	Builds and returns an array of mapped parameters.
	 *
	 *	@param array $map A map to translate the parameters.
	 *	@param array $options Generic parameters.
	 */

	protected function _mapped( array $map, array $params ) {

		$mapped = array( );

		// translation from generic parameters to specific ones

		foreach ( $map as $generic => $specific ) {
			if ( isset( $params[ $generic ])) {
				$value = $params[ $generic ];

				if ( is_array( $specific )) {
					if ( isset( $specific['param'])) {
						$param = $specific['param'];

						if ( $value && isset( $specific['prefix'])) {
							$value = $specific['prefix'] . $value;
						}

						$mapped[ $param ] = $value;
					} else {
						foreach ( $specific as $param ) {
							$mapped[ $param ] = $value;
						}
					}
				} else {
					$mapped[ $specific ] = $value;
				}
			}
		}

		// handling of non generic parameters

		$extra = array_diff_key( $params, $this->_params );

		return empty( $extra )
			? $mapped
			: array_merge( $mapped, $extra );
	}
}
