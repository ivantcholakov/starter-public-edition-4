<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Alternative and additional html helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015
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

        return trim(nohtml($string), " \t\n\r\0\x0B") == '' ? '' : $string;
    }

}

if (!function_exists('gmap')) {

    /**
     * Shows a simple Google Map at a given location and puts a marker on it.
     * Uses Coogle Maps API version 3.
     *
     * @param   float       $latitude           The location's latitude.
     * @param   float       $longitude          The location's longitude.
     * @param   int         $zoom               The map zooming.
     * @param   string      $element_id         The id HTML attribute the map containing element.
     * @param   string      $element_class      The class HTML attribute the map containing element.
     * @return  string                          Returns HTML and JavaScript for displaying the map.
     *
     * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
     * @license The MIT License, http://opensource.org/licenses/MIT
     */
    function gmap($latitude, $longitude, $zoom = null, $element_id = null, $element_class = null) {

        $latitude = trim($latitude);
        $longitude = trim($longitude);

        if ($latitude == '' || !is_numeric($latitude) || $longitude == '' || !is_numeric($longitude)) {
            return;
        }

        $zoom = (int) $zoom;

        if ($zoom <= 0) {
            $zoom = 1;
        }

        $element_id = (string) $element_id;

        if ($element_id == '') {
            $element_id = 'map_canvas';
        }

        $element_class = (string) $element_class;

        if ($element_class == '') {
            $element_class = 'google-maps';
        }

        $prefix = str_replace('-', '_', $element_id).'_';

        ob_start();

?><div id="<?php echo $element_id; ?>" class="<?php echo $element_class; ?>"></div>

<script type="text/javascript">
//<![CDATA[

if (typeof google == 'undefined' || typeof google.maps == 'undefined' ) {
    document.write('<script type="text/javascript" src="<?php echo is_https() ? 'https:' : 'http:'; ?>//maps.google.com/maps/api/js">\x3C/script>');
}

$(function () {

    var <?php echo $prefix; ?>latitude = <?php echo json_encode($latitude); ?>;
    var <?php echo $prefix; ?>longitude = <?php echo json_encode($longitude); ?>;
    var <?php echo $prefix; ?>zoom = <?php echo json_encode($zoom); ?>;

    var <?php echo $prefix; ?>position = new google.maps.LatLng(<?php echo $prefix; ?>latitude, <?php echo $prefix; ?>longitude);

    var <?php echo $prefix; ?>options = {
         center: <?php echo $prefix; ?>position,
         zoom: <?php echo $prefix; ?>zoom,
         mapTypeId: google.maps.MapTypeId.ROADMAP
     };

     var <?php echo $prefix; ?>map = new google.maps.Map(document.getElementById('<?php echo $element_id; ?>'), <?php echo $prefix; ?>options);
     var <?php echo $prefix; ?>map_marker = new google.maps.Marker({map: <?php echo $prefix; ?>map, position: <?php echo $prefix; ?>position});
});

//]]>
</script>

<?php

        $result = ob_get_contents();
        ob_end_clean();

        return $result;
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
     *
     * @deprecated Don't use.
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
     *
     * @deprecated Don't use.
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
     *
     * @deprecated Use html_attr().
     */
    function get_attributes_string($attributes)
    {
        return html_attr($attributes);
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
     *
     * @deprecated Use html_attr_merge().
     */
    function merge_attributes($attributes, $extra_attributes)
    {
        return html_attr_merge($attributes, $extra_attributes);
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
     *
     * @deprecated Use html_attr_remove().
     */
    function remove_attribute($attributes, $name)
    {
        return html_attr_remove($attributes, $name);
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
     *
     * @deprecated Use html_attr_set().
     */
    function set_attribute($attributes, $name, $value = null)
    {
        return html_attr_set($attributes, $name, $value);
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
     *
     * @deprecated Use html_attr_get().
     */
    function get_attribute($attributes, $name)
    {
        return html_attr_get($attributes, $name);
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
     *
     * @deprecated Use html_attr_has_class().
     */
    function has_class($attributes, $class)
    {
        return html_attr_has_class($attributes, $class);
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
     *
     * @deprecated Use html_attr_add_class().
     */
    function add_class($attributes, $class)
    {
        return html_attr_add_class($attributes, $class);
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
     *
     * @deprecated Use html_attr_remove_class().
     */
    function remove_class($attributes, $class)
    {
        return html_attr_remove_class($attributes, $class);
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
     *
     * @deprecated Use html_attr_merge().
     */
    function merge_attributes_and_classes($attributes, $extra_attributes)
    {
        return html_attr_merge($attributes, $extra_attributes);
    }

}

//------------------------------------------------------------------------------

if (!function_exists('antibot'))
{
    /**
     * Create a bot-protected text written in JavaScript.
     *
     * @param       string      The input text (may be email, phone number, ...).
     * @return      string      A JavaScript to visualize the input text.
     *
     * @see safe_mailto()
     */
    function antibot($text)
    {
        $x = array();

        for ($i = 0, $l = strlen($text); $i < $l; $i++)
        {
            $x[] = '|'.ord($text[$i]);
        }

        $x = array_reverse($x);

        $output = "<script type=\"text/javascript\">\n"
            ."\t//<![CDATA[\n"
            ."\tvar l=new Array();\n";

        for ($i = 0, $c = count($x); $i < $c; $i++)
        {
            $output .= "\tl[".$i."] = '".$x[$i]."';\n";
        }

        $output .= "\n\tfor (var i = l.length-1; i >= 0; i=i-1) {\n"
            ."\t\tif (l[i].substring(0, 1) === '|') document.write(\"&#\"+unescape(l[i].substring(1))+\";\");\n"
            ."\t\telse document.write(unescape(l[i]));\n"
            ."\t}\n"
            ."\t//]]>\n"
            .'</script>';

        return $output;
    }
}
