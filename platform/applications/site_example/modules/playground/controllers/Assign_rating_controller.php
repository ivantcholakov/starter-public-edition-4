<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Assign_rating_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Assign Rating Example')
        ;

        $this->template
            ->set_partial('subnavbar', 'assign_rating_subnavbar')
            ->set('subnavbar_item_active', 'v1')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'assign_rating_scripts')
            ->build('assign_rating');
    }

}
