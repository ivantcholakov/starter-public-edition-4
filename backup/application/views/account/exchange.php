<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users title form_exchange'); ?></h4>
      </div>
      <div class="col-md-6">
        <a href="#" data-toggle="modal" data-target="#rates" class="btn btn-success margin-left-10 pull-right"><?php echo lang('users exchange rate'); ?></a> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo form_open(site_url("account/exchange_of_base_currency/"), array("" => "")) ?>
            <div class="col-md-5">
                <div class="form-group">
                    <label><?php echo lang('users exchange amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
                    <input type="text" class="form-control" name="amount" id="amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                  </div>
                </div>
            <div class="col-md-4">
              <div class="form-group">
                <label><?php echo lang('users trans cyr'); ?></label>
                  <select class="form-control" name="currency">
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
            <div class="col-md-3">
              <div class="pull-right">
                <br>
                  <button type="submit" class="btn btn-primary">
                   <i class="icon-refresh icons"></i> <?php echo lang('users exchange start'); ?>
                  </button>
                </div>
                </div>
            </div>
          
           <?php echo form_close(); ?>  
          </div>
        </div>
      </div>

<div class="row">
  <div class="col-md-12">
         <h4 class="title"><?php echo lang('users title to_form_exchange'); ?></h4>
      </div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php echo form_open(site_url("account/exchange_to_base_currency/"), array("" => "")) ?>
            <div class="col-md-5">
                <div class="form-group">
                    <label><?php echo lang('users exchange amount'); ?></label>
                    <input type="text" class="form-control" name="amount2" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                  </div>
                </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label><?php echo lang('users trans cyr'); ?></label>
                  <select class="form-control" name="currency2">
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
            <div class="col-md-3">
              <div class="pull-right">
                <br>
                  <button type="submit" class="btn btn-primary">
                    <i class="icon-refresh icons"></i> <?php echo lang('users exchange start'); ?>
                  </button>
                </div>
                </div>
            </div>
          
           <?php echo form_close(); ?>  
          </div>
        </div>
      </div>
     
    </div>
     
    </div>


<!--Rates -->
<div class="modal fade" id="rates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('users exchange rate'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php if($this->currencys->display->extra1_check) : ?>
          <div class="col-md-4">
            <p><strong>1 <?php echo $this->currencys->display->base_code ?></strong> = <?php echo $this->currencys->display->extra1_rate ?> <?php echo $this->currencys->display->extra1_code ?></p>
          </div>
          <?php endif; ?>
          <?php if($this->currencys->display->extra2_check) : ?>
          <div class="col-md-4">
            <p><strong>1 <?php echo $this->currencys->display->base_code ?></strong> = <?php echo $this->currencys->display->extra2_rate ?> <?php echo $this->currencys->display->extra2_code ?></p>
          </div>
          <?php endif; ?>
          <?php if($this->currencys->display->extra3_check) : ?>
          <div class="col-md-4">
            <p><strong>1 <?php echo $this->currencys->display->base_code ?></strong> = <?php echo $this->currencys->display->extra3_rate ?> <?php echo $this->currencys->display->extra3_code ?></p>
          </div>
          <?php endif; ?>
          <?php if($this->currencys->display->extra4_check) : ?>
          <div class="col-md-4">
            <p><strong>1 <?php echo $this->currencys->display->base_code ?></strong> = <?php echo $this->currencys->display->extra4_rate ?> <?php echo $this->currencys->display->extra4_code ?></p>
          </div>
          <?php endif; ?>
          <?php if($this->currencys->display->extra5_check) : ?>
          <div class="col-md-4">
            <p><strong>1 <?php echo $this->currencys->display->base_code ?></strong> = <?php echo $this->currencys->display->extra5_rate ?> <?php echo $this->currencys->display->extra5_code ?></p>
          </div>
          <?php endif; ?>
        </div>
        <hr>
        <div class="row">
          
          <div class="col-md-4">
            <div class="form-group">
              <label><?php echo lang('users exchange amount'); ?>, <?php echo $this->currencys->display->base_code ?></label>
              <input type="text" class="form-control" name="amount1" id="amount1" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
            </div>
          </div>
          
          <div class="col-md-4">
              <div class="form-group">
                <label><?php echo lang('users trans cyr'); ?></label>
                  <select class="form-control" name="currency1" id="currency1">
                    <?php if($this->currencys->display->extra1_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra1_rate ?>">
                    <?php echo $this->currencys->display->extra1_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra2_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra2_rate ?>">
                    <?php echo $this->currencys->display->extra2_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra3_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra3_rate ?>">
                    <?php echo $this->currencys->display->extra3_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra4_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra4_rate ?>">
                    <?php echo $this->currencys->display->extra4_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra5_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra5_rate ?>">
                    <?php echo $this->currencys->display->extra5_code ?>
                    </option>
                    <?php endif; ?>
                  </select>
                </div>
            </div>
          
          <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('users exchange get'); ?></label>
                    <input type="text" class="form-control" name="sum1" id="sum1" disabled>
                  </div>
              </div>
          
          
        </div>
        
        <div class="row">
          
          <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('users exchange amount'); ?></label>
                    <input type="text" class="form-control" name="amount3" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
                  </div>
                </div>
          
          <div class="col-md-4">
              <div class="form-group">
                <label><?php echo lang('users trans cyr'); ?></label>
                  <select class="form-control" name="currency3" id="currency3">
                    <?php if($this->currencys->display->extra1_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra1_rate ?>">
                    <?php echo $this->currencys->display->extra1_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra2_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra2_rate ?>">
                    <?php echo $this->currencys->display->extra2_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra3_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra3_rate ?>">
                    <?php echo $this->currencys->display->extra3_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra4_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra4_rate ?>">
                    <?php echo $this->currencys->display->extra4_code ?>
                    </option>
                    <?php endif; ?>
                    <?php if($this->currencys->display->extra5_check) : ?>
                    <option value="<?php echo $this->currencys->display->extra5_rate ?>">
                    <?php echo $this->currencys->display->extra5_code ?>
                    </option>
                    <?php endif; ?>
                  </select>
                </div>
            </div>
          
          <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('users exchange get'); ?>, <?php echo $this->currencys->display->base_code ?></label>
                    <input type="text" class="form-control" name="sum3" id="sum1" disabled>
                  </div>
              </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('core button cancel'); ?></button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  let arg1 = document.querySelector('input[name="amount1"]');
  let res1 = document.querySelector('input[name="sum1"]');
  let cur1 = document.querySelector('select[name="currency1"]');
  let arr1 = [arg1, cur1];
  let calc1 = () => res1.value = arg1.value * cur1.value;
  
  arr1.forEach(function(el){
    el.addEventListener('input', calc1);
  });
  calc1();

  let arg3 = document.querySelector('input[name="amount3"]');
  let res3 = document.querySelector('input[name="sum3"]');
  let cur3 = document.querySelector('select[name="currency3"]');
  let arr3 = [arg3, cur3];

  let cal3 = () => res3.value = arg3.value / cur3.value;
  arr3.forEach(function(el){
    el.addEventListener('input', cal3);
  });
  cal3();
</script>