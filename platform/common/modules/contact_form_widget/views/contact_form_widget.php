<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

                <h4><i18n>contact_send_us_a_message</i18n></h4>

<?php

if ($this->settings->get('mailer_enabled')) {

?>

                <div id="contact_form_feedback_messages" style="display: none;"></div>

                <div id="contact_form_alert_success_wrapper" class="status alert alert-success" style="display: none;">
                    <div id="contact_form_alert_success"></div>
                </div>

                <div id="contact_form_alert_error_wrapper" class="status alert alert-danger" style="display: none;">
                    <div id="contact_form_alert_error"></div>
                </div>

                <?php echo form_open('', 'class="contact-form" name="main-contact-form" id="main-contact-form" method="post" role="form"'); ?>

                    <div class="row">

                        <div class="col-sm-5">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input type="text" id="contact_form_first_name" name="contact_form_first_name" class="form-control" i18n:placeholder="contact_first_name|* " />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input type="text" id="contact_form_last_name" name="contact_form_last_name" class="form-control" i18n:placeholder="contact_last_name|* " />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                    <input type="email" id="contact_form_email" name="contact_form_email" class="form-control" i18n:placeholder="contact_email|* " />
                                </div>
                            </div>

<?php

    if ($contact_form_has_phone) {

?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                    <input type="text" id="contact_form_phone" name="contact_form_phone" class="form-control" i18n:placeholder="contact_phone<?php echo $contact_form_phone_required ? '|* ' : ''; ?>" />
                                </div>
                            </div>
<?php
    }

    if ($contact_form_has_organization) {

?>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sitemap fa-fw"></i></span>
                                    <input type="text" id="contact_form_organization" name="contact_form_organization" class="form-control" i18n:placeholder="contact_organization<?php echo $contact_form_organization_required ? '|* ' : ''; ?>" />
                                </div>
                            </div>

<?php
    }

?>

                            <div class="form-group">

                                <div class="img-thumbnail">

                                    <img id="captcha_image"
                                        src="<?php echo $this->captcha->src.'?nocache='.rand(100000000, 999999999); ?>"
                                        class="img-thumbnail"
                                        style="cursor: pointer; margin-right: 5px; padding: 0; border-radius: 4px;"
                                        i18n:title="captcha.tip"
                                    /><button type="button" id="captcha_refresh" class="btn btn-default" i18n:title="ui_refresh"
                                        style="vertical-align: middle; margin-top: 5px; margin-bottom: 5px; margin-right: 2px; outline: 0;"
                                    >
                                        <i id="captcha_refresh" class="fa fa-refresh"></i>
                                    </button>

                                </div>

                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input type="text" id="contact_form_captcha" name="contact_form_captcha" class="form-control" i18n:placeholder="captcha.label|* " maxlength="<?php echo $this->captcha->length; ?>" />
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-7">

                            <div class="form-group">
                                <input type="text" id="contact_form_subject" name="contact_form_subject" class="form-control" i18n:placeholder="contact_subject|* " />
                            </div>

                            <div class="form-group">
                                <textarea id="contact_form_message" name="contact_form_message" class="form-control" rows="14" i18n:placeholder="contact_message|* "></textarea>
                            </div>

                            <div class="form-group">
                                <span class="help-block"><i18n>ui_required_fields_note</i18n></span>
                            </div>

                            <div class="form-group">
                                <button id="contact_form_submit" name="contact_form_submit" type="submit" class="btn btn-primary btn-block">
                                    <i id="contact_form_submit_icon" class="fa fa-check fa-fw"></i>
                                    <i id="contact_form_error_flag" class="fa fa-exclamation-triangle fa-fw" style="display: none;"></i>
                                    <i id="contact_form_processing" class="fa fa-spinner fa-spin fa-fw" style="display: none;"></i>
                                    <i18n>contact_send_message</i18n>
                                </button>
                            </div>

                        </div>

                    </div>

                <?php echo form_close(); ?>

                <script type="text/javascript">
                //<![CDATA[

                function refresh_captcha() {

                    $('#captcha_image').attr('src', '<?php echo $this->captcha->src; ?>' + '?nocache=' + Math.random()*999999999);
                    $('#contact_form_captcha').val('');
                }

                function contact_form_submit_state() {

                    $('#contact_form_submit').attr('disabled', 'disabled');
                    $('#contact_form_submit_icon').hide();
                    $('#contact_form_error_flag').hide();
                    $('#contact_form_processing').show();
                }

                function contact_form_success_state(message) {

                    $('#contact_form_processing').hide();
                    $('#contact_form_error_flag').hide();
                    $('#contact_form_submit_icon').show();
                    $('#contact_form_submit').removeAttr('disabled');

                    $('#main-contact-form').hide();

                    $('#contact_form_feedback_messages').html(message);
                    $('#contact_form_feedback_messages').fadeIn('slow');
                }

                function contact_form_error_state(message) {

                    $('#contact_form_processing').hide();

                    $('#contact_form_error_flag').show();
                    $('#contact_form_submit').removeAttr('disabled');

                    $('#contact_form_feedback_messages').html(message);
                    $('#contact_form_feedback_messages').fadeIn('slow');

                    refresh_captcha('#captcha_image');
                }

                $(function () {

                    $('#captcha_image').on('click', function() {
                        refresh_captcha();
                    });

                    $('#captcha_refresh').on('click', function() {
                        refresh_captcha();
                    });

                    $('#main-contact-form').submit(function(e) {

                        contact_form_submit_state();

                        var contact_form_data = $(this).serialize();

                        $.ajax({
                            type: 'post',
                            url: '<?php echo site_uri('contact_form_widget/submit'); ?>',
                            data: contact_form_data,
                            success: function(data) {

                                if (data.success) {

                                    contact_form_success_state(data.messages_html);

                                } else {

                                    contact_form_error_state(data.messages_html);

                                }

                            },
                            error: function () {

                                contact_form_error_state(<?php echo json_encode($mailer_error_html); ?>);

                            }
                        });

                        e.preventDefault();
                        return false;
                    });

                });
                //]]>
                </script>

<?php

} else {

?>

                <div class="status alert alert-warning">
                    <i18n>mailer_disabled</i18n>
                </div>

<?php

}
