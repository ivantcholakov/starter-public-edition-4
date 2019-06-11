<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin button processed_tickets'); ?></h3>
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
                          <?php if ($sort == 'date') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin tickets user'); ?></a>
                          <?php if ($sort == 'user') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin tickets title'); ?></a>
                          <?php if ($sort == 'title') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin col status'); ?></a>
                          <?php if ($sort == 'status') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                  </tr>

            </thead>
            <tbody>
              <?php // data rows ?>
            <?php if ($total) : ?>
            <?php foreach ($tickets as $ticket) : ?>
            
            <tr>
              
              <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                 <?php echo $ticket['id']; ?>
              </td>
              <td<?php echo (($sort == 'date') ? ' class="sorted"' : ''); ?>>
                 <?php echo $ticket['date']; ?>
              </td>
              <td<?php echo (($sort == 'user') ? ' class="sorted"' : ''); ?>>
                 <?php echo $ticket['user']; ?>
              </td>
              <td<?php echo (($sort == 'title') ? ' class="sorted"' : ''); ?>>
                 <?php echo $ticket['title']; ?>
              </td>
              
              <td<?php echo (($sort == 'status') ? ' class="sorted"' : ''); ?>>
                 <?if($ticket['status']==1){?>
                  <span class="label label-primary"><?php echo lang('admin tickets untreated'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($ticket['status']==2){?>
                  <span class="label label-success"><?php echo lang('admin tickets processed'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($ticket['status']==3){?>
                  <span class="label label-danger"><?php echo lang('admin tickets closed'); ?></span>
                 <?}else{?>
                 <?}?>
              </td>
              <td>
                <div class="text-center">
                  <a href="<?php echo $this_url; ?>/edit/<?php echo $ticket['id']; ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
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
                                                          <?php echo form_open("{$this_url_3}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                                                          <div class="modal-body">
                                                            <div class="row">
                                                              <div class="col-md-12">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans id'); ?></label>
                                                                    <?php echo form_input(array('name'=>'id', 'id'=>'id', 'class'=>'form-control underlined', 'placeholder'=>lang('admin trans id'), 'value'=>set_value('id', ((isset($filters['id'])) ? $filters['id'] : '')))); ?>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin tickets date'); ?></label>
                                                                    <?php echo form_input(array('name'=>'date', 'id'=>'date', 'class'=>'form-control underlined', 'placeholder'=>lang('admin tickets date'), 'value'=>set_value('date', ((isset($filters['date'])) ? $filters['date'] : '')))); ?>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin tickets user'); ?></label>
                                                                    <?php echo form_input(array('name'=>'user', 'id'=>'user', 'class'=>'form-control underlined', 'placeholder'=>lang('admin tickets user'), 'value'=>set_value('user', ((isset($filters['user'])) ? $filters['user'] : '')))); ?>
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