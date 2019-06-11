<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users vouchers all'); ?></h4>
      </div>
      <div class="col-md-6 hidden-xs">
        <div class="btn-group pull-right">
					<a href="<?php echo base_url('account/activate_code'); ?>" class="btn btn-default"><i class="icon-key icons"></i> <?php echo lang('users vouchers ac'); ?></a>
					<a href="<?php echo base_url('account/new_code'); ?>" class="btn btn-default"><i class="icon-plus icons"></i> <?php echo lang('users vouchers new'); ?></a>
				</div>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <th><?php echo lang('users vouchers date_created'); ?></th>
          <th><?php echo lang('users vouchers code'); ?></th>
          <th><?php echo lang('users trans amount'); ?></th>
          <th><?php echo lang('users disputes status'); ?></th>
        </thead>
        <tbody>
          <?php if ($total) : ?>
            <?php foreach ($vouchers as $view) : ?>
            <tr>
              
							<td><?php echo $view['date_creature']; ?></td>
            	<td><?php echo $view['code']; ?></td>
							<td><?php echo $view['amount']; ?> <?if($view['currency']=='debit_base'){?>
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
                            <?}?></td>
							<td>
                <?if($view['status']==1){?>
                              <span class="label label-primary"> <?php echo lang('users trans pending'); ?> </span>
                            <?}else{?>
                            <?}?>
                            <?if($view['status']==2){?>
                              <span class="label label-success"> <?php echo lang('users vouchers activated'); ?> </span>
                            <?}else{?>
                            <?}?>
                           
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
      <div class="pull-right">
                <?php echo $pagination; ?>
              </div>
    </div>
</div>