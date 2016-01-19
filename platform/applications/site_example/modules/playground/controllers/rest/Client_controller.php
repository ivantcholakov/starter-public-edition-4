<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Client_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Accessing the REST Server Using the Rest Client Library';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('RESTful Service Test', site_url('playground/rest/server'))
            ->set_breadcrumb($title, site_url('playground/rest/client'))
        ;

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'restclient')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $code_example = <<<EOT

        \$user_id = 1;

        \$this->load->helper('url');

        \$this->load->library('rest_client', array(
            'server' => site_url('playground/rest/server-api-example/'),
            //'http_user' => 'admin',
            //'http_pass' => '1234',
            //'http_auth' => 'basic' // or 'digest'
        ));

        \$result = \$this->rest_client->get('users/id/'.\$user_id.'/format/json');

EOT;

        eval($code_example);

        $this->template
            ->set(compact('code_example', 'result'))
            ->build('rest/client');
    }

}
