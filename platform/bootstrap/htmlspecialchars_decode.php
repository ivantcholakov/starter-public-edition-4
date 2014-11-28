<?php

if (!function_exists('htmlspecialchars_decode')) {

    // See http://www.php.net/manual/en/function.htmlspecialchars.php#41733

    function htmlspecialchars_decode($mixed, $quote_style = ENT_QUOTES) {

        if (is_array($mixed)) {
            return array_map('htmlspecialchars_decode', $mixed, array_fill(0, count($mixed), $quote_style));
        }

        $trans_table = get_html_translation_table(HTML_SPECIALCHARS, $quote_style);
        if ($trans_table["'"] != '&#039;' ) {   // Some versions of PHP match single quotes to &#39;
            $trans_table["'"] = '&#039;';
        }

        return (strtr($mixed, array_flip($trans_table)));
    }

}
