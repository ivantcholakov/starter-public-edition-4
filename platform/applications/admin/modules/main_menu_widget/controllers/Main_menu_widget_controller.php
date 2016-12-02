<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_menu_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->load->view('main_menu_widget');
    }

}
