<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="header-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-6 col-xs-7">
						<h3>Make payment</h3>
					</div>
				</div>
			</div>
</div>

<div class="container theme-showcase" role="main">
  
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default box-shadow">
				<div class="panel-body">
					<div class="row">
									<div class="col-md-4 col-xs-12">
										<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin:<?php echo $btc_order['adress'] ?>" class="img-responsive center-block">
									</div>

									<div class="col-md-8 col-xs-12">
										<h4><?php echo lang('core merchants btc_address'); ?>: <?php echo $btc_order['adress'] ?></h4>
            <p><?php echo lang('core merchants btc_order'); ?> <?php echo $rate; ?> BTC. <?php echo lang('core merchants btc_total'); ?> <?php echo $btc_order['amount'] ?> <?php echo $this->currencys->display->base_code ?> <?php echo lang('core merchants btc_completed'); ?>. <?php echo lang('core merchants btc_warning'); ?></p>
									</div>

									<div class="col-md-12 col-xs-12">
										<div class="form-group pull-right hidden-print">
											<a class="btn btn-default" href="#"><?php echo lang('core button cancel'); ?></a>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
    </div>
  </div>