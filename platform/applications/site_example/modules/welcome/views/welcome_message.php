<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="page-header">
                <h1>Application Starter 4 Public Edition</h1>
            </div>

            <p>
                Project repository: <a href="https://github.com/ivantcholakov/starter-public-edition-4/" target="_blank">https://github.com/ivantcholakov/starter-public-edition-4/</a>
            </p>

            <div class="alert alert-info">
                <i class="fa fa-exclamation-circle"></i> Here you can start developing the administration part of your site: <strong><a href="<?php echo base_url('admin-example'); ?>"><?php echo base_url('admin-example'); ?></a></strong>
            </div>

            <p>A Material Design icon: <i class="mdi mdi-star"></i></p>
            <p>A Font Awesome icon: <i class="fa fa-star"></i></p>
            <p>A Glyphicon: <span class="glyphicon glyphicon-star"></span></p>

            <h2>Self-Diagnostics</h2>

            <p><?php echo $diagnostics; ?></p>

            <h2>Internationalization Test</h2>

            <p>
                Switch language by using the menu, see top, right. The text below should be properly translated.
            </p>

            <p>A translated text: <strong><?php echo lang('welcome.hello'); ?></strong></p>
