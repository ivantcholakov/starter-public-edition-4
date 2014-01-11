<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */


$content = $path != '' ? @ file_get_contents($path) : '';

?>

        <section>

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

<?php

echo $this->parser->parse_string($content, null, true, array('markdown', 'auto_link'));

?>


                    </div>

                </div>

            </div>

        </section>
