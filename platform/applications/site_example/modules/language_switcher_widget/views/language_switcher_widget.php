<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!empty($language_switcher)) {

    $i = 0;

    foreach ($language_switcher as $key => $item) {

        if ($i > 0) {
            echo ' | ';
        }

        if (isset($item['flag']) && $item['flag'] != '') {
            $anchor = anchor($item['link'], image('lib/flags-iso/flat/16/'.$item['flag'].'.png').' '.$item['label']);
        } else {
            $anchor = anchor($item['link'], $item['label']);
        }

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
