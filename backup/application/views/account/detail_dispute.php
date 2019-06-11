<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-6">
    <h4 class="title">ID <?php echo $dispute['id'] ?>: <?if($dispute['title'] == 1){?>
      <?php echo lang('users history not_received'); ?>
      <?}else{?>
      <?}?><?if($dispute['title'] == 2){?>
        <?php echo lang('users history not_desk'); ?>
      <?}else{?>
      <?}?>
    </h4>
  </div>
  <div class="col-md-6 hidden-xs">
    <div class="btn-group margin-left-10 pull-right">
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><?php echo lang('users dispute action'); ?> <span class="caret"></span></button>
      <ul class="dropdown-menu" role="menu">
        <?if($dispute['status'] == 1){?>
        <li><a href="<?php echo base_url();?>account/open_claim/<?php echo $dispute['id']; ?>"><?php echo lang('users dispute start_claim'); ?></a></li>
        <?}else{?>
        <?}?>
        <?if($user['username'] == $dispute['claimant']){?>
        <?if($dispute['status'] == 1){?>
        <li><a href="<?php echo base_url();?>account/close_claim/<?php echo $dispute['id']; ?>"><?php echo lang('users dispute close_claim'); ?></a></li>
        <?}else{?>
        <?}?>
        <?}else{?>
        <?}?>
        <?if($user['username'] == $dispute['claimant']){?>
        <?if($dispute['status'] == 2){?>
        <li><a href="<?php echo base_url();?>account/close_claim/<?php echo $dispute['id']; ?>"><?php echo lang('users dispute close_claim'); ?></a></li>
        <?}else{?>
        <?}?>
        <?}else{?>
        <?}?>
        <li><a href="<?php echo $cancel_url; ?>"><?php echo lang('users disputes back'); ?></a></li>
      </ul>
    </div>
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
              <label><?php echo lang('users disputes status'); ?></label>
              <p class="form-control-static"><?if($dispute['status'] == 1){?>
                <span class="label label-primary"><?php echo lang('users disputes open'); ?></span>
                <?}else{?>
                <?}?>
                <?if($dispute['status'] == 2){?>
                <span class="label label-danger"><?php echo lang('users disputes claim'); ?></span>
                <?}else{?>
                <?}?>
                <?if($dispute['status'] == 3){?>
                <span class="label label-warning"><?php echo lang('users disputes rejected'); ?></span>
                <?}else{?>
                <?}?>
                <?if($dispute['status'] == 4){?>
                <span class="label label-success"><?php echo lang('users disputes satisfied'); ?></span>
                <?}else{?>
                <?}?>
              </p>
            </div>
            <div class="form-group">
              <label><?php echo lang('users disputes time_dispute'); ?></label>
              <p class="form-control-static"><?php echo $dispute['time_dispute'] ?></p>
            </div>
            <div class="form-group">
              <label><?php echo lang('users trans sum'); ?></label>
              <p class="form-control-static"><?php echo $dispute['sum'] ?> <?if($dispute['currency'] == 'debit_base'){?>
                <?php echo $this->currencys->display->base_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra1'){?>
                  <?php echo $this->currencys->display->extra1_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra2'){?>
                  <?php echo $this->currencys->display->extra2_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra3'){?>
                  <?php echo $this->currencys->display->extra3_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra4'){?>
                  <?php echo $this->currencys->display->extra4_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra5'){?>
                  <?php echo $this->currencys->display->extra5_code ?>
                <?}else{?>
                <?}?>
              </p>
            </div>
          </div>
          <div class="col-md-4 col-xs-6">
            <div class="form-group">
              <label><?php echo lang('users disputes id_tran'); ?></label>
              <p class="form-control-static"><?php echo $dispute['transaction'] ?></p>
            </div>
            <div class="form-group">
              <label><?php echo lang('users disputes claimant'); ?></label>
              <p class="form-control-static"><?php echo $dispute['claimant'] ?></p>
            </div>
            <div class="form-group">
              <label><?php echo lang('users trans fee'); ?></label>
              <p class="form-control-static"><?php echo $dispute['fee'] ?> <?if($dispute['currency']=='debit_base'){?>
                <?php echo $this->currencys->display->base_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra1'){?>
                  <?php echo $this->currencys->display->extra1_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra2'){?>
                  <?php echo $this->currencys->display->extra2_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra3'){?>
                  <?php echo $this->currencys->display->extra3_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra4'){?>
                  <?php echo $this->currencys->display->extra4_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency'] == 'debit_extra5'){?>
                  <?php echo $this->currencys->display->extra5_code ?>
                <?}else{?>
                <?}?>
              </p>
            </div>
          </div>
          <div class="col-md-4 col-xs-6">
            <div class="form-group">
              <label><?php echo lang('users disputes id_tran_time'); ?></label>
              <p class="form-control-static"><?php echo $dispute['time_transaction'] ?></p>
            </div>
            <div class="form-group">
              <label><?php echo lang('usersn disputes defendant'); ?></label>
              <p class="form-control-static"><?php echo $dispute['defendant'] ?></p>
            </div>
            <div class="form-group">
              <label><?php echo lang('users trans amount'); ?></label>
              <p class="form-control-static"><?php echo $dispute['amount'] ?> <?if($dispute['currency']=='debit_base'){?>
                <?php echo $this->currencys->display->base_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency']=='debit_extra1'){?>
                  <?php echo $this->currencys->display->extra1_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency']=='debit_extra2'){?>
                  <?php echo $this->currencys->display->extra2_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency']=='debit_extra3'){?>
                  <?php echo $this->currencys->display->extra3_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency']=='debit_extra4'){?>
                  <?php echo $this->currencys->display->extra4_code ?>
                <?}else{?>
                <?}?>
                <?if($dispute['currency']=='debit_extra5'){?>
                  <?php echo $this->currencys->display->extra5_code ?>
                <?}else{?>
                <?}?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <h4 class="title"><?php echo lang('users disputes overwiev'); ?></h4>
    <div class="alert alert-info"><?php echo $dispute['message'] ?></div>
    <hr>
    <?php foreach($log_comment->result() as $view) : ?>
    <div class="panel panel-<?if($view->role==1){?>default<?}else{?><?}?><?if($view->role==2){?>primary<?}else{?><?}?><?if($view->role==3){?>warning<?}else{?><?}?><?if($view->role==4){?>danger<?}else{?><?}?><?if($view->role==5){?>success<?}else{?><?}?>">
      <div class="panel-heading"><strong><?php echo $view->user ?></strong></div>
      <div class="panel-body">
        <?php echo $view->comment ?>
      </div>
      <div class="panel-footer"><i class="icon-clock icons"></i> <?php echo $view->time ?></div>
    </div>
    <?php endforeach; ?>
    <?php if(!$dispute['comments']) : ?>
    <?php echo form_open(site_url("account/add_user_comment/" . $dispute['id']), array("" => "")) ?>
    <div class="form-group hidden-print">
      <label><?php echo lang('users disputes new_comment'); ?></label>
      <textarea class="form-control" rows="8" name="comment"></textarea>
    </div>
    <div class="pull-right">
      <button type="submit" name="submit" class="btn btn-primary"><?php echo lang('users disputes add_comment'); ?></button>
    </div>
    <?php echo form_close(); ?>
    <?php endif; ?>
  </div>
</div>