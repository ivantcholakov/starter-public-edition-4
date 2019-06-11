<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="header-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-6 col-xs-7">
						<h3><?php echo lang('core payment order'); ?> <?php echo $order; ?></h3>
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
						<div class="col-md-12">
							<h1><?php echo $amount; ?> <?php echo $this->currencys->display->base_code ?></h1>
							<h4><?php echo $item_name; ?></h4>
						</div>
						<div class="col-md-12">
							<div class="bs-callout bs-callout-danger">
              <h4><?php echo lang('core payment ver_title'); ?></h4>
              <p><?php echo lang('core payment ver_msg'); ?></p>
            </div>
						<div class="row">
						<div class="col-md-12">

							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="home">
								<form id="check" action="">
									<div class="plan-card-group">
										<div class="row">
											
											<?php if($this->commission->display->ux_check) : ?>
											<?php // UX Wallet ?>
											<div class="col-md-6 col-xs-6">
												<div class="radio-card">
													<input type="radio" class="planes-radio" name="method" value="ux" id="10"/>
													<label for="10" id="10">
														<span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/ux.png" alt=""></span>
													</label>
												</div>
											</div>
											<?php endif; ?>
											
											<?php if($this->commission->display->check_pp_sci) : ?>
											<?php // PayPal ?>
											<div class="col-md-6 col-xs-6">
												<div class="radio-card">
													<input type="radio" class="planes-radio" name="payment" value="paypal" id="2"/>
													<label for="2" id="2">
														<span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/paypal.png" alt=""></span>
													</label>
												</div>
											</div>
											<?php endif; ?>

											<?php if($this->commission->display->check_btc_sci) : ?>
											<?php // BTC ?>
											<div class="col-md-6 col-xs-6">
												<div class="radio-card">
													<input type="radio" class="planes-radio" name="payment" value="btc" id="3"/>
													<label for="3" id="3">
														<span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/btc.png" alt=""></span>
													</label>
												</div>
											</div>
											<?php endif; ?>

											<?php if($this->commission->display->check_adv_sci) : ?>
											<?php // ADV ?>
											<div class="col-md-6 col-xs-6">
												<div class="radio-card">
													<input type="radio" class="planes-radio" name="payment" value="adv" id="4"/>
													<label for="4" id="4">
														<span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/adv.png" alt=""></span>
													</label>
												</div>
											</div>
											<?php endif; ?>

											</form>

											<?php if($this->commission->display->check_payeer_sci) : ?>
											<?php // Payeer ?>
											<div class="col-md-6 col-xs-6">
												<div class="radio-card">
													<input type="radio" class="planes-radio" name="payment" value="payeer" id="9"/>
													<label for="9" id="9">
														<span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/payeer.png" alt=""></span>
													</label>
												</div>
											</div>
											<?php endif; ?>

											<?php if($this->commission->display->check_perfect_sci) : ?>
											<?php // Perfect ?>
											<div class="col-md-6 col-xs-6">
												<div class="radio-card">
													<input type="radio" class="planes-radio" name="method" value="perfect" id="8"/>
													<label for="8" id="8">
														<span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/perfect.png" alt=""></span>
													</label>
												</div>
											</div>
											<?php endif; ?>

											<?php if($this->commission->display->swift_sci_check) : ?>
											<?php // SWIFT ?>
											<div class="col-md-6 col-xs-6">
												<div class="radio-card">
													<input type="radio" class="planes-radio" name="method" value="swift" id="7"/>
													<label for="7" id="7">
														<span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/swift.png" alt=""></span>
													</label>
												</div>
											</div>
											<?php endif; ?>

											<div class="col-md-12">
												<div class="pull-right">
													<a href="#payment" data-toggle="tab" class="btn btn-primary">
														<?php echo lang('core payment continue'); ?>
													</a>
												</div>
											</div>
										</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="profile">
								
								</div>
								<div class="tab-pane" id="payment">
									<?php if($this->commission->display->ux_check) : ?>
									<?php echo form_open(site_url("SCI/ux_pay/"), array("id" => "ux")) ?>
									<input type="hidden" name="captcha_time" value="<?php echo $captcha_time; ?>">
									<div class="row">
										<div class="col-md-12">
												<div class="form-group">
													<label for="exampleInputEmail1"><?php echo lang('users col username'); ?></label>
													<input type="text" class="form-control" name="username" id="login" placeholder="user">
												</div>
											
												<div class="form-group">
													<label for="exampleInputEmail1"><?php echo lang('users input password'); ?></label>
													<input type="password" name="password" class="form-control" id="password" placeholder="********">
												</div>
										</div>
										
										<div class="col-md-4">
											
											<div class="form-group">
													
            							<?php echo $captcha_image; ?>
											</div>
											
										</div>
										
										<div class="col-md-8">
											
											<div class="form-group">
													<label for="exampleInputEmail1">CAPTCHA</label>
													<input type="text" class="form-control" name="captcha" id="login" placeholder="Enter lagin or email">
												</div>
											
										</div>

										<div class="col-md-12">
											<input type="hidden" class="form-control" name="amount" value="<?php echo $amount; ?>">
											<input type="hidden" name="merchant" value="<?php echo $merchant; ?>" />
												
											<div class="pull-right">
												<a href="#home" data-toggle="tab" class="btn btn-default"><?php echo lang('core button cancel'); ?></a>
												<button type="submit" class="btn btn-primary"><?php echo lang('core payment go'); ?></button>
										</div>
										
										</div>
										
									</div>
									<?php echo form_close(); ?> 
									<?php endif; ?>
									
									<?php if($this->commission->display->check_pp_sci) : ?>
                <form id="paypal" name=paypal method="post" action="https://www.paypal.com/cgi-bin/webscr" accept-charset="UTF-8">
                  <input type="hidden" name="charset" value="utf-8" />
                  <input type="hidden" name="cmd" value="_xclick" />
                  <input type="hidden" name="item_number" value="<?php echo $order; ?>" />
                  <input type="hidden" name="item_name" value="<?php echo $item_name; ?>" />
                  <input type="hidden" name="quantity" value="1" />
                  <input type="hidden" name="custom" value="<?php echo $merchant; ?>" />
                  <input type="hidden" name="receiver_email" value="<?php echo $this->commission->display->account_pp_sci ?>" />
                  <input type="hidden" name="business" value="<?php echo $this->commission->display->account_pp_sci ?>" />
                  <input type="hidden" name="notify_url" value="<?php echo base_url();?>SCI/sci_paypal" />
                  <input type="hidden" name="return" value="<?php echo base_url();?>SCI/success" />
                  <input type="hidden" name="cancel_return" value="<?php echo base_url();?>SCI/fail" />
                  <input type="hidden" name="no_shipping" value="1" />
                  <input type="hidden" name="currency_code" value="<?php echo $this->currencys->display->base_code ?>"> 
                  <input type="hidden" name="no_note" value="1" />
                  <input type="hidden" class="form-control" name="amount" value="<?php echo $amount; ?>">
                  <div class="row">
										<div class="col-md-12">
											<div class="bs-callout-warning">
                        <p><?php echo lang('core payment agreement'); ?></p>
                    	</div>
											<div class="pull-right">
												<a href="#home" data-toggle="tab" class="btn btn-default"><?php echo lang('core button cancel'); ?></a>
												<button type="submit" class="btn btn-primary"><?php echo lang('core payment go'); ?></button>
											</div>
										</div>
									</div>

              </form>
						<?php endif; ?>
								
									<?php if($this->commission->display->check_adv_sci) : ?>
									<?php echo form_open(site_url("SCI/form_advcash/"), array("id" => "adv")) ?>
									<input type="hidden" name="order" value="<?php echo $order; ?>" />
									<input type="hidden" name="merchant" value="<?php echo $merchant; ?>" />
									<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
									<input type="hidden" name="custom" value="<?php echo $custom; ?>" />
										<div class="row">
										<div class="col-md-12">
											<div class="bs-callout-warning">
                        <p><?php echo lang('core payment agreement'); ?></p>
                    	</div>
											<div class="pull-right">
												<a href="#home" data-toggle="tab" class="btn btn-default"><?php echo lang('core button cancel'); ?></a>
												<button type="submit" class="btn btn-primary"><?php echo lang('core payment go'); ?></button>
											</div>
										</div>
									</div>
									<?php echo form_close(); ?> 
									<?php endif; ?>
									
									<?php if($this->commission->display->check_payeer_sci) : ?>
									<?php echo form_open(site_url("SCI/form_payeer/"), array("id" => "payeer")) ?>
									<input type="hidden" name="order" value="<?php echo $order; ?>" />
									<input type="hidden" name="merchant" value="<?php echo $merchant; ?>" />
									<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
									<input type="hidden" name="custom" value="<?php echo $custom; ?>" />
										<div class="row">
										<div class="col-md-12">
											<div class="bs-callout-warning">
                        <p><?php echo lang('core payment agreement'); ?></p>
                    	</div>
											<div class="pull-right">
												<a href="#home" data-toggle="tab" class="btn btn-default"><?php echo lang('core button cancel'); ?></a>
												<button type="submit" class="btn btn-primary"><?php echo lang('core payment go'); ?></button>
											</div>
										</div>
									</div>
									<?php echo form_close(); ?> 
									<?php endif; ?>
									
									<?php if($this->commission->display->check_perfect_sci) : ?>
									<form action="https://perfectmoney.is/api/step1.asp" id="perfect" method="POST">
										<input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $this->commission->display->account_perfect_sci ?>">
										<input type="hidden" name="PAYEE_NAME" value="<?php echo $order; ?>">
										<input type="hidden" name="PAYMENT_ID" value="<?php echo $merchant; ?>">
										<input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $amount; ?>">
										<input type="hidden" name="PAYMENT_UNITS" value="<?php echo $this->currencys->display->base_code ?>">
										<input type="hidden" name="STATUS_URL" value="<?php echo base_url();?>SCI/sci_perfect">
										<input type="hidden" name="PAYMENT_URL" value="<?php echo base_url();?>SCI/success">
										<input type="hidden" name="PAYMENT_URL_METHOD" value="LINK">
										<input type="hidden" name="NOPAYMENT_URL" value="<?php echo base_url();?>SCI/fail">
										<input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK">

										<input type="hidden" name="BAGGAGE_FIELDS" value="">
										<div class="row">
										<div class="col-md-12">
											<div class="bs-callout-warning">
                        <p><?php echo lang('core payment agreement'); ?></p>
                    	</div>
											<div class="pull-right">
												<a href="#home" data-toggle="tab" class="btn btn-default"><?php echo lang('core button cancel'); ?></a>
												<button type="submit" name="PAYMENT_METHOD" class="btn btn-primary"><?php echo lang('core payment go'); ?></button>
											</div>
										</div>
									</div>
									</form>
									<?php endif; ?>
									
									<?php if($this->commission->display->swift_sci_check) : ?>
									<form id="swift">
										<?php echo $this->commission->display->swift_desc_sci ?>
									</form>
									<?php endif; ?>
					
									<?php if($this->commission->display->check_btc_sci) : ?>
									<?php echo form_open(site_url("SCI/start_blockchain/"), array("id" => "btc")) ?>
										<input type="hidden" name="order" value="<?php echo $order; ?>">
										<input type="hidden" name="merchant" value="<?php echo $merchant; ?>">
										<input type="hidden" class="form-control" name="amount" value="<?php echo $amount; ?>">
										<div class="row">
										<div class="col-md-12">
											<div class="form-group">
													<label for="exampleInputEmail1">Email</label>
													<input type="email" class="form-control" name="custom" id="custom" placeholder="Enter your email">
												</div>
											<div class="bs-callout-warning">
                        <p><?php echo lang('core payment agreement'); ?></p>
                    	</div>
											<div class="pull-right">
												<a href="#home" data-toggle="tab" class="btn btn-default"><?php echo lang('core button cancel'); ?></a>
												<button type="submit" class="btn btn-primary"><?php echo lang('core payment go'); ?></button>
											</div>
										</div>
									</div>
									<?php echo form_close(); ?> 
									<?php endif; ?>
								
								</div>
							</div>	
						</div>
						</div>
							</div>
					</div>
				</div>
    </div>
    </div>
  </div>
  
</div>

<script>
var forms = document.querySelectorAll('form');
var radios = document.querySelectorAll('form#check input[type=radio]');
forms[0].addEventListener("click",function(e) {  
  if(e.target && e.target.nodeName == "INPUT") {
    hideFormsButFirst();
    setFormVisible(e.target.value);    
	}
});

function hideFormsButFirst() {
  for (var i = 0; i < forms.length; ++i) {
    forms[i].style.display = 'none';
  }
  forms[0].style.display = 'block';
}

function setFormVisible(id = "paypal") {
    var form = document.getElementById(id);         
    form.style.display = 'block';                              
}

function init() {
    hideFormsButFirst();
    setFormVisible();
}

init();
</script>