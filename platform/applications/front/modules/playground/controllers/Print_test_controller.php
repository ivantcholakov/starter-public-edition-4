<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Print_test_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Print Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/print-test'));
        ;

        $print = $this->input->get('print');
        $print = !empty($print);

        if ($print) {
            $this->registry->set('print', true);
        }

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_canonical_url(http_build_url(CURRENT_URL, null, HTTP_URL_STRIP_QUERY))
            ->set_partial('css', 'print_test_css')
            ->set_partial('scripts', 'print_test_scripts')
            ->build('print_test');
    }

}
