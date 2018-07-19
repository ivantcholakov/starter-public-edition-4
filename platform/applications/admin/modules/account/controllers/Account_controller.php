<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class Account_controller extends Base_Authenticated_Controller {
    public function __construct() {
        parent::__construct();
        $this->_set_nav('account');
    }
    public function index() {
        $title = 'Manage Your Account';
        $this->registry->set('title', $title);
        $this->_set_header_icon('user');
        $this->template
            ->prepend_title($title)
            ->set_partial('scripts', 'account_scripts')
            ->build('account');
    }
}
