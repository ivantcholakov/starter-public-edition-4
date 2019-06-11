<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users vouchers new_v'); ?></h4>
      </div>
			<div class="col-md-6 hidden-xs">
        <a href="/account/vouchers" class="btn btn-default margin-left-10 pull-right"><i class="icon-action-undo icons"></i> <?php echo lang('users disputes back'); ?></a>
      </div>
    </div>
    <?php echo form_open(site_url("account/start_new_code/"), array("" => "")) ?>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                    <label><?php echo lang('users trans amount'); ?></label>
                    <input type="text" class="form-control" name="amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                <label><?php echo lang('users trans cyr'); ?></label>
                  <select class="form-control" name="currency">
                    <option value="debit_base">
                    <?php echo $this->currencys->display->base_code ?>
                    </option>
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
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">
                    <?php echo lang('users vouchers create_v'); ?>
                  </button>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>  
     
    </div>

