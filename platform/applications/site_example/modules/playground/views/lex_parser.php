<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$template = 'Hello, {{name}}';
$data = array('name' => 'John');
$parser = new Lex\Parser();
$result = $parser->parse($template, $data);
echo $result;

?>
