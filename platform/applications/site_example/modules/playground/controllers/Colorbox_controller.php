<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Colorbox_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Colorbox Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $images = array(
            array(
                'image' => 'ohoopee1.jpg',
                'title' => 'Me and my grandfather on the Ohoopee',
            ),
            array(
                'image' => 'ohoopee2.jpg',
                'title' => 'On the Ohoopee as a child',
            ),
            array(
                'image' => 'ohoopee3.jpg',
                'title' => 'On the Ohoopee as an adult',
            ),
        );

        $this->template
            ->set('images', $images)
            ->set_partial('css', 'colorbox_css')
            ->set_partial('scripts', 'colorbox_scripts')
            ->build('colorbox');
    }

}

