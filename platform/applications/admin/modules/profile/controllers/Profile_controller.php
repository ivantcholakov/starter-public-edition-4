<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class Profile_controller extends Base_Authenticated_Controller {
    public function __construct() {
        parent::__construct();
        $this->_set_nav('profile');
    }
    public function index() {
        $title = 'Profile';
        $this->registry->set('title', $title);
        $this->_set_header_icon('user');
        $this->template
            ->prepend_title($title)
            ->set_partial('scripts', 'profile_scripts')
            ->build('profile');
    }
}
