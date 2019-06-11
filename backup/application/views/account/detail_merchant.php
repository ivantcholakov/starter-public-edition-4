<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo $merchant['name'] ?></h4>
      </div>
      <div class="col-md-6 hidden-xs">

        <form method="POST" action="<?php echo base_url();?>SCI/form">

          <input type="hidden" name="order" value="134543" /> 
          <input type="hidden" name="merchant" value="<?php echo $merchant['id'] ?>" /> 
          <input type="hidden" name="item_name" value="Testing payment" />
          <input type="hidden" name="amount" value="350.00" />
          <input type="hidden" name="custom" value="comment" />
          <button type="submit" class="btn btn-primary margin-left-10 pull-right"><i class="icon-share-alt icons"></i> <?php echo lang('users merchants test'); ?></button>
          
        </form>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4 col-xs-6">
            <div class="form-group">
              <label><?php echo lang('users trans status'); ?></label>
              <p class="form-control-static"><?if($merchant['status']==1){?>
                  <span class="label label-success"><?php echo lang('users merchants active'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($merchant['status']==2){?>
                  <span class="label label-warning"><?php echo lang('users merchants moderation'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($merchant['status']==3){?>
                  <span class="label label-danger"><?php echo lang('users merchants disapproved'); ?></span>
                 <?}else{?>
                 <?}?></p>
            </div>
          </div>

          
          <div class="col-md-4 col-xs-6">

            <div class="form-group">
              <label><?php echo lang('users merchants name'); ?></label>
              <p class="form-control-static"><?php echo $merchant['name'] ?></p>
            </div>

          </div>
          
          <div class="col-md-4 col-xs-6">

            <div class="form-group">
              <label><?php echo lang('users merchants password'); ?></label>
              <p class="form-control-static"><?php echo $merchant['password'] ?></p>
            </div>

          </div>
          
          <div class="col-md-4 col-xs-8">

            <div class="form-group">
              <label><?php echo lang('users merchants url'); ?></label>
              <p class="form-control-static"><?php echo $merchant['link'] ?></p>
            </div>

          </div>
          
          <div class="col-md-4 col-xs-8">

            <div class="form-group">
              <label><?php echo lang('users merchants ipn'); ?></label>
              <p class="form-control-static"><?php echo $merchant['status_link'] ?></p>
            </div>

          </div>
          
          <div class="col-md-12 col-xs-12">
            <div class="form-group pull-right hidden-print">
              <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
