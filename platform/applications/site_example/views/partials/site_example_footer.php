<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <footer id="footer">
        <div class="container">
            <p class="text-muted pull-left"><?php echo str_replace(array('{year}', '{organization}'), array(date('Y'), $this->settings->lang('contact_organization')), $this->settings->lang('copyright_note')); ?></p>
            <a id="scroll-top" href="<?php echo CURRENT_URI; ?>#page-top" title="<?php echo lang('ui_go_to_top'); ?>"><i class="fa fa-chevron-up"></i></a>
        </div>
    </footer>
