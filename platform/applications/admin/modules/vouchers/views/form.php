<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
                            <div class="col-md-12">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <div class="card-header bordered">
                                        <div class="header-block">
                                            <h3 class="title"><?php echo lang('admin vouchers voucher'); ?> ID <?php echo $vouchers['id']; ?></h3>
                                        </div>
                                        <div class="header-block pull-right">
                                          <?if($vouchers['status']==2){?>
                                                        <span class="label label-success"><?php echo lang('admin vouchers activated'); ?></span>
                                                       <?}else{?>
                                                       <?}?>
                                                       <?if($vouchers['status']==1){?>
                                                        <span class="label label-warning"><?php echo lang('admin vouchers pending'); ?></span>
                                                       <?}else{?>
                                                       <?}?>
                                        </div>
                                    </div>
                                    <section class="example">
                                        <div class="card-block">
                                          
                                          <?php echo form_open('', array('role'=>'form')); ?>

                                          <?php // hidden id ?>
                                          <?php if (isset($vouchers_id)) : ?>
                                            <?php echo form_hidden('id', $vouchers_id); ?>
                                          <?php endif; ?>
                                          
                                          <div class="row">
                                            
                                            <?php // status ?>
                                            
                                            <div class="form-group col-sm-2<?php echo form_error('status') ? ' has-error' : ''; ?>">
                                                        <?php echo form_label(lang('admin trans status'), '', array('class'=>'control-label')); ?>
                                                        <span class="required">*</span>
                                                         <div> 
                                                            <label style="font-weight:500">
                                                                <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'status', 'id'=>'status-1', 'value'=>'1', 'checked'=>((isset($vouchers['status']) && (int)$vouchers['status'] == 1) ? 'checked' : FALSE))); ?>
                                                                <span><?php echo lang('admin vouchers pending'); ?></span>
                                                            </label>
                                                        </div>
                                                        <div> 
                                                            <label style="font-weight:500">
                                                                <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'status', 'id'=>'status-2', 'value'=>'2', 'checked'=>((isset($vouchers['status']) && (int)$vouchers['status'] == 2) ? 'checked' : FALSE))); ?>
                                                                <span><?php echo lang('admin vouchers activated'); ?></span>
                                                            </label>
                                                        </div>
                                            </div>
                                            
                                            <div class="form-group col-sm-10<?php echo form_error('code') ? ' has-error' : ''; ?>">
                                                        <?php echo form_label(lang('admin vouchers code'), 'code', array('class'=>'control-label')); ?>
                                                        <span class="required">*</span>
                                                        <?php echo form_input(array('name'=>'code', 'value'=>set_value('code', (isset($vouchers['code']) ? $vouchers['code'] : '')), 'class'=>'form-control underlined')); ?>
                                                      </div>
                                            
                                            <div class="form-group col-sm-5<?php echo form_error('creator') ? ' has-error' : ''; ?>">
                                                        <?php echo form_label(lang('admin vouchers creator'), 'creator', array('class'=>'control-label')); ?>
                                                        <span class="required">*</span>
                                                        <?php echo form_input(array('name'=>'creator', 'value'=>set_value('creator', (isset($vouchers['creator']) ? $vouchers['creator'] : '')), 'class'=>'form-control underlined')); ?>
                                            </div>
                                            
                                            <div class="form-group col-sm-5<?php echo form_error('activator') ? ' has-error' : ''; ?>">
                                                        <?php echo form_label(lang('admin vouchers activator'), 'activator', array('class'=>'control-label')); ?>
                                                        <span class="required">*</span>
                                                        <?php echo form_input(array('name'=>'activator', 'value'=>set_value('activator', (isset($vouchers['activator']) ? $vouchers['activator'] : '')), 'class'=>'form-control underlined')); ?>
                                            </div>
                                            
                                          </div>
                                          
                                          <div class="row">
                                            <div class="form-group col-sm-4<?php echo form_error('date_creature') ? ' has-error' : ''; ?>">
                                                        <?php echo form_label(lang('admin tickets date'), 'activator', array('class'=>'control-label')); ?>
                                                        <span class="required">*</span>
                                                        <?php echo form_input(array('name'=>'date_creature', 'value'=>set_value('date_creature', (isset($vouchers['date_creature']) ? $vouchers['date_creature'] : '')), 'class'=>'form-control underlined')); ?>
                                            </div>
                                             <div class="form-group col-sm-4<?php echo form_error('admin vouchers date') ? ' has-error' : ''; ?>">
                                                        <?php echo form_label(lang('admin vouchers date'), 'date_activation', array('class'=>'control-label')); ?>
                                                        <span class="required">*</span>
                                                        <?php echo form_input(array('name'=>'date_activation', 'value'=>set_value('date_activation', (isset($vouchers['date_activation']) ? $vouchers['date_activation'] : '')), 'class'=>'form-control underlined')); ?>
                                            </div>
                                            <div class="form-group col-sm-4<?php echo form_error('admin trans amount') ? ' has-error' : ''; ?>">
                                                        <?php echo form_label(lang('admin trans amount'), 'amount', array('class'=>'control-label')); ?>
                                                        <span class="required"><?if($vouchers['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($vouchers['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($vouchers['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($vouchers['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($vouchers['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($vouchers['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?>*</span>
                                                        <?php echo form_input(array('name'=>'amount', 'value'=>set_value('amount', (isset($vouchers['amount']) ? $vouchers['amount'] : '')), 'class'=>'form-control underlined')); ?>
                                            </div>
                                          </div>
                                           
                                        </div>
                                        <div class="card-footer" style="text-align:right"> 
                                             <a class="btn btn-secondary btn-sm" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                                                    <button type="submit"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
                                        </div>
                                  <?php echo form_close(); ?>
                                    </section>
                                </div>
                            </div>
                        </div>