<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan tcholakov, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <style>
            .bootstrap-dialog .modal-header.bootstrap-dialog-draggable {
                cursor: move;
            }
        </style>

        <section>

            <div class="container">

<?php

template_partial('subnavbar');

?>

                <div class="page-header">
                    <h2>Assign Rating Example</h2>
                </div>

                <div class="text-center" style="margin-bottom: 20px;">
                    <button class="btn btn-default btn-sm" data-toggle="modal" id="assign_ratings" data-target="#ratings_modal"><i class="fa fa-star-o"></i> <?php echo $this->lang->line('ui_assign_rating'); ?></button>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="pull-left" style="margin-right: 20px; margin-bottom: 20px;">
                            <img src="<?php echo image_url('lib/bootstrap3-dialog/pig.ico'); ?>" />
                        </div>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                            Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text. Very long text.
                        </p>

                        <p>
                            <a href="https://github.com/nakupanda/bootstrap3-dialog" target="_blank">https://github.com/nakupanda/bootstrap3-dialog</a>
                        </p>

                        <p>
                            <a href="https://github.com/kartik-v/bootstrap-star-rating" target="_blank">https://github.com/kartik-v/bootstrap-star-rating</a>
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <div class="modal fade" id="ratings_modal" tabindex="-1" role="dialog" aria-labelledby="ratings_modal_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo $this->lang->line('ui_close'); ?>"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ratings_modal_label"><?php echo $this->lang->line('ui_assign_rating'); ?></h4>
                    </div>

                    <div class="modal-body">

                        <form action="javascript: return false;" method="post" role="form">

                            <label>Politeness</label>
                            <input id="input-r1" class="rating-entry" data-size="xs" />

                            <hr />

                            <label>Quality</label>
                            <input id="input-r2" class="rating-entry" data-size="xs" />

                            <hr />

                            <label>Price</label>
                            <input id="input-r3" class="rating-entry" data-size="xs" />

                        </form>

                    </div>

                    <div class="modal-footer">
                        <button id="save_ratings" type="button" class="btn btn-primary"><i class="fa fa-check fa-fw"></i> <?php echo $this->lang->line('ui_save'); ?></button>
                        <button id="delete_ratings" type="button" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> <?php echo $this->lang->line('ui_delete'); ?></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban fa-fw"></i> <?php echo $this->lang->line('ui_cancel'); ?></button>
                    </div>

                </div>
            </div>
        </div>