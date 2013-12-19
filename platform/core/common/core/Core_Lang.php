<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Core_Lang extends MX_Lang {

    protected $common_module_extender;

    public function __construct() {

        parent::__construct();
    }

    /**
     * Fetches a single line of text from the language array
     *
     * @param       string          $line           Language line key
     * @parap       string|array    $param          String or array of strings to be inserted at placeholders like %s, %d, etc.
     * @param       bool            $log_errors     Whether to log an error message if the line is not found
     * @return      string                          Translation
     */
    public function line($line = '', $param = NULL, $log_errors = TRUE) {

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

            if (is_array($param) && !empty($param)) {

                $value = vsprintf($value, $param);

            } elseif ($param != '') {

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
            '/i18n:(title|alt|placeholder)(\s*=\s*["\'])([^"\']+)(["\'])/im',
            array($this, '_parse_i18n_attributes_callback'),
            $string
        );
        //

        return $string;
    }

    // Added by Ivan Tcholakov, 19-DEC-2013.
    public function _parse_i18n_attributes_callback($matches) {

        return strtolower($matches[1]).$matches[2].$this->line($matches[3]).$matches[4];
    }
    //

}
