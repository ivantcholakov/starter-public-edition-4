<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users dispute list'); ?></h4>
      </div>
      <div class="col-md-6 hidden-xs">

      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php if ($total) : ?>
        <?php foreach ($dispute as $view) : ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-1 text-center alert-icon">
                 <?if($view['status']==1){?>
                 <i class="icon-hourglass icons text-warning"></i>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==2){?>
                 <i class="icon-hourglass icons text-warning"></i>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==3){?>
                 <i class="icon-bulb icons text-success"></i>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==4){?>
                 <i class="icon-bulb icons text-success"></i>
                 <?}else{?>
                 <?}?>
                 
              </div>
              <div class="col-md-9">
                <h4><?php echo lang('users dispute id'); ?>: <?php echo $view['id']; ?></h4>
                <p><?php echo lang('users dispute date'); ?>: <?php echo $view['time_dispute']; ?> | <?php echo lang('users history id_trans'); ?>: <?php echo $view['transaction']; ?> | <?php echo lang('users dispute claimant'); ?>: <?php echo $view['claimant']; ?></p>
              </div>
              <div class="col-md-2">
                <a href="/account/detail_dispute/<?php echo $view['id']; ?>" class="btn btn-primary btn-block margin-top-10"><?php echo lang('users trans detail'); ?></a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo lang('core error no_results'); ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <div class="col-md-12">
        <div class="pull-right">
                <?php echo $pagination; ?>
              </div>
      </div>
    </div>
