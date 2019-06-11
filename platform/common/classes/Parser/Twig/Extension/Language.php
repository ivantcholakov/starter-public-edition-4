<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Language {

    public static function lang() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $ci = & get_instance();

        $line = $args[0];

        if (count($args) == 1) {
            return $ci->lang->line($line);
        }

        $params = array_slice($args, 1);

        return $ci->lang->line($line, $params);
    }

    public static function lang_get($language = null) {

        $ci = & get_instance();

        if ($language === null) {
            $language = $ci->lang->current();
        }

        return $ci->lang->get($language);
    }

    public static function lang_current() {

        $ci = & get_instance();

        return $ci->lang->current();
    }

    public static function lang_code($language = null) {

        $ci = & get_instance();

        if ($language === null) {
            $language = $ci->lang->current();
        }

        return $ci->lang->code($language);
    }

    public static function lang_direction($language = null) {

        $ci = & get_instance();

        if ($language === null) {
            $language = $ci->lang->current();
        }

        return $ci->lang->direction($language);
    }

    public static function lang_uri_segment($language = null) {

        $ci = & get_instance();

        if ($language === null) {
            $language = $ci->lang->current();
        }

        return $ci->lang->uri_segment($language);
    }

    public static function lang_current_uri_segment() {

        $ci = & get_instance();

        return $ci->lang->hide_default_uri_segment() && $ci->lang->current() == $ci->lang->default_lang()
            ? NULL
            : $ci->lang->uri_segment();
    }

    public static function lang_name($language = null) {

        $ci = & get_instance();

        if ($language === null) {
            $language = $ci->lang->current();
        }

        return $ci->lang->name($language);
    }

    public static function lang_name_en($language = null) {

        $ci = & get_instance();

        if ($language === null) {
            $language = $ci->lang->current();
        }

        return $ci->lang->name_en($language);
    }

    public static function lang_flag($language = null) {

        $ci = & get_instance();

        if ($language === null) {
            $language = $ci->lang->current();
        }

        return $ci->lang->flag($language);
    }

    public static function lang_enabled() {

        $ci = & get_instance();

        return $ci->lang->enabled();
    }

    public static function is_multilingual() {

        $ci = & get_instance();

        return $ci->lang->multilingual_site();
    }

    public static function language_extra_helpers() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $name = array_shift($args);

        if (count($args) > 0) {

            foreach ($args as & $arg) {

                if (is_object($arg)) {
                    $arg = get_object_vars($arg);
                }
            }
        }

        return call_user_func_array('language_'.$name, $args);
    }

}
