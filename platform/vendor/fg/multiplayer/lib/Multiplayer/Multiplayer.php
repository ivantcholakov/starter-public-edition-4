<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */
namespace Multiplayer;

use Multiplayer\Param;



/**
 *	Builds HTML embed codes for videos.
 */
class Multiplayer {

	/**
	 *	Template.
	 *
	 *	@var callable
	 */
	protected $_template = 'Multiplayer::template';



	/**
	 *	A set of generic parameters.
	 *
	 *	@var array
	 */
	protected $_params = [
		Param::autoPlay => null,
		Param::showInfos => null,
		Param::showBranding => null,
		Param::showRelated => null,
		Param::backgroundColor => null,
		Param::foregroundColor => null,
		Param::highlightColor => null,
		Param::start => null
	];



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
	protected $_services = [
		'dailymotion' => [
			'id' => '#dailymotion\.com/(?:embed/)?video/(?<id>[a-z0-9]+)#i',
			'url' => '//www.dailymotion.com/embed/video/%s',
			'map' => [
				Param::autoPlay => 'autoplay',
				Param::showInfos => 'info',
				Param::showBranding => 'logo',
				Param::showRelated => 'related',
				Param::backgroundColor => [
					'prefix' => '#',
					'param' => 'background'
				],
				Param::foregroundColor => [
					'prefix' => '#',
					'param' => 'foreground'
				],
				Param::highlightColor => [
					'prefix' => '#',
					'param' => 'highlight'
				],
			]
		],
		'vimeo' => [
			'id' => '#vimeo\.com/(?:video/)?(?<id>[0-9]+)#i',
			'url' => '//player.vimeo.com/video/%s',
			'map' => [
				Param::autoPlay => 'autoplay',
				Param::showInfos => ['byline', 'portrait'],
				Param::foregroundColor => 'color'
			]
		],
		'youtube' => [
			'id' => '#(?:youtu\.be/|youtube.com/(?:v/|embed/|watch\?v=))(?<id>[a-z0-9_-]+)#i',
			'url' => '//www.youtube-nocookie.com/embed/%s',
			'map' => [
				Param::autoPlay => 'autoplay',
				Param::showInfos => 'showinfo',
				Param::showRelated => 'rel'
			]
		]
	];



	/**
	 *	Constructor.
	 *
	 *	@param array $services A set of services to be merged with the
	 *		default ones.
	 *	@param callable $template A function to generate the HTML code of a
	 *		player from an URL.
	 */
	public function __construct(array $services = [], callable $template = null) {
		$this->_services = array_merge($this->_services, $services);

		if ($template) {
			$this->_template = $template;
		}
	}



	/**
	 *	A HTML code to wrap a player URL.
	 *
	 *	@var string
	 */
	public static function template($url) {
		return <<<HTML
			<iframe
				src="$url"
				frameborder="0"
				webkitAllowFullScreen
				mozallowfullscreen
				allowFullScreen
			></iframe>
HTML;
	}



	/**
	 *	Builds and returns an HTML embed code.
	 *
	 *	@param string $source URL or HTML code.
	 *	@param array $params Player configuration.
	 *	@param callable $template A function to generate the HTML code of a
	 *		player from an URL.
	 *	@return string Prepared HTML code.
	 */
	public function html($source, array $params = [], callable $template = null) {
		$params += $this->_params;
		$id = null;

		foreach ($this->_services as $service => $config) {
			if (preg_match($config['id'], $source, $matches)) {
				$id = $matches['id'];
				break;
			}
		}

		if ($id) {
			$params = $this->_mapped($this->_services[$service]['map'], $params);
			$url = sprintf($this->_services[$service]['url'], $id);

			if ($params) {
				$url .= '?' . http_build_query($params);
			}

			$source = call_user_func(
				$template ? $template : $this->_template,
				$url
			);
		}

		return $source;
	}



	/**
	 *	Builds and returns an array of mapped parameters.
	 *
	 *	@param array $map A map to translate the parameters.
	 *	@param array $options Generic parameters.
	 */
	protected function _mapped(array $map, array $params) {
		$mapped = [];

		// translation from generic parameters to specific ones

		foreach ($map as $generic => $specific) {
			if (isset($params[$generic])) {
				$value = $params[$generic];

				if (is_array($specific)) {
					if (isset($specific['param'])) {
						$param = $specific['param'];

						if ($value && isset($specific['prefix'])) {
							$value = $specific['prefix'] . $value;
						}

						$mapped[$param] = $value;
					} else {
						foreach ($specific as $param) {
							$mapped[$param] = $value;
						}
					}
				} else {
					$mapped[$specific] = $value;
				}
			}
		}

		// handling of non generic parameters

		$extra = array_diff_key($params, $this->_params);

		return empty($extra)
			? $mapped
			: array_merge($mapped, $extra);
	}
}
