<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$template = 'Hello, {{ name }}';
$template_2 = '<h1>{{ template:title }}</h1> Hello, {{name}}';
$data = array('name' => 'John');

// Calling the Lex parser driver.
echo $this->parser->parse_string($template_2, $data, true, 'lex');

echo '<br />';

// Applying the Lex parser on views.
echo $this->load->view('test.lex', $data, true, 'lex');

echo '<br />';

// Direct usage the Lex parser API.
$parser = new Lex\Parser();
echo $parser->parse($template, $data);

echo '<br />';

// Direct usage of the old Lex parser API (added for BC).
$parser_2 = new Lex_Parser();
echo $parser_2->parse($template, $data);

?>
