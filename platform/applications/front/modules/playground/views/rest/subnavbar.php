<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!isset($subnavbar_item_active)) {
    $subnavbar_item_active = '';
}

?>

                <div class="ui secondary stackable wrappable menu">
                    <a class="<?php if ($subnavbar_item_active == 'restserver') { ?>active <?php } ?>item" href="<?php echo site_url('playground/rest/server'); ?>">REST Server</a>
                    <a class="<?php if ($subnavbar_item_active == 'curl') { ?>active <?php } ?>item" href="<?php echo site_url('playground/rest/curl'); ?>">Curl Library</a>
                    <a class="<?php if ($subnavbar_item_active == 'restclient') { ?>active <?php } ?>item" href="<?php echo site_url('playground/rest/client'); ?>">Rest Client Library</a>
                    <a class="<?php if ($subnavbar_item_active == 'guzzle_client') { ?>active <?php } ?>item" href="<?php echo site_url('playground/rest/guzzle'); ?>">Guzzle HTTP Client</a>
                    <a class="<?php if ($subnavbar_item_active == 'post_test') { ?>active <?php } ?>item" href="<?php echo site_url('playground/rest/post-test'); ?>">Testing a POST request</a>
                </div>
