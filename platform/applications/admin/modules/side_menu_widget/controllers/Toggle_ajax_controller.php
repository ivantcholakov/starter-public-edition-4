<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Toggle_ajax_controller extends Base_Authenticated_Ajax_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('session');
    }

    public function index() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $state = (string) $this->input->post('state');

        if ($state == '') {

            $state = null;
            $this->session->unset_userdata('side_menu_state');

        } else {

            $this->session->set_userdata('side_menu_state', $state);
        }

        $this->output->set_output(json_encode(array('state' => $state)));
    }

}
