<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Image_process_test_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Image Manipulations Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/image-process-test'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->build('image_process_test');
    }

}

