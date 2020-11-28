<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Post_test extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Testing a POST request';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('RESTful Service Test', site_url('playground/rest/server'))
            ->set_breadcrumb($title, site_url('playground/rest/post-test'))
        ;

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'post_test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index()
    {
        $this->load->helper('url');

        $result = null;
        $status_code = null;
        $content_type = null;

        $code_example = <<<EOT

        \$this->load->helper('url');

        \$client = new GuzzleHttp\Client();
        \$res = \$client->post(
            site_url('playground/rest/server-api-example/users'),
            [
                'auth' =>  ['admin', '1234'],
                'verify' => false,  // Disable SSL verification, this option value is insecure and should be avoided!,
                'form_params' => array('name' => 'John', 'email' => 'john@example.com')
            ]
        );

        \$result = (string) \$res->getBody();
        \$status_code = \$res->getStatusCode();

        \$content_type = \$res->getHeader('content-type');
        \$content_type = is_array(\$content_type) ? \$content_type[0] : \$content_type;


EOT;

        eval($code_example);

        $this->template
            ->set(compact('code_example', 'result', 'status_code', 'content_type'))
            ->build('rest/post_test');
    }
}
