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
    function doctype($type = 'html5') {

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
            $parser = new \Markdownify\ConverterExtra();
        }

        $parser->setKeepHTML(false);

        return @ $parser->parseString($html);
    }

}

if (!function_exists('text_to_html')) {

    function text_to_html($text) {

        $ci = & get_instance();
        $ci->load->parser();

        return $ci->parser->parse_string($text, null, true, 'markdown');
    }

}

if (!function_exists('html_simplify')) {

    function html_simplify($string) {

        return text_to_html(strip_tags(text_to_html(html_to_text($string))));
    }

}

if (!function_exists('nohtml')) {

    function nohtml($string) {

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
