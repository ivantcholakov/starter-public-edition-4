<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Fa_test_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Font Awesome Superset Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/fa-test'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $csv = (string) @ file_get_contents(DEFAULTFCPATH.'assets/less/lib/font-awesome-4-actions/list.md');

        $csv = preg_split('/\r\n|\r|\n/m', $csv, null, PREG_SPLIT_NO_EMPTY);

        if (empty($csv)) {
            $csv = array();
        }

        $items = array();

        foreach ($csv as $item) {

            $item = trim(str_replace('*', '', $item));

            // Skip technical details.
            if (
                strpos($item, '-alpha') !== false
                ||
                strpos($item, '-beta') !== false
            ) {
                continue;
            }

            $items[] = $item;
        }

        sort($items);

        $this->template
            ->set('items', $items)
            ->build('fa_test');
    }

}
