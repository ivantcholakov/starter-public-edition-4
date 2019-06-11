<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users title request_form'); ?></h4>
      </div>
    </div>
    <?php echo form_open(site_url("account/start_request/"), array("" => "")) ?>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                 <div class="form-group">
                    <label><?php echo lang('users reqest purpose'); ?></label>
                    <input type="text" class="form-control" name="purpose">
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('users reqest invoice'); ?></label>
                    <input type="text" class="form-control" name="invoice" placeholder="INV 32940-00">
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('users trans amount'); ?></label>
                    <input type="text" class="form-control" name="amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                <label><?php echo lang('users trans cyr'); ?></label>
                  <select class="form-control" name="currency">
                    <option value="<?php echo $this->currencys->display->base_code ?>">
                    <?php echo $this->currencys->display->base_code ?>
                    </option>
                    <?php if($this->currencys->display->extra1_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra1_code ?>">
                    <?php echo $this->currencys->display->extra1_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra2_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra2_code ?>">
                    <?php echo $this->currencys->display->extra2_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra3_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra3_code ?>">
                    <?php echo $this->currencys->display->extra3_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra4_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra4_code ?>">
                    <?php echo $this->currencys->display->extra4_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra5_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra5_code ?>">
                    <?php echo $this->currencys->display->extra5_code ?>
                    </option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo lang('users reqest email'); ?></label>
                    <input type="email" class="form-control" name="receiver" placeholder="mail@example.com">
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo lang('users reqest note'); ?></label>
                    <textarea class="form-control" rows="5" name="note"></textarea>
                  </div>
              </div>
              <div class="col-md-12">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">
                    <?php echo lang('users reqest send'); ?>
                  </button>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>  
     
    </div>

