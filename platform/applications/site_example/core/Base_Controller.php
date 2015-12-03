<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('template')
        ;

        $this->template->set_layout('front_theme_bs');

        $default_title = config_item('default_title');
        $default_description = config_item('default_description');
        $default_keywords = config_item('default_keywords');

        if ($default_title != '') {
             $this->template->title($default_title);
        }

        if ($default_description != '') {
            $this->template->set_metadata('description', $default_description);
        }

        if ($default_keywords != '') {
            $this->template->set_metadata('keywords', $default_keywords);
        }
    }

}
