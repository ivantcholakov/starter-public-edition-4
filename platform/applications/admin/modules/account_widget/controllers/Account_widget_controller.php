<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        //if (!$this->current_user->is_logged_in()) {
        //    return;
        //}

        $this->load->view('account_widget');
    }

}
