<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="header-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-6 col-xs-7">
						<h3><?php echo lang('core payment status'); ?></h3>
					</div>
				</div>
			</div>
</div>

<div class="container theme-showcase" role="main">
  
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default box-shadow">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 payment-icon text-center">
							<i class="icon-check icons text-success"></i>
							<h3><?php echo lang('core payment success'); ?></h3>
							<p><?php echo lang('core payment success_text'); ?></p>
							<a href="<?php echo base_url('account/history'); ?>" class="btn btn-primary"><?php echo lang('users title history'); ?></a>
						</div>
						
						</div>
							</div>
					</div>
				</div>
    </div>
  </div>