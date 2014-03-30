<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Lang extends Core_Lang {

    public function __construct() {

        parent::__construct();
    }

    public function datatables($language = null) {

        if ($language == '') {
            $language = $this->current();
        }

        $lang = @ file_get_contents(DEFAULTFCPATH.'assets/js/lib/dataTables/i18n/'.$language.'.lang', false);

        if ($lang == '') {
            return '{}';
        }

        return $lang;
    }

}
