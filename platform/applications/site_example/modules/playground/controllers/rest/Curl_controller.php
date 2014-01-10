<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Curl_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'curl')
        ;
    }

    public function index() {

        $code =
'    private function ci_curl($user_id) {

        $username = \'admin\';
        $password = \'1234\';

        $this->load->library(\'curl\');

        $this->curl->create(site_url(\'playground/rest/server-api-example/user/id/\'.$user_id.\'/format/json\'));
  
        // Optional, delete this line if your API is open
        $this->curl->http_login($username, $password);
  
        $this->curl->get();

        $result = $this->curl->execute();

        return $result;
    }
';
        $result = $this->ci_curl(1);

        $this->template
            ->set('code', $code)
            ->set('result', $result)
        ;

        $this->template->build('rest/curl');

    }

    private function ci_curl($user_id) {

        $username = 'admin';
        $password = '1234';

        $this->load->library('curl');

        $this->curl->create(site_url('playground/rest/server-api-example/user/id/'.$user_id.'/format/json'));
  
        // Optional, delete this line if your API is open
        $this->curl->http_login($username, $password);
  
        $this->curl->get();

        $result = $this->curl->execute();

        return $result;
    }

}
