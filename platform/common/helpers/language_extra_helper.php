<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('language_ckeditor')) {

    function language_ckeditor($language = null) {

        $ci = get_instance();

        $language = (string) $language;

        if ($language == '') {
            $language = $ci->lang->current();
        }

        $config = $ci->lang->get($language);
        $code = $ci->lang->code($language);

        if (empty($config) || $code == '') {
            return 'en';
        }

        if (isset($config['ckeditor'])) {
            return $config['ckeditor'];
        }

        $result = $code;

        switch ($code) {

            case 'es_419':
                $result = 'es';
                break;

            case 'pt_BR':
                $result = 'pt-br';
                break;
        }

        return $result;
    }

}

if (!function_exists('language_jquery_ui')) {

    function language_jquery_ui($language = null) {

        $ci = get_instance();

        $language = (string) $language;

        if ($language == '') {
            $language = $ci->lang->current();
        }

        $config = $ci->lang->get($language);
        $code = $ci->lang->code($language);

        if (empty($config) || $code == '') {
            return 'en';
        }

        if (isset($config['jquery_validation'])) {
            return $config['jquery_validation'];
        }

        $result = str_replace('_', '-', $code);

        switch ($code) {

            case 'es-419':
                $result = 'es';
                break;
        }

        return $result;
    }

}

if (!function_exists('language_jquery_validation')) {

    function language_jquery_validation($language = null) {

        $ci = get_instance();

        $language = (string) $language;

        if ($language == '') {
            $language = $ci->lang->current();
        }

        $config = $ci->lang->get($language);
        $code = $ci->lang->code($language);

        if (empty($config) || $code == '') {
            return 'en';
        }

        if (isset($config['jquery_validation'])) {
            return $config['jquery_validation'];
        }

        $result = $code;

        switch ($code) {

            case 'es_419':
                $result = 'es';
                break;

            case 'pt':
                $result = 'pt_PT';
                break;
        }

        return $result;
    }

}

if (!function_exists('language_datatables')) {

    function language_datatables($language = null) {

        $ci = get_instance();

        $language = (string) $language;

        if ($language == '') {
            $language = $ci->lang->current();
        }

        $lang = @ file_get_contents(DEFAULTFCPATH.'assets/js/lib/dataTables/i18n/'.$language.'.lang', false);

        if ($lang == '') {
            return '{}';
        }

        return $lang;
    }

}
