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

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->inject_partial('css', css('lib/bootstrap3-dialog/bootstrap-dialog.min.css').css('lib/bootstrap-star-rating/star-rating.min.css'))
            ->set_partial('scripts', 'assign_rating_scripts')
            ->build('assign_rating');
    }

}
