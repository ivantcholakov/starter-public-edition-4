<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-6">
    <h4 class="title"><?php echo lang('users history id_trans'); ?> <?php echo $transactions['id'] ?></h4>
  </div>
  <div class="col-md-6 hidden-xs">
    <button onclick="window.print()" class="btn btn-primary margin-left-10 pull-right"><i class="icon-printer icons"></i> <?php echo lang('users history print'); ?></button>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <div class="col-md-3 col-xs-6">
        <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin:<?php echo $transactions['user_comment'] ?>" class="img-responsive center-block">
      </div>   
      <div class="col-md-8 col-xs-6">
        <h4><?php echo lang('users merchants btc_address'); ?>: <?php echo $transactions['user_comment'] ?></h4>
        <p><?php echo lang('users merchants btc_order'); ?> <?php echo $rate; ?> BTC. <?php echo lang('users merchants btc_total'); ?> <?php echo $transactions['amount'] ?> <?php echo $this->currencys->display->base_code ?> <?php echo lang('users merchants btc_completed'); ?>. <?php echo lang('users merchants btc_warning'); ?></p>
      </div>
      <div class="col-md-12 col-xs-12">
        <div class="form-group pull-right hidden-print">
          <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>