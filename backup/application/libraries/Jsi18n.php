<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Used for Javascript internationalization (i18n)
 *
 * Based on an article by Alexandros D on coderwall.com
 * See: https://coderwall.com/p/j88iog
 *
 *
 * Load this library in the autoload.php file or manually in your controller:
 *
 *     $this->load->library('jsi18n');
 *
 * In your language file:
 *
 *     $lang['alert_message'] = "This is my alert message!";
 *
 * In your JS files, place your language key inside double braces:
 *
 *     function myFunction() {
 *         alert("{{alert_message}}");
 *     }
 *
 * Render the Javascript file in your template file:
 *
 *     <script type="text/javascript"><?php echo $this->jsi18n->translate("/js/my_javascript_file.js"); ?></script>
 *
 */

class Jsi18n {

    /**
     * Constructor
     */
    public function __construct()
    {
        $CI =& get_instance();

        // load file helper
        $CI->load->helper('file');
    }


    /**
     * Parse through a JS file and replace language keys with language text values
     *
     * @param string $file
     * @param bool $local
     * @return bool|mixed|null|string
     */
    function translate($file = NULL, $local = TRUE)
    {
        if ( ! $file)
        {
            return NULL;
        }

        // get the file contents
        if ($local)
        {
            $contents = read_file('.' . $file);
        }
        else
        {
            $contents = @file_get_contents($file);
        }

        if ( ! $contents)
        {
            return NULL;
        }

        // find all double braces {{...}}
        preg_match_all("/\{\{(.*?)\}\}/", $contents, $matches, PREG_PATTERN_ORDER);

        // are there any matches?
        if ($matches)
        {
            foreach ($matches[1] as $match)
            {
                // get the language text using the key
                $lang_value = lang($match);

                // replace double braces with language text
                $contents = str_replace("{{{$match}}}", $lang_value, $contents);
            }
        }

        // return Javascript code
        return $contents;
    }

}
