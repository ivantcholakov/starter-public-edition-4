<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class Payments_controller extends Base_Authenticated_Controller {
    public function __construct() {
        parent::__construct();
        $this->_set_nav('payments');
    }
    public function index() {
        $title = 'Payments';
        $this->registry->set('title', $title);
        $this->_set_header_icon('credit cards');
        $this->template
            ->prepend_title($title)
            ->set_partial('scripts', 'payments_scripts')
            ->build('payments');
    }
}
