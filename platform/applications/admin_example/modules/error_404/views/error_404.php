<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <section id="error" class="container text-center">

        <h1><?php echo lang('ui_error_404_title'); ?></h1>
        <p>
            <?php echo $this->lang->line('ui_error_404_description',
'
            <strong>
                <script type="text/javascript">
                //<![CDATA[
                    document.write(htmlspecialchars(document.location.href));
                //]]>
                </script>
            </strong>
'
                ); ?>
        </p>

        <p>
            <a class="btn btn-success" href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> <i18n>ui_admin_panel</i18n></a>
            <a class="btn btn-default" href="<?php echo DEFAULT_BASE_URL; ?>"><i class="fa fa-home"></i> <i18n>ui_to_public_site</i18n></a>
        </p>

    </section>
