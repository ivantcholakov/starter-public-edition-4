<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Less Compiler Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h4>The Less Source</h4>

                        <pre class="lang-css">
<?php

echo htmlspecialchars(@ file_get_contents($this->load->path('test.less')), ENT_QUOTES, 'UTF-8');

?>

                        </pre>

                    </div>

                    <div class="col-md-6">

                        <h4>The Result CSS</h4>

                        <pre class="lang-css">
<?php

echo htmlspecialchars($this->load->view('test.less', null, true, 'less'), ENT_QUOTES, 'UTF-8');

?>

                        </pre>

                    </div>

                </div>

            </div>

        </section>
