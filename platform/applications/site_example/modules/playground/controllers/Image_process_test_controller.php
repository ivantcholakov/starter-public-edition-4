<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Image_process_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Image Manipulations Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->build('image_process_test');
    }

}

