<?php

// Taken form http://stackoverflow.com/questions/1252693/using-str-replace-so-that-it-only-acts-on-the-first-match/11400172#11400172
// Author: http://stackoverflow.com/users/526741/bfrohs

if (!function_exists('str_replace_limit')) {

    /**
     * Replace $limit occurences of the search string with the replacement string
     * @param mixed $search The value being searched for, otherwise known as the needle. An
     * array may be used to designate multiple needles.
     * @param mixed $replace The replacement value that replaces found search values. An
     * array may be used to designate multiple replacements.
     * @param mixed $subject The string or array being searched and replaced on, otherwise
     * known as the haystack. If subject is an array, then the search and replace is
     * performed with every entry of subject, and the return value is an array as well.
     * @param string $count If passed, this will be set to the number of replacements
     * performed.
     * @param int $limit The maximum possible replacements for each pattern in each subject
     * string. Defaults to -1 (no limit).
     * @return string This function returns a string with the replaced values.
     */
    function str_replace_limit(
            $search,
            $replace,
            $subject,
            &$count,
            $limit = -1
        ){

        // Set some defaults
        $count = 0;

        // Invalid $limit provided. Throw a warning.
        if(!_str_replace_limit_valid_integer($limit)){
            $backtrace = debug_backtrace();
            trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                    '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting an '.
                    'integer', E_USER_WARNING);
            return $subject;
        }

        // Invalid $limit provided. Throw a warning.
        if($limit<-1){
            $backtrace = debug_backtrace();
            trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                    '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting -1 or '.
                    'a positive integer', E_USER_WARNING);
            return $subject;
        }

        // No replacements necessary. Throw a notice as this was most likely not the intended
        // use. And, if it was (e.g. part of a loop, setting $limit dynamically), it can be
        // worked around by simply checking to see if $limit===0, and if it does, skip the
        // function call (and set $count to 0, if applicable).
        if($limit===0){
            $backtrace = debug_backtrace();
            trigger_error('Invalid $limit `'.$limit.'` provided to '.__function__.'() in '.
                    '`'.$backtrace[0]['file'].'` on line '.$backtrace[0]['line'].'. Expecting -1 or '.
                    'a positive integer', E_USER_NOTICE);
            return $subject;
        }

        // Use str_replace() whenever possible (for performance reasons)
        if($limit===-1){
            return str_replace($search, $replace, $subject, $count);
        }

        if(is_array($subject)){

            // Loop through $subject values and call this function for each one.
            foreach($subject as $key => $this_subject){

                // Skip values that are arrays (to match str_replace()).
                if(!is_array($this_subject)){

                    // Call this function again for
                    $this_function = __FUNCTION__;
                    $subject[$key] = $this_function(
                            $search,
                            $replace,
                            $this_subject,
                            $this_count,
                            $limit
                    );

                    // Adjust $count
                    $count += $this_count;

                    // Adjust $limit, if not -1
                    if($limit!=-1){
                        $limit -= $this_count;
                    }

                    // Reached $limit, return $subject
                    if($limit===0){
                        return $subject;
                    }

                }

            }

            return $subject;

        } elseif(is_array($search)){
            // Only treat $replace as an array if $search is also an array (to match str_replace())

            // Clear keys of $search (to match str_replace()).
            $search = array_values($search);

            // Clear keys of $replace, if applicable (to match str_replace()).
            if(is_array($replace)){
                $replace = array_values($replace);
            }

            // Loop through $search array.
            foreach($search as $key => $this_search){

                // Don't support multi-dimensional arrays (to match str_replace()).
                $this_search = strval($this_search);

                // If $replace is an array, use the value of $replace[$key] as the replacement. If
                // $replace[$key] doesn't exist, just an empty string (to match str_replace()).
                if(is_array($replace)){
                    if(array_key_exists($key, $replace)){
                        $this_replace = strval($replace[$key]);
                    } else {
                        $this_replace = '';
                    }
                } else {
                    $this_replace = strval($replace);
                }

                // Call this function again for
                $this_function = __FUNCTION__;
                $subject = $this_function(
                        $this_search,
                        $this_replace,
                        $subject,
                        $this_count,
                        $limit
                );

                // Adjust $count
                $count += $this_count;

                // Adjust $limit, if not -1
                if($limit!=-1){
                    $limit -= $this_count;
                }

                // Reached $limit, return $subject
                if($limit===0){
                    return $subject;
                }

            }

            return $subject;

        } else {
            $search = strval($search);
            $replace = strval($replace);

            // Get position of first $search
            $pos = strpos($subject, $search);

            // Return $subject if $search cannot be found
            if($pos===false){
                return $subject;
            }

            // Get length of $search, to make proper replacement later on
            $search_len = strlen($search);

            // Loop until $search can no longer be found, or $limit is reached
            for($i=0;(($i<$limit)||($limit===-1));$i++){

                // Replace
                $subject = substr_replace($subject, $replace, $pos, $search_len);

                // Increase $count
                $count++;

                // Get location of next $search
                $pos = strpos($subject, $search);

                // Break out of loop if $needle
                if($pos===false){
                    break;
                }

            }

            // Return new $subject
            return $subject;

        }

    }

}

if (!function_exists('_str_replace_limit_valid_integer')) {

    /**
     * Checks if $string is a valid integer. Integers provided as strings (e.g. '2' vs 2)
     * are also supported.
     * @param mixed $string
     * @return bool Returns boolean TRUE if string is a valid integer, or FALSE if it is not
     */
    function _str_replace_limit_valid_integer($string){
        // 1. Cast as string (in case integer is provided)
        // 1. Convert the string to an integer and back to a string
        // 2. Check if identical (note: 'identical', NOT just 'equal')
        // Note: TRUE, FALSE, and NULL $string values all return FALSE
        $string = strval($string);
        return ($string===strval(intval($string)));
    }

}
