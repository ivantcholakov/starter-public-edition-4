<?php defined('BASEPATH') OR exit('No direct script access allowed');

foreach ($language_switcher as $key => $item) {

    if (!empty($item['active'])) {
?>

    <big><?php echo $item['link']; ?></big>
<?php

    } else {

?>

    <?php echo $item['link']; ?>

<?php
    }
}
