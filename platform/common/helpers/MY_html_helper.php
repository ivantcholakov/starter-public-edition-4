<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Alternative and additional html helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2017
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

if (!function_exists('gmap_embed')) {

    /**
     * Shows within an iframe a simple Google Map at a given location and puts a marker on it.
     * No JavaScript is used.
     *
     * @param   float       $latitude           The location's latitude.
     * @param   float       $longitude          The location's longitude.
     * @param   int         $zoom               The map zooming.
     * @param   boolean     $show_marker        TRUE - show a marker at the location, FALSE - don't show a marker.
     * @param   string      $marker_name        The name associated with the marker (an address for example)
     * @param   string/array $attributes        iframe attributes
     * @return  string                          Returns an iframe for displaying the map.
     *
     * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2017
     * @license The MIT License, http://opensource.org/licenses/MIT
     */
    function gmap_embed($latitude, $longitude, $zoom = null, $show_marker = true, $marker_name = null, $attributes = null) {

        $latitude = trim($latitude);
        $longitude = trim($longitude);

        if ($latitude == '' || !is_numeric($latitude) || $longitude == '' || !is_numeric($longitude)) {
            return;
        }

        $zoom = (int) $zoom;

        if ($zoom <= 0) {
            $zoom = 1;
        }

        $show_marker = !empty($show_marker);
        $marker_name = @ (string) $marker_name;

        $query = array(
            'll' => $latitude.','.$longitude,
            'sll' => $latitude.','.$longitude,
            'z' => $zoom,
            'output' => 'embed',
            'ie' => 'UTF8',
        );

        if ($show_marker) {
            $query = array_merge(array('q' => $latitude.','.$longitude), $query);
        }

        return '<iframe src="'.html_attr_escape('https://maps.google.com/maps?'.http_build_query($query)).'" '.html_attr_merge('width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"', $attributes).'></iframe>';
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


// Patches from 3.1.9-dev. Remove them after the next CI update. ---------------

if ( ! function_exists('img'))
{
    /**
     * Image
     *
     * Generates an <img /> element
     *
     * @param    mixed
     * @param    bool
     * @param    mixed
     * @return    string
     */
    function img($src = '', $index_page = FALSE, $attributes = '')
    {
        if ( ! is_array($src) )
        {
            $src = array('src' => $src);
        }

        // If there is no alt attribute defined, set it to an empty string
        if ( ! isset($src['alt']))
        {
            $src['alt'] = '';
        }

        $img = '<img';

        foreach ($src as $k => $v)
        {
            if ($k === 'src' && ! preg_match('#^(data:[a-z,;])|(([a-z]+:)?(?<!data:)//)#i', $v))
            {
                if ($index_page === TRUE)
                {
                    $img .= ' src="'.get_instance()->config->site_url($v).'"';
                }
                else
                {
                    $img .= ' src="'.get_instance()->config->base_url($v).'"';
                }
            }
            else
            {
                $img .= ' '.$k.'="'.$v.'"';
            }
        }

        return $img._stringify_attributes($attributes).' />';
    }
}

if ( ! function_exists('link_tag'))
{
    /**
     * Link
     *
     * Generates link to a CSS file
     *
     * @param    mixed    stylesheet hrefs or an array
     * @param    string    rel
     * @param    string    type
     * @param    string    title
     * @param    string    media
     * @param    bool    should index_page be added to the css path
     * @return    string
     */
    function link_tag($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE)
    {
        $CI =& get_instance();
        $link = '<link ';

        if (is_array($href))
        {
            foreach ($href as $k => $v)
            {
                if ($k === 'href' && ! preg_match('#^([a-z]+:)?//#i', $v))
                {
                    if ($index_page === TRUE)
                    {
                        $link .= 'href="'.$CI->config->site_url($v).'" ';
                    }
                    else
                    {
                        $link .= 'href="'.$CI->config->base_url($v).'" ';
                    }
                }
                else
                {
                    $link .= $k.'="'.$v.'" ';
                }
            }
        }
        else
        {
            if (preg_match('#^([a-z]+:)?//#i', $href))
            {
                $link .= 'href="'.$href.'" ';
            }
            elseif ($index_page === TRUE)
            {
                $link .= 'href="'.$CI->config->site_url($href).'" ';
            }
            else
            {
                $link .= 'href="'.$CI->config->base_url($href).'" ';
            }

            $link .= 'rel="'.$rel.'" type="'.$type.'" ';

            if ($media !== '')
            {
                $link .= 'media="'.$media.'" ';
            }

            if ($title !== '')
            {
                $link .= 'title="'.$title.'" ';
            }
        }

        return $link."/>\n";
    }
}

// -----------------------------------------------------------------------------
