<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-6">
    <h4 class="title"><?php echo lang('users vouchers ac'); ?></h4>
  </div>
  <div class="col-md-6 hidden-xs">
    <a href="/account/vouchers" class="btn btn-default margin-left-10 pull-right"><i class="icon-action-undo icons"></i> <?php echo lang('users disputes back'); ?></a>
  </div>
</div>
<?php echo form_open(site_url("account/start_activate_code/"), array("" => "")) ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label><?php echo lang('users vouchers code_v'); ?></label>
              <input type="text" class="form-control" name="code">
            </div>
          </div>
          <div class="col-md-12">
            <div class="pull-right">
              <button type="submit" class="btn btn-primary">
                <?php echo lang('users vouchers now'); ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<?php echo form_close(); ?>