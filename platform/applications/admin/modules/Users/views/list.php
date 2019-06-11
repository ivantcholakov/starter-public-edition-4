<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin button users_all'); ?></h3>
        </div>
        <div class="header-block pull-right">
          <?php if ($total) : ?>
                    <a href="<?php echo $this_url; ?>/export?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?><?php echo $filter; ?>" class="btn btn-success btn-sm"><i class="icon-cloud-download icons"></i> <?php echo lang('admin button csv_export'); ?></a>
                <?php endif; ?> <button type="button" data-toggle="modal" data-target="#search" class="btn btn-warning btn-sm"><i class="icon-magnifier icons"></i> <?php echo lang('admin log search'); ?></button>
        </div>
        </div>

   
    <section class="example">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <?php // sortable headers ?>
            <tr>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=id&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('users col user_id'); ?></a>
                    <?php if ($sort == 'id') : ?><span class="glyphicon glyphicon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?>"></span><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=username&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('users col username'); ?></a>
                    <?php if ($sort == 'username') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=first_name&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('users col first_name'); ?></a>
                    <?php if ($sort == 'first_name') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=last_name&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('users col last_name'); ?></a>
                    <?php if ($sort == 'last_name') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=status&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('admin col status'); ?></a>
                    <?php if ($sort == 'status') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th>
                    <a href="<?php echo current_url(); ?>?sort=is_admin&dir=<?php echo (($dir == 'asc' ) ? 'desc' : 'asc'); ?>&limit=<?php echo $limit; ?>&offset=<?php echo $offset; ?><?php echo $filter; ?>"><?php echo lang('users col is_admin'); ?></a>
                    <?php if ($sort == 'is_admin') : ?><i class="icon-arrow-<?php echo (($dir == 'asc') ? 'up' : 'down'); ?> icons"></i><?php endif; ?>
                </th>
                <th><?php echo lang('admin col actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php // data rows ?>
            <?php if ($total) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td<?php echo (($sort == 'id') ? ' class="sorted"' : ''); ?>>
                            <?php echo $user['id']; ?>
                        </td>
                        <td<?php echo (($sort == 'username') ? ' class="sorted"' : ''); ?>>
                            <?php echo $user['username']; ?>
                        </td>
                        <td<?php echo (($sort == 'first_name') ? ' class="sorted"' : ''); ?>>
                            <?php echo $user['first_name']; ?>
                        </td>
                        <td<?php echo (($sort == 'last_name') ? ' class="sorted"' : ''); ?>>
                            <?php echo $user['last_name']; ?>
                        </td>
                        <td<?php echo (($sort == 'status') ? ' class="sorted"' : ''); ?>>
                            <?php echo ($user['status']) ? '<span class="label label-success">' . lang('admin input active') . '</span>' : '<span class="label label-danger">' . lang('admin input inactive') . '</span>'; ?>
                        </td>
                        <td<?php echo (($sort == 'is_admin') ? ' class="sorted"' : ''); ?>>
                            <?php echo ($user['is_admin']) ? lang('core text yes') : lang('core text no'); ?>
                        </td>
                        <td>
                               
                                    <?php if ($user['id'] > 1) : ?>
                                        <a href="#modal-<?php echo $user['id']; ?>" data-toggle="modal" class="btn btn-down btn-danger"><i class="icon-close icons"></i></a>
                                    <?php endif; ?>
                                    <a href="<?php echo $this_url; ?>/edit/<?php echo $user['id']; ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
                               
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
                                                                  <label class="control-label"><?php echo lang('users input username'); ?></label>
                                                                    <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form-control underlined', 'placeholder'=>lang('users input username'), 'value'=>set_value('username', ((isset($filters['username'])) ? $filters['username'] : '')))); ?>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-6">

                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('users input first_name'); ?></label>
                                                                    <?php echo form_input(array('name'=>'first_name', 'id'=>'first_name', 'class'=>'form-control underlined', 'placeholder'=>lang('users input first_name'), 'value'=>set_value('first_name', ((isset($filters['first_name'])) ? $filters['first_name'] : '')))); ?>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-12">
                                                                <div class="form-group" style="margin-bottom:1rem"> 
                                                                  <label class="control-label"><?php echo lang('users input last_name'); ?></label>
                                                                    <?php echo form_input(array('name'=>'last_name', 'id'=>'username', 'class'=>'form-control underlined', 'placeholder'=>lang('users input last_name'), 'value'=>set_value('last_name', ((isset($filters['last_name'])) ? $filters['last_name'] : '')))); ?>
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
<?php // delete modal ?>
<?php if ($total) : ?>
    <?php foreach ($users as $user) : ?>
        <?php echo form_open('admin/users/delete/'. $user['id'] . '', array('role'=>'form')); ?>

              <?php // hidden id ?>
              <?php if (isset($user['id'])) : ?>
                  <?php echo form_hidden('id', $user['id']); ?>
              <?php endif; ?>
        <div class="modal fade" id="modal-<?php echo $user['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-<?php echo $user['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 id="modal-label-<?php echo $user['id']; ?>"><?php echo lang('users title user_delete');  ?></h6>
                    </div>
                    <div class="modal-body">
                        <p><?php echo sprintf(lang('users msg delete_confirm'), $user['first_name'] . " " . $user['last_name']); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?php echo lang('core button cancel'); ?></button>
                        <button type="submit" class="btn btn-primary btn-delete-user btn-sm" data-id="<?php echo $user['id']; ?>"><?php echo lang('admin button delete'); ?></button>
                    </div>
                </div>
            </div>
        </div>
<?php echo form_close(); ?>
    <?php endforeach; ?>
<?php endif; ?>

