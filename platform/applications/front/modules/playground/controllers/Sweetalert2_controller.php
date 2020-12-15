<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Sweetalert2_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'SweetAlert 2 Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/sweetalert2'));
        ;

        $this->registry->set('nav', 'sweetalert2');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'sweetalert2_scripts')
            ->build('sweetalert2');
    }

}

