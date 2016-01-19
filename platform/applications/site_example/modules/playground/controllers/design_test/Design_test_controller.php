<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Design_test_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Design Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/design-test'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('css', 'design_test/design_test_css')
            ->set_partial('scripts', 'design_test/design_test_scripts')
            ->build('design_test/design_test');
    }

}

