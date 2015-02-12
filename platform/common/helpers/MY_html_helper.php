<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Alternative and additional html helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('doctype')) {

    /**
     * Doctype
     *
     * Generates a page document type declaration
     *
     * Examples of valid options: html5, xhtml-11, xhtml-strict, xhtml-trans,
     * xhtml-frame, html4-strict, html4-trans, and html4-frame.
     * All values are saved in the doctypes config file.
     *
     * @param     string  type    The doctype to be generated (a short key)
     * @return    string
     */
    function doctype($type = 'xhtml1-strict') {

        static $doctypes;

        if (!isset($doctypes) || !is_array($doctypes)) {

            if (file_exists(COMMONPATH.'config/doctypes.php')) {
                include(COMMONPATH.'config/doctypes.php');
            }

            if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/doctypes.php')) {
                include(COMMONPATH.'config/'.ENVIRONMENT.'/doctypes.php');
            }

            if (file_exists(APPPATH.'config/doctypes.php')) {
                include(APPPATH.'config/doctypes.php');
            }

            if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/doctypes.php')) {
                include(APPPATH.'config/'.ENVIRONMENT.'/doctypes.php');
            }

            if (empty($_doctypes) || !is_array($_doctypes)) {

                $doctypes = array();
                return false;
            }

            $doctypes = $_doctypes;
        }

        return isset($doctypes[$type]) ? $doctypes[$type] : false;
    }

}

if (!function_exists('html_to_text')) {

    function html_to_text($html) {

        static $parser;

        if (!isset($parser)) {
            $parser = new Markdownify_Extra();
            $parser->keepHTML = false;
        }

        return @ $parser->parseString($html);
    }

}

if (!function_exists('text_to_html')) {

    function text_to_html($text) {

/*
        static $parser;

        if (!isset($parser)) {
            $parser = new MarkdownExtra_Parser();
        }

        return @ $parser->transform($text);
*/

        static $parser;

        if (!isset($parser)) {
            $parser = new ParsedownExtra();
        }

        return @ $parser->text($text);
    }

}

if (!function_exists('html_simplify')) {

    function html_simplify($string) {

        return text_to_html(strip_tags(text_to_html(html_to_text($string))));
    }

}

if (!function_exists('nohtml')) {

    function nohtml($string) {

/*
        static $purifier;

        if (!isset($purifier)) {

            $config = HTMLPurifier_Config::createDefault();

            $config->set('Cache.SerializerPath', HTMLPURIFIER_CACHE_SERIALIZER_PATH);
            $config->set('Core.Encoding', config_item('charset'));
            $config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
            $config->set('HTML.TidyLevel', 'light');
            $config->set('Core.ConvertDocumentToFragment', false);
            $config->set('Core.RemoveProcessingInstructions', true);
            @ $config->set('HTML.Allowed', '');

            $purifier = @ new HTMLPurifier($config);
        }

        return trim(@ $purifier->purify(strip_tags($string)), " \t\n\r\0\x0B");
*/

        return get_instance()->security->xss_clean(strip_tags($string));
    }

}

if (!function_exists('trim_html')) {

    function trim_html($string) {

        return nohtml($string) == '' ? '' : $string;
    }

}


//------------------------------------------------------------------------------

/**
 * The following functions are derived work.
 * Adaptation by Ivan Tcholakov, OCT-2013.
 * Code is rewritten in procedural style,
 * it is less effective than the original.
 * 
 * The original work is from a PEAR package:
 * @category HTML
 * @package  HTML_Common2
 * @author   Alexey Borzov <avb@php.net>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  SVN: $Id: Common2.php 324960 2012-04-08 15:03:46Z avb $
 * @link     http://pear.php.net/package/HTML_Common2
 */

if (!function_exists('parse_attributes')) {

    /**
     * Parses the HTML attributes given as string
     *
     * @param string $attrString HTML attribute string
     *
     * @return array An associative array of attributes
     */
    function parse_attributes($attrString)
    {
        $attributes = array();
        if (preg_match_all(
            "/(([A-Za-z_:]|[^\\x00-\\x7F])([A-Za-z0-9_:.-]|[^\\x00-\\x7F])*)" .
            "([ \\n\\t\\r]+)?(=([ \\n\\t\\r]+)?(\"[^\"]*\"|'[^']*'|[^ \\n\\t\\r]*))?/",
            $attrString,
            $regs
        )) {
            for ($i = 0; $i < count($regs[1]); $i++) {
                $name  = trim($regs[1][$i]);
                $check = trim($regs[0][$i]);
                $value = trim($regs[7][$i]);
                if ($name == $check) {
                    $attributes[strtolower($name)] = strtolower($name);
                } else {
                    if (!empty($value) && ($value[0] == '\'' || $value[0] == '"')) {
                        $value = substr($value, 1, -1);
                    }
                    $attributes[strtolower($name)] = $value;
                }
            }
        }
        return $attributes;
    }

}

if (!function_exists('prepare_attributes')) {

    /**
     * Creates a valid attribute array from either a string or an array
     *
     * @param string|array $attributes Array of attributes or HTML attribute string
     *
     * @return array An associative array of attributes
     */
    function prepare_attributes($attributes)
    {
        $prepared = array();
        if (is_string($attributes)) {
            return parse_attributes($attributes);

        } elseif (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                if (is_int($key)) {
                    $key = strtolower($value);
                    $prepared[$key] = $key;
                } else {
                    $prepared[strtolower($key)] = (string)$value;
                }
            }
        }
        return $prepared;
    }

}

if (!function_exists('get_attributes_string')) {

    /**
     * Creates HTML attribute string from array
     *
     * @param string|array $attributes Attribute array
     *
     * @return string Attribute string
     */
    function get_attributes_string($attributes)
    {
        static $charset;

        if (!isset($charset)) {

            $charset = config_item('charset');

            if ($charset == '') {
                $charset = 'utf-8';
            }
        }

        if (!is_array($attributes)) {
            $attributes = prepare_attributes((string) $attributes);
        }

        $str = '';
        foreach ($attributes as $key => $value) {
            $str .= ' ' . $key . '="' . htmlspecialchars($value, ENT_QUOTES, $charset) . '"';
        }
        return $str;
    }

}

if (!function_exists('merge_attributes')) {

    /**
     * Merges the existing attributes with the new ones
     *
     * @param array|string $attributes Array of attribute 'name' => 'value' pairs
     *                                 or HTML attribute string
     * @param array|string $attributes Array of attribute 'name' => 'value' pairs
     *                                 or HTML attribute string
     *
     * @return string A string containing merged attributes
     */
    function merge_attributes($attributes, $extra_attributes)
    {
        $attributes = prepare_attributes($attributes);
        $extra_attributes = prepare_attributes($extra_attributes);

        return get_attributes_string(array_merge($attributes, $extra_attributes));
    }

}

if (!function_exists('remove_attribute')) {

    /**
     * Removes an attribute
     *
     * @param string|array $attributes Array of attributes or HTML attribute string
     * @param string $attribute Name of attribute to remove
     *
     * @return string A string with the rest of the attributes
     */
    function remove_attribute($attributes, $name)
    {
        $name = strtolower($name);
        $attributes = prepare_attributes($attributes);

        if (isset($attributes[$name])) {
            unset($attributes[$name]);
        }

        return get_attributes_string($attributes);
    }

}

if (!function_exists('set_attribute')) {

    /**
     * Sets the value of the attribute
     *
     * @param string|array $attributes Array of attributes or HTML attribute string
     * @param string $name  Attribute name
     * @param string $value Attribute value (will be set to $name if omitted)
     *
     * @return string A string containing result attributes
     */
    function set_attribute($attributes, $name, $value = null)
    {
        $name = strtolower($name);
        $attributes = prepare_attributes($attributes);

        if (is_null($value)) {
            $value = $name;
        }

        $attributes[$name] = (string) $value;

        if ($name == 'class') {

            if ($attributes[$name] == '') {
                return remove_attribute($value, $name);
            }
        }

        return get_attributes_string($attributes);
    }

}

if (!function_exists('get_attribute')) {

    /**
     * Returns the value of an attribute
     *
     * @param string|array $attributes Array of attributes or HTML attribute string
     * @param string $name Attribute name
     *
     * @return string|null Attribute value, null if attribute does not exist
     */
    function get_attribute($attributes, $name)
    {
        $name = strtolower($name);
        $attributes = prepare_attributes($attributes);

        return isset($attributes[$name])? $attributes[$name]: null;
    }

}

if (!function_exists('has_class')) {

    /**
     * Checks whether the element has given CSS class
     *
     * @param string|array $attributes Array of attributes or HTML attribute string
     * @param string $class CSS Class name
     *
     * @return bool
     */
    function has_class($attributes, $class)
    {
        $regex = '/(^|\s)' . preg_quote($class, '/') . '(\s|$)/';
        return (bool) preg_match($regex, get_attribute($attributes, 'class'));
    }

}

if (!function_exists('add_class')) {

    /**
     * Adds the given CSS class(es) to the element
     *
     * @param string|array $attributes Array of attributes or HTML attribute string
     * @param string|array $class Class name, multiple class names separated by
     *                            whitespace, array of class names
     *
     * @return string A string containing result attributes
     */
    function add_class($attributes, $class)
    {
        $attributes = prepare_attributes($attributes);

        if (!is_array($class)) {
            $class = preg_split('/\s+/', $class, null, PREG_SPLIT_NO_EMPTY);
        }
        $curClass = preg_split(
            '/\s+/', get_attribute($attributes, 'class'), null, PREG_SPLIT_NO_EMPTY
        );
        foreach ($class as $c) {
            if (!in_array($c, $curClass)) {
                $curClass[] = $c;
            }
        }

        return set_attribute($attributes, 'class', implode(' ', $curClass));
    }

}

if (!function_exists('remove_class')) {

    /**
     * Removes the given CSS class(es) from the element
     *
     * @param string|array $attributes Array of attributes or HTML attribute string
     * @param string|array $class Class name, multiple class names separated by
     *                            whitespace, array of class names
     *
     * @return string A string containing result attributes
     */
    function remove_class($attributes, $class)
    {
        $attributes = prepare_attributes($attributes);

        if (!is_array($class)) {
            $class = preg_split('/\s+/', $class, null, PREG_SPLIT_NO_EMPTY);
        }
        $curClass = array_diff(
            preg_split(
                '/\s+/', get_attribute($attributes, 'class'), null, PREG_SPLIT_NO_EMPTY
            ),
            $class
        );

        if (0 == count($curClass)) {
            return remove_attribute($attributes, 'class');
        }

        return set_attribute($attributes, 'class', implode(' ', $curClass));
    }

}

if (!function_exists('merge_attributes_and_classes')) {

    /**
     * Merges the existing attributes with the new ones
     *
     * @param array|string $attributes Array of attribute 'name' => 'value' pairs
     *                                 or HTML attribute string
     * @param array|string $attributes Array of attribute 'name' => 'value' pairs
     *                                 or HTML attribute string
     *
     * @return string A string containing merged attributes
     */
    function merge_attributes_and_classes($attributes, $extra_attributes)
    {
        $attributes = prepare_attributes($attributes);
        $extra_attributes = prepare_attributes($extra_attributes);

        $class_extra = get_attribute($extra_attributes, 'class');

        $attributes = add_class($attributes, get_attribute($extra_attributes, 'class'));
        $extra_attributes = remove_attribute($extra_attributes, 'class');

        return merge_attributes($attributes, $extra_attributes);
    }

}

//------------------------------------------------------------------------------
