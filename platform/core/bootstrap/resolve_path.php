<?php

if (!function_exists('resolve_path')) {

    /**
     * This function resolves paths like realpath does,
     * WITHOUT checking for validance.
     * http://www.php.net/manual/en/function.realpath.php#81935
     * @author 131 dot php at cloudyks dot org
     */

    //realpath like, working with absolute/relative path & a little bit shorter :p 

    function resolve_path($path) {

        $path = str_replace('\\', '/', $path);

        $out = array();

        foreach (explode('/', $path) as $i => $fold) {

            if ($fold == '' || $fold == '.') {
                continue;
            }

            if ($fold == '..' && $i > 0 && end($out) != '..') {
                array_pop($out);
            } else {
                $out[] = $fold;
            }
        }

        return ($path{0} == '/' ? '/' : '').join('/', $out); 
    }

}
