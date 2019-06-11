<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users title form_withdrawal'); ?></h4>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <?php echo form_open(site_url("account/start_withdrawal/"), array("" => "")) ?>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label><?php echo lang('users withdrawal amount'); ?></label>
              <input type="text" class="form-control" name="amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label><?php echo lang('users withdrawal currency'); ?></label>
              <select class="form-control" name="currency">
                    <option value="debit_base"><?php echo $this->currencys->display->base_code ?></option>
                    <?php if($this->currencys->display->extra1_check) : ?>
                    <option value="debit_extra1">
                    <?php echo $this->currencys->display->extra1_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra2_check) : ?>
                    <option value="debit_extra2">
                    <?php echo $this->currencys->display->extra2_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra3_check) : ?>
                    <option value="debit_extra3">
                    <?php echo $this->currencys->display->extra3_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra4_check) : ?>
                    <option value="debit_extra4">
                    <?php echo $this->currencys->display->extra4_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra5_check) : ?>
                    <option value="debit_extra5">
                    <?php echo $this->currencys->display->extra5_code ?>
                    </option>
                    <?php endif; ?>
                  </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label><?php echo lang('users withdrawal account'); ?> <a href="#" rel='tooltip' title="<?php echo lang('users withdrawal help'); ?>"><i class="icon-question icons"></i></a></label>
              <input type="text" class="form-control" name="account">
            </div>
          </div>
          <div class="col-md-12">
            <div class="plan-card-group">
            <div class="row">
              <?php if($this->commission->display->card_check) : ?>
              <?php // Card ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->card_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="1" id="1"/>
                  <label for="1" id="1">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/new_card.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
              <?php if($this->commission->display->pp_check) : ?>
              <?php // PayPal ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->pp_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="2" id="2"/>
                  <label for="2" id="2">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/paypal.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
               <?php if($this->commission->display->btc_check) : ?>
              <?php // BTC ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->btc_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="3" id="3"/>
                  <label for="3" id="3">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/btc.png" alt=""></span>
                  </label>
                </div>
              </div>
               <?php endif; ?>
              <?php if($this->commission->display->adv_check) : ?>
              <?php // ADV ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->adv_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="4" id="4"/>
                  <label for="4" id="4">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/adv.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
              <?php if($this->commission->display->wm_check) : ?>
              <?php // Webmoney ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->wm_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="5" id="5"/>
                  <label for="5" id="5">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/webmoney.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
              <?php if($this->commission->display->payeer_check) : ?>
              <?php // Payeer ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->payeer_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="9" id="9"/>
                  <label for="9" id="9">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/payeer.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
              <?php if($this->commission->display->qiwi_check) : ?>
              <?php // QIWI ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->qiwi_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="6" id="6"/>
                  <label for="6" id="6">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/qiwi.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
              <?php if($this->commission->display->perfect_check) : ?>
              <?php // Perfect ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->perfect_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="8" id="8"/>
                  <label for="8" id="8">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/perfect.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
              <?php if($this->commission->display->swift_check) : ?>
              <?php // SWIFT ?>
              <div class="col-md-4 col-xs-6">
                <div class="radio-card">
                  <div class="fee"><?php echo $this->commission->display->swift_fee ?>%</div>
                  <input type="radio" class="planes-radio" name="method" value="7" id="7"/>
                  <label for="7" id="7">
                    <span class="card-title"><img class="img-responsive" src="<?php echo base_url();?>themes/private/img/pay/swift.png" alt=""></span>
                  </label>
                </div>
              </div>
              <?php endif; ?>
              <div class="col-md-12">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">
                    <?php echo lang('users transfer send'); ?>
                  </button>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?>  
      </div>
    </div>
