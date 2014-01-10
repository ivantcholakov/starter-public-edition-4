<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

<?php

template_partial('subnavbar');

?>

                <div class="page-header">
                    <h1>REST Server</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <p>
                            See the article
                            <a href="http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/" target="_blank">
                                http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/
                            </a>
                        </p>

                        <p>
                            Click on the links to check whether the REST server is working.
                        </p>

                        <ul>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users'); ?>">Users</a> - defaulting to XML</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/format/csv'); ?>">Users</a> - get it in CSV</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/user/id/1'); ?>">User #1</a> - defaulting to XML</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/user/id/1/format/json'); ?>">User #1</a> - get it in JSON</li>
                            <li><a id="ajax" href="<?php echo site_url('playground/rest/server-api-example/users/format/json'); ?>">Users</a> - get it in JSON (AJAX request)</li>
                        </ul>

                    </div>

                </div>

            </div>

        </section>
