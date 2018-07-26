<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Customers_list_widget_controller extends Base_Widget_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {

        $data = array();
        $this->load->view('customers_list_widget', $data);
    
    }
}
