<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <div class="row">
            <div class="column">

                <div class="ui breadcrumb">
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
                    <a href="<?php echo $breadcrumb['uri']; ?>" class="section"><?php echo $breadcrumb['name']; ?></a>
                    <span class="divider">/</span>
<?php
        } else {
?>
                    <div class="active section"><?php echo $breadcrumb['name']; ?></div>
<?php
        }

        $i++;
    }
?>

                </div>

            </div>
        </div>
