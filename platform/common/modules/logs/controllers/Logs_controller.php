<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_controller extends Core_Controller {

    protected $logViewer;

    public function __construct() {

        parent::__construct();

        $this->logViewer = new CILogViewer();
    }

    public function index() {

        // https://stackoverflow.com/questions/35588699/response-to-preflight-request-doesnt-pass-access-control-check
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, X-Requested-With');

        $this->output->set_output($this->logViewer->showLogs());
    }

}
