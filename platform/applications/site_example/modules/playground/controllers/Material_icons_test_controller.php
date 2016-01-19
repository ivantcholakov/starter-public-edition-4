<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Material_icons_test_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Material Icons Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/material-icons-test'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $csv = (string) @ file_get_contents(DEFAULTFCPATH.'assets/fonts/material-icons/codepoints');

        $items = preg_split('/\r\n|\r|\n/m', $csv, null, PREG_SPLIT_NO_EMPTY);

        if (empty($items)) {
            $items = array();
        }

        foreach ($items as $key => $item) {

            $item = explode(' ', $item);
            $item = array('name' => $item[0], 'codepoint' => $item[1]);
            $items[$key] = $item;
        }

        $this->template
            ->set('items', $items)
            ->build('material_icons');
    }

}
