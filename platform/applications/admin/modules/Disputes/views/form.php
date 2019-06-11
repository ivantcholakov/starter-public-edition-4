<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
           <h3 class="title"><?php echo lang('admin disputes edit_dispute'); ?></h3> 
        </div>
       <ul class="nav nav-tabs pull-right" role="tablist">
          <li class="nav-item"> <a class="nav-link active" href="#detail" role="tab" data-toggle="tab"><?php echo lang('admin disputes detail'); ?></a> </li>
          <li class="nav-item"> <a class="nav-link" href="#overview" role="tab" data-toggle="tab"><?php echo lang('admin disputes overview'); ?></a></li>
       </ul>
     </div>
     <div class="card-block">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active fade in" id="detail">
                <?php echo form_open('', array('role'=>'form')); ?>
                <?php // hidden id ?>
                <?php if (isset($disputes_id)) : ?>
                    <?php echo form_hidden('id', $disputes_id); ?>
                <?php endif; ?>
    
    <div class="row">
      
      <?php // status ?>
      <div class="form-group col-sm-4<?php echo form_error('status') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin disputes status'), 'time_dispute', array('class'=>'control-label underlined')); ?>
            <span class="required">*</span><br>
             <?if($disputes['status']==1){?>
                  <span class="label label-primary"><?php echo lang('admin disputes open'); ?></span>
                 <?}else{?>
                 <?}?>
            <?if($disputes['status']==2){?>
                  <span class="label label-danger"><?php echo lang('admin disputes claim'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($disputes['status']==3){?>
                  <span class="label label-warning"><?php echo lang('admin disputes rejected'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($disputes['status']==4){?>
                  <span class="label label-success"><?php echo lang('admin disputes satisfied'); ?></span>
                 <?}else{?>
                 <?}?>
        
      </div>
      
      <?php // transaction ?>
      <div class="form-group col-sm-4<?php echo form_error('transaction') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin disputes id_tran'), 'transaction', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'transaction', 'value'=>set_value('transaction', (isset($disputes['transaction']) ? $disputes['transaction'] : '')), 'class'=>'form-control underlined', 'disabled'=>'disabled')); ?>
      </div>
      
      <?php // time transaction ?>
      <div class="form-group col-sm-4<?php echo form_error('time_transaction') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin disputes id_tran_time'), 'time_transaction', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'time_transaction', 'value'=>set_value('time_transaction', (isset($disputes['time_transaction']) ? $disputes['time_transaction'] : '')), 'class'=>'form-control underlined')); ?>
      </div>
      
      <?php // time dispute ?>
      <div class="form-group col-sm-4<?php echo form_error('time_dispute') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin disputes time_dispute'), 'time_dispute', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'time_dispute', 'value'=>set_value('time_dispute', (isset($disputes['time_dispute']) ? $disputes['time_dispute'] : '')), 'class'=>'form-control underlined')); ?>
      </div>
      
      <?php // claimant ?>
      <div class="form-group col-sm-4<?php echo form_error('claimant') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin disputes claimant'), 'claimant', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'claimant', 'value'=>set_value('claimant', (isset($disputes['claimant']) ? $disputes['claimant'] : '')), 'class'=>'form-control underlined')); ?>
      </div>
    
      <?php // defendant ?>
      <div class="form-group col-sm-4<?php echo form_error('defendant') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin disputes defendant'), 'defendant', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'defendant', 'value'=>set_value('defendant', (isset($disputes['defendant']) ? $disputes['defendant'] : '')), 'class'=>'form-control underlined')); ?>
      </div>
    
      <?php // sum ?>
      <div class="form-group col-sm-4<?php echo form_error('sum') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin trans sum'), 'sum', array('class'=>'control-label')); ?>,
            <span class="control-label">
              <?if($disputes['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?>
            </span>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'sum', 'value'=>set_value('sum', (isset($disputes['sum']) ? $disputes['sum'] : '')), 'class'=>'form-control underlined')); ?>
      </div>
    
      <?php // fee ?>
      <div class="form-group col-sm-4<?php echo form_error('fee') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin trans fee'), 'fee', array('class'=>'control-label')); ?>,
            <span class="control-label">
              <?if($disputes['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?>
            </span>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'fee', 'value'=>set_value('fee', (isset($disputes['fee']) ? $disputes['fee'] : '')), 'class'=>'form-control underlined')); ?>
      </div>
    
      <?php // amount ?>
      <div class="form-group col-sm-4<?php echo form_error('amount') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('admin trans amount'), 'amount', array('class'=>'control-label')); ?>,
            <span class="control-label">
              <?if($disputes['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($disputes['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?>
            </span>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'amount', 'value'=>set_value('amount', (isset($disputes['amount']) ? $disputes['amount'] : '')), 'class'=>'form-control underlined')); ?>
      </div>
      
      <div class="pull-right">
        <div class="col-md-12">
          <a class="btn btn-secondary btn-sm" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
          <button type="submit" name="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
        </div>
      </div>
    </div>
 </div>
      <?php echo form_close(); ?>
      
                
          
   
          
    <div role="tabpanel" class="tab-pane" id="overview">
                          <div class="row">
                            <div class="col-md-12">
                              <ul class="timeline">
                                <li>
                                  <p class="timeline-date"><i class="icon-clock icons"></i> <?php echo $disputes['time_dispute'] ?></p>
                                  <div class="timeline-content-default">
                                    <p><strong><?php echo $disputes['claimant'] ?></strong></p>
                                    <p><?php echo $disputes['message'] ?></p>
                                  </div>
                                </li>
                                <?php foreach($log_comment->result() as $view) : ?>
                                <li>
                                  <p class="timeline-date"><i class="icon-clock icons"></i> <?php echo $view->time ?></p>
                                  <div class="timeline-content-<?if($view->role==1){?>default<?}else{?><?}?><?if($view->role==2){?>primary<?}else{?><?}?><?if($view->role==3){?>warning<?}else{?><?}?><?if($view->role==4){?>danger<?}else{?><?}?><?if($view->role==5){?>success<?}else{?><?}?>">
                                    <p><strong><?php echo $view->user ?></strong></p>
                                    <p><?php echo $view->comment ?></p>
                                  </div>
                                </li>
                                <?php endforeach; ?>
                              </ul>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <?php echo form_open(site_url("admin/disputes/add_admin_comment/" . $disputes['id']), array("" => "")) ?>
                                <div class="form-group col-sm-12">
                                <label for="transaction" class="control-label"><?php echo lang('admin disputes new_comment'); ?></label>   
                                <textarea name="comment" class="form-control underlined" rows="5"></textarea>
                                </div>
                               </div>
                            </div>
                            
                            <div class="row pull-right">
                              <div class="col-sm-12">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"><?php echo lang('admin disputes decision'); ?> <span class="caret"></span></button>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo $this_url; ?>/open_dispute/<?php echo $disputes['id']; ?>"><?php echo lang('admin disputes open'); ?></a></li>
                                  <li><a href="<?php echo $this_url; ?>/open_claim/<?php echo $disputes['id']; ?>"><?php echo lang('admin disputes open_claim'); ?></a></li>
                                    <li><a href="<?php echo $this_url; ?>/reject/<?php echo $disputes['id']; ?>"><?php echo lang('admin disputes reject'); ?></a></li>
                                    <li><a href="<?php echo $this_url; ?>/satisfy/<?php echo $disputes['id']; ?>"><?php echo lang('admin disputes satisfy'); ?></a></li>
                                  </ul>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo lang('admin disputes add_comment'); ?></button>
                              </div>
                            </div>
                            <?php echo form_close(); ?>  
                          </div>
    </div>
   </div>
 </div>
</div>
</div>
</div>

