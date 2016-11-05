<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Masonry_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Masonry Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/masonry'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'masonry_scripts')
            ->build('masonry');
    }

}
