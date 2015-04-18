<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Star_rating_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Bootstrap Star Rating Examples')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->inject_partial('css', css('lib/bootstrap-star-rating/star-rating.min.css'))
            ->inject_partial('head', js('lib/bootstrap-star-rating/star-rating.min.js'))
            ->set_partial('scripts', 'star_rating_scripts')
            ->build('star_rating');
    }

}
