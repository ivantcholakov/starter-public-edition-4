<?php defined('BASEPATH') OR exit('No direct script access allowed.');

// A place where you can move your custom helper functions,
// that are to be loaded before the functions below.
// If it is needed, create the corresponding file, insert
// your source there and uncomment the following lines.
//if (is_file(dirname(__FILE__).'/MY_email_helper_0.php')) {
//    require_once dirname(__FILE__).'/MY_email_helper_0.php';
//}

// Instead of copying manually or through script in this directory,
// let us just load here the provided by Composer file.
if (is_file(VENDORPATH.'ivantcholakov/codeigniter-phpmailer/helpers/MY_email_helper.php')) {
    require_once VENDORPATH.'ivantcholakov/codeigniter-phpmailer/helpers/MY_email_helper.php';
}

// A place where you can move your custom helper functions,
// that are to be loaded after the functions above.
// If it is needed, create the corresponding file, insert
// your source there and uncomment the following lines.
if (is_file(dirname(__FILE__).'/MY_email_helper_2.php')) {
    require_once dirname(__FILE__).'/MY_email_helper_2.php';
}
