<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Test_controller extends Core_Controller {
    
    public function __construct() {

        parent::__construct();
    }

    public function _remap() {

        show_404();
    }

    public function index($to = null) {

        $to = $to == '' ? null : $to;
        $subject = '['.$this->settings->get('site_name').'] '.'Test Message';
        $body =
'
    <h1>This is a message for testing purpose</h1>
    <p>Greetings from the team of <a href="'.base_url().'">'.$this->settings->get('site_name').'</a>.</p>
';

        return Events::trigger('email', compact('to', 'subject', 'body'));
    }

}
