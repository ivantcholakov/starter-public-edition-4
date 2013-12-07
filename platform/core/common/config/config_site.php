<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Site Name & Contact Data
|--------------------------------------------------------------------------
*/
$config['site_name'] = 'Site name';
$config['contact_organization'] = 'Organization name';
$config['contact_address'] = 'Organization address';
$config['contact_phone'] = '+359 2 00 00 00';
$config['contact_email'] = 'my@organization.com';


/*
|--------------------------------------------------------------------------
| Default Metadata: Title, Description, and Keywords.
|--------------------------------------------------------------------------
*/
$config['default_title'] = 'Default title';
$config['default_description'] = 'Default description';
$config['default_keywords'] = 'Default keywords';


/*
|--------------------------------------------------------------------------
| Automatic Email Messages
|--------------------------------------------------------------------------
*/

// Turn on/off the mailer.
// See also the configuration file email.php for proper settings for the mailer.
$config['mailer_enabled'] = false;

// The email-address from which the platform sends automatic messages.
// Usually it should be registered within your e-mail server, expect
// sending e-mails from a fake address to be forbidden. So, this setting
// should match to the credential settings for the e-mail server, see
// the configuration file email.php.
$config['site_email'] = 'mailer@organization.com';

// E-mail addresses (receivers), where notification/confirmation messages
// are to be automatically sent.
$config['notification_email'] = $config['contact_email'];

// An e-mail address that receives copies of sent/received messages.
$config['cc_email'] = '';


/*
|--------------------------------------------------------------------------
| Google Analytics Settings
|--------------------------------------------------------------------------
*/
$config['google_analytics_active'] = false;
$config['google_analytics_id'] = 'UA-XXXXX-X';  // Change UA-XXXXX-X to be your site's ID.
