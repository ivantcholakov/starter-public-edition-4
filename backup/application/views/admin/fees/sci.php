<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open(site_url("admin/fees/sci_update"), array("" => "")) ?>

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
       
       <?php // PayPal?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees pp'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="check_pp_sci" value="1" <?php if($this->commission->display->check_pp_sci) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees pp'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="fee_pp_sci" name="fee_pp_sci" placeholder="50" value="<?php echo $this->commission->display->fee_pp_sci ?>"> 
        </div>
       
       <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees pp'); ?> <?php echo lang('admin fees fees'); ?>, <?php echo $this->currencys->display->base_code; ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="sci_pp_fee_fix" name="sci_pp_fee_fix" placeholder="50" value="<?php echo $this->commission->display->sci_pp_fee_fix ?>"> 
        </div>
       
       <div class="form-group col-sm-4">
            <label><?php echo lang('admin fees acc_pp'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="account_pp_sci" name="account_pp_sci" placeholder="mail@gmail.com" value="<?php echo $this->commission->display->account_pp_sci ?>"> 
        </div>
      
        
      
        
    </div>
      
      <div class="row">
       
       <?php // Payeer ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees payeer'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="check_payeer_sci" value="1" <?php if($this->commission->display->check_payeer_sci) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees payeer'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="fee_payeer_sci" name="fee_payeer_sci" placeholder="50" value="<?php echo $this->commission->display->fee_payeer_sci ?>"> 
        </div>
      
        <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees payeer'); ?>, <?php echo $this->currencys->display->base_code; ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="sci_pay_fee_fix" name="sci_pay_fee_fix" placeholder="50" value="<?php echo $this->commission->display->sci_pay_fee_fix ?>"> 
        </div>
       
       <div class="form-group col-sm-4">
            <label><?php echo lang('admin fees acc_payeer'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="merch_payeer_sci" name="merch_payeer_sci" placeholder="" value="<?php echo $this->commission->display->merch_payeer_sci ?>"> 
        </div>
      
      <div class="form-group col-sm-2">
      </div>
      
      <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees key_payeer'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="key_payeer_sci" name="key_payeer_sci" placeholder="" value="<?php echo $this->commission->display->key_payeer_sci ?>"> 
        </div>
      
      <div class="form-group col-sm-7">
            <label><?php echo lang('admin fees crypt_payeer'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="crypt_payeer_sci" name="crypt_payeer_sci" placeholder="" value="<?php echo $this->commission->display->crypt_payeer_sci ?>"> 
        </div>
      
      </div>
      
      <div class="row">
      
        <?php // ADV Cash ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees adv'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="check_adv_sci" value="1" <?php if($this->commission->display->check_adv_sci) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees adv'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="fee_adv_sci" name="fee_adv_sci" placeholder="50" value="<?php echo $this->commission->display->fee_adv_sci ?>"> 
        </div>
    
        <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees adv'); ?>, <?php echo $this->currencys->display->base_code; ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="sci_adv_fix" name="sci_adv_fix" placeholder="50" value="<?php echo $this->commission->display->sci_adv_fix ?>"> 
        </div>
       
       <div class="form-group col-sm-4">
            <label><?php echo lang('admin fees acc_adv'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="account_adv_sci" name="account_adv_sci" placeholder="" value="<?php echo $this->commission->display->account_adv_sci ?>"> 
        </div>
    
      <div class="form-group col-sm-2">
      </div>
      
      <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees sci_name'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="name_adv_sci" name="name_adv_sci" placeholder="" value="<?php echo $this->commission->display->name_adv_sci ?>"> 
        </div>
      
      <div class="form-group col-sm-7">
            <label><?php echo lang('admin fees pass_dep'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="secret_adv_sci" name="secret_adv_sci" placeholder="" value="<?php echo $this->commission->display->secret_adv_sci ?>"> 
        </div>
    
    </div>
  
    <div class="row">
    
        <?php // Perfect money ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees perfect'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="check_perfect_sci" value="1" <?php if($this->commission->display->check_perfect_sci) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees perfect'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="fee_perfect_sci" name="fee_perfect_sci" placeholder="50" value="<?php echo $this->commission->display->fee_perfect_sci ?>"> 
        </div>
  
      <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees perfect'); ?>, <?php echo $this->currencys->display->base_code; ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="sci_per_fee_fix" name="sci_per_fee_fix" placeholder="50" value="<?php echo $this->commission->display->sci_per_fee_fix ?>"> 
        </div>
       
       <div class="form-group col-sm-4">
            <label><?php echo lang('admin fees acc_perfect'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="account_perfect_sci" name="account_perfect_sci" placeholder="" value="<?php echo $this->commission->display->account_perfect_sci ?>"> 
        </div>
  
   <div class="form-group col-sm-2">
      </div>
  
      <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees key_perfect'); ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="key_perfect_sci" name="key_perfect_sci" placeholder="" value="<?php echo $this->commission->display->key_perfect_sci ?>"> 
        </div>
  
    </div>

    <div class="row">
  
      <?php // BTC ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees btc'); ?> (GAP: <?php echo $limit; ?>)</label>
            </br>
            <input type="checkbox" class="js-switch primary" name="check_btc_sci" value="1" <?php if($this->commission->display->check_btc_sci) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees btc'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="fee_btc_sci" name="fee_btc_sci" placeholder="50" value="<?php echo $this->commission->display->fee_btc_sci ?>"> 
        </div>

         <div class="form-group col-sm-3">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees btc'); ?>, <?php echo $this->currencys->display->base_code; ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="sci_btc_fee_fix" name="sci_btc_fee_fix" placeholder="50" value="<?php echo $this->commission->display->sci_btc_fee_fix ?>"> 
        </div>
       
       <div class="form-group col-sm-4">
            <label>API key</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="shop_btc_sci" name="shop_btc_sci" placeholder="" value="<?php echo $this->commission->display->shop_btc_sci ?>"> 
        </div>
      <div class="form-group col-sm-2">
      </div>
      <div class="form-group col-sm-6">
            <label>Secret</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="pass_btc_sci" name="pass_btc_sci" placeholder="" value="<?php echo $this->commission->display->pass_btc_sci ?>"> 
        </div>

      <div class="form-group col-sm-4">
            <label>Xpub Blockchain</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="sci_xpub" name="sci_xpub" placeholder="" value="<?php echo $this->commission->display->sci_xpub ?>"> 
        </div>
    </div>

    <div class="row">

    <?php // SWIFT ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin fees swift'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="swift_sci_check" value="1" <?php if($this->commission->display->swift_sci_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-6">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees swift'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="fee_swift_sci" name="fee_swift_sci" placeholder="50" value="<?php echo $this->commission->display->fee_swift_sci ?>"> 
        </div>
<div class="form-group col-sm-4">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin fees swift'); ?>, <?php echo $this->currencys->display->base_code; ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="sci_swift_fee_fix" name="sci_swift_fee_fix" placeholder="50" value="<?php echo $this->commission->display->sci_swift_fee_fix ?>"> 
        </div>
       <div class="form-group col-sm-2">
      </div>
       <div class="form-group col-sm-10">
            <label><?php echo lang('admin fees swift_desk'); ?></label>
          <span class="required">*</span>
            <textarea class="form-control underlined" name="swift_desc_sci" rows="20" id="swift_desc_sci" value=""><?php echo $this->commission->display->swift_desc_sci ?></textarea>
          <script>
                CKEDITOR.replace( 'swift_desc_sci', { height:['200px'] } );
                CKEDITOR.config.allowedContent = true;
                CKEDITOR.replace('body', {height: 500});
            </script> 
        </div>


      <?php // UX ?>
        <div class="form-group col-sm-2">
            <label><?php echo lang('admin pay wallet'); ?></label>
            </br>
            <input type="checkbox" class="js-switch primary" name="ux_check" value="1" <?php if($this->commission->display->ux_check) echo "checked" ?>/>
        </div>

         <div class="form-group col-sm-6">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin pay wallet'); ?>, %</label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="fee_ux" name="fee_ux" placeholder="50" value="<?php echo $this->commission->display->fee_ux ?>"> 
        </div>

      <div class="form-group col-sm-4">
            <label><?php echo lang('admin fees fees'); ?> <?php echo lang('admin pay wallet'); ?>, <?php echo $this->currencys->display->base_code; ?></label>
          <span class="required">*</span>
            <input type="text" class="form-control underlined" id="ux_fee_fix" name="ux_fee_fix" placeholder="50" value="<?php echo $this->commission->display->ux_fee_fix ?>"> 
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
