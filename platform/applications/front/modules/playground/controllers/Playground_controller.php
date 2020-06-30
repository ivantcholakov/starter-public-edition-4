<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Playground_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->append_title('The Playground')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'playground_scripts')
            ->build('playground');
    }

}
