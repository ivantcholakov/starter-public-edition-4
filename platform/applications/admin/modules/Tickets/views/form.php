<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-3">
    <ul class="list-group">
       <li class="list-group-item"><strong class="text-primary"><?php echo lang('admin tickets id'); ?>:</strong> <span class="pull-right"><?php echo $tickets['id']; ?></span></li>
       <li class="list-group-item"><strong class="text-primary"><?php echo lang('admin tickets date_info'); ?>:</strong> <span class="pull-right"><?php echo $tickets['date']; ?></span></li>
       <li class="list-group-item"><strong class="text-primary"><?php echo lang('admin tickets user'); ?>:</strong> <span class="pull-right"><?php echo $tickets['user']; ?></span></li>
       <li class="list-group-item"><strong class="text-primary"><?php echo lang('admin col status'); ?>:</strong> 
         <span class="pull-right">
                 <?if($tickets['status']==1){?>
                  <span class="label label-primary"><?php echo lang('admin tickets untreated'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($tickets['status']==2){?>
                  <span class="label label-success"><?php echo lang('admin tickets processed'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($tickets['status']==3){?>
                  <span class="label label-danger"><?php echo lang('admin tickets closed'); ?></span>
                 <?}else{?>
                 <?}?>
         </span>
      </li>
    </ul>
  </div>
  <div class="col-md-9">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo $tickets['title']; ?></h3>
        </div>                                   
      </div>
      <section class="example">
        <div class="card-block">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-default" style="border:1px solid rgb(239, 239, 239)">
                <div class="card-header">
                  <div class="header-block">
                    <p class="title" style="font-size:1rem">
                      <?php echo $tickets['user']; ?>
                    </p>
                  </div>
                  <div class="header-block pull-right">
                    <i class="icon-pin icons"></i>
                  </div>
                </div>
                <div class="card-block">
                  <p>
                    <?php echo $tickets['message']; ?>
                  </p>
                </div>
                <div class="card-footer">
                  <p>
                    <i class="icon-clock icons"></i> <?php echo $tickets['date']; ?>
                  </p>
                </div>
              </div>
              <?php foreach($log_comment->result() as $view) : ?>
              <div class="card card-<?if($view->role==1){?>default<?}else{?><?}?><?if($view->role==2){?>primary<?}else{?><?}?>" style="border:1px solid rgb(239, 239, 239)">
                <div class="card-header">
                  <div class="header-block">
                    <p class="title" style="font-size:1rem">
                      <?php echo $view->user ?>
                    </p>
                  </div>
                  <div class="header-block pull-right">
                    <i class="icon-pin icons"></i>
                  </div>
                </div>
                <div class="card-block">
                  <p>
                    <?php echo $view->comment ?>
                  </p>
                </div>
                <div class="card-footer">
                  <p>
                    <i class="icon-clock icons"></i> <?php echo $view->date ?>
                  </p>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </section>
    </div>
    <?php echo form_open(site_url("admin/tickets/add_admin_comment/" . $tickets['id']), array("" => "")) ?>
    <div class="card card-default">
      <div class="card-block">
              <label for="transaction" class="control-label"><?php echo lang('admin disputes new_comment'); ?></label>   
              <textarea name="comment" class="form-control underlined" rows="10" placeholder="<?php echo lang('admin tickets textarea'); ?>"></textarea>
      </div>
      <div class="card-footer" style="text-align:right"> 
        <a class="btn btn-danger btn-sm" href="<?php echo $this_url; ?>/close_ticket/<?php echo $tickets['id']; ?>"><?php echo lang('admin tickets close'); ?></a>
        <button type="submit"  class="btn btn-primary btn-sm"><?php echo lang('admin tickets reply'); ?></button>
      </div>
    </div>
    <?php echo form_close(); ?>  
  </div>
</div>