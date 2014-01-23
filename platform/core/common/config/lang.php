<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Hides language segment for default language.
$config['hide_default_uri_segment'] = true;

// Declare the default language within config.php.
// It should be one of the enabled languages.

$config['enabled_languages'] = array(); // The default language is enabled by default.

$config['languages'] = array(

    'bulgarian' => array(
        'code' => 'bg',             // CLDR language code.
        'direction' => 'ltr',       // This is the value by default, you may omit it.
        'uri_segment' => 'bg',      // If this value == value[code], you may omit it.
        'name' => 'Български',      // Native name.
        'name_en' => 'Bulgarian',   // Name in English.
        'flag' => 'BG',             // Flag (country code).
    ),

    'english' => array(
        'code' => 'en',
        'direction' => 'ltr',
        'uri_segment' => 'en',
        'name' => 'English',
        'name_en' => 'English',
        'flag' => 'GB',
    ),

    'german' => array(
        'code' => 'de',
        'direction' => 'ltr',
        'uri_segment' => 'de',
        'name' => 'Deutsch',
        'name_en' => 'German',
        'flag' => 'DE',
    ),

    'spanish' => array(
        'code' => 'es',
        'direction' => 'ltr',
        'uri_segment' => 'es',
        'name' => 'Español',
        'name_en' => 'Spanish',
        'flag' => 'ES',
    ),

    'spanish_latin' => array(
        'code' => 'es_419',
        'direction' => 'ltr',
        'uri_segment' => 'es-419',
        'name' => 'Español  latinoamericano',
        'name_en' => 'Latin American Spanish',
        'flag' => 'MX',
    ),

    'french' => array(
        'code' => 'fr',
        'direction' => 'ltr',
        'uri_segment' => 'fr',
        'name' => 'Français',
        'name_en' => 'French',
        'flag' => 'FR',
    ),

    'italian' => array(
        'code' => 'it',
        'direction' => 'ltr',
        'uri_segment' => 'it',
        'name' => 'Italiano',
        'name_en' => 'Italian',
        'flag' => 'IT',
    ),

    'portuguese' => array(
        'code' => 'pt',
        'direction' => 'ltr',
        'uri_segment' => 'pt',
        'name' => 'Português',
        'name_en' => 'Portuguese',
        'flag' => 'PT',
    ),

    'brazilian_portuguese' => array(
        'code' => 'pt_BR',
        'direction' => 'ltr',
        'uri_segment' => 'pt-br',
        'name' => 'Português do Brasil',
        'name_en' => 'Brazilian Portuguese',
        'flag' => 'BR',
    ),

    'russian' => array(
        'code' => 'ru',
        'direction' => 'ltr',
        'uri_segment' => 'ru',
        'name' => 'Русский',
        'name_en' => 'Russian',
        'flag' => 'RU',
    ),

);
