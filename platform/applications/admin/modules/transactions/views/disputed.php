<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin trans dis_trans'); ?></h3>
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
                    <?php if ($sort == 'id') : ?> <i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin trans type'); ?></a>
                    <?php if ($sort == 'type') : ?> <i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <?php echo lang('admin trans status'); ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin trans sender'); ?></a>
                    <?php if ($sort == 'sender') : ?> <i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin trans receiver'); ?></a>
                    <?php if ($sort == 'receiver') : ?> <i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin trans time'); ?></a>
                    <?php if ($sort == 'time') : ?> <i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                 <th>
                    <?php echo lang('admin button currency'); ?>
                </th>
                <th>
                    <?php echo lang('admin trans sum'); ?>
                </th>
                <th>
                    <?php echo lang('admin trans fee'); ?>
                </th>
                <th>
                    <?php echo lang('admin trans amount'); ?>
                </th>
                <th class="text-center"></th>
            </tr>
            <?php // search filters ?>
          </thead>
          <tbody>
            <?php // data rows ?>
            <?php if ($total) : ?>
            <?php foreach ($transactions as $transaction) : ?>
            <tr <?if($transaction['status']==4){?> class="danger" <?}else{?><?}?> >
              <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                 <?php echo $transaction['id']; ?>
              </td>
              <td<?php echo (($sort == 'type') ? ' class="sorted"' : ''); ?>>
                 <?if($transaction['type']==1){?>
                      <?php echo lang('admin trans deposit'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transaction['type']==2){?>
                      <?php echo lang('admin trans withdrawal'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transaction['type']==3){?>
                      <?php echo lang('admin trans transfer'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transaction['type']==4){?>
                      <?php echo lang('admin trans exchange'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($transaction['type']==5){?>
                      <?php echo lang('admin trans external'); ?>
                 <?}else{?>
                 <?}?>
              </td>
              <td<?php echo (($sort == 'status') ? ' class="sorted"' : ''); ?>>
                 <?if($transaction['status']==1){?>
                <span class="label label-primary"> <?php echo lang('admin trans pending'); ?> </span>
                 <?}else{?>
                 <?}?>
                 <?if($transaction['status']==2){?>
                <span class="label label-success"> <?php echo lang('admin trans success'); ?> </span>
                 <?}else{?>
                 <?}?>
                 <?if($transaction['status']==3){?>
                <span class="label label-info"> <?php echo lang('admin trans refund'); ?> </span>
                 <?}else{?>
                 <?}?>
                <?if($transaction['status']==4){?>
                <span class="label label-danger"> <?php echo lang('admin trans dispute'); ?> </span>
                 <?}else{?>
                 <?}?>
                 <?if($transaction['status']==5){?>
                <span class="label label-warning"> <?php echo lang('admin trans blocked'); ?> </span>
                 <?}else{?>
                 <?}?>
              </td>
              <td<?php echo (($sort == 'sender') ? ' class="sorted"' : ''); ?>>
                 <?php echo $transaction['sender']; ?>
              </td>
              <td<?php echo (($sort == 'receiver') ? ' class="sorted"' : ''); ?>>
                 <?php echo $transaction['receiver']; ?>
              </td>
              <td<?php echo (($sort == 'time') ? ' class="sorted"' : ''); ?>>
                 <?php echo $transaction['time']; ?>
              </td>
              <td class="center">
                  <?if($transaction['currency']=='debit_base'){?>
                      <?php echo $this->currencys->display->base_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transaction['currency']=='debit_extra1'){?>
                      <?php echo $this->currencys->display->extra1_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transaction['currency']=='debit_extra2'){?>
                      <?php echo $this->currencys->display->extra2_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transaction['currency']=='debit_extra3'){?>
                      <?php echo $this->currencys->display->extra3_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transaction['currency']=='debit_extra4'){?>
                      <?php echo $this->currencys->display->extra4_code ?>
                  <?}else{?>
                  <?}?>
                  <?if($transaction['currency']=='debit_extra5'){?>
                      <?php echo $this->currencys->display->extra5_code ?>
                  <?}else{?>
                  <?}?>
              </td>
              <td>
                 <?php echo $transaction['sum']; ?>
              </td>
              <td>
                 <?php echo $transaction['fee']; ?>
              </td>
              <td>
                 <?php echo $transaction['amount']; ?>
              </td>
              <td class="text-center">
                <div class="text-center">
                  <a href="<?php echo $this_url; ?>/edit/<?php echo $transaction['id']; ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">
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
                                                              <div class="col-md-12">
                                                                 <div class="form-group" style="margin-bottom:1rem"> 
                                                                    <label class="control-label"><?php echo lang('admin trans type'); ?></label>
                                                                    <select name="type" id="type" class="form-control underlined">
                                                                       <option> </option>
                                                                       <option value="1"><?php echo lang('admin trans deposit'); ?></option>
                                                                       <option value="2"><?php echo lang('admin trans withdrawal'); ?></option>
                                                                       <option value="3"><?php echo lang('admin trans transfer'); ?></option>
                                                                       <option value="4"><?php echo lang('admin trans exchange'); ?></option>
                                                                       <option value="5"><?php echo lang('admin trans external'); ?></option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans sender'); ?></label>
                                                                    <?php echo form_input(array('name'=>'sender', 'id'=>'sender', 'class'=>'form-control underlined', 'placeholder'=>lang('admin trans sender'), 'value'=>set_value('sender', ((isset($filters['sender'])) ? $filters['sender'] : '')))); ?>
                                                                </div>
                                                              </div>
    
                                                              <div class="col-md-12">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans time'); ?></label>
                                                                    <?php echo form_input(array('name'=>'time', 'id'=>'time', 'class'=>'form-control underlined', 'placeholder'=>lang('admin trans time'), 'value'=>set_value('time', ((isset($filters['time'])) ? $filters['time'] : '')))); ?>
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
    
    
    </div>
      </div>
    </section>
   </div>
  </div>
</div>