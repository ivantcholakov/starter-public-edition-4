<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Please, do not remove this dummy controller, it is needed for special core initialization.

class Dummy_controller extends Core_Controller {

    public function __construct() {

        if (NORMAL_MVC_EXECUTION) {
            die('Access to this script (the dummy controller) is not allowed on normal core initialization.');
        }

        parent::__construct();
    }

    public function index() {

    }

}
