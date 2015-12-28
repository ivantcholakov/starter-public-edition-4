<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('rand_string')) {

    // This function provides compatibility with PyroCMS.
    function rand_string($length = 10) {

        return Random::string($length, 'ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz');
    }

}
