<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Footer_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $data = array();

        $this->load->view('footer_widget', $data);
    }

}
