<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Common_Events_Email {

    protected $ci = null;
    protected $email = null;
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

    /**
     * Sends an email message.
     * @param       array       $data       The email message data. It is an associative array
     *                                      with the following elements (not all of them are mandatory):
     *                                      'from', 'from_name', 'return_path', 'to' (string or array),
     *                                      'reply_to', 'reply_to_name', 'cc' (string or array),
     *                                      'subject' (mandatory), 'body' (mandatory), 'attach' (array of file names).
     * @return      boolean                 TRUE on success, FALSE on failure
     */
    public function email($data = array()) {

        $this->ci->load->library('email');
        $this->email = $this->ci->email;

        if (isset($data['from']) && $data['from'] != '') {

            $from = $data['from'];

            if (isset($data['from_name']) && $data['from_name'] != '') {
                $from_name = $data['from_name'];
            } else {
                $from_name = null;
            }

        } else {

            $from = $this->settings->get('site_email');
            $from_name = $this->settings->get('site_name');
        }

        if (isset($data['reply_to']) && $data['reply_to'] != '') {

            $reply_to = $data['reply_to'];

            if (isset($data['reply_to_name']) && $data['reply_to_name'] != '') {
                $reply_to_name = $data['reply_to_name'];
            } else {
                $reply_to_name = null;
            }

        } else {

            $reply_to = $this->settings->get('notification_email');
            $reply_to_name = $this->settings->get('site_name');
        }

        if (isset($data['return_path']) && $data['return_path'] != '') {
            $return_path = $data['reply_to'];
        } else {
            $return_path = $this->settings->get('notification_email');
        }

        if (isset($data['to'])) {

            if (is_array($data['to']) && !empty($data['to'])) {
                $to = $data['to'];
            } elseif ($data['to'] != '') {
                $to = $data['to'];
            } else {
                $to = $this->settings->get('notification_email');
            }

        } else {
            $to = $this->settings->get('notification_email');
        }

        $cc_email = $this->settings->get('cc_email');

        if (!is_array($cc_email)) {

            if ($cc_email != '') {
                $cc_email = array($cc_email);
            } else {
                $cc_email = array();
            }
        }

        if (isset($data['cc'])) {

            if (!is_array($data['cc'])) {

                if ($data['cc'] != '') {
                    $cc = array($data['cc']);
                } else {
                    $cc = array();
                }

            } else {
                $cc = $data['cc'];
            }

        } else {
            $cc = array();
        }

        $subject = isset($data['subject']) ? trim($data['subject']) : '';
        $body = isset($data['body']) ? trim($data['body']) : '';

        if ($subject != '' && $body != '') {

            if (!empty($cc)) {
                $this->email->cc($cc);
            }

            $this->email
                ->from($from, $from_name, $return_path)
                ->to($to)
                ->reply_to($reply_to, $reply_to_name)
                ->subject($subject)
                ->message($body);

            if (isset($data['attach']) && is_array($data['attach'])) {

                foreach ($data['attach'] as $attachment) {
                    $this->email->attach($attachment);
                }
            }

            $result = (bool) $this->email->send();

            $debug_message = trim(strip_tags($this->email->print_debugger()));

            if ($debug_message != '') {
                log_message($result ? 'debug' : 'error', $debug_message);
            }

            return $result;
        }

        log_message('error', 'Send email: No subject or body text.');

        return false;
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
