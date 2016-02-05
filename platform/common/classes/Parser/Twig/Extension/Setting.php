<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Setting {

    public static function config($item) {

        $item = trim(@ (string) $item);

        if ($item == '') {
            return;
        }

        $ci = & get_instance();

        if ($ci->parser->is_blacklisted_config_setting($item)) {
            return;
        }

        return $ci ->config->item($item);
    }

    public static function setting($item) {

        $item = trim(@ (string) $item);

        if ($item == '') {
            return;
        }

        $ci = & get_instance();

        if ($ci->parser->is_blacklisted_config_setting($item)) {
            return;
        }

        return $ci->settings->lang($item, null, true);
    }

}
