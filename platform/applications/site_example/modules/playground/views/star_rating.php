<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Copyright (c) 2013 - 2015, Kartik Visweswaran
 * @license The MIT License, http://opensource.org/licenses/MIT
 * @author Adapted by Ivan Tcholakov, 2015
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h2>Bootstrap Star Rating Examples <small>&copy; Kartik Visweswaran, Krajee.com</small></h2>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <?php echo form_open('', 'method="post" role="form"'); ?>
                            <input id="input-2b" type="number" class="rating" min="0" max="5" step="0.5" data-size="xl"
                            data-symbol="&#xe005;" data-default-caption="{rating} hearts" data-star-captions="{}">
                            <hr>
                            <label>Font Awesome Stars</label>
                            <input id="input-2c" class="rating" min="0" max="5" step="0.5" data-size="sm"
                                   data-symbol="&#xf005;" data-glyphicon="false" data-rating-class="rating-fa">
                            <label>Font Awesome Beer</label>
                            <input id="input-2d" class="rating" min="0" max="5" step="0.5" data-size="sm"
                                   data-symbol="&#xf0fc;" data-glyphicon="false" data-rating-class="rating-fa" data-default-caption="{rating} drinks" data-star-captions="{}">
                            <hr>
                            <input id="input-21a" value="0" type="number" class="rating" data-symbol="*" min=0 max=5 step=0.5 data-size="xl" >
                            <hr>
                            <input id="input-21b" value="4" type="number" class="rating" min=0 max=5 step=0.2 data-size="lg">
                            <hr>
                            <input id="input-21c" value="0" type="number" class="rating" min=0 max=8 step=0.5 data-size="xl" data-stars="8">
                            <hr>
                            <input id="input-21d" value="2" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
                            <hr>
                            <input id="input-21e" value="0" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" >
                            <hr>
                            <input id="input-21f" value="0" type="number" min=0 max=5 step=0.1 data-size="md" >
                            <hr>
                            <input id="input-2ba" type="number" class="rating" min="0" max="5" step="0.5" data-stars=5
                            data-symbol="&#xe005;" data-default-caption="{rating} hearts" data-star-captions="{}">
                            <hr>
                            <input id="input-22"  value="0" type="number" class="rating" min=0 max=5 step=0.5 data-rtl=1 data-container-class='text-right' data-glyphicon=0>
                            <div class="clearfix"></div>
                            <hr>
                            <input class="rb-rating">
                            <hr>
                            <input id="rating-input" type="number" />
                            <button id="btn-rating-input" type="button" class="btn btn-primary">Toggle Disable</button>
                            <hr>
                            <input id="kartik" class="rating" data-stars="5" data-step="0.1"/>
                            <div class="form-group" style="margin-top:10px">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="button" class="btn btn-danger">Destroy</button>
                            <button type="button" class="btn btn-success">Create</button>
                            </div>
                        <?php echo form_close(); ?>
                        <hr>

                        <p>
                            <a href="https://github.com/kartik-v/bootstrap-star-rating" target="_blank">https://github.com/kartik-v/bootstrap-star-rating</a>
                        </p>
                        <br />

                    </div>

                </div>

            </div>

        </section>
