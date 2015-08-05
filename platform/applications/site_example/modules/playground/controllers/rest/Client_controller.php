<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Client_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'restclient')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $code =
'    private function ci_rest($user_id) {

        $this->load->library(\'rest\', array(
            \'server\' => site_url(\'playground/rest/server-api-example/\'),
            //\'http_user\' => \'admin\',
            //\'http_pass\' => \'1234\',
            //\'http_auth\' => \'basic\' // or \'digest\'
        ), \'rest_client\');

        $result = $this->rest_client->get(\'users/id/\'.$user_id.\'/format/json\');

        return $result;
    }
';
        $result = $this->ci_rest(1);

        ob_start();
        echo print_d($result, true);
        $result = ob_get_contents();
        ob_end_clean();

        $this->template
            ->set('code', $code)
            ->set('result', $result)
        ;

        $this->template->build('rest/client');
    }

    private function ci_rest($user_id) {

        $this->load->library('rest', array(
            'server' => site_url('playground/rest/server-api-example/'),
            //'http_user' => 'admin',
            //'http_pass' => '1234',
            //'http_auth' => 'basic' // or 'digest'
        ), 'rest_client');

        $result = $this->rest_client->get('users/id/'.$user_id.'/format/json');

        return $result;
    }

}
