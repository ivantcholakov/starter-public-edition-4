<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin disputes all_dispute'); ?></h3>
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
                    <?php echo lang('admin disputes id_tran'); ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin disputes time_dispute'); ?></a>
                    <?php if ($sort == 'time_dispute') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin disputes claimant'); ?></a>
                    <?php if ($sort == 'claimant') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin disputes defendant'); ?></a>
                    <?php if ($sort == 'defendant') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin disputes status'); ?></a>
                    <?php if ($sort == 'status') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
            </tr>
            
      </thead>
          <tbody>
              <?php // data rows ?>
            <?php if ($total) : ?>
            <?php foreach ($disputes as $dispute) : ?>
            
            <tr>
              
              <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                 <?php echo $dispute['id']; ?>
              </td>
              <td<?php echo (($sort == 'transaction') ? ' class="sorted"' : ''); ?>>
                 <?php echo $dispute['transaction']; ?>
              </td>
              <td<?php echo (($sort == 'time_dispute') ? ' class="sorted"' : ''); ?>>
                 <?php echo $dispute['time_dispute']; ?>
              </td>
              <td<?php echo (($sort == 'claimant') ? ' class="sorted"' : ''); ?>>
                 <?php echo $dispute['claimant']; ?>
              </td>
              <td<?php echo (($sort == 'defendant') ? ' class="sorted"' : ''); ?>>
                 <?php echo $dispute['defendant']; ?>
              </td>
              <td<?php echo (($sort == 'status') ? ' class="sorted"' : ''); ?>>
                 <?if($dispute['status']==1){?>
                  <span class="label label-primary"><?php echo lang('admin disputes open'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($dispute['status']==2){?>
                  <span class="label label-danger"><?php echo lang('admin disputes claim'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($dispute['status']==3){?>
                  <span class="label label-warning"><?php echo lang('admin disputes rejected'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($dispute['status']==4){?>
                  <span class="label label-success"><?php echo lang('admin disputes satisfied'); ?></span>
                 <?}else{?>
                 <?}?>
              </td>
              <td>
                <div class="text-center">
                  <a href="<?php echo $this_url; ?>/edit/<?php echo $dispute['id']; ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
                </div>
              </td>
            
            </tr>
            
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8">
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
  </div>
</section>
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
                                                          <?php echo form_open("{$this_url}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                                                          <div class="modal-body">
                                                            <div class="row">
                                                              <div class="col-md-6">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans id'); ?></label>
                                                                    <?php echo form_input(array('name'=>'id', 'id'=>'id', 'class'=>'form-control underlined', 'placeholder'=>lang('admin trans id'), 'value'=>set_value('id', ((isset($filters['id'])) ? $filters['id'] : '')))); ?>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin disputes time_dispute'); ?></label>
                                                                    <?php echo form_input(array('name'=>'time_dispute', 'id'=>'time_dispute', 'class'=>'form-control underlined', 'placeholder'=>lang('admin disputes time_dispute'), 'value'=>set_value('time_dispute', ((isset($filters['time_dispute'])) ? $filters['time_dispute'] : '')))); ?>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin disputes defendant'); ?></label>
                                                                    <?php echo form_input(array('name'=>'defendant', 'id'=>'defendant', 'class'=>'form-control underlined', 'placeholder'=>lang('admin disputes defendant'), 'value'=>set_value('defendant', ((isset($filters['defendant'])) ? $filters['defendant'] : '')))); ?>
                                                                </div>
                                                              </div>
                                                              
                                                              
                                                              <div class="col-md-6">

                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin disputes id_tran'); ?></label>
                                                                     <?php echo form_input(array('name'=>'transaction', 'id'=>'transaction', 'class'=>'form-control underlined', 'placeholder'=>lang('admin disputes id_tran'), 'value'=>set_value('transaction', ((isset($filters['transaction'])) ? $filters['transaction'] : '')))); ?>
                                                                </div>
                                                                
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin disputes claimant'); ?></label>
                                                                    <?php echo form_input(array('name'=>'claimant', 'id'=>'claimant', 'class'=>'form-control underlined', 'placeholder'=>lang('admin disputes claimant'), 'value'=>set_value('claimant', ((isset($filters['claimant'])) ? $filters['claimant'] : '')))); ?>
                                                                </div>
                                                                
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans status'); ?></label>
                                                                   <select name="status" id="status" class="form-control underlined">
                                                                     <option> </option>
                                                                     <option value="1"><?php echo lang('admin disputes open'); ?></option>
                                                                     <option value="2"><?php echo lang('admin disputes claim'); ?></option>
                                                                     <option value="3"><?php echo lang('admin disputes rejected'); ?></option>
                                                                     <option value="4"><?php echo lang('admin disputes satisfied'); ?></option>
                                                                  </select>
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