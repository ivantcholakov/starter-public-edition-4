<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Random_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Random Values Test')
        ;
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'random_scripts')
            ->build('random');
    }

}
