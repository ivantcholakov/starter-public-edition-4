<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Mustache Parser Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-3">

                        <h4>Data (JSON Encoded)</h4>

                        <pre><?php echo json_encode($data); ?></pre>

                    </div>

                    <div class="col-md-3">

                        <h4>The Template</h4>

                        <pre><?php echo htmlspecialchars($mustache_template, ENT_QUOTES, 'UTF-8'); ?></pre>

                    </div>

                    <div class="col-md-3">

                        <h4>The PHP Parser Result</h4>

                        <?php echo $this->parser->parse_string($mustache_template, $data, true, 'mustache'); ?>

                    </div>

                    <div class="col-md-3">

                        <h4>The JavaScript Parser Result</h4>

                        <div id="the_result"></div>

                    </div>

                </div>

            </div>

        </section>
