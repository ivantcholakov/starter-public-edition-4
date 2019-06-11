<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users trans all'); ?></h4>
      </div>
      <div class="col-md-6 hidden-xs">
        
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <th><?php echo lang('users trans id'); ?></th>
          <th><?php echo lang('users trans date'); ?></th>
          <th></th>
          <th><?php echo lang('users trans type'); ?></th>
          <th><?php echo lang('users trans sum'); ?></th>
          <th class="text-center"><?php echo lang('users trans cyr'); ?></th>
          <th><?php echo lang('users trans status'); ?></th>
          <th></th>
        </thead>
        <tbody>
          <?php if ($total) : ?>
            <?php foreach ($history as $view) : ?>
            <tr>
              <td><?php echo $view['id']; ?></td>
              <td> <i class="icon-clock icons"></i> <?php echo $view['time']; ?></td>
              <td>
                
                <?if($view['sender']=="system"){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/fiat.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}elseif($view['sender']=="PayPal"){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/paypal.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}elseif($view['sender']=="Bitcoin"){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/btc.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}elseif($view['sender']=="Payeer"){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/payeer.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}elseif($view['sender']=="Perfect Money"){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/pm.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}elseif($view['sender']=="ADV Cash"){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/advcash.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                 <?}elseif($view['sender']=="SWIFT"){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/swift.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}elseif($view['sender']==$user['username']){?>
                <img src="<?php echo base_url();?>themes/default/img/icon/fiat.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}else{?>
                <img src="<?php echo base_url();?>themes/default/img/icon/fiat.png" class="img-circle" rel='tooltip' title="<?php echo $view['sender']; ?>">
                <?}?>

              </td>
              <td>
                <?if($view['type']==1){?>
                              <?php echo lang('users trans deposit'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view['type']==2){?>
                              <?php echo lang('users trans withdrawal'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view['type']==3){?>
                              <?php echo lang('users trans transfer'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view['type']==4){?>
                              <?php echo lang('users trans exchange'); ?>
                            <?}else{?>
                            <?}?>
                           <?if($view['type']==5){?>
                              <?php echo lang('users trans external'); ?>
                            <?}else{?>
                            <?}?>
              </td>
              <td>
                <?if($view['sender']==$user['username'] && $view['sum']>0){?>
                <span class="text-danger">- <?php echo $view['sum']; ?></span>
                
                <?}elseif($view['type']==3 && $view['sender']==$user['username'] && $view['sum']>0){?>
                <span class="text-danger">- <?php echo $view['sum']; ?></span>
                
                <?}elseif($view['type']==3 && $view['sender']!=$user['username'] && $view['sum']>0){?>
                <span class="text-success">+ <?php echo $view['amount']; ?></span>
                
                <?}elseif($view['sender']!=$user['username'] && $view['sum']>0){?>
                <span class="text-success">+ <?php echo $view['sum']; ?></span>
                
                <?}else{?>

                <span class="text-danger"><?php echo $view['sum']; ?></span>
                
                
                <?}?>

              </td>
              <td class="text-center">
                <?if($view['currency']=='debit_base'){?>
                                <?php echo $this->currencys->display->base_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view['currency']=='debit_extra1'){?>
                                <?php echo $this->currencys->display->extra1_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view['currency']=='debit_extra2'){?>
                                <?php echo $this->currencys->display->extra2_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view['currency']=='debit_extra3'){?>
                                <?php echo $this->currencys->display->extra3_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view['currency']=='debit_extra4'){?>
                                <?php echo $this->currencys->display->extra4_code ?>
                            <?}else{?>
                            <?}?>
                            <?if($view['currency']=='debit_extra5'){?>
                                <?php echo $this->currencys->display->extra5_code ?>
                            <?}else{?>
                            <?}?>
              </td>
              <td>
                <?if($view['status']==1){?>
                              <span class="label label-primary"> <?php echo lang('users trans pending'); ?> </span>
                            <?}else{?>
                            <?}?>
                            <?if($view['status']==2){?>
                              <span class="label label-success"> <?php echo lang('users trans success'); ?> </span>
                            <?}else{?>
                            <?}?>
                            <?if($view['status']==3){?>
                              <span class="label label-default"> <?php echo lang('users trans refund'); ?> </span>
                            <?}else{?>
                            <?}?>
                            <?if($view['status']==4){?>
                              <span class="label label-danger"> <?php echo lang('users trans dispute'); ?> </span>
                            <?}else{?>
                            <?}?>
                            <?if($view['status']==5){?>
                              <span class="label label-warning"> <?php echo lang('users trans blocked'); ?> </span>
                            <?}else{?>
                            <?}?>
              </td>
              <td><a href="/account/detail_transaction/<?php echo $view['id']; ?>" class="btn btn-default btn-block"><?php echo lang('users trans detail'); ?></a></td>
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
      <div class="pull-right">
                <?php echo $pagination; ?>
              </div>
    </div>
</div>