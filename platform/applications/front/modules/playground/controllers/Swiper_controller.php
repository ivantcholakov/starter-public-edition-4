<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2019
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Swiper_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $images = array();

        for ($i = 1; $i <= 8; $i++) {

            $images[] = array(
                'title' => 'Image '.$i,
                'src' => image_url('lib/ihover/'.$i.'.jpg'),
            );
        }

        $title = 'Swiper Slider Test';

        $this->template
            ->set('images', $images)
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/swiper'))
            ->set_partial('css', 'swiper_css')
            ->set_partial('scripts', 'swiper_scripts')
            ->build('swiper');
    }

}
