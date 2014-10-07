<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Hides language segment for default language.
$config['hide_default_uri_segment'] = true;

// Declare the default language within config.php.
// It should be one of the enabled languages.

// A list of the enabled languages.
// Example: $config['enabled_languages'] = array('english', 'bulgarian');
// The default language is enabled by default.
$config['enabled_languages'] = array();

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
        'name' => 'Español latinoamericano',
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

    'dutch' => array(
        'code' => 'nl',
        'direction' => 'ltr',
        'uri_segment' => 'nl',
        'name' => 'Nederlands',
        'name_en' => 'Dutch',
        'flag' => 'NL',
    ),

    'turkish' => array(
        'code' => 'tr',
        'direction' => 'ltr',
        'uri_segment' => 'tr',
        'name' => 'Türkçe',
        'name_en' => 'Turkish',
        'flag' => 'TR',
    ),

    'albanian' => array(
        'code' => 'sq',
        'direction' => 'ltr',
        'uri_segment' => 'sq',
        'name' => 'Shqip',
        'name_en' => 'Albanian',
        'flag' => 'AL',
    ),

    'arabic' => array(
        'code' => 'ar',
        'direction' => 'rtl',
        'uri_segment' => 'ar',
        'name' => 'العربية',
        'name_en' => 'Arabic',
        'flag' => 'EG',
    ),

    'bosnian' => array(
        'code' => 'bs',
        'direction' => 'ltr',
        'uri_segment' => 'bs',
        'name' => 'Bosanski',
        'name_en' => 'Bosnian',
        'flag' => 'BA',
    ),

    'greek' => array(
        'code' => 'el',
        'direction' => 'ltr',
        'uri_segment' => 'el',
        'name' => 'Ελληνικά',
        'name_en' => 'Greek',
        'flag' => 'GR',
    ),

    'danish' => array(
        'code' => 'da',
        'direction' => 'ltr',
        'uri_segment' => 'da',
        'name' => 'Dansk',
        'name_en' => 'Danish',
        'flag' => 'DK',
    ),

    'estonian' => array(
        'code' => 'et',
        'direction' => 'ltr',
        'uri_segment' => 'et',
        'name' => 'Eesti',
        'name_en' => 'Estonian',
        'flag' => 'EE',
    ),

    'irish' => array(
        'code' => 'ga',
        'direction' => 'ltr',
        'uri_segment' => 'ga',
        'name' => 'Gaeilge',
        'name_en' => 'Irish',
        'flag' => 'IE',
    ),

    'icelandic' => array(
        'code' => 'is',
        'direction' => 'ltr',
        'uri_segment' => 'is',
        'name' => 'Íslenska',
        'name_en' => 'Icelandic',
        'flag' => 'IS',
    ),

    'latvian' => array(
        'code' => 'lv',
        'direction' => 'ltr',
        'uri_segment' => 'lv',
        'name' => 'Latviešu',
        'name_en' => 'Latvian',
        'flag' => 'LV',
    ),

    'lithuanian' => array(
        'code' => 'lt',
        'direction' => 'ltr',
        'uri_segment' => 'lt',
        'name' => 'Lietuvių',
        'name_en' => 'Lithuanian',
        'flag' => 'LT',
    ),

    'macedonian' => array(
        'code' => 'mk',
        'direction' => 'ltr',
        'uri_segment' => 'mk',
        'name' => 'Македонски',
        'name_en' => 'Macedonian',
        'flag' => 'MK',
    ),

    'norwegian' => array(
        'code' => 'no',
        'direction' => 'ltr',
        'uri_segment' => 'no',
        'name' => 'Norsk',
        'name_en' => 'Norwegian',
        'flag' => 'NO',
    ),

    'polish' => array(
        'code' => 'pl',
        'direction' => 'ltr',
        'uri_segment' => 'pl',
        'name' => 'Polski',
        'name_en' => 'Polish',
        'flag' => 'PL',
    ),

    'romanian' => array(
        'code' => 'ro',
        'direction' => 'ltr',
        'uri_segment' => 'ro',
        'name' => 'Română',
        'name_en' => 'Romanian',
        'flag' => 'RO',
    ),

    'slovak' => array(
        'code' => 'sk',
        'direction' => 'ltr',
        'uri_segment' => 'sk',
        'name' => 'Română',
        'name_en' => 'Slovak',
        'flag' => 'SK',
    ),

    'slovenian' => array(
        'code' => 'sl',
        'direction' => 'ltr',
        'uri_segment' => 'sl',
        'name' => 'Slovenščina',
        'name_en' => 'Slovenian',
        'flag' => 'SI',
    ),

    'serbian' => array(
        'code' => 'sr',
        'direction' => 'ltr',
        'uri_segment' => 'sr',
        'name' => 'Српски',
        'name_en' => 'Serbian',
        'flag' => 'RS',
    ),

    'ukrainian' => array(
        'code' => 'uk',
        'direction' => 'ltr',
        'uri_segment' => 'uk',
        'name' => 'Українська',
        'name_en' => 'Ukrainian',
        'flag' => 'UA',
    ),

    'hungarian' => array(
        'code' => 'hu',
        'direction' => 'ltr',
        'uri_segment' => 'hu',
        'name' => 'Magyar',
        'name_en' => 'Hungarian',
        'flag' => 'HU',
    ),

    'finnish' => array(
        'code' => 'fi',
        'direction' => 'ltr',
        'uri_segment' => 'fi',
        'name' => 'Suomi',
        'name_en' => 'Finnish',
        'flag' => 'FI',
    ),

    'croatian' => array(
        'code' => 'hr',
        'direction' => 'ltr',
        'uri_segment' => 'hr',
        'name' => 'Hrvatski',
        'name_en' => 'Croatian',
        'flag' => 'HR',
    ),

    'czech' => array(
        'code' => 'cs',
        'direction' => 'ltr',
        'uri_segment' => 'cs',
        'name' => 'Čeština',
        'name_en' => 'Czech',
        'flag' => 'CZ',
    ),

    'czech' => array(
        'code' => 'cs',
        'direction' => 'ltr',
        'uri_segment' => 'cs',
        'name' => 'Čeština',
        'name_en' => 'Czech',
        'flag' => 'CZ',
    ),

    'swedish' => array(
        'code' => 'sv',
        'direction' => 'ltr',
        'uri_segment' => 'sv',
        'name' => 'Svenska',
        'name_en' => 'Swedish',
        'flag' => 'SE',
    ),

);
