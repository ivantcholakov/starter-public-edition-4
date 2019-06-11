<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Requests_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Accessing the REST Server Using the Requests HTTP Library';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('RESTful Service Test', site_url('playground/rest/server'))
            ->set_breadcrumb($title, site_url('playground/rest/requests'))
        ;

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'requests')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->load->helper('url');

        $result = null;
        $status_code = null;
        $content_type = null;

        $code_example = <<<EOT

        \$user_id = 1;

        \$this->load->helper('url');

        \$headers = array('Accept' => 'application/json');
        \$options = array(
            'auth' => array('admin', '1234'),
            'verify' => false,  // Disable SSL verification, this option value is insecure and should be avoided!
        );
        \$request = Requests::get(site_url('playground/rest/server-api-example/users/id/'.\$user_id.'/format/json'), \$headers, \$options);

        \$result = \$request->body;
        \$status_code = \$request->status_code;
        \$content_type = \$request->headers['content-type'];

EOT;

        eval($code_example);

        $this->template
            ->set(compact('code_example', 'result', 'status_code', 'content_type'))
            ->build('rest/requests');
    }

}
