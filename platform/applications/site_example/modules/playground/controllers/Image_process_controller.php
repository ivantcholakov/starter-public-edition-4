<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * TODO: To be removed.
 *
 * This controller is for demonstration purpose only.
 * See the common Thumbnail controller.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Image_process_controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->load->library('thumbnail');

        $this->thumbnail->initialize(array(
            'has_watermark' => true,
        ));

        $this->thumbnail->get($this->input->get());
    }

}
