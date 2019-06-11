<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-6">
    <h4 class="title"><?php echo lang('users title form_deposit'); ?></h4>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <div class="tab-content">
      <div class="tab-pane active" id="home">
        <div class="row">
          <div class="col-md-12">
            <form id="check" action="">
              <div class="plan-card-group">
                <div class="row">
    							<?php if($this->commission->display->check_pp_dep) : ?>
                  <?php // PayPal ?>
                  <div class="col-md-4 col-xs-6">
                    <div class="radio-card">
                      <div class="fee"><?php echo $this->commission->display->fee_pp_dep ?>% + <?php echo $this->commission->display->fee_pp_fix_dep ?> <?php echo $this->currencys->display->base_code ?></div>
                      <input type="radio" class="planes-radio" name="payment" value="paypal" id="2"/>
                      <label for="2" id="2">
                        <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/paypal.png" alt=""></span>
                      </label>
                    </div>
                  </div>
  							  <?php endif; ?>
							
    							<?php if($this->commission->display->check_btc_dep) : ?>
                  <?php // BTC ?>
                  <div class="col-md-4 col-xs-6">
                    <div class="radio-card">
                      <div class="fee"><?php echo $this->commission->display->fee_btc_dep ?>% + <?php echo $this->commission->display->fee_btc_fix ?> <?php echo $this->currencys->display->base_code ?></div>
                      <input type="radio" class="planes-radio" name="payment" value="btc" id="3"/>
                      <label for="3" id="3">
                        <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/btc.png" alt=""></span>
                      </label>
                    </div>
                  </div>
    							<?php endif; ?>
              
    							<?php if($this->commission->display->check_adv_dep) : ?>
                  <?php // ADV ?>
                  <div class="col-md-4 col-xs-6">
                    <div class="radio-card">
                      <div class="fee"><?php echo $this->commission->display->fee_adv_dep ?>% + <?php echo $this->commission->display->fee_adv_fix ?> <?php echo $this->currencys->display->base_code ?></div>
                      <input type="radio" class="planes-radio" name="payment" value="adv" id="4"/>
                      <label for="4" id="4">
                        <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/adv.png" alt=""></span>
                      </label>
                    </div>
                  </div>
    							<?php endif; ?>
							
    							<?php if($this->commission->display->check_payeer_dep) : ?>
                  <?php // Payeer ?>
                  <div class="col-md-4 col-xs-6">
                    <div class="radio-card">
                      <div class="fee"><?php echo $this->commission->display->fee_payeer_dep ?>% + <?php echo $this->commission->display->fee_pay_fix ?> <?php echo $this->currencys->display->base_code ?></div>
                      <input type="radio" class="planes-radio" name="payment" value="payeer" id="9"/>
                      <label for="9" id="9">
                        <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/payeer.png" alt=""></span>
                      </label>
                    </div>
                  </div>
    							<?php endif; ?>

    							<?php if($this->commission->display->check_perfect) : ?>
                  <?php // Perfect ?>
                  <div class="col-md-4 col-xs-6">
                    <div class="radio-card">
                      <div class="fee"><?php echo $this->commission->display->fee_perfect ?>% + <?php echo $this->commission->display->fee_perf_fix ?> <?php echo $this->currencys->display->base_code ?></div>
                      <input type="radio" class="planes-radio" name="method" value="perfect" id="8"/>
                      <label for="8" id="8">
                        <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/perfect.png" alt=""></span>
                      </label>
                    </div>
                  </div>
    							<?php endif; ?>
              
    							<?php if($this->commission->display->swift_dep_check) : ?>
                  <?php // SWIFT ?>
                  <div class="col-md-4 col-xs-6">
                    <div class="radio-card">
                      <div class="fee"><?php echo $this->commission->display->fee_swift_dep ?>% + <?php echo $this->commission->display->fee_swift_fix ?> <?php echo $this->currencys->display->base_code ?></div>
                      <input type="radio" class="planes-radio" name="method" value="swift" id="7"/>
                      <label for="7" id="7">
                        <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/swift.png" alt=""></span>
                      </label>
                    </div>
                  </div>
    							<?php endif; ?>

                  <div class="col-md-12">
                    <div class="pull-right">
                      <a href="#profile" data-toggle="tab" class="btn btn-primary">
                        <?php echo lang('users deposit next'); ?>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="profile">
				<?php if($this->commission->display->check_pp_dep) : ?>
        <div class="row">
          <div class="col-md-12">
            <form id="paypal" name=paypal action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="charset" value="utf-8" />
              <input type="hidden" name="cmd" value="_xclick" />
              <input type="hidden" name="item_number" value="funds01" />
              <input type="hidden" name="item_name" value="Deposit for <?php echo $this->settings->site_name; ?>" />
              <input type="hidden" name="quantity" value="1" />
              <input type="hidden" name="custom" value="<?php echo $user['username'] ?>" />
              <input type="hidden" name="receiver_email" value="<?php echo $this->commission->display->account_pp ?>" />
              <input type="hidden" name="business" value="<?php echo $this->commission->display->account_pp ?>" />
              <input type="hidden" name="notify_url" value="<?php echo base_url();?>IPN/paypal" />
              <input type="hidden" name="return" value="<?php echo base_url();?>account/history" />
              <input type="hidden" name="cancel_return" value="<?php echo base_url();?>account/deposit" />
              <input type="hidden" name="no_shipping" value="1" />
              <input type="hidden" name="currency_code" value="<?php echo $this->currencys->display->base_code ?>"> 
              <input type="hidden" name="no_note" value="1" />
              <div class="form-group">
                <label><?php echo lang('users withdrawal amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
                <input type="text" class="form-control" name="amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
              </div>
              <div class="pull-right">
								<a href="#home" data-toggle="tab" class="btn btn-default">
                  <?php echo lang('core button cancel'); ?>
                </a>
                <button type="submit" class="btn btn-primary"><?php echo lang('users deposit payment'); ?></button>
              </div>
            </form>
          </div>
        </div>
				<?php endif; ?>
						
				<?php if($this->commission->display->check_perfect) : ?>
				<form action="https://perfectmoney.is/api/step1.asp" id="perfect" method="POST">
					<input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $this->commission->display->account_perfect ?>">
					<input type="hidden" name="PAYEE_NAME" value="Deposit for <?php echo $this->settings->site_name; ?>">
					<input type="hidden" name="PAYMENT_ID" value="<?php echo $user['id'] ?>">
					<input type="hidden" name="PAYMENT_UNITS" value="<?php echo $this->currencys->display->base_code ?>">
					<input type="hidden" name="STATUS_URL" value="<?php echo base_url();?>IPN/perfect2">
					<input type="hidden" name="PAYMENT_URL" value="<?php echo base_url();?>account/history">
					<input type="hidden" name="PAYMENT_URL_METHOD" value="LINK">
					<input type="hidden" name="NOPAYMENT_URL" value="<?php echo base_url();?>account/deposit">
					<input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK">
					<input type="hidden" name="SUGGESTED_MEMO" value="<?php echo $user['username'] ?>">
					<input type="hidden" name="BAGGAGE_FIELDS" value="">
					<div class="form-group">
            <label><?php echo lang('users withdrawal amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
            <input type="text" class="form-control" name="PAYMENT_AMOUNT" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
          </div>
          <div class="pull-right">
						<a href="#home" data-toggle="tab" class="btn btn-default">
              <?php echo lang('core button cancel'); ?>
            </a>
            <button type="submit" name="PAYMENT_METHOD" class="btn btn-primary"><?php echo lang('users deposit payment'); ?></button>
          </div>
				</form>
        <?php endif; ?>
						
				<?php if($this->commission->display->check_btc_dep) : ?>
        <?php echo form_open(site_url("account/start_blockio/"), array("id" => "btc")) ?>
					<div class="form-group">
            <label><?php echo lang('users withdrawal amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
            <input type="text" class="form-control" name="form_amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
          </div>
          <div class="pull-right">
						<a href="#home" data-toggle="tab" class="btn btn-default">
              <?php echo lang('core button cancel'); ?>
            </a>
            <button type="submit" class="btn btn-primary"><?php echo lang('users deposit payment'); ?></button>
          </div>
        <?php echo form_close(); ?> 
				<?php endif; ?>
						
				<?php if($this->commission->display->check_adv_dep) : ?>
					<?php echo form_open(site_url("account/start_advcash/"), array("id" => "adv")) ?>
            <div class="row">
              <div class="col-md-12">
								<div class="form-group">
                  <label><?php echo lang('users withdrawal amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
                  <input type="text" class="form-control" name="form_amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                </div>
								<div class="pull-right">
									<a href="#home" data-toggle="tab" class="btn btn-default">
                    <?php echo lang('core button cancel'); ?>
                  </a>
                  <button type="submit" class="btn btn-primary"><?php echo lang('users deposit payment'); ?></button>
                </div>
							</div>
						</div>
          <?php echo form_close(); ?> 
				<?php endif; ?>
						
				<?php if($this->commission->display->swift_dep_check) : ?>
					<?php echo form_open(site_url("account/start_swift/"), array("id" => "swift")) ?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
                    <label><?php echo lang('users withdrawal amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
                    <input type="text" class="form-control" name="form_amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                  </div>
							</div>
							<div class="col-md-12">
								<?php echo $this->commission->display->swift_desc ?>
							</div>
							<div class="col-md-12 col-xs-12">
								<div class="form-group pull-right hidden-print">
									<br><button type="submit" class="btn btn-primary"><?php echo lang('users deposit payment'); ?></button>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?> 
        <?php endif; ?>
            
				<?php if($this->commission->display->check_payeer_dep) : ?> 
					<?php echo form_open(site_url("account/start_payeer/"), array("id" => "payeer")) ?>
						<div class="row">
              <div class="col-md-12">
								<div class="form-group">
                    <label><?php echo lang('users withdrawal amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
                    <input type="text" class="form-control" name="form_amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                  </div>
								<div class="pull-right">
									<a href="#home" data-toggle="tab" class="btn btn-default">
                    <?php echo lang('core button cancel'); ?>
                  </a>
                  <button type="submit" class="btn btn-primary"><?php echo lang('users deposit payment'); ?></button>
                </div>
							</div>
						</div>
					<?php echo form_close(); ?> 
				<?php endif; ?>
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