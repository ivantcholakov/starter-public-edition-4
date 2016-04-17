<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This controller outputs thumbnails.
 *
 * If watermaring is active and watermarks are to be applied selectively
 * based on image subdirectory, then this controller should be upgraded
 * with the needed additional logic.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Thumbnail_controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->load->library('thumbnail');

        // An example for selective watermark activation.
        $src = $this->input->get('src');
        $path = str_replace(default_base_url(), '', $src);

        if (strpos($path, 'assets/img/playground.jpg') === 0) {
            $this->thumbnail->initialize(array('has_watermark' => true));
        }
        //

        $this->thumbnail->get($this->input->get());
    }

}
