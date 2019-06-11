<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
                            <div class="col-md-12">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <div class="card-header bordered">
                                        <div class="header-block">
                                            <h3 class="title"><?php echo lang('admin merchant merchant'); ?> <?php echo $merchants['id']; ?></h3>
                                        </div>
                                        <div class="header-block pull-right">
                                          <?if($merchants['status']==1){?>
                                                        <span class="label label-success"><?php echo lang('admin merchant active'); ?></span>
                                                       <?}else{?>
                                                       <?}?>
                                                       <?if($merchants['status']==2){?>
                                                        <span class="label label-warning"><?php echo lang('admin merchant moderation'); ?></span>
                                                       <?}else{?>
                                                       <?}?>
                                                       <?if($merchants['status']==3){?>
                                                        <span class="label label-danger"><?php echo lang('admin merchant disapproved'); ?></span>
                                                       <?}else{?>
                                                         <?}?>
                                        </div>
                                    </div>
                                    <section class="example">
                                        <div class="card-block">
                                            <div class="row">
                                               <?php echo form_open('', array('role'=>'form')); ?>

                                                <?php // hidden id ?>
                                                <?php if (isset($merchants_id)) : ?>
                                                    <?php echo form_hidden('id', $merchants_id); ?>
                                                <?php endif; ?>
                                              
                                              <?php // date ?>
                                                <div class="form-group col-sm-4<?php echo form_error('date') ? ' has-error' : ''; ?>">
                                                      <?php echo form_label(lang('admin tickets date'), 'date', array('class'=>'control-label')); ?>
                                                      <span class="required">*</span>
                                                      <?php echo form_input(array('name'=>'date', 'value'=>set_value('date', (isset($merchants['date']) ? $merchants['date'] : '')), 'class'=>'form-control underlined')); ?>
                                                </div>
                                              
                                              <?php // name ?>
                                                <div class="form-group col-sm-4<?php echo form_error('name') ? ' has-error' : ''; ?>">
                                                      <?php echo form_label(lang('admin merchant name'), 'name', array('class'=>'control-label')); ?>
                                                      <span class="required">*</span>
                                                      <?php echo form_input(array('name'=>'name', 'value'=>set_value('name', (isset($merchants['name']) ? $merchants['name'] : '')), 'class'=>'form-control underlined')); ?>
                                                </div>
                                              
                                                <?php // link ?>
                                                <div class="form-group col-sm-4<?php echo form_error('link') ? ' has-error' : ''; ?>">
                                                      <?php echo form_label(lang('admin merchant link'), 'link', array('class'=>'control-label')); ?>
                                                      <span class="required">*</span>
                                                      <?php echo form_input(array('name'=>'link', 'value'=>set_value('link', (isset($merchants['link']) ? $merchants['link'] : '')), 'class'=>'form-control underlined')); ?>
                                                </div>
                                              
                                              
                                                <?php // user ?>
                                                <div class="form-group col-sm-4<?php echo form_error('user') ? ' has-error' : ''; ?>">
                                                      <?php echo form_label(lang('admin tickets user'), 'user', array('class'=>'control-label')); ?>
                                                      <span class="required">*</span>
                                                      <?php echo form_input(array('name'=>'user', 'value'=>set_value('user', (isset($merchants['user']) ? $merchants['user'] : '')), 'class'=>'form-control underlined')); ?>
                                                </div>
                                              
                                                <?php // password ?>
                                                <div class="form-group col-sm-4<?php echo form_error('password') ? ' has-error' : ''; ?>">
                                                      <?php echo form_label(lang('admin merchant password'), 'password', array('class'=>'control-label')); ?>
                                                      <span class="required">*</span>
                                                      <?php echo form_input(array('name'=>'password', 'value'=>set_value('password', (isset($merchants['password']) ? $merchants['password'] : '')), 'class'=>'form-control underlined')); ?>
                                                </div>
                                              
                                                <?php // ipn link ?>
                                                <div class="form-group col-sm-4<?php echo form_error('status_link') ? ' has-error' : ''; ?>">
                                                      <?php echo form_label(lang('admin merchant ipn_link'), 'status_link', array('class'=>'control-label')); ?>
                                                      <span class="required"></span>
                                                      <?php echo form_input(array('name'=>'status_link', 'value'=>set_value('status_link', (isset($merchants['status_link']) ? $merchants['status_link'] : '')), 'class'=>'form-control underlined')); ?>
                                                </div>
                                              
                                                <?php // comment ?>
                                                <div class="form-group col-sm-12<?php echo form_error('comment') ? ' has-error' : ''; ?>">
                                                      <?php echo form_label(lang('admin merchant comment'), 'comment', array('class'=>'control-label')); ?>
                                                      <span class="required"></span>
                                                      <?php echo form_textarea(array('name'=>'comment', 'value'=>set_value('comment', (isset($merchants['comment']) ? $merchants['comment'] : '')), 'class'=>'form-control underlined')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="text-align:right"> 
                                             <a class="btn btn-secondary btn-sm" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                                          <div class="btn-group"> 
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
                                            <div class="dropdown-menu"> 
                                              <a class="dropdown-item" href="<?php echo base_url();?>admin/merchants/confirm/<?php echo $merchants['id']; ?>"><?php echo lang('admin verification comfirm'); ?></a> 
                                              <a class="dropdown-item" href="<?php echo base_url();?>admin/merchants/reject/<?php echo $merchants['id']; ?>"><?php echo lang('admin merchant reject'); ?></a> 
                                            </div>
                                          </div>
                                                    <button type="submit"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
                                        </div>
                                  <?php echo form_close(); ?>
                                    </section>
                                </div>
                            </div>
                        </div>