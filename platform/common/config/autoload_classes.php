<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Auto-load Classes in PHP5 Way - A Location Map
|
|  An example:
|  $autoload['classes'] = array(
|      'Markdown_Parser' => APPPATH.'third_party/markdown/markdown.php',
|  );
| -------------------------------------------------------------------
*/

$autoload['classes'] = array(
    'Markdownify' => COMMONPATH.'third_party/markdownify/markdownify.php',
    'Markdownify_Extra' => COMMONPATH.'third_party/markdownify/markdownify_extra.php',
    'Markdown_Parser' => COMMONPATH.'third_party/markdown/markdown.php',
    'MarkdownExtra_Parser' => COMMONPATH.'third_party/markdown/markdown.php',
);
