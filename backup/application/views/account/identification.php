<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users verifi title'); ?></h4>
      </div>
    </div>
    <div class="row">
      <?if($user['verifi_status']==3){?>
      <div class="col-md-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo lang('admin verifi check'); ?>
        </div>
      </div>
      <?}else{?>
      <?}?>
      <!-- Table #1  -->
      <div class="col-xs-12 col-lg-4">
        <div class="card-price text-xs-center">
          <div class="card-block">
            <h4 class="card-title text-center"> 
              <?php echo lang('users verifi anonymous'); ?>
            </h4>
            <ul class="list-group padding-10 text-center">
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi deposit'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi transfer'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi exchange'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi request'); ?></li>
              <li class="list-group-item"><span class="text-danger"><?php echo lang('users verifi not_available'); ?></span> <?php echo lang('users verifi withdrawal'); ?></li>
              <li class="list-group-item"><span class="text-danger"><?php echo lang('users verifi not_available'); ?></span> <?php echo lang('users verifi acceptance'); ?></li>
            </ul>
            <div class="text-center">
            <?if($user['verifi_status']==0){?>
            <a href="#" class="btn btn-success disabled"><?php echo lang('users verifi you_status'); ?></a>
            <?}else{?>
            <?}?>
            <?if($user['verifi_status']>0){?>
            <a href="#" class="btn btn-success disabled"><?php echo lang('users verifi unavailable'); ?></a>
            <?}else{?>
            <?}?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-xs-12 col-lg-4">
        <div class="card-price text-xs-center">
          <div class="card-block">
            <h4 class="card-title text-center"> 
              <?php echo lang('users verifi verified'); ?>
            </h4>
            <ul class="list-group padding-10 text-center">
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi deposit'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi transfer'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi exchange'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi request'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi withdrawal'); ?></li>
              <li class="list-group-item"><span class="text-danger"><?php echo lang('users verifi not_available'); ?></span> <?php echo lang('users verifi acceptance'); ?></li>
            </ul>
            <div class="text-center">
            <?if($user['verifi_status']==0){?>
            <a href="#" data-toggle="modal" data-target="#verifi" class="btn btn-success"><?php echo lang('users verifi get_it_now'); ?></a>
            <?}else{?>
            <?}?>
            <?if($user['verifi_status']==1){?>
            <a href="#" class="btn btn-success disabled"><?php echo lang('users verifi you_status'); ?></a>
            <?}else{?>
            <?}?>
            <?if($user['verifi_status']>1){?>
            <a href="#" class="btn btn-success disabled"><?php echo lang('users verifi unavailable'); ?></a>
            <?}else{?>
            <?}?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-xs-12 col-lg-4">
        <div class="card-price text-xs-center">
          <div class="card-block">
            <h4 class="card-title text-center"> 
              <?php echo lang('users verifi business'); ?>
            </h4>
            <ul class="list-group padding-10 text-center">
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi deposit'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi transfer'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi exchange'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi request'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi withdrawal'); ?></li>
              <li class="list-group-item"><span class="text-success"><?php echo lang('users verifi available'); ?></span> <?php echo lang('users verifi acceptance'); ?></li>
            </ul>
            <div class="text-center">
            <?if($user['verifi_status']==0){?>
            <a href="#" class="btn btn-success" disabled><?php echo lang('users verifi get_it_now'); ?></a>
            <?}else{?>
            <?}?>
            <?if($user['verifi_status']==1){?>
            <a href="#" data-toggle="modal" data-target="#business" class="btn btn-success"><?php echo lang('users verifi get_it_now'); ?></a>
            <?}else{?>
            <?}?>
            <?if($user['verifi_status']==2){?>
            <a href="#" class="btn btn-success disabled"><?php echo lang('users verifi you_status'); ?></a>
            <?}else{?>
            <?}?>
            <?if($user['verifi_status']==3){?>
            <a href="#" class="btn btn-success disabled"><?php echo lang('users verifi unavailable'); ?></a>
            <?}else{?>
            <?}?>
            </div>
          </div>
        </div>
      </div>

      </div>

    </div>

<!-- Verifi -->    
<?php echo form_open_multipart(site_url("account/verifi_identification/"), array("" => "")) ?>
<div class="modal fade" id="verifi" tabindex="-1" role="dialog" aria-labelledby="verifi" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="verifi"><?php echo lang('users verifi upload'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo lang('users verifi info'); ?>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1"><?php echo lang('users verifi id'); ?></label>
          <input type="file" id="passport" name="passport">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1"><?php echo lang('users verifi adress'); ?></label>
          <input type="file" id="address" name="address">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('users verifi close'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo lang('users verifi save'); ?></button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>  

<!-- Business -->   
<?php echo form_open_multipart(site_url("account/business_identification/"), array("" => "")) ?>
<div class="modal fade" id="business" tabindex="-1" role="dialog" aria-labelledby="business" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="business"><?php echo lang('users verifi upload'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo lang('users verifi info'); ?>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1"><?php echo lang('users verifi doc_business'); ?></label>
          <input type="file" id="business" name="business">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('users verifi close'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo lang('users verifi save'); ?></button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>  