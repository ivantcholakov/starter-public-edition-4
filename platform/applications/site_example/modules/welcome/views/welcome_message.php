<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <p>
                Project repository: <a href="https://github.com/ivantcholakov/starter-public-edition-4/" target="_blank">https://github.com/ivantcholakov/starter-public-edition-4/</a>
            </p>

            <div class="ui info message">
                <i class="info circle icon"></i> Here you can start developing the administration part of your site: <strong><a href="<?php echo base_url('admin-example'); ?>"><?php echo base_url('admin-example'); ?></a></strong>
            </div>

            <p>A Semantic UI icon: <i class="star icon"></i></p>
            <p>A Material Design icon: <i class="mdi mdi-star"></i></p>
            <p>A Font Awesome icon: <i class="fa fa-star"></i></p>

            <h2>Internationalization Test</h2>

            <p>
                Switch language by using the menu, see top, right. The text below should be properly translated.
            </p>

            <p>A translated text: <strong><?php echo lang('welcome.hello'); ?></strong></p>

            <h2>Self-Diagnostics</h2>

            <p><?php echo $diagnostics; ?></p>
