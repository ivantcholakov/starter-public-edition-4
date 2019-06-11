<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin verification all'); ?></h3>
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
                        <?php echo lang('admin verification img'); ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin tickets user'); ?></a>
                          <?php if ($sort == 'user') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                          <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin trans type'); ?></a>
                          <?php if ($sort == 'type') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                      </th>
                      <th>
                        <?php echo lang('admin tickets date'); ?>
                      </th>
                      <th>
                        <?php echo lang('admin trans status'); ?>
                      </th>
                  </tr>

            </thead>
            <tbody>
              <?php // data rows ?>
            <?php if ($total) : ?>
              <?php foreach ($verification as $view) : ?>
            
            <tr>
              
              <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                 <?php echo $view['id']; ?>
              </td>
              <td>
                 <img class="center-block" src="<?php echo base_url();?>docbank/<?php echo $view['img']; ?>" style="height:50px; max-width:50px">
              </td>
              <td<?php echo (($sort == 'user') ? ' class="sorted"' : ''); ?>>
                 <?php echo $view['user']; ?>
              </td>
              <td<?php echo (($sort == 'type') ? ' class="sorted"' : ''); ?>>
                  <?if($view['type']==1){?>
                    <?php echo lang('admin verification doc_user'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($view['type']==2){?>
                  <?php echo lang('admin verification doc_adress'); ?>
                 <?}else{?>
                 <?}?>
                 <?if($view['type']==3){?>
                  <?php echo lang('admin verification doc_bus'); ?>
                 <?}else{?>
                 <?}?>
              </td>
              <td<?php echo (($sort == 'date') ? ' class="sorted"' : ''); ?>>
                 <?php echo $view['date']; ?>
              </td>
              
              <td>
                 <?if($view['status']==1){?>
                  <span class="label label-primary"><?php echo lang('admin verification pending'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==2){?>
                  <span class="label label-success"><?php echo lang('admin verification confirmed'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==3){?>
                  <span class="label label-danger"><?php echo lang('admin verification disapproved'); ?></span>
                 <?}else{?>
                 <?}?>
              </td>
              <td>
                <div class="text-center">
                  <a href="#modal-<?php echo $view['id']; ?>" data-toggle="modal" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
                </div>
              </td>
            
            </tr>
            <?php // img modal ?>
        <div class="modal fade" id="modal-<?php echo $view['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-<?php echo $view['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 id="modal-label-<?php echo $view['id']; ?>"><?if($view['type']==1){?><?php echo lang('admin verification doc_user'); ?><?}else{?><?}?><?if($view['type']==2){?><?php echo lang('admin verification doc_adress'); ?><?}else{?><?}?><?if($view['type']==3){?><?php echo lang('admin verification doc_bus'); ?><?}else{?><?}?> <?php echo lang('admin verification doc_for'); ?> <?php echo $view['user']; ?></h6>
                    </div>
                    <div class="modal-body">
                        <img class="img-responsive" src="<?php echo base_url();?>docbank/<?php echo $view['img']; ?>" style="max-width:100%">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?php echo lang('core button cancel'); ?></button>
                        <div class="btn-group dropup"> 
                          <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo lang('admin verification action'); ?></button>
                          <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="<?php echo $this_url; ?>/confirm/<?php echo $view['id']; ?>"><?php echo lang('admin verification comfirm'); ?></a> 
                            <a class="dropdown-item" href="<?php echo $this_url; ?>/confirm_verify/<?php echo $view['id']; ?>"><?php echo lang('admin verification comfirm_ver'); ?></a> 
                            <a class="dropdown-item" href="<?php echo $this_url; ?>/confirm_business/<?php echo $view['id']; ?>"><?php echo lang('admin verification comfirm_bus'); ?></a>
                            <div class="dropdown-divider"></div> 
                            <a class="dropdown-item" href="<?php echo $this_url; ?>/reject/<?php echo $view['id']; ?>"><?php echo lang('admin verification reject'); ?></a> 
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                                          <?php echo form_open("{$this_url}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                                                          <div class="modal-body">
                                                            <div class="row">
                                                              <div class="col-md-12">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans id'); ?></label>
                                                                    <?php echo form_input(array('name'=>'id', 'id'=>'id', 'class'=>'form-control underlined', 'placeholder'=>lang('admin trans id'), 'value'=>set_value('id', ((isset($filters['id'])) ? $filters['id'] : '')))); ?>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin tickets user'); ?></label>
                                                                    <?php echo form_input(array('name'=>'user', 'id'=>'user', 'class'=>'form-control underlined', 'placeholder'=>lang('admin tickets user'), 'value'=>set_value('user', ((isset($filters['user'])) ? $filters['user'] : '')))); ?>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('admin trans status'); ?></label>
                                                                    <select name="type" id="type" class="form-control underlined">
                                                                           <option> </option>
                                                                           <option value="1"><?php echo lang('admin verification doc_user'); ?></option>
                                                                           <option value="2"><?php echo lang('admin verification doc_adress'); ?></option>
                                                                           <option value="3"><?php echo lang('admin verification doc_bus'); ?></option>
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