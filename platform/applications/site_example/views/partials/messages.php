<?php defined('BASEPATH') OR exit('No direct script access allowed');

$success = !empty($success);
$messages = isset($messages) ? $messages : array();

if (!is_array($messages)) {
    $messages = array($messages);
}

if (count($messages) > 0) {

?>

                <div class="status alert <?php if ($success) { ?>alert-success<?php } else { ?>alert-danger<?php } ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?php

    if (count($messages) == 1) {

?>

                    <?php echo reset($messages); ?>
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

<?php
}
