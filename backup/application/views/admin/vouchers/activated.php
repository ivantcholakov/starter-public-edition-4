<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin vouchers activated'); ?></h3>
        </div>
        <div class="header-block pull-right">
          <button type="button" data-toggle="modal" data-target="#search" class="btn btn-warning btn-sm"><i class="icon-magnifier icons"></i> <?php echo lang('admin log search'); ?></button>
        </div>
     </div>
     <section class="example">
      <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover">
           <thead>
            <?php // sortable headers ?>
              <tr>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin trans id'); ?></a>
                          <?php if ($sort == 'id') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin tickets date'); ?></a>
                          <?php if ($sort == 'date_creature') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin vouchers creator'); ?></a>
                          <?php if ($sort == 'creator') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin vouchers code'); ?></a>
                          <?php if ($sort == 'code') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin trans amount'); ?></a>
                          <?php if ($sort == 'amount') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin col status'); ?></a>
                          <?php if ($sort == 'status') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                <th></th>
                  </tr>

            </thead>
            <tbody>
              
              <?php // data rows ?>
            <?php if ($total) : ?>
            <?php foreach ($vouchers as $voucher) : ?>
            
            <tr>
              
              <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                 <?php echo $voucher['id']; ?>
              </td>
              
               <td<?php echo (($sort == 'date_creature') ? ' class="sorted"' : ''); ?>>
                 <?php echo $voucher['date_creature']; ?>
              </td>
              
              <td<?php echo (($sort == 'creator') ? ' class="sorted"' : ''); ?>>
                 <?php echo $voucher['creator']; ?>
              </td>
              
              <td<?php echo (($sort == 'code') ? ' class="sorted"' : ''); ?>>
                 <?php echo $voucher['code']; ?>
              </td>
              
              <td<?php echo (($sort == 'amount') ? ' class="sorted"' : ''); ?>>
                 <?php echo $voucher['amount']; ?> <?if($voucher['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($voucher['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($voucher['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($voucher['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($voucher['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($voucher['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?>
              </td>
              
               <td<?php echo (($sort == 'status') ? ' class="sorted"' : ''); ?>>
                 <?if($voucher['status']==2){?>
                  <span class="label label-success"><?php echo lang('admin vouchers activated'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($voucher['status']==1){?>
                  <span class="label label-warning"><?php echo lang('admin vouchers pending'); ?></span>
                 <?}else{?>
                 <?}?>
              </td>
              
              <td>
                <div class="text-center">
                  <a href="<?php echo $this_url; ?>/edit/<?php echo $voucher['id']; ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
                </div>
              </td>
              
            
            </tr>
            
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">
                        <?php echo lang('core error no_results'); ?>
                    </td>
                </tr>
            <?php endif; ?>
             
            </tbody>
         </table>
          <div class="card-footer">
          <div class="row">
                <div class="col-md-4 text-left">
                    <label><?php echo sprintf(lang('admin label rows'), $total); ?></label>
                </div>
                <div class="col-md-8">
                  <div class="pull-right">
                    <?php echo $pagination; ?>
                  </div>
                </div>
            </div>

        </div>
      </div>
    </section>
  </div>
 </div>
</div>

<!-- Modal search-->
                                                    <div class="modal right fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                      <div class="modal-dialog" role="document">
                                                        <div class="modal-content">

                                                          <div class="modal-header-right">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h5 class="modal-title" id="myModalLabel2"><i class="icon-magnifier icons"></i> <?php echo lang('admin log search'); ?></h5>
                                                          </div>
                                                          <?php echo form_open("{$this_url_4}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                                                          <div class="modal-body">
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans id'); ?></label>
                                                                    <?php echo form_input(array('name'=>'id', 'id'=>'id', 'class'=>'form-control underlined', 'placeholder'=>lang('admin trans id'), 'value'=>set_value('id', ((isset($filters['id'])) ? $filters['id'] : '')))); ?>
                                                                </div>
                                                                
                                                              </div>
                                                              <div class="col-md-6">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin tickets date'); ?></label>
                                                                    <?php echo form_input(array('name'=>'date_creature', 'id'=>'date_creature', 'class'=>'form-control underlined', 'placeholder'=>lang('admin tickets date'), 'value'=>set_value('date', ((isset($filters['date_creature'])) ? $filters['date'] : '')))); ?>
                                                                </div>
                                                                
                                                              </div>
                                                              
                                                              <div class="col-md-12">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin vouchers creator'); ?></label>
                                                                    <?php echo form_input(array('name'=>'creator', 'id'=>'creator', 'class'=>'form-control underlined', 'placeholder'=>lang('admin vouchers creator'), 'value'=>set_value('creator', ((isset($filters['creator'])) ? $filters['creator'] : '')))); ?>
                                                                </div>
                                                                
                                                              </div>
                                                              
                                                              
                                                              <div class="col-md-12">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin vouchers code'); ?></label>
                                                                    <?php echo form_input(array('name'=>'code', 'id'=>'code', 'class'=>'form-control underlined', 'placeholder'=>lang('admin vouchers code'), 'value'=>set_value('code', ((isset($filters['code'])) ? $filters['code'] : '')))); ?>
                                                                </div>
                                                                
                                                              </div>

                                                            </div>
                                                          </div>
                                                          <div class="modal-footer"> 
                                                              <a href="<?php echo $this_url; ?>" class="btn btn-warning btn-sm"><?php echo lang('core button reset'); ?></a> 
                                                              <button type="submit" name="submit" value="<?php echo lang('core button filter'); ?>" class="btn btn-primary btn-sm"><?php echo lang('core button filter'); ?></button> 
                                                          </div>
                                                          <?php echo form_close(); ?>

                                                        </div><!-- modal-content -->
                                                      </div><!-- modal-dialog -->
                                                    </div><!-- modal -->