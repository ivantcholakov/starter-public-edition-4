<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (isset($contact_map) && $contact_map != '') {

?>

                <h4><i18n>contact_our_location</i18n></h4>

                <div class="thumbnail">
                    <?php echo $contact_map; ?>
                </div>
<?php

}
