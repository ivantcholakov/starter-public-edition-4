<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Please, do not remove this dummy controller, it is needed for special core initialization.

class Dummy_controller extends Core_Controller {

    public function __construct() {

        if (NORMAL_MVC_EXECUTION) {

            echo 'Access to the dummy controller is not allowed on normal MVC execution.';
            exit(EXIT_ERROR);
        }

        parent::__construct();
    }

    public function index() {

    }

}
