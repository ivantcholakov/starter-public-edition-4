<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

template_partial('subnavbar');

?>

                        <p>
                            See
                            <a href="https://github.com/php-http" target="_blank" rel="noopener">https://github.com/php-http</a>,
                            <a href="http://httplug.io" target="_blank" rel="noopener">http://httplug.io</a>
                        </p>

                        <h3>Code:</h3>

                        <pre><code><?php echo html_escape($code_example); ?></code></pre>

<?php

if (is_php($php_required)) {

?>

                        <h3>Result:</h3>

                        <?php echo print_d($result); ?>

                        <div class="ui clearing hidden divider"></div>

                        <h3>Status Code:</h3>

                        <?php echo print_d($status_code); ?>

                        <div class="ui clearing hidden divider"></div>

                        <h3>Content Type:</h3>

                        <?php echo print_d($content_type); ?>

<?php

} else {

?>

                        <div class="alert alert-warning">PHP <?php echo $php_required ?> is required for this demo to work.</div>
<?php

}
