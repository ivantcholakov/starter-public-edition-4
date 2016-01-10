<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

<?php

template_partial('subnavbar');

?>

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <h3>Code:</h3>

                        <pre><code><?php echo html_escape($code_example); ?></code></pre>

                        <h3>Result:</h3>

                        <?php echo print_d($result); ?>

                        <div class="clearfix"></div>

                        <h3>Status Code:</h3>

                        <?php echo print_d($status_code); ?>

                        <div class="clearfix"></div>

                        <h3>Content Type:</h3>

                        <?php echo print_d($content_type); ?>

                    </div>

                </div>

            </div>

        </section>
