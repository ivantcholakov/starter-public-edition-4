<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo $ticket['title'] ?></h4>
      </div>
      <div class="col-md-6 hidden-xs">
        <?if($ticket['status']<3){?>
        <a href="<?php echo base_url();?>account/close_ticket/<?php echo $ticket['id']; ?>" class="btn btn-success margin-left-10 pull-right"><?php echo lang('users tickets close'); ?></a>
        <?}else{?>
        <?}?>
        <button onclick="window.print()" class="btn btn-primary margin-left-10 pull-right"><i class="icon-printer icons"></i> <?php echo lang('users history print'); ?></button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4 col-xs-6">
                <div class="form-group">
                  <label><?php echo lang('users tickets id'); ?></label>
                  <p class="form-control-static"><?php echo $ticket['id'] ?></p>
                </div>
              </div>
              <div class="col-md-4 col-xs-6">
                <div class="form-group">
                  <label><?php echo lang('users tickets date'); ?></label>
                  <p class="form-control-static"><?php echo $ticket['date'] ?></p>
                </div>
              </div>
              <div class="col-md-4 col-xs-6">
                <div class="form-group">
                  <label><?php echo lang('users disputes status'); ?></label>
                  <p class="form-control-static"><?if($ticket['status']==2){?>
                  <span class="label label-primary"><?php echo lang('users tickets untreated'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($ticket['status']==1){?>
                  <span class="label label-success"><?php echo lang('users tickets processed'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($ticket['status']==3){?>
                  <span class="label label-danger"><?php echo lang('users tickets closed'); ?></span>
                 <?}else{?>
                 <?}?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <h4 class="title">
          <?php echo lang('users tickets message'); ?>
        </h4>
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo $ticket['message'] ?>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <?php foreach($log_comment->result() as $view) : ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo $view->comment ?>
          </div>
          <div class="panel-footer"><i class="icon-clock icons"></i> <?php echo $view->date ?></div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="col-md-12">
        <?php if(!$ticket['comments']) : ?>
        <?php echo form_open(site_url("account/add_ticket_comment/" . $ticket['id']), array("" => "")) ?>
        <div class="form-group">
          <label><?php echo lang('users tickets new'); ?></label>
          <textarea class="form-control" name="comment" rows="8"></textarea>
        </div>
        <div class="pull-right">
          <button class="btn btn-primary">
            <?php echo lang('users tickets reply'); ?>
          </button>
        </div>
        <?php echo form_close(); ?>  
        <?php endif; ?>
      </div>
  </div>
                
                
          