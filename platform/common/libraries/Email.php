<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * CodeIgniter compatible email-library powered by PHPMailer.
 * Version: 1.3.1
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2019.
 * @license The MIT License (MIT), http://opensource.org/licenses/MIT
 * @link https://github.com/ivantcholakov/codeigniter-phpmailer
 *
 * Tested on CodeIgniter 3.1.10-dev (December 6th, 2018) and
 * PHPMailer Version 6.0.6 (November 16th, 2018).
 */

if (is_php('5.5') && class_exists('\\PHPMailer\\PHPMailer\\PHPMailer', true)) {

    require_once dirname(__FILE__).'/Email_3_1_x_phpmailer_6_0_x.php';

} else {

    require_once dirname(__FILE__).'/Email_3_1_x.php';
}
