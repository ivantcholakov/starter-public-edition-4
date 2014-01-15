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
        return Events::trigger('email', array_merge($this->get_message(), compact('to')));
    }

    public function get_message() {

        $subject = '['.$this->settings->get('site_name').'] '.'Test Message';
        $body =
'
    <h1>This is a message for testing purpose</h1>
    <p>Greetings from the team of <a href="'.common_base_url().'">'.$this->settings->get('site_name').'</a>.</p>
';

        return compact('subject', 'body');
    }

}
