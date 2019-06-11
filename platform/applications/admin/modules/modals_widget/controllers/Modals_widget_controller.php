<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modals_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->model('')
            ->library('')
        ;
    }

    public function index() {

        $data = array();

        $this->load->view('modals_widget');
    }

}
