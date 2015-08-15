<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <ul class="nav nav-pills">
            <li<?php if ($this->registry->get('pjax_subnavbar_active') == 'home') { ?> class="active"<?php } ?>><a data-pjax href="<?php echo site_url('playground/pjax'); ?>">Pjax - Home Page</a></li>
            <li<?php if ($this->registry->get('pjax_subnavbar_active') == 'page_1') { ?> class="active"<?php } ?>><a data-pjax href="<?php echo site_url('playground/pjax/page-1'); ?>">Pjax - Test Page 1</a></li>
            <li<?php if ($this->registry->get('pjax_subnavbar_active') == 'page_2') { ?> class="active"<?php } ?>><a data-pjax href="<?php echo site_url('playground/pjax/page-2'); ?>">Pjax - Test Page 2</a></li>
        </ul>
