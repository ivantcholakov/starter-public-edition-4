<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class Gateway_controller extends Base_Authenticated_Controller {
    public function __construct() {
        parent::__construct();
        $this->_set_nav('gateways');
    }
    public function index() {
        $title = 'Gateways';
        $this->registry->set('title', $title);
        $this->_set_header_icon('signal');
        $this->template
            ->prepend_title($title)
            ->set_partial('scripts', 'gateway_scripts')
            ->build('gateways');
    }
}
