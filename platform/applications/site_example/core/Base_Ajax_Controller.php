<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Ajax_Controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        if (!$this->input->is_ajax_request()) {
            exit(EXIT_ERROR);
        }
    }

}
