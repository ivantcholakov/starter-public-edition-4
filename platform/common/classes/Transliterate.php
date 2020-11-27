<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Transliteration class
 *
 * @version 1.1.1
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2012-2016.
 * @link https://github.com/ivantcholakov/transliterate
 *
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 */

if (!defined('ICONV_INSTALLED')) {
    define('ICONV_INSTALLED', function_exists('iconv'));
}

if (!defined('INTL_INSTALLED')) {
    define('INTL_INSTALLED', function_exists('intl_get_error_code'));
}

if (!defined('IS_CODEIGNITER')) {
    // A flag, telling that this code runs on CodeIgniter framework.
    //define('IS_CODEIGNITER', defined('BASEPATH') && defined('APPPATH') && defined('CI_VERSION') && function_exists('get_instance'));
    define('IS_CODEIGNITER', true);
}

class Transliterate {

    // Bulgarian
    // See http://bg.wikipedia.org/wiki/Транслитерация_на_българските_букви_с_латински

    // A correction by Ivan Tcholakov, 23-APR-2014: 'Ч' -> 'Ch', 'ч' -> 'ch'

    private static $cyr_bg                  = array('Щ',  'Ш', 'Ч',  'Ц', 'Ю', 'Я', 'Ж', 'А','Б','В','Г','Д','Е','Ё','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ь','Ы','Ъ','Э');
    private static $lat_bg                  = array('Sht','Sh','Ch','Ts','Yu','Ya','Zh','A','B','V','G','D','E','E','Z','I','Y','K','L','M','N','O','P','R','S','T','U','F','H','Y','J','A','E');

    private static $cyr_bg_lower            = array('щ',  'ш', 'ч',  'ц', 'ю', 'я', 'ж', 'а','б','в','г','д','е','ё','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ь','ы','ъ','э');
    private static $lat_bg_lower            = array('sht','sh','ch','ts','yu','ya','zh','a','b','v','g','d','e','e','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','y','j','a','e');

    private static $cyr_ru                  = array('Щ',  'Ш', 'Ч', 'Ц', 'Ю', 'Я', 'Ж', 'А','Б','В','Г','Д','Е','Ё','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ь', 'Ы','Ъ','Э');
    private static $lat_ru                  = array('Sch','Sh','Ch','Ts','Yu','Ya','Zh','A','B','V','G','D','E','E','Z','I','J','K','L','M','N','O','P','R','S','T','U','F','H','\'','Y','`','E');

    // Russian

    private static $cyr_ru_lower            = array('щ',  'ш', 'ч', 'ц', 'ю', 'я', 'ж', 'а','б','в','г','д','е','ё','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ь', 'ы','ъ','э');
    private static $lat_ru_lower            = array('sch','sh','ch','ts','yu','ya','zh','a','b','v','g','d','e','e','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','\'','y','`','e');

    private static $cyr_ru_additional       = array('В','Кс','К','Ё', 'Я', 'Ю', 'ь', 'ъ','ы');
    private static $lat_ru_additional       = array('W','X', 'Q','Yo','Ja','Ju','\'','`','y');

    private static $cyr_ru_additional_lower = array('в','кс','к','ё', 'я', 'ю', 'ь', 'ъ','ы');
    private static $lat_ru_additional_lower = array('w','x', 'q','yo','ja','ju','\'','`','y');

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

                // Added by Ivan Tcholakov, 23-APR-2014.
                $string = preg_replace('/България/iu', 'Bulgaria', $string);
                //

                // Added by Ivan Tcholakov, 23-APR-2014.
                $string = preg_replace('/ия([^\p{L}]|$)/u', 'ia$1', $string);
                //

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

                // Added by Ivan Tcholakov, 23-APR-2014.
                $string = preg_replace('/Bulgaria/iu', 'България', $string);
                //

                // Added by Ivan Tcholakov, 23-APR-2014.
                $string = preg_replace('/ia([^\p{L}]|$)/u', 'ия$1', $string);
                //

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

        static $transliterator_ids = array();

        if (INTL_INSTALLED && class_exists('Transliterator', false)) {

            if (empty($transliterator_ids)) {
                $transliterator_ids = Transliterator::listIDs();
            }

            $transliterator_id = null;

            switch ($language) {

                case 'ar':
                    $transliterator_id = 'Arabic-Latin';
                    break;

                case 'el':
                    $transliterator_id = 'Greek-Latin';
                    break;

                case 'mk':
                    $transliterator_id = 'Macedonian-Latin/BGN';
                    break;

                case 'sr':
                    $transliterator_id = 'Serbian-Latin/BGN';
                    break;

                case 'uk':
                    $transliterator_id = 'Ukrainian-Latin/BGN';
                    break;

                case 'ko':
                    $transliterator_id = 'Korean-Latin/BGN';
                    break;

                case 'th':
                    $transliterator_id = 'Thai-Latin';
                    break;

                case 'gu':
                    $transliterator_id = 'Gujarati-Latin';
                    break;

                case 'ta':
                    $transliterator_id = 'Tamil-Latin';
                    break;

                case 'az':
                    $transliterator_id = 'Azerbaijani-Latin/BGN';
                    break;
            }

            if (!in_array($transliterator_id, $transliterator_ids)) {
                $transliterator_id = null;
            }

            if ($transliterator_id == '') {
                $transliterator_id = 'Any-Latin; Latin-ASCII';
            } else {
                $transliterator_id .= '; Any-Latin; Latin-ASCII';
            }

            $transliterator = @ Transliterator::create($transliterator_id);

            if (is_object($transliterator)) {
                $new_string = @ $transliterator->transliterate($string);
            } else {
                $new_string = false;
            }

            if ($new_string !== false) {
                $string = $new_string;
            }

            unset($new_string);
        }

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

        if ($language == '') {

            if (IS_CODEIGNITER) {

                $ci = & get_instance();
                $language = $ci->config->item('language');
            }
        }

        $l = strtolower($language);

        switch ($l) {

            case 'bulgarian':
            case 'bg':
                $l = 'bg';
                break;

            case 'russian':
            case 'ru':
                $l = 'ru';
                break;

            case 'english':
            case 'en':
                $l = 'en';
                break;

            case 'german':
            case 'de':
                $l = 'de';
                break;

            case 'spanish':
            case 'es':
                $l = 'es';
                break;

            case 'spanish-latin':
            case 'es-419':
                $l = 'es-419';
                break;

            case 'french':
            case 'fr':
                $l = 'fr';
                break;

            case 'italian':
            case 'it':
                $l = 'it';
                break;

            case 'portuguese':
            case 'pt':
                $l = 'pt';
                break;

            case 'portuguese-brazilian':
            case 'pt-br':
                $l = 'pt-BR';
                break;

            case 'dutch':
            case 'nl':
                $l = 'nl';
                break;

            case 'turkish':
            case 'tr':
                $l = 'tr';
                break;

            case 'albanian':
            case 'sq':
                $l = 'sq';
                break;

            case 'arabic':
            case 'ar':
                $l = 'ar';
                break;

            case 'bosnian':
            case 'bs':
                $l = 'bs';
                break;

            case 'greek':
            case 'el':
                $l = 'el';
                break;

            case 'danish':
            case 'da':
                $l = 'da';
                break;

            case 'estonian':
            case 'et':
                $l = 'et';
                break;

            case 'irish':
            case 'ga':
                $l = 'ga';
                break;

            case 'icelandic':
            case 'is':
                $l = 'is';
                break;

            case 'latvian':
            case 'lv':
                $l = 'lv';
                break;

            case 'lithuanian':
            case 'lt':
                $l = 'lt';
                break;

            case 'macedonian':
            case 'mk':
                $l = 'mk';
                break;

            case 'norwegian':
            case 'no':
                $l = 'no';
                break;

            case 'polish':
            case 'pl':
                $l = 'pl';
                break;

            case 'romanian':
            case 'ro':
                $l = 'ro';
                break;

            case 'slovak':
            case 'sk':
                $l = 'sk';
                break;

            case 'slovenian':
            case 'sl':
                $l = 'sl';
                break;

            case 'serbian':
            case 'sr':
                $l = 'sr';
                break;

            case 'ukrainian':
            case 'uk':
                $l = 'uk';
                break;

            case 'hungarian':
            case 'hu':
                $l = 'hu';
                break;

            case 'finnish':
            case 'fi':
                $l = 'fi';
                break;

            case 'croatian':
            case 'hr':
                $l = 'hr';
                break;

            case 'czech':
            case 'cs':
                $l = 'cs';
                break;

            case 'swedish':
            case 'sv':
                $l = 'sv';
                break;

            case 'indonesian':
            case 'id':
                $l = 'id';
                break;

            case 'japanese':
            case 'ja':
                $l = 'ja';
                break;

            case 'korean':
            case 'ko':
                $l = 'ko';
                break;

            case 'persian':
            case 'fa':
                $l = 'fa';
                break;

            case 'simplified-chinese':
            case 'zh-hans':
            case 'zh-cn':
                $l = 'zh-Hans';
                break;

            case 'thai':
            case 'th':
                $l = 'th';
                break;

            case 'traditional-chinese':
            case 'zh-hant';
            case 'zh-tw':
                $l = 'zh-Hant';
                break;

            case 'catalan':
            case 'ca':
                $l = 'ca';
                break;

            case 'filipino':
            case 'fil':
                $l = 'fil';
                break;

            case 'gujarati':
            case 'gu':
                $l = 'gu';
                break;

            case 'khmer':
            case 'km':
                $l = 'km';
                break;

            case 'tamil':
            case 'ta':
                $l = 'ta';
                break;

            case 'urdu':
            case 'ur':
                $l = 'ur';
                break;

            case 'hindi':
            case 'hi':
                $l = 'hi';
                break;

            case 'azerbaijani':
            case 'az':
                $l = 'az';
                break;

            default:
                $l = null;
                break;
        }

        if ($l != '') {
            $language = $l;
        }

        return $language;
    }

}
