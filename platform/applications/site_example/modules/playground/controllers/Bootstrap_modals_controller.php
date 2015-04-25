<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Bootstrap_modals_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Bootstrap Modal Dialogs')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->inject_partial('css', css('lib/bootstrap3-dialog/bootstrap-dialog.min.css'))
            ->set_partial('scripts', 'bootstrap_modals_scripts')
            ->build('bootstrap_modals');
    }

    public function remote_html() {

        $this->load->view('bootstrap_modals_remote_html');
    }

}

