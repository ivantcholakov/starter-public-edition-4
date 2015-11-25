<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
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
                    <li><a href="<?php echo base_url('non-mvc/normalize-v1.css.php'); ?>">Testing normalize.css, v1.x</a></li>
                    <li><a href="<?php echo base_url('non-mvc/normalize-v2.css.php'); ?>">Testing normalize.css, v2.x</a></li>
                    <li><a href="<?php echo base_url('non-mvc/normalize-v3.css.php'); ?>">Testing normalize.css, v3.x</a></li>
                    <li><a href="<?php echo base_url('non-mvc/normalize-v3.css-2.php'); ?>">Testing normalize.css, v3.x, the test is from v2.x</a></li>
                    <li><a href="<?php echo base_url('non-mvc/password_hash_test.php'); ?>">PasswordHash Test</a></li>
                    <li><a href="<?php echo base_url('non-mvc/redis_caching_driver_test.php'); ?>">Redis Caching Driver Test</a> (Redis server and phpredis extension must be set up first)</li>
                </ul>

                <h4>Feature Tests</h4>

                <ul>
                    <li><a href="<?php echo site_url('playground/captcha'); ?>">Captcha Test</a></li>
                    <li><a href="<?php echo site_url('playground/mustache'); ?>">Mustache Parser Test</a></li>
                    <li><a href="<?php echo site_url('playground/textile'); ?>">Textile Parser Test</a></li>
                    <li><a href="<?php echo site_url('playground/scss'); ?>">SCSS Compiler Test</a></li>
                    <li><a href="<?php echo site_url('playground/less'); ?>">Less Compiler Test</a></li>
                    <li><a href="<?php echo site_url('playground/gibberish-aes'); ?>">GibberishAES Test</a></li>
                    <li><a href="<?php echo site_url('playground/random'); ?>">Random Values Test</a></li>
                    <li><a href="<?php echo site_url('playground/ajax-queue'); ?>">AJAX Queue Test</a></li>
                    <li><a href="<?php echo site_url('playground/jquery-url-parser'); ?>">jQuery URL Parser Test</a></li>
                    <li><a href="<?php echo site_url('playground/rest/server'); ?>">RESTful Service Test</a></li>
                    <li><a href="<?php echo site_url('playground/online-editor/user-mode'); ?>">Online Editor Test</a></li>
                    <li><a href="<?php echo site_url('playground/email-test'); ?>">Email Test</a></li>
                    <li><a href="<?php echo site_url('playground/datatables'); ?>">DataTables</a></li>
                    <li><a href="<?php echo site_url('playground/gravatar-test'); ?>">Gravatar Test</a></li>
                    <li><a href="<?php echo site_url('playground/multiplayer'); ?>">Multiplayer Library Test</a></li>
                    <li><a href="<?php echo site_url('playground/jquery-chosen'); ?>">jQuery Chosen Test</a></li>
                    <li><a href="<?php echo site_url('playground/google-maps-v3'); ?>">Google Maps JavaScript API v3 Demo</a></li>
                    <li><a href="<?php echo site_url('playground/smileys'); ?>">Smiley Test</a></li>
                    <li><a href="<?php echo site_url('playground/file-type-icons'); ?>">Testing File Type Icons</a></li>
                    <li><a href="<?php echo site_url('playground/cssmin'); ?>">CSS Minification Test</a></li>
                    <li><a href="<?php echo site_url('playground/jsmin'); ?>">JavaScript Minification Test</a></li>
                    <li><a href="<?php echo site_url('playground/fb'); ?>">Facebook PHP SDK v4 for CodeIgniter</a></li>
                    <li><a href="<?php echo site_url('playground/bootstrap-modals'); ?>">Bootstrap Modal Dialogs</a></li>
                    <li><a href="<?php echo site_url('playground/star-rating'); ?>">Bootstrap Star Rating Examples</a></li>
                    <li><a href="<?php echo site_url('playground/assign-rating'); ?>">Assign Rating Example</a></li>
                    <li><a href="<?php echo site_url('playground/print-test'); ?>">Print Test</a></li>
                    <li><a href="<?php echo site_url('playground/social-buttons'); ?>">Social Buttons for Bootstrap</a></li>
                    <li><a href="<?php echo site_url('playground/image-process-test'); ?>">Image Manipulations Test</a></li>
                    <li><a href="<?php echo site_url('playground/pjax'); ?>">Pjax jQuery plugin Test</a></li>
                    <li><a href="<?php echo site_url('playground/typescript'); ?>">TypeScript Compiler Test</a></li>
                    <li><a href="<?php echo site_url('playground/colorbox'); ?>">Colorbox Test</a></li>
                    <li><a href="<?php echo site_url('playground/jsonmin'); ?>">JSON Minification Test</a></li>
                    <li><a href="<?php echo site_url('playground/animate'); ?>">Animate,css Test</a></li>
                    <li><a href="<?php echo site_url('playground/material-icons-test'); ?>">Material Icons Test</a></li>
                    <li><a href="<?php echo site_url('playground/design-test'); ?>">Design Test</a></li>
                </ul>

            </div>

            <div class="col-sm-4">

                  <img src="<?php echo image_path('playground.jpg'); ?>" class="thumbnail img-responsive" />

            </div>

        </div>

    </section>
