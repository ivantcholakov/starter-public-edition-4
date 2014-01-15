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

    public function _remap() {

        show_404();
    }

    public function index($to = null) {

        $to = $to == '' ? null : $to;

        extract($this->get_message());

        $has_logo = file_exists(FCPATH.'apple-touch-icon-precomposed.png');

        $body = $this->parser->parse_string(
            $body,
            array(/* 'has_logo' => $has_logo, */ 'has_logo' => false, /* 'logo_src' => base_url('apple-touch-icon-precomposed.png') */),
            true,
            'mustache'
        );
        
        return Events::trigger('email', compact('subject', 'body', 'to'));
    }

    public function get_message() {

        $subject = '['.$this->settings->get('site_name').'] '.'Test Message';
        $body =
'
    {{#has_logo}}
    <p><img src="{{logo_src}}" /></p>
    {{/has_logo}}
    <h1>This is a message for testing purpose</h1>
    <p>Greetings from the team of <a href="'.common_base_url().'">'.$this->settings->get('site_name').'</a>.</p>
';

        return compact('subject', 'body');
    }

}
