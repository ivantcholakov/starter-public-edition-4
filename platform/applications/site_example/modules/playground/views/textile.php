<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h4>The Input Text</h4>

                        <pre class="lang-html">
<?php

echo htmlspecialchars(str_replace('BASE_URL', base_url(), @ file_get_contents($this->load->path('test.textile'))), ENT_QUOTES, 'UTF-8');

?>

                        </pre>

                    </div>

                    <div class="col-md-6">

                        <h4>The Result</h4>

<?php

try {
    echo str_replace('BASE_URL', base_url(), $this->load->view('test.textile', null, true, 'textile'));
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

                    </div>

                </div>

            </div>

        </section>
