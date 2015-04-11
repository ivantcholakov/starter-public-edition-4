<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Registry library for CodeIgniter
 *
 * You may use this library for storing and accessing application-level global data.
 * This library is intended to be compatible with CI 2.x and CI 3.x.
 *
 * Installation:
 *
 * Put this file Registry.php within application/libraries/ folder of your project.
 *
 * Usage Example:
 *
 * //---------------------------------------------------------------------------
 * // Context #1:
 *
 * $ci = get_instance(); // Use $this instead of $ci inside a controller's method.
 * $ci->load->library('registry'); // You may autoload this library at will.
 *
 * $title = 'Page Title';
 * $subtitle = 'Page Subtitle';
 * $metatitle = 'Page Title (Meta)';
 * $metadescription = 'Page Description (Meta)';
 * $metakeywords = 'page, keywords, meta';
 *
 * $ci->registry
 *     // Method chaining is possible.
 *     // Set values individually:
 *     ->set('page_title', $title)
 *     ->set('page_subtitle', $subtitle)
 *     // Set multiple values.
 *     ->set(compact('metatitle', 'metadescription', 'metakeywords'))
 * ;
 *
 * unset($title, $subtitle, $metatitle, $metadescription, $metakeywords);
 *
 * //---------------------------------------------------------------------------
 * // Context #2:
 *
 * $ci = get_instance();
 * $ci->load->library('registry');
 *
 * // Get values individually.
 * $title = $ci->registry->get('page_title');
 * $subtitle = $ci->registry->get('page_subtitle');
 *
 * // Get multiple values.
 * extract($ci->registry->get(array('metatitle', 'metadescription', 'metakeywords')));
 *
 * // Test:
 * var_dump(compact('title', 'subtitle', 'metatitle', 'metadescription', 'metakeywords'));
 *
 * //---------------------------------------------------------------------------
 * // Also:
 *
 * // Check whether a particular value is present.
 * $test = $ci->registry->has('test_key');
 * var_dump($test);
 *
 * // Gets everything from the registry (for debugging purpose).
 * $registry = $ci->registry->get_all();
 * var_dump($registry);
 *
 * // Unset values.
 * $ci->registry
 *     ->delete('page_title')
 *     ->delete('page_subtitle')
 *     ->delete(array('metatitle', 'metadescription', 'metakeywords'))
 * ;
 * var_dump($ci->registry->get_all());
 *
 * // Use destroy method only for testing purposes
 * $ci->registry->destroy();
 * var_dump($ci->registry->get_all());
 *
 * //---------------------------------------------------------------------------
 *
 * @version: 1.0.0
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Code repository: https://github.com/ivantcholakov/codeigniter-registry
 */

class Registry {

    protected static $data = array();

    public function __construct() {

        // Added by Ivan Tcholakov, 07-JAN-2014.
        $ci = get_instance();
        if (is_object($ci)) {
            $ci->load->helper('registry');
        }
        //

        log_message('info', 'Registry class initialized');
    }

    public function get($key) {

        if (is_array($key)) {

            $result = array();

            foreach ($key as $k) {
                $result[$k] = $this->get($k);
            }

            return $result;
        }

        $key = (string) $key;

        if ($key != '' && array_key_exists($key, self::$data)) {
            return self::$data[$key];
        }

        return null;
    }

    public function get_all() {

        return self::$data;
    }

    public function set($key, $value = null) {

        if (is_array($key)) {

            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }

            return $this;
        }

        self::$data[(string) $key] = $value;

        return $this;
    }

    public function has($key) {

        $key = (string) $key;

        return $key != '' && array_key_exists($key, self::$data);
    }

    public function delete($key) {

        if (is_array($key)) {

            foreach ($key as $k) {
                $this->delete($k);
            }

            return $this;
        }

        $key = (string) $key;

        if ($key != '' && array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }

        return $this;
    }

    // Use this method for testing purposes only!
    public function destroy() {

        self::$data = array();

        return $this;
    }

}
