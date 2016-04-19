<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This controller outputs thumbnails.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Thumbnail_controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        try {

            $this->load->library('thumbnail');
            $this->thumbnail->get($this->input->get());

        } catch (Exception $ex) {

            set_status_header(500);
            exit;
        }
    }

}
