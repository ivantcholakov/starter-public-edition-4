<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <section id="error" class="container">

        <style type="text/css">

            #goog-wm {
                margin-top: 50px;
            }

            #goog-wm-qt {
                /* Google search: This is the text box. */
                width: 350px;
                margin-right: 5px;
            }

            #goog-wm-sb {
                /* Google search: This is the button. */
                width: 200px;
            }

            #goog-wm li {
                list-style-type: none;
            }

        </style>

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

        <a class="btn btn-success" href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> <?php echo lang('ui_go_to_homepage'); ?></a>

        <div id="google_search_form" class="form" style="display: none;"></div>

        <div id="google_search_form_hidden" style="display: none;">

<?php

// See http://support.google.com/webmasters/bin/answer.py?hl=en&answer=136085

?>

            <script type="text/javascript">
            //<![CDATA[
                var GOOG_FIXURL_LANG = '<?php echo get_instance()->lang->code(); ?>';
                var GOOG_FIXURL_SITE = BASE_URL;
            //]]>
            </script>

            <script type="text/javascript"
                src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js">
            </script>

        </div>

        <script type="text/javascript">
        //<![CDATA[

        $(function () {

            // The script fixurl.js is slow, this is why it is loaded
            // within a hidden div-element at the bottom of this partial.
            // After the page has been loaded, the generated form is to be
            // moved and shown on its visual place.
            try {
                var fixurl_form = $('#goog-fixurl').html();
                $('#google_search_form_hidden').html('');
                $('#google_search_form').html(fixurl_form);
                $('#google_search_form').show();

                jQuery(function( $ ) {
                    $('#goog-wm form').addClass('form-inline');
                    $('#goog-wm-sb').addClass('btn btn-primary');
                    $('#goog-wm-qt').addClass('form-control');
                });
            } catch (ex) {}

        });

        //]]>
        </script>

    </section><!--/#error-->
