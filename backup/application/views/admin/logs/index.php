<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin log list'); ?></h3>
        </div>
        <div class="header-block pull-right">
          <a href="<?php echo site_url("admin/logs/clear_log/") ?>" class="btn btn-danger btn-sm"><i class="icon-trash icons"></i> <?php echo lang('admin log clear'); ?></a
        </div>
     </div>
   </div>
 <section class="example">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
      <thead>
            <?php // sortable headers ?>
              <tr>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin log id'); ?></a>
                    <?php if ($sort == 'id') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </th>
               <th>
                    <a href="<?php echo current_url(); ?>?sort=user&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin log username'); ?></a>
                    <?php if ($sort == 'username') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=date&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin log date'); ?></a>
                    <?php if ($sort == 'date') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=ip&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin log ip'); ?></a>
                    <?php if ($sort == 'ip') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=event&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin log event'); ?></a>
                    <?php if ($sort == 'event') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </th>
                <th></th>
              </tr>
              <?php // search filters ?>
              <tr>
                <?php echo form_open("{$this_url}?sort={$sort}&dir={$dir}&limit={$limit}&offset=0{$filter}", array('role'=>'form', 'id'=>"filters")); ?>
                  <th></th>
                  <th<?php echo ((isset($filters['user'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'user', 'id'=>'user', 'class'=>'form-control form-control-sm', 'placeholder'=>lang('admin log username'), 'value'=>set_value('user', ((isset($filters['user'])) ? $filters['user'] : '')))); ?>
                  </th>
                  <th<?php echo ((isset($filters['date'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'date', 'id'=>'date', 'class'=>'form-control form-control-sm', 'placeholder'=>lang('admin log date'), 'value'=>set_value('date', ((isset($filters['date'])) ? $filters['date'] : '')))); ?>
                  </th>
                  <th<?php echo ((isset($filters['ip'])) ? ' class="has-success"' : ''); ?> colspan="2">
                        <?php echo form_input(array('name'=>'ip', 'id'=>'ip', 'class'=>'form-control form-control-sm', 'placeholder'=>lang('admin log ip'), 'value'=>set_value('ip', ((isset($filters['ip'])) ? $filters['ip'] : '')))); ?>
                  </th>
 
                  <th>
                    <div class="text-center">
                      <div class="btn-group"> 
                            <button type="submit" name="submit" value="<?php echo lang('core button filter'); ?>" class="btn btn-primary btn-sm"><?php echo lang('core button filter'); ?></button>
                            <a href="<?php echo $this_url; ?>" class="btn btn-warning btn-sm"><?php echo lang('core button reset'); ?></a> 
                      </div>
                    </div>
                  </th>
                <?php echo form_close(); ?>
             </tr>
            
          </thead>
          <tbody>
            <?php // data rows ?>
            <?php if ($total) : ?>
                <?php foreach ($logs as $log) : ?>
                  <tr>
                    <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?> width="5%">
                            <?php echo $log['id']; ?>
                    </td>
                     <td<?php echo (($sort == 'user') ? ' class="sorted"' : ''); ?> width="15%">
                            <?php echo $log['user']; ?>
                    </td>
                    <td<?php echo (($sort == 'date') ? ' class="sorted"' : ''); ?> width="20%">
                            <?php echo $log['date']; ?>
                    </td>
                    
                    <td<?php echo (($sort == 'ip') ? ' class="sorted"' : ''); ?> width="15%">
                            <?php echo $log['ip']; ?>
                    </td>
                    <td<?php echo (($sort == 'event') ? ' class="sorted"' : ''); ?> width="15%">
                      <?if($log['event']==1){?>
                        <?php echo lang('admin log login'); ?>
                      <?}else{?>
                      <?}?>
                          
                    </td>
                    <td width="13%">
                      <button type="button" class="btn btn-secondary btn-sm btn-block" data-toggle="collapse" data-target="#device<?php echo $log['id']; ?>"><i class="icon-screen-desktop icons"></i> <?php echo lang('admin log device'); ?></button>

                    </td>
                  </tr>
                  <tr class="hiddenRow">
                                                            <td class="hiddenRow" colspan="6" style="padding:0px">
                                                                <div class="accordian-body collapse" id="device<?php echo $log['id']; ?>"> 
                                                                    <div class="card card-default">
                                                                        <div class="card-block focuscard">
                                                                            <p class="text-primary"><?php echo lang('admin log device'); ?></p>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                      <?php echo $log['device']; ?>
                                                                              </div>
                                                                            </div>
                                                                        </div>
        
                                                                    </div>
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
    
    
    </div>
     </div>
  </div>
</section>
</div>
</div>