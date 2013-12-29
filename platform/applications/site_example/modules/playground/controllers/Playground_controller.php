<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Playground_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('The Playground')
        ;
    }

    public function index() {

        $this->template
            ->build('playground');
    }

}
