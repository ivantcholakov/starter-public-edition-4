<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ($path != '') {
    $content = @ file_get_contents($path);
}

echo $content;
