<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class Customers_controller extends Base_Authenticated_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->template->set_layout('customer');
        $this->_set_nav('Customers');
    }
    public function index() {
        $title = 'Customers';
        $this->registry->set('title', $title);
        $this->_set_header_icon('user');
        $this->template
            ->prepend_title($title)
            ->set_partial('scripts', 'customers_scripts')
            ->build('customers');
    }
}
