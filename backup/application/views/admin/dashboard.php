<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="section" style="margin-bottom:25px">
<div class="row">
  <div class="col-md-4">
    <div class="card card-widget-success">
      <div class="card-block">
        <div class="widget-title"><?php echo lang('admin dashboard users'); ?></div>
        <span class="icon-people icons"></span>
        <div class="result"><?php echo number_format($total_users) ?></div>
        <div class="widget-link"><a href="/admin/users"><?php echo lang('admin dashboard link'); ?></a></div>
      </div>
   </div>
  </div>   
  
  <div class="col-md-4">
    <div class="card card-widget-warning">
      <div class="card-block">
        <div class="widget-title"><?php echo lang('admin dashboard trans'); ?></div>
        <span class="icon-directions icons"></span>
        <div class="result"><?php echo number_format($total_transactions) ?></div>
        <div class="widget-link"><a href="/admin/transactions"><?php echo lang('admin dashboard link'); ?></a></div>
      </div>
   </div>
  </div>   
  
  <div class="col-md-4">
    <div class="card card-widget-info">
      <div class="card-block">
        <div class="widget-title"><?php echo lang('admin dashboard dispute'); ?></div>
        <span class="icon-shield icons"></span>
        <div class="result"><?php echo number_format($total_disputes) ?></div>
        <div class="widget-link"><a href="/admin/disputes"><?php echo lang('admin dashboard link'); ?></a></div>
      </div>
   </div>
  </div>  
  
  <?if($limit_dep > 15){?>
  <div class="col-md-12">
    <div class="alert alert-danger">
      <?php echo lang('admin label limit'); ?> <?php echo lang('admin trans deposit'); ?>! <a href="https://blog.blockchain.com/2016/06/15/receive-payments-api-update-address-gap-limits/" target="_blank" class="alert-link"> <?php echo lang('admin label more'); ?></a>
    </div>
  </div>
  <?}else{?>
  <?}?>
  
  <?if($limit_sci > 15){?>
  <div class="col-md-12">
    <div class="alert alert-danger">
      <?php echo lang('admin label limit'); ?> SCI! <a href="https://blog.blockchain.com/2016/06/15/receive-payments-api-update-address-gap-limits/" target="_blank" class="alert-link"> <?php echo lang('admin label more'); ?></a>
    </div>
  </div>
  <?}else{?>
  <?}?>
  
</div>
</section>

<div class="row">
  <div class="col-md-12">
     <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin dashboard last_trans'); ?></h3>
        </div>
        <div class="header-block pull-right">
          <i class="icon-credit-card icons"></i>
        </div>
     </div>
      <div class="card-block">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <th><?php echo lang('admin trans id'); ?></th>
              <th><?php echo lang('admin trans type'); ?></th>
 
              <th><?php echo lang('admin button currency'); ?></th>
              <th><?php echo lang('admin trans amount'); ?></th>
              <th><?php echo lang('admin trans fee'); ?></th>
              <th><?php echo lang('admin trans sum'); ?></th>
            </thead>
            <tbody>
                      <?php foreach($log_transaction->result() as $view) : ?>
                      <tr>
                         <td><?php echo $view->id ?></td>
                         <td>
                            <?if($view->type==1){?>
                              <?php echo lang('admin trans deposit'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view->type==2){?>
                              <?php echo lang('admin trans withdrawal'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view->type==3){?>
                              <?php echo lang('admin trans transfer'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view->type==4){?>
                              <?php echo lang('admin trans exchange'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view->type==5){?>
                              <?php echo lang('admin trans external'); ?>
                            <?}else{?>
                            <?}?>
                         </td>
                         <td class="center">
                            <?if($view->currency=='debit_base'){?>
                                <?php echo $this->currencys->display->base_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view->currency=='debit_extra1'){?>
                                <?php echo $this->currencys->display->extra1_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view->currency=='debit_extra2'){?>
                                <?php echo $this->currencys->display->extra2_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view->currency=='debit_extra3'){?>
                                <?php echo $this->currencys->display->extra3_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view->currency=='debit_extra4'){?>
                                <?php echo $this->currencys->display->extra4_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view->currency=='debit_extra5'){?>
                                <?php echo $this->currencys->display->extra5_code ?>
                            <?}else{?>
                            <?}?>
                        </td>
                         <td><?php echo $view->amount ?></td>
                         <td><?php echo $view->fee ?></td>
                         <td><?php echo $view->sum ?></td>
                         <td class="text-center">
                           <a href="/admin/transactions/edit/<?php echo $view->id ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a> 
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer"> 
        <div class="text-center">
          <a href="/admin/transactions" class="btn btn-primary btn-sm"><i class="icon-eye icons"></i> <?php echo lang('admin dashboard link'); ?></a>
        </div>
      </div>
    </div>
  </div>  

<div class="col-md-12">
  <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin dashboard last_tickets'); ?></h3>
        </div>
        <div class="header-block pull-right">
          <i class="icon-envelope-letter icons"></i>
        </div>
     </div>
      <div class="card-block">
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover">
           <thead>
             <th><?php echo lang('admin trans id'); ?></th>
             <th><?php echo lang('admin tickets user'); ?></th>
             <th><?php echo lang('admin tickets title'); ?></th>
             <th></th>
           </thead>
           <tbody>
             <?php foreach($log_ticket->result() as $view) : ?>
              <tr>
                <td><?php echo $view->id ?></td>
                <td><?php echo $view->user ?></td>
                <td><?php echo $view->title ?></td>
                <td>
                  <div class="text-center">
                    <a href="/admin/tickets/edit/<?php echo $view->id ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
           </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer"> 
        <div class="text-center">
          <a href="/admin/tickets" class="btn btn-primary btn-sm"><i class="icon-eye icons"></i> <?php echo lang('admin dashboard link'); ?></a>
        </div>
      </div>
    </div>
</div>
</div>
