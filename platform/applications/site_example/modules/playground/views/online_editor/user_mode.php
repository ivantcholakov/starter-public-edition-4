<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

<?php

template_partial('subnavbar');

?>

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <?php echo form_open('', 'method="post"'); ?>

                            <div>
<?php

echo form_ckeditor('content', $content, 'user', array('height' => 150));

?>
                            </div>

                            <br class="clear" />

                            <button type="submit" class="btn btn-primary">Submit Content</button>

                        <?php echo form_close(); ?>

                        <h2>Result:</h2>

                        <div><?php echo set_value('content', $content, false); ?></div>

                    </div>

                </div>

            </div>

        </section>
