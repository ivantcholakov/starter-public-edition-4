<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Extend from a controller with more resticted user access.
class Home_controller extends Base_Authenticated_Controller {

    public function __construct() {

        parent::__construct();

        $this->_set_nav('error_logs');
    }

    public function index() {

        $this->_set_title('Error Logs');
        $this->_set_header_icon('exclamation triangle');

        $this->load->config('logs');
        $items = $this->config->item('logs');

        $this->template
            ->set('items', $items)
            ->set_partial('scripts', 'home_scripts')
            ->build('home');
    }

}
