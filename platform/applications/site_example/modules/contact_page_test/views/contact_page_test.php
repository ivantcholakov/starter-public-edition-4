<?php defined('BASEPATH') OR exit('No direct script access allowed');

$show_map = $this->settings->get('contact_show_map');
$show_contact_info = $this->settings->get('contact_show_info');
$show_info_pane = $this->settings->get('contact_show_map') || $this->settings->get('contact_show_info');

?>

    <section id="contact-page" class="container">

        <div class="row">

            <div class="col-sm-<?php echo $show_info_pane ? 8 : 12; ?>">



<?php

echo Modules::run('contact_form_widget/index');


?>
            </div>

<?php

if ($show_info_pane) {

?>

            <div class="col-sm-4">
<?php

    if ($show_contact_info) {

        echo Modules::run('contact_map_widget/index');
    }

    if ($show_contact_info) {

        echo Modules::run('contact_info_widget/index');
    }

?>

            </div>

<?php
}

?>

        </div>

    </section>


