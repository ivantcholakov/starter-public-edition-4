<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends Base_Authenticated_Controller {

    public function __construct() {

        parent::__construct();

        $this->_set_nav('twig');
    }

    public function index() {

        $this->_set_title('Twig');
        $this->_set_header_icon('file code outline');

        $this->load->config('twig');
        $items = $this->config->item('twig');

        $this->template
            ->set('items', $items)
            ->set_partial('scripts', 'home_scripts')
            ->build('home');
    }

}
