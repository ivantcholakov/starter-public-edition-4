<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Smileys_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Smiley Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/smileys'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->load->helper('smiley');  // This is needed only for calling _get_smiley_array().
        $smileys = _get_smiley_array();

        $items = array();

        if (!empty($smileys)) {

            foreach ($smileys as $key => $value) {
                $items[] = array(
                    'key' => $key,
                    'key_escaped' => $this->_force_htmlentities($key),
                    'image_name' => $value[0],
                    'width' => $value[1],
                    'height' => $value[2],
                    'alt' => $value[3],
                );
            }
        }

        $this->template
            ->set('items', $items)
            ->enable_parser_body('smileys')
            ->build('smileys');
    }

    protected function _force_htmlentities($string) {

        $arr = preg_split('/(?<!^)(?!$)/u', $string);  // An array of every multi-byte characters.

        $result = '';

        if (!empty($arr)) {

            foreach ($arr as $c) {
                $result .= '&#'.ord($c).';';
            }
        }

        return $result;
    }

}
