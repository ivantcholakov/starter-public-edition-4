<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_controller extends Core_Controller {

    protected $logViewer;

    public function __construct() {

        parent::__construct();

        $this->logViewer = new CILogViewer();
    }

    public function index() {

        $this->output->set_output($this->logViewer->showLogs());
    }

}
