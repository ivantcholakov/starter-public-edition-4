<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open(site_url("admin/fees/update"), array("" => "")) ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin fees title'); ?></h3>
        </div>
     </div>
     <div class="card-block">

    <div class="row">
        <?php // Bank cards?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees card'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="card_check" value="1" <?php if($this->commission->display->card_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees card'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="card_fee" name="card_fee" placeholder="50.00" value="<?php echo $this->commission->display->card_fee ?>"> 
        </div>
       
       <?php // PayPal?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees pp'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="pp_check" value="1" <?php if($this->commission->display->pp_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees pp'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="pp_fee" name="pp_fee" placeholder="50.00" value="<?php echo $this->commission->display->pp_fee ?>"> 
        </div>
      
        <?php // BTC?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees btc'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="btc_check" value="1" <?php if($this->commission->display->btc_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees btc'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="btc_fee" name="btc_fee" placeholder="50.00" value="<?php echo $this->commission->display->btc_fee ?>"> 
        </div>
    
        <?php // ADV?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees adv'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="adv_check" value="1" <?php if($this->commission->display->adv_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees adv'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="adv_fee" name="adv_fee" placeholder="50.00" value="<?php echo $this->commission->display->adv_fee ?>"> 
        </div>
  
        <?php // WM ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees wmz'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="wm_check" value="1" <?php if($this->commission->display->wm_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees wmz'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="wm_fee" name="wm_fee" placeholder="50.00" value="<?php echo $this->commission->display->wm_fee ?>"> 
        </div>


        <?php // Payeer ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees payeer'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="payeer_check" value="1" <?php if($this->commission->display->payeer_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees payeer'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="payeer_fee" name="payeer_fee" placeholder="50.00" value="<?php echo $this->commission->display->payeer_fee ?>"> 
        </div>

        <?php // QIWI ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees qiwi'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="qiwi_check" value="1" <?php if($this->commission->display->qiwi_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees qiwi'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="qiwi_fee" name="qiwi_fee" placeholder="50.00" value="<?php echo $this->commission->display->qiwi_fee ?>"> 
        </div>

        <?php // Perfect ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees perfect'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="perfect_check" value="1" <?php if($this->commission->display->perfect_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees perfect'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="perfect_fee" name="perfect_fee" placeholder="50.00" value="<?php echo $this->commission->display->perfect_fee ?>"> 
        </div>

        <?php // SWIFT ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees swift'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="swift_check" value="1" <?php if($this->commission->display->swift_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees swift'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="swift_fee" name="swift_fee" placeholder="50.00" value="<?php echo $this->commission->display->swift_fee ?>"> 
        </div>

      
        
    </div>

     </div>
<div class="card-footer" style="text-align:right"> 
                                             <a class="btn btn-secondary btn-sm" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                                                    <button type="submit"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
                                        </div>
   </div>
 </div>
</div>


<?php echo form_close(); ?>
