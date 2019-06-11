<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users tickets form'); ?></h4>
      </div>
      <div class="col-md-6 hidden-xs">
        <a href="/account/support" class="btn btn-primary margin-left-10 pull-right"><i class="icon-action-undo icons"></i> <?php echo lang('users disputes back'); ?></a>
      </div>
    </div>
    <?php echo form_open(site_url("account/start_ticket/"), array("" => "")) ?>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                 <div class="form-group">
                    <label><?php echo lang('users tickets title'); ?></label>
                    <input type="text" class="form-control" name="title">
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo lang('users tickets message'); ?></label>
                    <textarea class="form-control" rows="10" name="message"></textarea>
                  </div>
              </div>
              <div class="col-md-12">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">
                    <?php echo lang('users tickets send'); ?>
                  </button>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>  
     
    </div>

