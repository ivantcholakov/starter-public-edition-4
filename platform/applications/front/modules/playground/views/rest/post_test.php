<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

template_partial('subnavbar');

?>

                        <h3>Code:</h3>

                        <pre><code><?php echo html_escape($code_example); ?></code></pre>

                        <h3>Result:</h3>

                        <?php echo print_d($result); ?>

                        <div class="ui clearing hidden divider"></div>

                        <h3>Status Code:</h3>

                        <?php echo print_d($status_code); ?>

                        <div class="ui clearing hidden divider"></div>

                        <h3>Content Type:</h3>

                        <?php echo print_d($content_type); ?>
