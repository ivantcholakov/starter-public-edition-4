<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!empty($theme_switcher)) {

    $i = 0;

    foreach ($theme_switcher as $key => $item) {

        if ($i > 0) {
            echo ' | ';
        }

        $anchor = anchor($item['link'], $item['label']);

        if (!empty($item['active'])) {
?>

    <strong><?php echo $anchor; ?></strong>
<?php

        } else {

?>

    <?php echo $anchor; ?>

<?php
        }

        $i++;
    }
}
