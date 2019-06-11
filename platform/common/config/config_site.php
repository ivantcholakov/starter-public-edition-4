<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Site Name & Contact Data
|--------------------------------------------------------------------------
*/
$config['site_name'] = 'Everpay';
$config['contact_organization'] = 'Everpay Corporation';
$config['contact_address'] = '5401 Rue York, Montreal, Quebec, H4E 4E4, Canada';
$config['contact_phone'] = '+1 800 566 6003';
$config['contact_fax'] = '';
$config['contact_email'] = 'hello@everpayinc.com';
$config['contact_first_name'] = '';     // Contact person, first name.
$config['contact_last_name'] = '';      // Contact person, last name.
$config['contact_web_site'] = DEFAULT_BASE_URL;
$config['contact_facebook'] = '';
$config['contact_twitter'] = '';
$config['contact_google_plus'] = '';
$config['contact_linkedin'] = '';
$config['contact_github'] = '';

// Here there are some optional contact information translations.
// The key suffix "_bg" is based on the language codes.
$config['contact_organization_bg'] = 'Име на организацията';
$config['contact_address_bg'] = 'България, София';
$config['contact_first_name_bg'] = '';
$config['contact_last_name_bg'] = '';

$config['contact_map'] = '<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?ie=UTF8&amp;t=m&amp;source=embed&amp;ll=42.684454,23.329468&amp;spn=0.436106,1.020355&amp;z=11&amp;output=embed"></iframe>';


/*
|--------------------------------------------------------------------------
| Copyright Note by the Site's Owner
|--------------------------------------------------------------------------
*/
$config['copyright_note'] = 'Copyright &copy; 2012 - {year} Everpay LLC. This page has been generated in <strong>{elapsed_time} seconds</strong> using <strong>{memory_usage}</strong> of memory.';


/*
|--------------------------------------------------------------------------
| Default Metadata: Title, Description, and Keywords.
|--------------------------------------------------------------------------
*/
$config['default_title'] = 'Get Everpay';
$config['default_description'] = '';
$config['default_keywords'] = '';


/*
|--------------------------------------------------------------------------
| Automatic Email Messages
|--------------------------------------------------------------------------
*/

// Turn on/off the mailer.
// See also the configuration file email.php for proper settings for the mailer.
$config['mailer_enabled'] = true;

// The email-address from which the platform sends automatic messages.
// Usually it should be registered within your e-mail server, expect
// sending e-mails from a fake address to be forbidden. So, this setting
// should match to the credential settings for the e-mail server, see
// the configuration file email.php.
$config['site_email'] = 'no-reply@everpayinc.com';

// E-mail addresses (receivers), where notification/confirmation messages
// are to be automatically sent.
$config['notification_email'] = $config['contact_email'];

// An e-mail address that receives copies of sent/received messages.
$config['cc_email'] = '';


/*
|--------------------------------------------------------------------------
| Google Analytics Settings
|
| Also, see the file robots.txt on how to enable sitemap.xml.
|--------------------------------------------------------------------------
*/
$config['google_analytics_enabled'] = false;
$config['google_analytics_id'] = 'UA-XXXXX-X';  // Change UA-XXXXX-X to be your site's ID.
