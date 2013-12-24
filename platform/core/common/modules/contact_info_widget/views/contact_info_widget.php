<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!isset($contacts) || !is_array($contacts)) {
    $contacts = array();
}

foreach ($contacts as $item) {

?>

                    <h4><?php echo $item['contact_label']; ?></h4>

                    <ul class="fa-ul">

<?php

    if (isset($item['contact_address'])) {
?>
                        <li i18n:title="contact_address"><i class="fa-li fa fa-map-marker fa-lg"></i><?php echo $item['contact_address']; ?></li>
<?php
    }

    if (isset($item['contact_phone'])) {
?>
                        <li i18n:title="contact_phone"><i class="fa-li fa fa-phone fa-lg"></i><?php echo $item['contact_phone']; ?></li>
<?php
    }

    if (isset($item['contact_fax'])) {
?>
                        <li i18n:title="contact_fax"><i class="fa-li fa fa-print fa-lg"></i><?php echo $item['contact_fax']; ?></li>
<?php
    }

    if (isset($item['contact_email'])) {
?>
                        <li i18n:title="contact_email"><i class="fa-li fa fa-envelope-o fa-lg"></i><?php echo auto_link($item['contact_email']); ?></li>
<?php
    }

    if (isset($item['contact_person'])) {
?>
                        <li i18n:title="contact_person"><i class="fa-li fa fa-user fa-lg"></i><?php echo $item['contact_person']; ?></li>
<?php
    }

    if (isset($item['contact_web_site'])) {
?>
                        <li i18n:title="contact_web_site"><i class="fa-li fa fa-link fa-lg"></i><?php echo auto_link($item['contact_web_site']); ?></li>
<?php
    }

    if (isset($item['contact_facebook'])) {
?>
                        <li i18n:title="contact_facebook"><i class="fa-li fa fa-facebook fa-lg"></i><?php echo auto_link($item['contact_facebook']); ?></li>
<?php
    }

    if (isset($item['contact_twitter'])) {
?>
                        <li i18n:title="contact_twitter"><i class="fa-li fa fa-twitter fa-lg"></i><?php echo auto_link($item['contact_twitter']); ?></li>
<?php
    }

    if (isset($item['contact_google_plus'])) {
?>
                        <li i18n:title="contact_google_plus"><i class="fa-li fa  fa-google-plus fa-lg"></i><?php echo auto_link($item['contact_google_plus']); ?></li>
<?php
    }

    if (isset($item['contact_linkedin'])) {
?>
                        <li i18n:title="contact_linkedin"><i class="fa-li fa fa-linkedin fa-lg"></i><?php echo auto_link($item['contact_linkedin']); ?></li>
<?php
    }

    if (isset($item['contact_github'])) {
?>
                        <li i18n:title="contact_github"><i class="fa-li fa fa-github fa-lg"></i><?php echo auto_link($item['contact_github']); ?></li>
<?php
    }

?>

                    </ul>
<?php

}
