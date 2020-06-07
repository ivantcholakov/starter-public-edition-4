<?php defined('BASEPATH') OR exit('No direct script access allowed.');

// Instead of copying manually or through script in this directory,
// let us just load here the provided by Composer file.
require_once VENDORPATH.'ivantcholakov/codeigniter-phpmailer/libraries/MY_Email.php';
class_alias ('MY_Email', 'Email', false);
