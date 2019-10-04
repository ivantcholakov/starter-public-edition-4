<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * CodeIgniter compatible email-library powered by PHPMailer.
 * Version: 1.3.2
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2019.
 * @license The MIT License (MIT), http://opensource.org/licenses/MIT
 * @link https://github.com/ivantcholakov/codeigniter-phpmailer
 *
 * Tested on CodeIgniter 3.1.11 (September 19th, 2019) and
 * PHPMailer Version 6.1.1 (September 28th, 2019).
 */

if (is_php('5.5') && class_exists('\\PHPMailer\\PHPMailer\\PHPMailer', true)) {

    require_once dirname(__FILE__).'/Email_3_1_x_phpmailer_6_0_x.php';

} else {

    require_once dirname(__FILE__).'/Email_3_1_x.php';
}
