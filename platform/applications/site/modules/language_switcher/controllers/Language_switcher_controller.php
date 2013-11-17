<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Language_switcher_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->language = config_item('language');
    }

    public function _remap() { }

    public function index() {

        $language_switcher = array(
            array(
                'link' => anchor($this->lang->switch_uri('en'), 'English'),
                'language' => 'english',
            ),
            array(
                'link' => anchor($this->lang->switch_uri('bg'), 'Bulgarian'),
                'language' => 'bulgarian',
            ),
        );

        foreach ($language_switcher as $key => $item) {

            if ($this->language == $item['language']) {
                $language_switcher[$key]['active'] = true;
            }
        }

        $this->load->view('language_switcher', compact('language_switcher'));
    }

}
