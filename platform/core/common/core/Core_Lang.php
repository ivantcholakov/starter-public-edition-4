<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Core_Lang extends MX_Lang {

    protected $common_module_extender;

    public function __construct() {

        parent::__construct();

        global $URI;

        $uri_segment = $this->get_uri_lang($URI->uri_string());

        $language = $uri_segment ? $this->by_uri_segment($uri_segment['lang']) : null;

        $this->set_current($language);
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

        if ($line == '' || !isset($this->language[$line])) {

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

        while (($pos_start = strpos($string, $delimiter_begin, $offset)) !== false)
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
                trigger_error("parse_i18n: No ending i18n tag after position [$offset] found!", E_USER_ERROR);
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
            '/i18n:(title|alt|placeholder|value)(\s*=\s*["\'])([^"\']+)(["\'])/im',
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

            $result .= $this->line($attribute);

        } else {

            $translate = substr($attribute, 0, $pos);
            $format_values = substr($attribute, $pos + 1);
            $format_values = explode(',', $format_values);

            $result .= $this->line($translate, $format_values);
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

    function switch_uri($language) {

        global $URI;

        $uri = (string) $URI->uri_string();

        $lang = $this->uri_segment($language);

        $result = $uri;

        if ($this->valid_uri_segment($lang)) {

            if ($uri_segment = $this->get_uri_lang($uri)) {

                $uri_segment['parts'][0] = $lang;
                $result = implode('/', $uri_segment['parts']);

            } else {

                $result = $lang.'/'.$uri;
            }
        }

        return $result;
    }

    // Add language segment to $uri (if appropriate)
    function localized($uri) {

        global $CFG;

        return $CFG->localized($uri);
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    // Checks whether the language exists within URI.
    // When true - returns an array with language segment + rest.
    public function get_uri_lang($uri = '') {

        global $CFG;

        return $CFG->get_uri_lang($uri);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function multilingual_site() {

        global $CFG;

        return $CFG->multilingual_site();
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function hide_default_uri_segment() {

        global $CFG;

        return $CFG->hide_default_language_uri_segment();
    }

    // Added by Ivan Tcholakov, 23-JAN-2014.
    public function get($language) {

        global $CFG;

        return $CFG->get_language($language);
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function set_current($language) {

        global $CFG;

        $CFG->set_current_language($language);
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function current() {

        global $CFG;

        return $CFG->current_language();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function default_lang() {

        global $CFG;

        return $CFG->default_language();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function default_code() {

        global $CFG;

        return $CFG->default_language_code();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function default_uri_segment() {

        global $CFG;

        return $CFG->default_language_uri_segment();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function enabled() {

        global $CFG;

        return $CFG->enabled_languages();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function enabled_codes() {

        global $CFG;

        return $CFG->enabled_languages_codes();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function enabled_uri_segments() {

        global $CFG;

        return $CFG->enabled_languages_uri_segments();
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function valid($language) {

        global $CFG;

        return $CFG->valid_language($language);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function valid_code($code) {

        global $CFG;

        return $CFG->valid_code($code);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function valid_uri_segment($uri_segment) {

        global $CFG;

        return $CFG->valid_language_uri_segment($uri_segment);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function by_code($code) {

        global $CFG;

        return $CFG->language_by_code($code);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function by_uri_segment($uri_segment) {

        global $CFG;

        return $CFG->language_by_uri_segment($uri_segment);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function code($language = null) {

        global $CFG;

        return $CFG->language_code($language);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function uri_segment($language = null) {

        global $CFG;

        return $CFG->language_uri_segment($language);
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function direction($language = null) {

        global $CFG;

        return $CFG->language_direction($language);
    }

}
