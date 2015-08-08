<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

<?php

template_partial('subnavbar');

?>

                <div class="page-header">
                    <h1>Accessing the REST Server Using the Curl Library</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <p>
                            See the article
                            <a href="http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/" target="_blank">
                                http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/
                            </a>
                        </p>

                        <h3>Code:</h3>

                        <pre><code><?php echo html_escape($code_example); ?></code></pre>

                        <h3>Result:</h3>

                        <?php echo print_d($result); ?>

                    </div>

                </div>

            </div>

        </section>
