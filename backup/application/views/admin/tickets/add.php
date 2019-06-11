<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin button add_tickets'); ?></h3>
        </div>
     </div>
     <section class="example">
     <?php echo form_open(site_url("admin/tickets/add_ticket"), array("" => "")) ?>
     <div class="card-block">
      <div class="row">
        <div class="form-group col-sm-12">
            <label><?php echo lang('admin tickets user'); ?></label>
            <span class="required">*</span>
            <input type="text" class="form-control underlined" id="usernames" name="usernames" placeholder="<?php echo lang('admin tickets user'); ?>"> 
        </div>
        <div class="form-group col-sm-12">
            <label><?php echo lang('admin tickets title'); ?></label>
            <span class="required">*</span>
            <input type="text" class="form-control underlined" id="title" name="title" placeholder="<?php echo lang('admin tickets title'); ?>"> 
        </div>
        <div class="form-group col-sm-12">
            <label><?php echo lang('admin tickets message'); ?></label>
            <span class="required">*</span>
          <textarea class="form-control underlined" rows="12" id="message" name="message" placeholder="<?php echo lang('admin tickets message'); ?>"></textarea>
        </div>
      </div>
     </div>
     <div class="card-footer" style="text-align:right"> 
      <button type="submit"  class="btn btn-primary btn-sm"> <?php echo lang('admin tickets create'); ?></button>
    </div>
    <?php echo form_close(); ?>
    </section>
  </div>
 </div>
</div>