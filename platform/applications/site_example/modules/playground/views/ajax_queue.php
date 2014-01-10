<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>AJAX Queue Test</h1>
                </div>

                <div class="col-md-6">

                    <h3>Queued AJAX Calls</h3>
                    <h4 style="margin-bottom: 10px;">(the results should appear in correct order)</h4>

                    <pre><code><?php echo htmlspecialchars($test_script_1, ENT_QUOTES, 'UTF-8') ?></code></pre>

                    <h3>Results:</h3>

                    <ul id="queued_ajax"></ul>

                </div>

                <div class="col-md-6">

                    <h3>Ordinary AJAX Calls</h3>
                    <h4 style="margin-bottom: 10px;">(the results might appear in incorrect order)</h4>

                    <pre><code><?php echo htmlspecialchars($test_script_2, ENT_QUOTES, 'UTF-8') ?></code></pre>

                    <h3>Results:</h3>

                    <ul id="ordinary_ajax"></ul>

                </div>

            </div>

        </section>
