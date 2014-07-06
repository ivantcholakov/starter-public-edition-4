<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Textile_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Textile Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->build('textile');
    }

}
