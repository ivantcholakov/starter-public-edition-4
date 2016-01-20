<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Core_Lang extends MX_Lang {

    protected $config;

    protected $common_module_extender;

    public function __construct() {

        parent::__construct();

        $this->config = load_class('Config', 'core');
    }

    /**
     * Fetches a single line of text from the language array
     *
     * @param       string          $line           Language line key
     * @parap       string|array    $param          String or array of strings to be inserted at placeholders like %s, %d, etc.
     * @param       bool            $log_errors     Whether to log an error message if the line is not found
     * @return      string                          Translation
     */
    public function line($line, $param = NULL, $log_errors = TRUE) {

        $line = (string) $line;

        if (is_bool($param)) {

            // Backward compatibility, the parent method line()
            // does not contain $param parameter.
            $log_errors = $param;
            $param = '';

        } elseif (!is_array($param)) {

            $param = (string) $param;
        }

        $log_errors = (bool) $log_errors;

        if (!isset($this->language[$line])) {

            $value = FALSE;

        } else {

            $value = $this->language[$line];
            $line_has_parameters = strpos($value, '%') !== false;

            if (is_array($param) && !empty($param)) {

                if (!$line_has_parameters) {
                    // Prepend missing parameters.
                    $value = str_repeat('%s', count($param)).$value;
                }

                $value = @ vsprintf($value, $param);

            } else {

                if (!$line_has_parameters && $param != '') {
                    // Prepend the missing parameter.
                    $value = '%s'.$value;
                }

                $value = sprintf($value, $param);
            }
        }

        if ($value === FALSE && $log_errors) {

            log_message('error', 'Could not find the language line "'.$line.'"');
        }

        return $value;
    }

    // --------------------------------------------------------------------

    /**
     * i18n tag parser.
     * @param       string      $string     The input HTML content with i18n tags.
     * @return      string                  The parsed content as a result.
     * @link http://devzone.zend.com/1441/zend-framework-and-translation/
     */
    public function parse_i18n($string)
    {
        if (strlen($string) == 0)
        {
            return '';
        }

        $delimiter_start = '<i18n>';
        $delimiter_end = '</i18n>';
        $replacement_attr = 'replacement';
        $replacement_attr_delimiter = ',';

        $delimiter_start_length = strlen($delimiter_start);
        $delimiter_end_length = strlen($delimiter_end);

        $delimiter_begin = substr($delimiter_start, 0, -1);

        $offset = 0;

        while (($pos_start = @ strpos($string, $delimiter_begin, $offset)) !== false)
        {
            $offset = $pos_start + $delimiter_start_length;

            // Check for an tag ending '>'.
            $pos_tag_end = strpos($string, '>', $offset - 1);

            $format_values = null;

            // If '<i18n' is not followed by char '>' directly, then we obviously have attributes in our tag.
            if ($pos_tag_end - $pos_start + 1 > $delimiter_start_length)
            {
                $format = substr($string, $offset, $pos_tag_end - $offset);

                $matches = array();
                // Check for value of 'format' attribute and explode it into $format_values.
                preg_match('/' . $replacement_attr . '="([^"]*)"/', $format, $matches);
                if (isset($matches[1]))
                {
                    $format_values = explode($replacement_attr_delimiter, $matches[1]);
                }

                $offset = $pos_tag_end + 1;
            }

            if (($pos_end = strpos($string, $delimiter_end, $offset)) === false)
            {
                trigger_error("parse_i18n: No ending i18n tag after position [$offset] found!", E_USER_WARNING);
            }

            $translate = substr($string, $offset, $pos_end - $offset);
            $translate = $this->line($translate, $format_values);

            $offset = $pos_end + $delimiter_end_length;
            $string = substr_replace($string, $translate, $pos_start, $offset - $pos_start);
            $offset = $offset - $delimiter_start_length - $delimiter_end_length;
        }

        // Added by Ivan Tcholakov, 19-DEC-2013.
        // Parse attributes:
        // i18n:title
        // i18n:alt
        // i18n:placeholder
        $string = preg_replace_callback(
            '/i18n:(title|alt|placeholder|value|data\-content)(\s*=\s*["\'])([^"\']+)(["\'])/im',
            array($this, '_parse_i18n_attributes_callback'),
            $string
        );
        //

        return $string;
    }

    // Added by Ivan Tcholakov, 19-DEC-2013.
    public function _parse_i18n_attributes_callback($matches) {

        $result = strtolower($matches[1]).$matches[2];
        $attribute = $matches[3];
        $pos = strpos($attribute, '|');

        if ($pos === false) {

            $result .= html_escape($this->line($attribute), FALSE);

        } else {

            $translate = substr($attribute, 0, $pos);
            $format_values = substr($attribute, $pos + 1);
            $format_values = explode(',', $format_values);

            $result .= html_escape($this->line($translate, $format_values), FALSE);
        }

        $result .= $matches[4];

        return $result;
    }
    //

    /**
     * Same behavior as the parent method, but it can load the first defined
     * lang configuration to fill other languages gaps. This is very useful
     * because you don't have to update all your lang files during development
     * each time you update a text. If a constant is missing it will load
     * it in the first language configured in the array $languages. (OPB)
     *
     * @param boolean $load_default_lang false to keep the old behavior. Please
     * modify the default value to true to use this feature without having to
     * modify your code
     */
    // Modified by Ivan Tcholakov, 17-DEC-2013.
    //function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '', $load_default_lang = false) {
    function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '', $module = '', $load_default_lang = false) {
    //

        if ($load_default_lang) {

            $default_lang = $this->default_lang();

            if ($this->current() != $default_lang) {

                // Modified by Ivan Tcholakov, 17-DEC-2013.
                //$addedLang = parent::load($langfile, $firstValue, $return, $add_suffix, $alt_path);
                $addedLang = parent::load($langfile, $default_lang, $return, $add_suffix, $alt_path, $module);
                //

                if ($addedLang) {

                    if ($add_suffix) {

                        $langfileToRemove = str_replace('.php', '', $langfile);
                        $langfileToRemove = str_replace('_lang.', '', $langfileToRemove) . '_lang';
                        $langfileToRemove .= '.php';
                    }

                    $this->is_loaded = array_diff($this->is_loaded, array($langfileToRemove));
                }
            }
        }

        // Modified by Ivan Tcholakov, 17-DEC-2013.
        //return parent::load($langfile, $idiom, $return, $add_suffix, $alt_path);
        return parent::load($langfile, $idiom, $return, $add_suffix, $alt_path, $module);
        //
    }

    // Added by Ivan Tcholakov, 16-MAR-2014.
    public function site_url($uri = '', $protocol = NULL, $language = NULL) {

        return $this->config->site_url($uri, $protocol, $language);
    }

    // Added by Ivan Tcholakov, 16-MAR-2014.
    public function site_uri($uri = '', $language = NULL) {

        return $this->config->site_uri($uri, $language);
    }

    function switch_uri($language) {

        global $URI;

        $uri = (string) $URI->uri_string();

        $lang = $this->uri_segment($language);

        $result = $uri;

        if ($this->valid_uri_segment($lang)) {

            if ($uri_segment = $this->get_uri_lang($uri)) {

                $uri_segment['parts'][0] = $lang;
                $parts = $uri_segment['parts'];

                if ($this->hide_default_uri_segment() && $language == $this->default_lang()) {
                    array_shift($parts);
                }

                $result = implode('/', $parts);

                if (!isset($uri_segment['parts'][1]) && $result != '') {
                    $result .= '/';
                }

            } else {

                if ($this->hide_default_uri_segment() && $language == $this->default_lang()) {
                    $result = $uri;
                } else {
                    $result = $lang.'/'.$uri;
                }
            }
        }

        // Added by Ivan Tcholakov, 21-OCT-2014.
        // Query strings should not be cut.
        $result = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '' ? $result.'?'.$_SERVER['QUERY_STRING'] : $result;
        //

        return $result;
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    // Checks whether the language exists within URI.
    // When true - returns an array with language segment + rest.
    public function get_uri_lang($uri = '') {

        return $this->config->get_uri_lang($uri);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function multilingual_site() {

        return $this->config->multilingual_site();
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function hide_default_uri_segment() {

        return $this->config->hide_default_language_uri_segment();
    }

    // Added by Ivan Tcholakov, 23-JAN-2014.
    public function get($language) {

        return $this->config->get_language($language);
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function set_current($language) {

        $this->config->set_current_language($language);
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function current() {

        return $this->config->current_language();
    }

    // Added by Ivan Tcholakov, 26-APR-2014.
    public function current_code() {

        return $this->config->current_language_code();
    }

    // Added by Ivan Tcholakov, 26-APR-2014.
    public function english() {

        return $this->config->english_language();
    }

    // Added by Ivan Tcholakov, 26-APR-2014.
    public function english_code() {

        return $this->config->english_language_code();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function default_lang() {

        return $this->config->default_language();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function default_code() {

        return $this->config->default_language_code();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function default_uri_segment() {

        return $this->config->default_language_uri_segment();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function enabled() {

        return $this->config->enabled_languages();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function enabled_codes() {

        return $this->config->enabled_languages_codes();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function enabled_uri_segments() {

        return $this->config->enabled_languages_uri_segments();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function valid($language) {

        return $this->config->valid_language($language);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function valid_code($code) {

        return $this->config->valid_code($code);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function valid_uri_segment($uri_segment) {

        return $this->config->valid_language_uri_segment($uri_segment);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function by_code($code) {

        return $this->config->language_by_code($code);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function by_uri_segment($uri_segment) {

        return $this->config->language_by_uri_segment($uri_segment);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function code($language = null) {

        return $this->config->language_code($language);
    }

    /**
     * Retrieves a custom language code that exist within the configuration data under the specified key.
     * This is for serving addins that identify languages with their own sets of codes.
     *
     * Example: $phpmailer_lang = $this->lang->custom_code('phpmailer', 'bulgarian);
     * For this example there must be 'phpmailer' configuration item (non-mandatory) for the corredponding language
     * within the configuration file lang.php:
     *
     * ...
     * 'bulgarian' => array(
     *     'code' => 'bg',              // CLDR language code.
     *     'direction' => 'ltr',        // This is the value by default, you may omit it.
     *     'uri_segment' => 'bg',       // If this value == value[code], you may omit it.
     *     'name' => 'Български',       // Native name.
     *     'name_en' => 'Bulgarian',    // Name in English.
     *     'flag' => 'BG',              // Flag (country code).
     *     'phpmailer' => 'bg',         // Language code used by PHPMailer, in this specific language it can be omited.
     * ),
     * ...
     *
     * @param string        $key        The key for accessing the custom code.
     * @param string/null   $language   The language.
     * @return string/null              Returns the custom code or if not found - the conventional (CLDR) language code.
     */
    public function custom_code($key, $language = null) {

        return $this->config->language_custom_code($key, $language);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function uri_segment($language = null) {

        return $this->config->language_uri_segment($language);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function direction($language = null) {

        return $this->config->language_direction($language);
    }

    // Added by Ivan Tcholakov, 18-APR-2014.
    public function name($language = null) {

        return $this->config->language_name($language);
    }

    // Added by Ivan Tcholakov, 18-APR-2014.
    public function name_en($language = null) {

        return $this->config->language_name_en($language);
    }

    // Added by Ivan Tcholakov, 31-MAY-2014.

    public function flag($language = null) {

        return $this->config->language_flag($language);
    }

}
