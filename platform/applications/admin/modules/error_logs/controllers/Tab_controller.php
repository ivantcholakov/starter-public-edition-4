<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Tab_controller extends Base_Authenticated_Ajax_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $active = (string) $this->input->post('active');

        if ($active == '') {

            $active = null;
            $this->session->unset_userdata('error_logs_active_tab');

        } else {

            $this->session->set_userdata('error_logs_active_tab', $active);
        }

        $this->output->set_output(json_encode(array('active' => $active)));
    }
}
