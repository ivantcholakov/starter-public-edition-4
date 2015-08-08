<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
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
                </ul>
