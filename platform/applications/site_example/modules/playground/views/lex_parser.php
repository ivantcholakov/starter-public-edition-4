<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$template = 'Hello, {{name}}';
$data = array('name' => 'John');

$parser = new Lex\Parser();
echo $parser->parse($template, $data);

echo '<br />';

echo $this->parser->parse_string($template, $data, true, 'lex');

echo '<br />';

echo $this->load->view('test.lex', $data, true, 'lex');

?>
