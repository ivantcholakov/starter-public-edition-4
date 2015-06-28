<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Social_buttons_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Social Buttons for Bootstrap')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->inject_partial('css', css('lib/bootstrap-social/bootstrap-social.min.css'))
            ->set_partial('scripts', 'social_buttons_scripts')
            ->build('social_buttons');
    }

}
