<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users merchants all'); ?></h4>
      </div>
      <div class="col-md-6">
        <a href="/account/new_merchant" class="btn btn-primary pull-right"><i class="icon-plus icons"></i> <?php echo lang('users merchants create'); ?></a>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <th><?php echo lang('users trans id'); ?></th>
          <th><?php echo lang('users merchants name'); ?></th>
          <th><?php echo lang('users merchants url'); ?></th>
          <th><?php echo lang('users trans status'); ?></th>
          <th></th>
          <th></th>
        </thead>
         <tbody>
          <?php if ($total) : ?>
            <?php foreach ($merchant as $view) : ?>
            <tr>
              <td><?php echo $view['id']; ?></td>
               <td><?php echo $view['name']; ?></td>
               <td><?php echo $view['link']; ?></td>
               <td><?if($view['status']==1){?>
                  <span class="label label-success"><?php echo lang('users merchants active'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==2){?>
                  <span class="label label-warning"><?php echo lang('users merchants moderation'); ?></span>
                 <?}else{?>
                 <?}?>
                 <?if($view['status']==3){?>
                  <span class="label label-danger"><?php echo lang('users merchants disapproved'); ?></span>
                 <?}else{?>
                 <?}?></td>
               <td class="text-center"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="icon-magic-wand icons"></i></button></td>
               <td><a href="/account/detail_merchant/<?php echo $view['id']; ?>" class="btn btn-default btn-block"><?php echo lang('users trans detail'); ?></a></td>
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
               
      </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('users merchants html'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
               <label><?php echo lang('users merchants id'); ?>*</label>
               <input type="text" class="form-control" name="id_merch" id="id_merch">
            </div>
            <div class="form-group">
               <label><?php echo lang('users merchants item'); ?>*</label>
               <input type="text" class="form-control" name="item_name" id="item_name">
            </div>
            <div class="form-group">
               <label><?php echo lang('users merchants order'); ?>*</label>
               <input type="text" class="form-control" name="order" id="order">
            </div>
            <div class="form-group">
               <label><?php echo lang('users merchants price'); ?>, <?php echo $this->currencys->display->base_code ?>*</label>
               <input type="text" class="form-control" name="amount" id="amount" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="0.00">
            </div>
            <div class="form-group">
               <label><?php echo lang('users merchants custom'); ?></label>
               <input type="text" class="form-control" name="custom" id="custom">
            </div>
          </div>
          <div class="col-md-7">
            <div class="form-group">
               <label><?php echo lang('users merchants form'); ?></label>
               <textarea class="form-control" name="html" id="resultat" rows="8" disabled><form method="POST" action="<?php echo base_url();?>SCI/form">
  <input type="hidden" name="order" value="134543" />
  <input type="hidden" name="merchant" value="#" />
  <input type="hidden" name="item_name" value="Testing payment" />
  <input type="hidden" name="amount" value="#" />
  <input type="hidden" name="custom" value="comment" />
  <button type="submit"><?php echo lang('users merchants test'); ?></button>
</form></textarea>
            <p class="help-block"><?php echo lang('users merchants copy'); ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('core button cancel'); ?></button>
        <button id="btn" type="submit" class="btn btn-primary"><?php echo lang('users merchants generate'); ?></button>
      </div>
    </div>
  </div>
</div>
<script>
var output = document.getElementById('resultat'),
  field1 = document.getElementById('id_merch'),
  field2 = document.getElementById('item_name'),
  field3 = document.getElementById('order'),
  field4 = document.getElementById('amount'),
  field5 = document.getElementById('custom'),
  btn = document.getElementById('btn');

btn.onclick = function() {
  var val1 = field1.value,
    val2 = field2.value,
    val3 = field3.value,
    val4 = field4.value,
    val5 = field5.value;
  output.value = '<form method="POST" action="<?php echo base_url();?>SCI/form"><input type="hidden" name="order" value="' + val3 + '" /><input type="hidden" name="merchant" value="' + val1 + '" /><input type="hidden" name="item_name" value="' + val2 + '" /><input type="hidden" name="amount" value="' + val4 + '" /><input type="hidden" name="custom" value="' + val5 + '" /><button type="submit">Pay now!</button></form>';
}
</script>