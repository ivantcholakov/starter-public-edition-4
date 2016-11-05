<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Google_maps_v3_controller extends Playground_Base_Controller {

    public $driver_ok = false;

    public function __construct() {

        parent::__construct();

        $this->driver_ok = extension_loaded('pdo_sqlite');

        if ($this->driver_ok) {
            $this->load->database();
        }

        $title = 'Google Maps JavaScript API v3 Demo';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/google-maps-v3'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set('driver_ok', $this->driver_ok)
            ->set_partial('scripts', 'google_maps_v3_scripts')
            ->build('google_maps_v3');
    }

}
