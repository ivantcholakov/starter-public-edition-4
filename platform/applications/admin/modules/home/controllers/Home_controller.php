<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Home_controller extends Base_Authenticated_Controller {

    public function __construct() {

        parent::__construct();

        $this->_set_nav('home');
    }

    public function index() {

        $title = 'Dashboard';
        $this->registry->set('title', $title);
        $this->_set_header_icon('dashboard');

        $this->template
            ->prepend_title($title)
            ->set_partial('scripts', 'home_scripts')
            ->build('home');
    }

}
