<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

template_partial('subnavbar');

?>

                        <p>
                            The article: <a href="http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/" target="_blank" rel="noopener">http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/</a>
                        </p>

                        <p>
                            Click on the links to check whether the REST server is working.
                        </p>

                        <ol>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users'); ?>">Users</a> - defaulting to JSON</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/format/csv'); ?>">Users</a> - get it in CSV</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/id/1'); ?>">User #1</a> - defaulting to JSON  (users/id/1)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/1'); ?>">User #1</a> - defaulting to JSON  (users/1)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/id/1.xml'); ?>">User #1</a> - get it in XML (users/id/1.xml)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/id/1/format/xml'); ?>">User #1</a> - get it in XML (users/id/1/format/xml)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/id/1?format=xml'); ?>">User #1</a> - get it in XML (users/id/1?format=xml)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/1.xml'); ?>">User #1</a> - get it in XML (users/1.xml)</li>
                            <li><a id="ajax" href="<?php echo site_url('playground/rest/server-api-example/users/format/json'); ?>">Users</a> - get it in JSON (AJAX request)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users.html'); ?>">Users</a> - get it in HTML (users.html)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/format/html'); ?>">Users</a> - get it in HTML (users/format/html)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users?format=html'); ?>">Users</a> - get it in HTML (users?format=html)</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/format/debug'); ?>">Users</a> - get it as a debugging HTML preview</li>
                        </ol>
