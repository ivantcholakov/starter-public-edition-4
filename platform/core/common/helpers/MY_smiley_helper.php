<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Alternative and additional smiley helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('_get_smiley_array')) {

    /**
     * Get Smiley Array
     * Fetches the config/smiley.php file
     * @return    mixed
     */
    function _get_smiley_array() {

        static $_smileys;

        if (!isset($_smileys)) {

            if (file_exists(COMMONPATH.'config/smileys.php')) {
                include(COMMONPATH.'config/smileys.php');
            }

            if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/smileys.php')) {
                include(COMMONPATH.'config/'.ENVIRONMENT.'/smileys.php');
            }

            if (file_exists(APPPATH.'config/smileys.php')) {
                include(APPPATH.'config/smileys.php');
            }

            if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/smileys.php')) {
                include(APPPATH.'config/'.ENVIRONMENT.'/smileys.php');
            }

            if (empty($smileys) OR !is_array($smileys)) {
                $_smileys = FALSE;
            } else {
                $_smileys = $smileys;
            }
        }

        return $_smileys;
    }

}
