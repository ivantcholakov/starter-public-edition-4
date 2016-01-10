<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

<?php

file_partial('messages');

?>

                        <?php echo form_open('', 'id="test_form" method="post" role="form"'); ?>

                            <div class="form-group">
                                <label for="input">The input, CSS source:</label>
                                <textarea id="input" name="input" class="form-control" rows="10" placeholder="Copy/paste your CSS source here."><?php echo set_value('input', '', true); ?></textarea>
                            </div>

                            <div class="form-group">
                                <button id="test_form_submit" name="test_form_submit" type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>

                            <div class="form-group">
                                <label for="output">The result, minified CSS:</label>
                                <textarea id="output" class="form-control" rows="10"><?php echo form_prep($output, true); ?></textarea>
                            </div>

                        <?php echo form_close(); ?>

                    </div>

                </div>

            </div>

        </section>
