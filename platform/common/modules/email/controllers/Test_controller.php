<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2017
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

        extract($this->get_message());

        $logo = DEFAULTFCPATH.'apple-touch-icon-precomposed.png';
        $has_logo = file_exists($logo);

        $body = $this->parser->parse_string(
            $body,
            array(
                'has_logo' => $has_logo,
                'logo_src' => 'cid:logo_src',
                'custom_text' => $custom_text,
                'site_url' => default_base_url(),
                'site_name' => $this->settings->lang('site_name'),
            ),
            true,
            'handlebars'
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

    public function get_message() {

        $subject = '['.$this->settings->lang('site_name').'] '.'Test Message';
        $body =
'
    {{#if has_logo}}
    <p><img src="{{logo_src}}" /></p>
    {{/if}}
    <h1>This is a message for testing purpose</h1>
    {{{custom_text}}}
    <p>Greetings from the team of <strong>{{site_name}}</strong>.</p>
';

        return compact('subject', 'body');
    }

}
