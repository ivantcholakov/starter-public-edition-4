<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gravatar Library for CodeIgniter - Configuration
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// For more information see http://en.gravatar.com/site/implement/images/

$config['gravatar_base_url'] = 'http://www.gravatar.com/';
$config['gravatar_secure_base_url'] = 'https://secure.gravatar.com/';
$config['gravatar_image_extension'] = '.png';   // '', '.png' or '.jpg'.
$config['gravatar_image_size'] = 80;

$config['gravatar_default_image'] = ''; // '', '404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank'.
//$config['gravatar_default_image'] = DEFAULT_BASE_URL.'assets/img/lib/default-person.png'; // Another possible option: a custon image.

$config['gravatar_force_default_image'] = false;
$config['gravatar_rating'] = '';  // '', 'g' (default), 'pg', 'r', 'x'.

// Useragent string for server-made requests.
// It is for not getting 403 forbidden response.
$config['gravatar_useragent'] = 'PHP Gravatar Library';
