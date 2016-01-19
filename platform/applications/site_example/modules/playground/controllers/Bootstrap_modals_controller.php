<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Bootstrap_modals_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Bootstrap Modal Dialogs';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/bootstrap-modals'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'bootstrap_modals_scripts')
            ->build('bootstrap_modals');
    }

    public function remote_html() {

        $this->load->view('bootstrap_modals_remote_html');
    }

}

