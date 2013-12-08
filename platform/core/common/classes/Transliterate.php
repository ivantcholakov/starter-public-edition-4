<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Transliteration class
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2013.
 * @link https://github.com/ivantcholakov/transliterate
 *
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 *
 */

if (!defined('ICONV_INSTALLED')) {
    define('ICONV_INSTALLED', function_exists('iconv'));
}

if (!defined('IS_CODEIGNITER')) {
    // A flag, telling that this code runs on CodeIgniter framework.
    //define('IS_CODEIGNITER', defined('BASEPATH') && defined('APPPATH') && defined('CI_VERSION') && function_exists('get_instance'));
    define('IS_CODEIGNITER', true);
}

class Transliterate {

    private static $cyr_bg                  = array('Щ',  'Ш', 'Ч',  'Ц', 'Ю', 'Я', 'Ж', 'А','Б','В','Г','Д','Е','Ё','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ь','Ы','Ъ','Э');
    private static $lat_bg                  = array('Sht','Sh','Tch','Ts','Yu','Ya','Zh','A','B','V','G','D','E','E','Z','I','Y','K','L','M','N','O','P','R','S','T','U','F','H','Y','J','A','E');

    private static $cyr_bg_lower            = array('щ',  'ш', 'ч',  'ц', 'ю', 'я', 'ж', 'а','б','в','г','д','е','ё','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ь','ы','ъ','э');
    private static $lat_bg_lower            = array('sht','sh','tch','ts','yu','ya','zh','a','b','v','g','d','e','e','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','y','j','a','e');

    private static $cyr_ru                  = array('Щ',  'Ш', 'Ч', 'Ц', 'Ю', 'Я', 'Ж', 'А','Б','В','Г','Д','Е','Ё','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ь', 'Ы','Ъ','Э');
    private static $lat_ru                  = array('Sch','Sh','Ch','Ts','Yu','Ya','Zh','A','B','V','G','D','E','E','Z','I','J','K','L','M','N','O','P','R','S','T','U','F','H','\'','Y','`','E');

    private static $cyr_ru_lower            = array('щ',  'ш', 'ч', 'ц', 'ю', 'я', 'ж', 'а','б','в','г','д','е','ё','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ь', 'ы','ъ','э');
    private static $lat_ru_lower            = array('sch','sh','ch','ts','yu','ya','zh','a','b','v','g','d','e','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','\'','y','`','e');

    private static $cyr_ru_additional       = array('В','Кс','К','Ё', 'Я', 'Ю', 'ь', 'ъ','ы');
    private static $lat_ru_additional       = array('W','X', 'Q','Yo','Ja','Ju','\'','`','y');

    private static $cyr_ru_additional_lower = array('в','кс','к','ё', 'я', 'ю', 'ь', 'ъ','ы');
    private static $lat_ru_additional_lower = array('w','x', 'q','yo','ja','ju','\'','`','y');

    final private function __construct() {}
    final private function __clone() {}

    /**
     * Converts cyrillic letters within a string into their ASCII equivalents.
     * Conversion is language dependent.
     * @param string $string        The input string, UTF-8.
     * @param string $language      Language identificator ('bg', 'ru', ...)
     * @return string
     */
    public static function cyr_to_lat($string, $language = null) {

        $language = self::detect_language($language);

        switch ($language) {

            case 'ru':
                $string = str_replace(self::$cyr_ru, self::$lat_ru, $string);
                $string = str_replace(self::$cyr_ru_lower, self::$lat_ru_lower, $string);
                break;

            default:
                // Bulgarian variant of transliteration is by default.
                $string = str_replace(self::$cyr_bg, self::$lat_bg, $string);
                $string = str_replace(self::$cyr_bg_lower, self::$lat_bg_lower, $string);
                break;
        }

        return $string;
    }

    /**
     * Converts ASCII letters within a string into their cyrillic equivalents.
     * Conversion is language dependent.
     * @param string $string        The input string, UTF-8.
     * @param string $language      Language identificator ('bg', 'ru', ...)
     * @return string
     */
    public static function lat_to_cyr($string, $language = null) {

        $language = self::detect_language($language);

        switch ($language) {

            case 'ru':
                $string = str_replace(self::$lat_ru_additional, self::$cyr_ru_additional, $string);
                $string = str_replace(self::$lat_ru_additional_lower, self::$cyr_ru_additional_lower, $string);
                break;

            default:
                // Bulgarian variant of transliteration is by default.
                $string = str_replace(self::$lat_bg, self::$cyr_bg, $string);
                $string = str_replace(self::$lat_bg_lower, self::$cyr_bg_lower, $string);
                break;
        }

        return $string;
    }

    /**
     * Transliterates the input string to an ASCII equivalent string.
     * Transliteration is language dependent.
     * @param string $string        The input string, UTF-8.
     * @param string $language      Language identificator ('bg', 'ru', ...)
     * @return string
     */
    public static function to_ascii($string, $language = null) {

        $language = self::detect_language($language);

        $string = self::cyr_to_lat($string, $language);

        static $search;
        static $replace;

        if (IS_CODEIGNITER) {

            if (!isset($search) || !is_array($search)) {

                // Added by Ivan Tcholakov, 03-OCT-2013.
                if (file_exists(COMMONPATH.'config/foreign_chars.php')) {
                    include COMMONPATH.'config/foreign_chars.php';
                }

                if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/foreign_chars.php')) {
                    include COMMONPATH.'config/'.ENVIRONMENT.'/foreign_chars.php';
                }
                //

                if (file_exists(APPPATH.'config/foreign_chars.php')) {
                    include APPPATH.'config/foreign_chars.php';
                }

                if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/foreign_chars.php')) {
                    include APPPATH.'config/'.ENVIRONMENT.'/foreign_chars.php';
                }

                if (empty($foreign_characters) || !is_array($foreign_characters)) {

                    $search = array();
                    $replace = array();

                } else {

                    $search = array_keys($foreign_characters);
                    $replace = array_values($foreign_characters);
                }
            }

            $string = preg_replace($search, $replace, $string);
        }

        if (ICONV_INSTALLED) {
            $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        }

        return $string;
    }

    /**
     * Unifies language identificators.
     * @param string $language      Language identificator ('bg', 'bulgarian' 'ru', 'russian', ...)
     * @return string               Resulting language identificator, ISO 639-1 ('bg', 'ru', ...)
     */
    private static function detect_language($language) {

        $language = strtolower($language);

        switch ($language) {

            case 'bulgarian':
            case 'bg':
                $language = 'bg';
                break;

            case 'russian':
            case 'ru':
                $language = 'ru';
                break;
        }

        return $language;
    }

}
