<?php defined('SYSPATH') or die('No direct script access.');
/**
 * UTF8::stripos
 *
 * @copyright  (c) 2015 Ivan Tcholakov
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt
 */
function _stripos($str, $search, $offset = 0)
{
	return UTF8::strpos(UTF8::strtolower($str), UTF8::strtolower($search), $offset);
}