<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Server_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'REST Server';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('RESTful Service Test', site_url('playground/rest/server'));
        ;

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'restserver')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'rest/server_scripts')
            ->build('rest/server');
    }

}
