<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Common_Events_Email {

    protected $ci = null;
    protected $settings = null;

    public function __construct() {

        $this->ci = get_instance();

        $this->ci->load->library('settings');
        $this->settings = $this->ci->settings;

        if ($this->settings->get('mailer_enabled')) {
            Events::register('email', array($this, 'email'));
            Events::register('email_test', array($this, 'email_test'));
        }
    }

    public function email($data = array()) {

        return Modules::run('email/index', $data);
    }

    public function email_test($to = null) {

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
