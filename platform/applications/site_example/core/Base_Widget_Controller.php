<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Widget_Controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('settings')
            ->helper('url')
            ->helper('language')
            ->helper('asset')
            ->language('ui')
        ;

    }

    public function _remap() {

        show_404();
    }

}
