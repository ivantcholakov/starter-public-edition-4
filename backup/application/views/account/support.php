<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users title all_tickets'); ?></h4>
      </div>
      <div class="col-md-6">
        <a href="/account/new_ticket" class="btn btn-primary pull-right"><i class="icon-plus icons"></i> <?php echo lang('users tickets add'); ?></a>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <th><?php echo lang('users trans id'); ?></th>
          <th><?php echo lang('users tickets date'); ?></th>
          <th><?php echo lang('users tickets title'); ?></th>
          <th><?php echo lang('users trans status'); ?></th>
          <th></th>
        </thead>
        <tbody>
          <?php if ($total) : ?>
            <?php foreach ($ticket as $view) : ?>
            <tr>
              <td><?php echo $view['id']; ?></td>
              <td><?php echo $view['date']; ?></td>
              <td><?php echo $view['title']; ?></td>
              <td>
                 <?if($view['status']==2){?>
                  <span class="label label-primary"><?php echo lang('users tickets untreated'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==1){?>
                  <span class="label label-success"><?php echo lang('users tickets processed'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==3){?>
                  <span class="label label-danger"><?php echo lang('users tickets closed'); ?></span>
                 <?}else{?>
                 <?}?></td>
              <td><a href="/account/detail_ticket/<?php echo $view['id']; ?>" class="btn btn-default btn-block"><?php echo lang('users trans detail'); ?></a></td>
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
      <div class="pull-right">
                <?php echo $pagination; ?>
              </div>
    </div>
</div>