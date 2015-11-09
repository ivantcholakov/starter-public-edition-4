<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!isset($subnavbar_item_active)) {
    $subnavbar_item_active = '';
}

?>

                <ul class="nav nav-pills">
                    <li<?php if ($subnavbar_item_active == 'restserver') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/rest/server'); ?>">REST Server</a></li>
                    <li<?php if ($subnavbar_item_active == 'curl') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/rest/curl'); ?>">Curl Library</a></li>
                    <li<?php if ($subnavbar_item_active == 'restclient') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/rest/client'); ?>">Rest Client Library</a></li>
                    <li<?php if ($subnavbar_item_active == 'requests') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/rest/requests'); ?>">Requests HTTP Library</a></li>

<?php /* The Guzzle client tests stays dormant for now, it requires PHP 5.5. If you want to activate it, install using Composer Guzzle 6 ("guzzlehttp/guzzle": "~6.0" uder "require" section) and uncomment the following menu item.
                    <li<?php if ($subnavbar_item_active == 'guzzle_client') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/rest/guzzle'); ?>">Guzzle HTTP Client</a></li>
*/ ?>

                    <li<?php if ($subnavbar_item_active == 'post_test') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/rest/post-test'); ?>">Testing a POST request</a></li>
                </ul>
