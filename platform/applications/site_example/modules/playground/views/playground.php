<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

    <section class="container">

        <div class="row">

            <div class="col-sm-12">

                <div class="page-header">
                    <h1>The Playground</h1>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-sm-8">

                <h4>Standalone Pages</h4>

                <ul>
                    <li><a href="<?php echo base_url('non-mvc/demo.php'); ?>">Non-MVC Page Demonstration</a></li>
                    <li><a href="<?php echo base_url('non-mvc/http_build_url_test.php'); ?>">Testing http_build_url()</a></li>
                    <li>
                        <a href="<?php echo base_url('non-mvc/idna.php'); ?>">IDNA Converter Test (PEAR IDNA2)</a>
                        <br />
                        <span class="text-muted">This component might be used by HTMLPurifier, so let us have a look at its test.</span>
                    </li>
                    <li><a href="<?php echo base_url('non-mvc/normalize.css.php'); ?>">Testing normalize.css</a></li>
                </ul>

                <h4>Feature Tests</h4>

                <ul>
                    <li><a href="<?php echo site_url('playground/captcha'); ?>">Captcha Test</a></li>
                    <li><a href="<?php echo site_url('playground/mustache'); ?>">Mustache Parser Test</a></li>
                    <li><a href="<?php echo site_url('playground/gibberish-aes'); ?>">GibberishAES Test</a></li>
                    <li><a href="<?php echo site_url('playground/random'); ?>">Random Values Test</a></li>
                    <li><a href="<?php echo site_url('playground/ajax-queue'); ?>">AJAX Queue Test</a></li>
                    <li><a href="<?php echo site_url('playground/jquery-url-parser'); ?>">jQuery URL Parser Test</a></li>
                    <li><a href="<?php echo site_url('playground/rest/server'); ?>">RESTful Service Test</a></li>
                    <li><a href="<?php echo site_url('playground/online-editor/user-mode'); ?>">Online Editor Test</a></li>
                    <li><a href="<?php echo site_url('playground/email-test'); ?>">Email Test</a></li>
                </ul>

            </div>

            <div class="col-sm-4">

                  <img src="<?php echo image_path('playground.jpg'); ?>" class="thumbnail img-responsive" />

            </div>

        </div>

    </section>


