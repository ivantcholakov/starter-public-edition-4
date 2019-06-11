<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ping_controller extends Base_Ajax_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        if (config_item('sess_driver') == 'files') {

            $now = time();
            $sess_time_to_update = config_item('sess_time_to_update');
            $last_activity = $this->session->userdata('last_activity');

            if (($sess_time_to_update > 0 && $last_activity !== null)
                && ($last_activity + $sess_time_to_update) < $now) {
                $this->session->sess_regenerate(false);
            }
        }

        $this->output->set_header('Content-type: text/html; charset=utf-8');
        $this->output->set_output('pong');
    }

}
