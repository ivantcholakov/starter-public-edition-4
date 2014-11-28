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

    public function email_test($data = array()) {

        return Modules::run('email/test/index', $data);
    }

}
