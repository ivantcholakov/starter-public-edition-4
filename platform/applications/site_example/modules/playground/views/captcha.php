<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="page-header">
                <h1>Captcha Test</h1>
            </div>

            <p>Note: Examine the contact form as a real captcha usage example.</p>

            <h4>Click on the image:</h4>

            <p>

                <div>
                    <img id="captcha_image"
                        class="img-thumbnail"
                        src="<?php echo $this->captcha->src.'?nocache='.rand(100000000, 999999999); ?>"
                        style="cursor: pointer;"
                        title="Click on the image if you want to change the proposed text."
                    />
                </div>

            </p>

            <h4>User input simulation:</h4>

            <div id="captcha_test"></div>
