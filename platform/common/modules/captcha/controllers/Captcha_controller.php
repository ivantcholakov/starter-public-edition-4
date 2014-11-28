<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Important note: This feature requires Session library/driver to be loaded.
 */

class Captcha_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('kcaptcha', null, 'captcha');
    }

    public function index() {

        $this->captcha->create();
    }

}
