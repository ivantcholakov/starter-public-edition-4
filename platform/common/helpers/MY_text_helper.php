<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UTF-8 alternatives to CodeIgniter's text helper functions
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!function_exists('character_limiter') && IS_UTF8_CHARSET) {

    /**
     * Character Limiter, UTF-8 version.
     *
     * Limits the string based on the character count. Preserves complete words
     * so the character count may not be exactly as specified.
     *
     * @param       string
     * @param       int
     * @param       string    The end character. Usually an ellipsis
     * @return      string
     */
    function character_limiter($str, $n = 500, $end_char = '&#8230;') {

        if (UTF8::strlen($str) < $n) {
            return $str;
        }

        $end_char = html_entity_decode($end_char, ENT_QUOTES, 'UTF-8');

        // a bit complicated, but faster than preg_replace with \s+
        //$str = preg_replace('/ {2,}/', ' ', str_replace(array("\r", "\n", "\t", "\x0B", "\x0C"), ' ', $str));
        $str = preg_replace('/\s+/u', ' ', $str);

        if (UTF8::strlen($str) <= $n) {
            return $str;
        }

        $out = '';

        foreach (explode(' ', trim($str)) as $val) {

            $out .= $val.' ';

            if (UTF8::strlen($out) >= $n) {
                $out = trim($out);
                return (UTF8::strlen($out) === UTF8::strlen($str)) ? $out : $out.$end_char;
            }
        }
    }

}

if (!function_exists('convert_accented_characters') && IS_UTF8_CHARSET) {

    /**
     * Converts (Accented) Foreign Characters to ASCII
     *
     * @param   string  $string     Input string
     * @param   string  $language   Language identificator
     * @return  string
     */
    function convert_accented_characters($string, $language = null) {

        $language = (string) $language;

        if ($language == '') {
            $language = config_item('language');
        }

        // See https://github.com/ivantcholakov/transliterate
        return Transliterate::to_ascii($string, $language);
    }

}

if (!function_exists('ellipsize') && IS_UTF8_CHARSET)
{
    /**
     * Ellipsize String (UTF-8 compatible version)
     *
     * This function will strip tags from a string, split it at its max_length and ellipsize
     *
     * @param   string      string to ellipsize
     * @param   int         max length of string
     * @param   mixed       int (1|0) or float, .5, .2, etc for position to split
     * @param   string      ellipsis ; Default '...'
     * @return  string      ellipsized string
     */
    function ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;')
    {
        // Strip tags
        $str = trim(strip_tags($str));

        // Added by Ivan Tcholakov, 07-JAN-2014.
        $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
        //

        // Is the string long enough to ellipsize?
        if (UTF8::strlen($str) <= $max_length)
        {
            return $str;
        }

        $beg = UTF8::substr($str, 0, floor($max_length * $position));
        $position = ($position > 1) ? 1 : $position;

        if ($position === 1)
        {
            $end = UTF8::substr($str, 0, -($max_length - UTF8::strlen($beg)));
        }
        else
        {
            $end = UTF8::substr($str, -($max_length - UTF8::strlen($beg)));
        }

        return $beg.$ellipsis.$end;
    }
}


if ( ! function_exists('word_wrap') && IS_UTF8_CHARSET)
{
    /**
     * Word Wrap
     *
     * Wraps text at the specified character. Maintains the integrity of words.
     * Anything placed between {unwrap}{/unwrap} will not be word wrapped, nor
     * will URLs.
     *
     * @param       string      $str                the text string
     * @param       int         $charlim = 76       the number of characters to wrap at
     * @return      string
     */
    function word_wrap($str, $charlim = 76)
    {
        // Set the character limit
        is_numeric($charlim) OR $charlim = 76;

        // Reduce multiple spaces
        $str = preg_replace('| +|'.(IS_UTF8_CHARSET && PCRE_UTF8_INSTALLED ? 'u' : ''), ' ', $str);

        // Standardize newlines
        if (strpos($str, "\r") !== FALSE)
        {
            $str = str_replace(array("\r\n", "\r"), "\n", $str);
        }

        // If the current word is surrounded by {unwrap} tags we'll
        // strip the entire chunk and replace it with a marker.
        $unwrap = array();
        if (preg_match_all('|\{unwrap\}(.+?)\{/unwrap\}|s'.(IS_UTF8_CHARSET && PCRE_UTF8_INSTALLED ? 'u' : ''), $str, $matches))
        {
            for ($i = 0, $c = count($matches[0]); $i < $c; $i++)
            {
                $unwrap[] = $matches[1][$i];
                $str = str_replace($matches[0][$i], '{{unwrapped'.$i.'}}', $str);
            }
        }

        // Use PHP's native function to do the initial wordwrap.
        // We set the cut flag to FALSE so that any individual words that are
        // too long get left alone. In the next step we'll deal with them.
        $str = UTF8::wordwrap($str, $charlim, "\n", FALSE);

        // Split the string into individual lines of text and cycle through them
        $output = '';
        foreach (explode("\n", $str) as $line)
        {
            // Is the line within the allowed character count?
            // If so we'll join it to the output and continue
            if (UTF8::strlen($line) <= $charlim)
            {
                $output .= $line."\n";
                continue;
            }

            $temp = '';
            while (UTF8::strlen($line) > $charlim)
            {
                // If the over-length word is a URL we won't wrap it
                if (preg_match('!\[url.+\]|://|www\.!'.(IS_UTF8_CHARSET && PCRE_UTF8_INSTALLED ? 'u' : ''), $line))
                {
                    break;
                }

                // Trim the word down
                $temp .= UTF8::substr($line, 0, $charlim - 1);
                $line = UTF8::substr($line, $charlim - 1);
            }

            // If $temp contains data it means we had to split up an over-length
            // word into smaller chunks so we'll add it back to our current line
            if ($temp !== '')
            {
                $output .= $temp."\n".$line."\n";
            }
            else
            {
                $output .= $line."\n";
            }
        }

        // Put our markers back
        if (count($unwrap) > 0)
        {
            foreach ($unwrap as $key => $val)
            {
                $output = str_replace('{{unwrapped'.$key.'}}', $val, $output);
            }
        }

        return $output;
    }
}

if (!function_exists('word_limiter') && IS_UTF8_CHARSET) {

    /**
     * Word Limiter, UTF-8 version.
     *
     * Limits a string to X number of words.
     *
     * @param       string
     * @param       int
     * @param       string    The end character. Usually an ellipsis
     * @return      string
     */
    function word_limiter($str, $limit = 100, $end_char = '&#8230;')
    {
        if (UTF8::trim($str) === '')
        {
            return $str;
        }

        // Added by Ivan Tcholakov, 08-FEB-2016.
        $end_char = html_entity_decode($end_char, ENT_QUOTES, 'UTF-8');
        //

        preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/'.(IS_UTF8_CHARSET && PCRE_UTF8_INSTALLED ? 'u' : ''), $str, $matches);

        if (UTF8::strlen($str) === UTF8::strlen($matches[0]))
        {
            $end_char = '';
        }

        return UTF8::rtrim($matches[0]).$end_char;
    }

}
