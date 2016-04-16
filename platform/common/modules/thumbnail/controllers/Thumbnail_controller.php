<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Thumbnail_controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->load->library('thumbnail');

        $this->thumbnail->get($this->input->get());
    }

}
