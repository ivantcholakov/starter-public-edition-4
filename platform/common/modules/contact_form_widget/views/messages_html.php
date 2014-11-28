<?php defined('BASEPATH') OR exit('No direct script access allowed');

$success = !empty($success);
$single_message = isset($single_message) ? $single_message : true;
$message = isset($message) ? $message : '';

?>

                <div class="status alert <?php if ($success) { ?>alert-success<?php } else { ?>alert-danger<?php } ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?php

if ($single_message) {

?>

                    <?php echo $message; ?>
<?php

} else {

?>

                    <ul>
<?php

    foreach ($messages as $message) {

?>

                        <li><?php echo $message; ?></li>
<?php

    }

?>

                    </ul>
<?php
}

?>

                </div>
