<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Outputs an array in a user-readable JSON format
 *
 * @param array $array
 */
if ( ! function_exists('display_json'))
{
    function display_json($array)
    {
        $data = json_indent($array);

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo $data;
    }
}


/**
 * Convert an array to a user-readable JSON string
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('json_indent'))
{
    function json_indent($array = array())
    {
        // make sure array is provided
        if (empty($array))
            return NULL;

        //Encode the string
        $json = json_encode($array);

        $result        = '';
        $pos           = 0;
        $str_len       = strlen($json);
        $indent_str    = '  ';
        $new_line      = "\n";
        $prev_char     = '';
        $out_of_quotes = true;

        for ($i = 0; $i <= $str_len; $i++)
        {
            // grab the next character in the string
            $char = substr($json, $i, 1);

            // are we inside a quoted string?
            if ($char == '"' && $prev_char != '\\')
            {
                $out_of_quotes = !$out_of_quotes;
            }
            // if this character is the end of an element, output a new line and indent the next line
            elseif (($char == '}' OR $char == ']') && $out_of_quotes)
            {
                $result .= $new_line;
                $pos--;

                for ($j = 0; $j < $pos; $j++)
                {
                    $result .= $indent_str;
                }
            }

            // add the character to the result string
            $result .= $char;

            // if the last character was the beginning of an element, output a new line and indent the next line
            if (($char == ',' OR $char == '{' OR $char == '[') && $out_of_quotes)
            {
                $result .= $new_line;

                if ($char == '{' OR $char == '[')
                {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++)
                {
                    $result .= $indent_str;
                }
            }

            $prev_char = $char;
        }

        // return result
        return $result . $new_line;
    }
}


/**
 * Save data to a CSV file
 *
 * @param array $array
 * @param string $filename
 * @return bool
 */
if ( ! function_exists('array_to_csv'))
{
    function array_to_csv($array = array(), $filename = "export.csv")
    {
        $CI = get_instance();

        // disable the profiler otherwise header errors will occur
        $CI->output->enable_profiler(FALSE);

        if ( ! empty($array))
        {
            // ensure proper file extension is used
            if ( ! substr(strrchr($filename, '.csv'), 1))
            {
                $filename .= '.csv';
            }

            try
            {
                // set the headers for file download
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                header("Content-type: text/csv");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename={$filename}");

                $output = @fopen('php://output', 'w');

                // used to determine header row
                $header_displayed = FALSE;

                foreach ($array as $row)
                {
                    if ( ! $header_displayed)
                    {
                        // use the array keys as the header row
                        fputcsv($output, array_keys($row));
                        $header_displayed = TRUE;
                    }

                    // clean the data
                    $allowed = '/[^a-zA-Z0-9_ %\|\[\]\.\(\)%&-]/s';
                    foreach ($row as $key => $value)
                    {
                        $row[$key] = preg_replace($allowed, '', $value);
                    }

                    // insert the data
                    fputcsv($output, $row);
                }

                fclose($output);

            }
            catch (Exception $e) {}
        }

        exit;
    }
}


/**
 * Generates a random password
 *
 * @return string
 */
if ( ! function_exists('generate_random_password'))
{
    function generate_random_password()
    {
        $characters = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alpha_length = strlen($characters) - 1;

        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, $alpha_length);
            $pass[] = $characters[$n];
        }

        return implode($pass);
    }
}


/**
 * Retrieves list of language folders
 *
 * @return array
 */
if ( ! function_exists('get_languages'))
{
    function get_languages()
    {
        $CI = get_instance();

        if ($CI->session->languages)
        {
            return $CI->session->languages;
        }

        $CI->load->helper('directory');

        $language_directories = directory_map(APPPATH . '/language/', 1);
        if ( ! $language_directories)
        {
            $language_directories = directory_map(BASEPATH . '/language/', 1);
        }

        $languages = array();
        foreach ($language_directories as $language)
        {
            if (substr($language, -1) == "/" || substr($language, -1) == "\\")
            {
                $languages[substr($language, 0, -1)] = ucwords(str_replace(array('-', '_'), ' ', substr($language, 0, -1)));
            }
        }

        $CI->session->languages = $languages;

        return $languages;
    }
}
