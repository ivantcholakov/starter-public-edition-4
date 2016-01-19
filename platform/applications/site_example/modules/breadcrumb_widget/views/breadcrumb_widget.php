<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <ol class="breadcrumb">
<?php

    $i = 1;

    foreach ($breadcrumbs as $breadcrumb) {

        //// Added by Ivan Tcholakov, 03-MAR-2015.
        //if ($i >= $n) {
        //    break;
        //}
        ////

        if ($i < $n) {
?>
                    <li><a href="<?php echo $breadcrumb['uri']; ?>"><?php echo $breadcrumb['name']; ?></a>
<?php
        } else {
?>
                    <li class="active"><?php echo $breadcrumb['name']; ?></li>
<?php
        }

        $i++;
    }
?>

            </ol>
