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
