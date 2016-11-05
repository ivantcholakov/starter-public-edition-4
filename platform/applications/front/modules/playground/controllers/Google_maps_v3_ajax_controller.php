<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Google_maps_v3_ajax_controller extends Base_Ajax_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->database();
        $this->load->model('map');
    }

    public function index() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8');

        $this->output->set_output(json_encode($this->map->guess($this->input->post())));
    }

}
