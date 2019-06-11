<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('contact all_list'); ?></h3>
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
                        <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col message_id'); ?></a>
                        <?php if ($sort == 'id') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                    </th>
                    <th>
                        <a href="<?php echo current_url(); ?>?sort=name&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col name'); ?></a>
                        <?php if ($sort == 'name') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                    </th>
                    <th>
                        <a href="<?php echo current_url(); ?>?sort=email&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col email'); ?></a>
                        <?php if ($sort == 'email') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                    </th>
                    <th>
                        <a href="<?php echo current_url(); ?>?sort=title&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col title'); ?></a>
                        <?php if ($sort == 'title') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                    </th>
                    <th>
                        <a href="<?php echo current_url(); ?>?sort=created&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('contact col created'); ?></a>
                        <?php if ($sort == 'created') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                    </th>
                    <th>
                        <?php echo lang('admin col actions'); ?>
                    </th>
                </tr>
              </thead>
              <tbody>
                <?php // data rows ?>
                <?php if ($total) : ?>
                    <?php foreach ($messages as $message) : ?>
                        <tr>
                            <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                                <?php echo $message['id']; ?>
                            </td>
                            <td<?php echo (($sort == 'name') ? ' class="sorted"' : ''); ?>>
                                <?php echo $message['name']; ?>
                            </td>
                            <td<?php echo (($sort == 'email') ? ' class="sorted"' : ''); ?>>
                                <?php echo $message['email']; ?>
                            </td>
                            <td<?php echo (($sort == 'title') ? ' class="sorted"' : ''); ?>>
                                <?php echo $message['title']; ?>
                            </td>
                            <td<?php echo (($sort == 'created') ? ' class="sorted"' : ''); ?>>
                                <?php echo $message['created']; ?>
                            </td>
                            <td>
                                <div class="text-right">
                                    <div class="btn-group">
                                      
                                            <button type="button" class="btn btn-secondary btn-sm btn-block" data-toggle="collapse" data-target="#message<?php echo $message['id']; ?>"><i class="icon-eye icons"></i> <?php echo lang('admin label read'); ?></button>
                                       
                                     
                                    </div>
                                </div>
                            </td>
                          <tr class="hiddenRow">
                          <td class="hiddenRow" colspan="6" style="padding:0px">
                             <div class="accordian-body collapse" id="message<?php echo $message['id']; ?>"> 
                              <div class="card card-default">
                                <div class="card-block focuscard">
                                  <p class="text-primary">#<?php echo $message['id']; ?> <?php echo $message['title']; ?></p>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <?php echo $message['message']; ?>
                                      </div>
                                    </div>
                                </div>
                              </div>
                             </div> 
                            </td>
                         </tr>
                        </tr>
                <?php // messages modal ?>
                <?php if ($total) : ?>

                  <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">
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
                                                              <div class="col-md-6">

                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('contact input name'); ?></label>
                                                                    <?php echo ((isset($filters['name'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'name', 'id'=>'name', 'class'=>'form-control underlined', 'placeholder'=>lang('contact input name'), 'value'=>set_value('name', ((isset($filters['name'])) ? $filters['name'] : '')))); ?>
                                                                </div>
                                                                
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('contact input title'); ?></label>
                                                                    <?php echo ((isset($filters['last_name'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'title', 'id'=>'title', 'class'=>'form-control underlined', 'placeholder'=>lang('contact input title'), 'value'=>set_value('title', ((isset($filters['title'])) ? $filters['title'] : '')))); ?>
                                                                </div>
                                                                
                                                              </div>
                                                              <div class="col-md-6">

                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('contact input email'); ?></label>
                                                                    <?php echo ((isset($filters['email'])) ? ' class="has-success"' : ''); ?>>
                        <?php echo form_input(array('name'=>'email', 'id'=>'email', 'class'=>'form-control underlined', 'placeholder'=>lang('contact input email'), 'value'=>set_value('email', ((isset($filters['email'])) ? $filters['email'] : '')))); ?>
                                                                </div>
                                                                
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('contact input created'); ?></label>
                                                                    <?php echo form_input(array('name'=>'created', 'id'=>'created', 'class'=>'form-control underlined', 'placeholder'=>lang('contact input created'), 'value'=>set_value('created', ((isset($filters['created'])) ? $filters['created'] : '')))); ?>
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