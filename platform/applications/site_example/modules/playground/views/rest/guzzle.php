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
                    <h1>Accessing the REST Server Using the Guzzle HTTP Client</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <p>
                            See
                            <a href="https://github.com/guzzle/guzzle" target="_blank">https://github.com/guzzle/guzzle</a>,
                            <a href="http://guzzlephp.org/" target="_blank">http://guzzlephp.org/</a>
                        </p>

                        <h3>Code:</h3>

                        <pre><code><?php echo html_escape($code_example); ?></code></pre>

<?php

if (is_php($php_required)) {

?>

                        <h3>Result (for $user_id = 1):</h3>

                        <?php echo print_d($result); ?>

                        <div class="clearfix"></div>

                        <h3>Status Code:</h3>

                        <?php echo print_d($status_code); ?>

                        <div class="clearfix"></div>

                        <h3>Content Type:</h3>

                        <?php echo print_d($content_type); ?>

<?php

} else {

?>

                        <div class="alert alert-warning">PHP <?php echo $php_required ?> is required for this demo to work.</div>
<?php

}

?>

                    </div>

                </div>

            </div>

        </section>
