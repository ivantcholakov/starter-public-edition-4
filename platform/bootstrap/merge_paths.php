<?php

if (!function_exists('merge_paths')) {

    // See http://stackoverflow.com/questions/2267074/merge-string-with-common-middle-part
    // "Merge string with common middle part"

    function merge_paths($path1, $path2) {

        // Added by Ivan Tcholakov, 13-MAR-2016.
        $path1 = str_replace('\\', '/', $path1);
        $path2 = str_replace('\\', '/', $path2);
        //

        $p1 = explode('/', trim($path1,' /'));
        $p2 = explode('/', trim($path2,' /'));

        $len = count($p1);

        do {

            if (array_slice($p1, -$len) === array_slice($p2, 0, $len)) {

                return '/'
                    . implode('/', array_slice($p1, 0, -$len))
                    . '/'
                    . implode('/', $p2);
            }
        }
        while (--$len);

        return '/'.implode('/', array_merge($p1, $p2));
    }

}
