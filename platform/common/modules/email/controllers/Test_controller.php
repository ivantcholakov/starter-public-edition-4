<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Test_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->parser()
        ;
    }

    public function _remap($method, $params = array()) {

        show_404();
    }

    public function index($data = array()) {

        if (!is_array($data)) {
            $data = $data !== null ? array('to' => (string) $data) : array();
        }

        $custom_text = isset($data['custom_text']) ? $data['custom_text'] : null;

        extract($this->get_message($custom_text));

        $logo = DEFAULTFCPATH.'apple-touch-icon-precomposed.png';
        $has_logo = file_exists($logo);

        $body = $this->parser->parse_string(
            $body,
            array('has_logo' => $has_logo, 'logo_src' => 'cid:logo_src'),
            true,
            'mustache'
        );

        $attach = array();

        if ($has_logo) {

            $attach[] = array(
                'file' => $logo,
                'disposition' => 'inline',
                'embedded_image' => true,
                'key' => 'logo_src',
            );
        }

        $this->load->library('email');
        $body = $this->email->full_html($subject, $body);

        $data = array_merge($data, compact('subject', 'body', 'attach'));

        return Events::trigger('email', $data);
    }

    public function get_message($custom_text = null) {

        $subject = '['.$this->settings->lang('site_name').'] '.'Test Message';
        $body =
'
    {{#has_logo}}
    <p><img src="{{logo_src}}" /></p>
    {{/has_logo}}
    <h1>This is a message for testing purpose</h1>
';

        if ($custom_text != '') {
            $body .= $custom_text;
        }

        $body .= '
    <p>Greetings from the team of <a href="'.default_base_url().'">'.$this->settings->lang('site_name').'</a>.</p>
';

        return compact('subject', 'body');
    }

}
