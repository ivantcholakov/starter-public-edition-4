<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Smileys_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->helper('smiley')
        ;

        $this->template
            ->title('Smiley Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $smileys = _get_smiley_array();

        $this->template
            ->set('smileys', $smileys)
            ->build('smileys');
    }

}
