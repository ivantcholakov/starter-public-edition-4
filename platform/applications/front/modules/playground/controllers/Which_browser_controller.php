<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Which_browser_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'WhichBrowser Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/which_browser'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        try {

            $this->load->library('which_browser');
            $your_browser = $this->which_browser->get()->toString();

        } catch (Exception $ex) {

            $your_browser = $ex->getMessage();
        }

        $this->template
            ->set('your_browser', $your_browser)
            ->build('which_browser');
    }

}
