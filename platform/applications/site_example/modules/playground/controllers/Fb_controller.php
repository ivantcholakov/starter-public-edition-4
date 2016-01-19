<?php

/**
 * @author Mattias Hedman, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 * @author Code adaptation by Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Fb_controller extends Playground_Base_Controller {

    protected $error_message;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');

        $this->registry->set('nav', 'playground');

        if (!is_php('5.4')) {
            $this->error_message = 'PHP 5.4 is required for this demo to run.';
        }

        if ($this->error_message == '') {

            try {
                $this->load->library('facebook');
            } catch (Exception $ex) {
                $this->error_message = $ex->getMessage();
            }
        }
    }

    public function index()
    {
        $title = 'Facebook PHP SDK v4 for CodeIgniter';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/fb'));
        ;

        $this->template
            ->set('error_message', $this->error_message)
            ->set_partial('css', 'fb_start_css')
            ->build('fb_start');
    }

    public function web_login()
    {
        $data = array();

        if ($this->error_message == '') {

            $data['user'] = array();

            if ($this->facebook->logged_in())
            {
                $user = $this->facebook->user();

                if ($user['code'] === 200)
                {
                    unset($user['data']['permissions']);
                    $data['user'] = $user['data'];
                }
            }
        }

        $this->template
            ->title('Facebook PHP SDK v4 for CodeIgniter - Redirect login example')
            ->set($data)
            ->set('error_message', $this->error_message)
            ->set_partial('css', 'fb_web_css')
            ->build('fb_web');
    }

    public function js_login()
    {
        $this->template
            ->title('Facebook PHP SDK v4 for CodeIgniter - Javascript login example')
            ->set('error_message', $this->error_message)
            ->set_partial('css', 'fb_js_css')
            ->set_partial('scripts', 'fb_js_scripts')
            ->build('fb_js');
    }

    public function post()
    {
        header('Content-Type: application/json');

        $result = $this->facebook->publish_text($this->input->post('message'));
        $this->output->set_output(json_encode($result));
    }

    public function logout()
    {
        $this->facebook->destroy_session();
        redirect(site_url('playground/fb/web-login'));
    }

}
