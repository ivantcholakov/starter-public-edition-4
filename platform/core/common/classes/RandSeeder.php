<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/**
 * The purpose of this class is to provide session-invariant random numbers.
 * The provided values can be used for example for pagination of items with
 * random order (they are to seed the MySQL function RAND()).
 */

class RandSeeder {

    protected static $rand_seeder;

    final private function __construct() {}
    final private function __clone() {}

    public static function get() {

        if (!isset(self::$rand_seeder)) {

            //if ((PHP_SAPI == 'cli') or defined('STDIN')) {
            if (IS_CLI) {   // CodeIgniter specific implementation.

                self::$rand_seeder = rand();

            } else {

                //if (function_exists('get_instance')) {

                    // CodeIgniter specific implementation.

                    $ci = get_instance();
                    $ci->load->library('session');
                    $session_data = $ci->session->userdata('rand_seeder');

                    if (!is_null($session_data)) {

                        self::$rand_seeder = $session_data;

                    } else {

                        self::$rand_seeder = rand();
                        $ci->session->set_userdata('rand_seeder', self::$rand_seeder);
                    }

                //} else {

                //    if (isset($_SESSION['rand_seeder'])) {
                //        self::$rand_seeder = $_SESSION['rand_seeder'];
                //    } else {
                //        self::$rand_seeder = rand();
                //        $_SESSION['rand_seeder'] = self::$rand_seeder;
                //    }
                //}
            }
        }

        return self::$rand_seeder;
    }

}
