<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Curl_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'curl')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $code_example = <<<EOT

        \$user_id = 1;

        \$this->load->helper('url');
        \$this->load->library('curl');

        \$this->curl->create(site_url('playground/rest/server-api-example/users/id/'.\$user_id.'/format/json'));

        // Optional, delete this line if your API is open.
        \$username = 'admin';
        \$password = '1234';
        \$this->curl->http_login(\$username, \$password);

        \$result = \$this->curl->get()->execute();

EOT;

        eval($code_example);

        $this->template
            ->set(compact('code_example', 'result'))
            ->build('rest/curl');
    }

}
