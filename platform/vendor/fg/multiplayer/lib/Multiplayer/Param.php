<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */
namespace Multiplayer;



/**
 *	A set of generic parameters.
 */
class Param {

	/**
	 *	Whether or not to start the video when it is loaded.
	 *
	 *	@var string
	 */
	const autoPlay = 'autoPlay';



	/**
	 *
	 *
	 *	@var string
	 */
	const showInfos = 'showInfos';



	/**
	 *
	 *
	 *	@var string
	 */
	const showBranding = 'showBranding';



	/**
	 *	Whether or not to show related videos at the end.
	 *
	 *	@var string
	 */
	const showRelated = 'showRelated';



	/**
	 *	Hex code of the player's background color.
	 *
	 *	@var string
	 */
	const backgroundColor = 'backgroundColor';



	/**
	 *	Hex code of the player's foreground color.
	 *
	 *	@var string
	 */
	const foregroundColor = 'foregroundColor';



	/**
	 *	Hex code of the player's highlight color.
	 *
	 *	@var string
	 */
	const highlightColor = 'highlightColor';



	/**
	 *	The number of seconds at which the video must start.
	 *
	 *	@var string
	 */
	const start = 'start';

}
