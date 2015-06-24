<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <style>
            /* If you would like to change the cursor shape of hovering on dialog header, you can try the following css lines: */
            .bootstrap-dialog .modal-header.bootstrap-dialog-draggable {
                cursor: move;
            }
        </style>

        <style>
            /* Additional CSS Classes */
           .login-dialog .modal-dialog {
                width: 300px;
            }
        </style>

        <style>
            p > .btn {
                margin-bottom: 10px;
            }
        </style>

        <section>

            <div class="container">

                <div class="page-header">
                    <h2>Bootstrap Modal Dialogs</h2>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <p>
                            <button class="btn btn-default" id="simple_test">Simple Test</button>
                            <button class="btn btn-default" id="dialog_title">Dialog Title</button>
                            <button class="btn btn-default" id="manipulating_dialog_title">Manipulating Dialog Title</button>
                            <button class="btn btn-default" id="manipulating_dialog_message">Manipulating Dialog Message</button>
                            <button class="btn btn-default" id="loading_remote_page_1">Loading remote page (1)</button>
                            <button class="btn btn-default" id="loading_remote_page_2">Loading remote page (2)</button>
                            <button class="btn btn-default" id="buttons">Buttons</button>
                            <button class="btn btn-default" id="manipulating_buttons">Manipulating Buttons</button>
                            <button class="btn btn-default" id="button_hotkey">Button Hotkey</button>
                            <button class="btn btn-default" id="keys_conflicts">Keys Conflicts</button>
                            <button class="btn btn-default" id="opening_multiple_dialogs">Opening multiple dialogs</button>
                            <button class="btn btn-default" id="creating_dialog_instances">Creating dialog instances</button>
                            <button class="btn btn-default" id="creating_dialog_instances_2">Creating dialog instances (2)</button>
                            <button class="btn btn-default" id="open_close_multiple_dialogs">Open / Close multiple dialogs</button>
                            <button class="btn btn-default" id="button_with_identifier">Button with identifier</button>
                            <button class="btn btn-default" id="message_types">Message types</button>
                            <button class="btn btn-default" id="changing_dialog_type">Changing dialog type</button>
                            <button class="btn btn-default" id="larger_dialog">Larger dialog</button>
                            <button class="btn btn-default" id="more_dialog_sizes">More dialog sizes</button>
                            <button class="btn btn-default" id="rich_message">Rich message</button>
                            <button class="btn btn-default" id="dialog_closable_unclosable">Dialog closable / unclosable</button>
                            <button class="btn btn-default" id="more_controls_on_closing_a_dialog">More controls on closing a dialog</button>
                            <button class="btn btn-default" id="disabling_animation">Disabling Animation</button>
                            <button class="btn btn-default" id="auto_spinning_icon">Auto spinning icon</button>
                            <button class="btn btn-default" id="dialog_draggable">Dialog Draggable</button>
                            <button class="btn btn-default" id="manipulating_your_dialog">Manipulating your dialog</button>
                            <button class="btn btn-default" id="additional_css_classes_to_your_dialog">Additional CSS classes to your dialog</button>
                            <button class="btn btn-default" id="adding_a_description_to_your_dialog">Adding a description to your dialog (for accessibility)</button>
                            <button class="btn btn-default" id="data_binding">Data binding</button>
                            <button class="btn btn-default" id="dialog_events">Dialog events</button>
                            <button class="btn btn-default" id="stop_closing_your_dialog">Stop closing your dialog</button>
                            <button class="btn btn-default" id="alert">Alert</button>
                            <button class="btn btn-default" id="alert_with_callback">Alert with callback</button>
                            <button class="btn btn-default" id="alert_with_customizations">Alert with customizations</button>
                            <button class="btn btn-default" id="confirm">Confirm</button>
                            <button class="btn btn-default" id="confirm_with_callback">Confirm with callback</button>
                            <button class="btn btn-default" id="confirm_with_customizations">Confirm with customizations</button>
                        </p>

                        <hr />

                        <div id="modal-container"></div><!-- For "Append modal to div" example -->

                        <p>
                            <button class="btn btn-default" id="append_modal_to_div">Append modal to div</button>
                            <button class="btn btn-default" id="button_event">Button Event</button>
                            <button class="btn btn-default" id="custom_dialog_id">Custom Dialog ID</button>
                            <button class="btn btn-default" id="custom_spinning_icon">Custom Spinning Icon</button>
                            <button class="btn btn-default" id="custom_tabindex">Custom Tabindex</button>
                            <button class="btn btn-default" id="reopen_dialog">Reopen Dialog</button>
                        </p>

                        <hr />

                        <p>
                            Project repository: <a href="https://github.com/nakupanda/bootstrap3-dialog" target="_blank">https://github.com/nakupanda/bootstrap3-dialog</a>
                        </p>

                        <p>
                            The original live examples: <a href="http://nakupanda.github.io/bootstrap3-dialog" target="_blank">http://nakupanda.github.io/bootstrap3-dialog</a>
                        </p>

                    </div>

                </div>

            </div>

        </section>
