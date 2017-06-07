<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Added by Ivan Tcholakov, 07-JUN-2017.
// The original class \Netcarver\Textile\Parser v.3.6.0 needs
// to be patched, because on PHP 7.1 it shows the fatal error
// "[] operator not supported for strings".
// See https://github.com/textile/php-textile/issues/175

class TextileParser extends \Netcarver\Textile\Parser {

    public function __construct($doctype = 'xhtml') {

        parent::__construct($doctype);
    }

    /**
     * Parses Textile attributes into an array.
     *
     * @param  string $in         The Textile attribute string to be parsed
     * @param  string $element    Focus the routine to interpret the attributes as applying to a specific HTML tag
     * @param  bool   $include_id If FALSE, IDs are not included in the attribute list
     * @param  string $autoclass  An additional classes applied to the output
     * @return array  HTML attributes as key => value mappings
     * @see    Parser::parseAttribs()
     */

    protected function parseAttribsToArray($in, $element = '', $include_id = true, $autoclass = '')
    {
        // Proposed by Jan Wulf (jwulfgit), 11-APR-2017
        //$style = '';
        $style = array();
        //

        $class = '';
        $lang = '';
        $colspan = '';
        $rowspan = '';
        $span = '';
        $width = '';
        $id = '';
        $atts = '';
        $align = '';
        $matched = $in;

        if ($element == 'td') {
            if (preg_match("/\\\\([0-9]+)/", $matched, $csp)) {
                $colspan = $csp[1];
            }

            if (preg_match("/\/([0-9]+)/", $matched, $rsp)) {
                $rowspan = $rsp[1];
            }
        }

        if ($element == 'td' or $element == 'tr') {
            if (preg_match("/^($this->vlgn)/", $matched, $vert)) {
                $style[] = "vertical-align:" . $this->vAlign($vert[1]);
            }
        }

        if (preg_match("/\{([^}]*)\}/", $matched, $sty)) {
            if ($sty[1] = $this->cleanAttribs($sty[1])) {
                $style[] = rtrim($sty[1], ';');
            }

            $matched = str_replace($sty[0], '', $matched);
        }

        if (preg_match("/\[([^]]+)\]/U", $matched, $lng)) {
            // Consume entire lang block -- valid or invalid.
            $matched = str_replace($lng[0], '', $matched);
            if (preg_match("/\[([a-zA-Z]{2}(?:[\-\_][a-zA-Z]{2})?)\]/U", $lng[0], $lng)) {
                $lang = $lng[1];
            }
        }

        if (preg_match("/\(([^()]+)\)/U", $matched, $cls)) {
            $class_regex = "/^([-a-zA-Z 0-9_\.]*)$/";

            // Consume entire class block -- valid or invalid.
            $matched = str_replace($cls[0], '', $matched);

            // Only allow a restricted subset of the CSS standard characters for classes/ids.
            // No encoding markers allowed.
            if (preg_match("/\(([-a-zA-Z 0-9_\.\:\#]+)\)/U", $cls[0], $cls)) {
                $hashpos = strpos($cls[1], '#');
                // If a textile class block attribute was found with a '#' in it
                // split it into the css class and css id...
                if (false !== $hashpos) {
                    if (preg_match("/#([-a-zA-Z0-9_\.\:]*)$/", substr($cls[1], $hashpos), $ids)) {
                        $id = $ids[1];
                    }

                    if (preg_match($class_regex, substr($cls[1], 0, $hashpos), $ids)) {
                        $class = $ids[1];
                    }
                } else {
                    if (preg_match($class_regex, $cls[1], $ids)) {
                        $class = $ids[1];
                    }
                }
            }
        }

        if (preg_match("/([(]+)/", $matched, $pl)) {
            $style[] = "padding-left:" . strlen($pl[1]) . "em";
            $matched = str_replace($pl[0], '', $matched);
        }

        if (preg_match("/([)]+)/", $matched, $pr)) {
            $style[] = "padding-right:" . strlen($pr[1]) . "em";
            $matched = str_replace($pr[0], '', $matched);
        }

        if (preg_match("/($this->hlgn)/", $matched, $horiz)) {
            $style[] = "text-align:" . $this->hAlign($horiz[1]);
        }

        if ($element == 'col') {
            if (preg_match("/(?:\\\\([0-9]+))?{$this->regex_snippets['space']}*([0-9]+)?/", $matched, $csp)) {
                $span = isset($csp[1]) ? $csp[1] : '';
                $width = isset($csp[2]) ? $csp[2] : '';
            }
        }

        if ($this->isRestrictedModeEnabled()) {
            $o = array();
            $class = trim($autoclass);

            if ($class) {
                $o['class'] = $this->cleanAttribs($class);
            }

            if ($lang) {
                $o['lang'] = $this->cleanAttribs($lang);
            }

            ksort($o);
            return $o;
        } else {
            $class = trim($class . ' ' . $autoclass);
        }

        $o = array();

        if ($class) {
            $o['class'] = $this->cleanAttribs($class);
        }

        if ($colspan) {
            $o['colspan'] = $this->cleanAttribs($colspan);
        }

        if ($id && $include_id) {
            $o['id'] = $this->cleanAttribs($id);
        }

        if ($lang) {
            $o['lang'] = $this->cleanAttribs($lang);
        }

        if ($rowspan) {
            $o['rowspan'] = $this->cleanAttribs($rowspan);
        }

        if ($span) {
            $o['span'] = $this->cleanAttribs($span);
        }

        // Proposed by Jan Wulf (jwulfgit), 11-APR-2017
        //if ($style) {
        if (!empty($style)) {
        //

            $so = '';
            $tmps = array();

            foreach ($style as $s) {
                $parts = explode(';', $s);

                foreach ($parts as $p) {
                    if ($p = trim(trim($p), ":")) {
                        $tmps[] = $p;
                    }
                }
            }

            sort($tmps);

            foreach ($tmps as $p) {
                if ($p) {
                    $so .= $p.';';
                }
            }

            // Proposed by Jan Wulf (jwulfgit), 11-APR-2017
            //$style = trim(str_replace(array("\n", ';;'), array('', ';'), $so));
            //$o['style'] = $style;
            $o['style'] = trim(str_replace(array("\n", ';;'), array('', ';'), $so));
            //
        }

        if ($width) {
            $o['width'] = $this->cleanAttribs($width);
        }

        ksort($o);
        return $o;
    }

}
