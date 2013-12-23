<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Site Name & Contact Data
|--------------------------------------------------------------------------
*/
$config['site_name'] = 'Site Name';
$config['contact_organization'] = 'Organization Name';
$config['contact_address'] = 'Milky Way, Solar System, Planet Earth, Sofia, BULGARIA';
$config['contact_phone'] = '+359 2 00 00 00';
$config['contact_fax'] = '';
$config['contact_email'] = 'my@organization.com';
$config['contact_first_name'] = '';     // Contact person, first name.
$config['contact_last_name'] = '';      // Contact person, last name.
$config['contact_web_site'] = BASE_URL;
$config['contact_facebook'] = '';
$config['contact_twitter'] = '';
$config['contact_google_plus'] = '';
$config['contact_linkedin'] = '';
$config['contact_github'] = '';

$config['contact_map'] = '<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?ie=UTF8&amp;t=m&amp;source=embed&amp;ll=42.684454,23.329468&amp;spn=0.436106,1.020355&amp;z=11&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?ie=UTF8&amp;t=m&amp;source=embed&amp;ll=42.684454,23.329468&amp;spn=0.436106,1.020355&amp;z=11" style="color:#0000FF;text-align:left"><i18n>ui_see_a_lager_map</i18n></a></small>';


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
$config['google_analytics_enabled'] = false;
$config['google_analytics_id'] = 'UA-XXXXX-X';  // Change UA-XXXXX-X to be your site's ID.
