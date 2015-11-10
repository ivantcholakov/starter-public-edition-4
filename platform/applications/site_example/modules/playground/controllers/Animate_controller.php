<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Animate_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Animate.css Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('css', 'animate_css')
            ->set_partial('scripts', 'animate_scripts')
            ->build('animate');
    }

}
