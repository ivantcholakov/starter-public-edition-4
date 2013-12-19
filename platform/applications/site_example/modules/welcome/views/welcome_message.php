<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="page-header">
                <h1 class="my_section">Application Starter 4 Public Edition</h1>
            </div>

            <p>
                Project repository: <a href="https://github.com/ivantcholakov/starter-public-edition-4/" target="_blank">https://github.com/ivantcholakov/starter-public-edition-4/</a>
            </p>

            <p>
                Here you can start developing the administration part of your site: <a href="<?php echo base_url('admin-example'); ?>"><?php echo base_url('admin-example'); ?></a>
            </p>

            <h2>Self-Diagnostics</h2>

            <p><?php echo $diagnostics; ?></p>

            <h2>Internationalization Test</h2>

            <p>
                Language switcher:

    <?php

    echo Modules::run('language_switcher/index');

    ?>

            </p>

            <p>A translated text: <strong><?php echo lang('welcome.hello'); ?></strong></p>

            <h2>Captcha Test</h2>

            <p>

                <div>
                    <img id="captcha_image"
                        class="img-thumbnail"
                        src="<?php echo $this->captcha->src.'?nocache='.rand(100000000, 999999999); ?>"
                        style="cursor: pointer;"
                        title="Click on the image if you want to change the proposed text."
                    />
                </div>

                <div id="captcha_test"></div>

            </p>
