<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Asset {

    public static function css($asset_name, $attributes = array()) {

        return css($asset_name, null, $attributes);
    }

    public static function image($asset_name, $attributes = array()) {

        return image($asset_name, null, $attributes);
    }

    public static function js($asset_name, $attributes = array()) {

        return js($asset_name, null, $attributes);
    }

}
