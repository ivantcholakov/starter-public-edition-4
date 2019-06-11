<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
           <h3 class="title"><?php echo lang('admin input use_detail'); ?></h3> 
        </div>
       <ul class="nav nav-tabs pull-right" role="tablist">
          <li class="nav-item"> <a class="nav-link active" href="#overview" role="tab" data-toggle="tab"><?php echo lang('admin input overview'); ?></a> </li>
       </ul>
     </div>
     <div class="card-block">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active fade in" id="overview">
            <?php echo form_open('', array('role'=>'form')); ?>

              <?php // hidden id ?>
              <?php if (isset($user_id)) : ?>
                  <?php echo form_hidden('id', $user_id); ?>
              <?php endif; ?>
              <div class="row">
                  <?php // username ?>
                  <div class="form-group col-sm-4<?php echo form_error('username') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input username'), 'username', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'username', 'value'=>set_value('username', (isset($user['username']) ? $user['username'] : '')), 'class'=>'form-control underlined')); ?>
                  </div>

                  <?php // first name ?>
                  <div class="form-group col-sm-4<?php echo form_error('first_name') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input first_name'), 'first_name', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control underlined')); ?>
                  </div>

                  <?php // last name ?>
                  <div class="form-group col-sm-4<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input last_name'), 'last_name', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name', (isset($user['last_name']) ? $user['last_name'] : '')), 'class'=>'form-control underlined')); ?>
                  </div>
              </div>

              <div class="row">
                  <?php // language ?>
                  <div class="form-group col-sm-4<?php echo form_error('language') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input language'), 'language', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_dropdown('language', $this->languages, (isset($user['language']) ? $user['language'] : $this->config->item('language')), 'id="language" class="form-control underlined"'); ?>
                  </div>

                  <?php // email ?>
                  <div class="form-group col-sm-4<?php echo form_error('email') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input email'), 'email', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control underlined')); ?>
                  </div>
                
                  <?php // phone ?>
                  <div class="form-group col-sm-4<?php echo form_error('phone') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('admin input phone'), 'phone', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php echo form_input(array('name'=>'phone', 'value'=>set_value('phone', (isset($user['phone']) ? $user['phone'] : '')), 'class'=>'form-control underlined')); ?>
                  </div>
              </div>
              <div class="row">
                  <?php // status ?>
                  <div class="form-group col-sm-3<?php echo form_error('status') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input status'), '', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <div>
                          <label style="font-weight:500">
                              <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'status', 'id'=>'radio-status-1', 'value'=>'1', 'checked'=>(( ! isset($user['status']) OR (isset($user['status']) && (int)$user['status'] == 1) OR $user['id'] == 1) ? 'checked' : FALSE))); ?>
                              <span><?php echo lang('admin input active'); ?></span>
                          </label>
                      </div>
                      <?php if ( ! $user['id'] OR $user['id'] > 1) : ?>
                          <div>
                              <label style="font-weight:500">
                                  <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'status', 'id'=>'radio-status-2', 'value'=>'0', 'checked'=>((isset($user['status']) && (int)$user['status'] == 0) ? 'checked' : FALSE))); ?>
                                <span><?php echo lang('admin input inactive'); ?></span>
                              </label>
                          </div>
                      <?php endif; ?>
                  </div>

                  <?php // administrator ?>
                  <div class="form-group col-sm-3<?php echo form_error('is_admin') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input is_admin'), '', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <?php if ( ! $user['id'] OR $user['id'] > 1) : ?>
                          <div>
                              <label style="font-weight:500">
                                  <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'is_admin', 'id'=>'radio-is_admin-1', 'value'=>'0', 'checked'=>(( ! isset($user['is_admin']) OR (isset($user['is_admin']) && (int)$user['is_admin'] == 0) && $user['id'] != 1) ? 'checked' : FALSE))); ?>
                                <span><?php echo lang('core text no'); ?></span>
                              </label>
                          </div>
                      <?php endif; ?>
                      <div>
                          <label style="font-weight:500">
                              <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'is_admin', 'id'=>'radio-is_admin-2', 'value'=>'1', 'checked'=>((isset($user['is_admin']) && (int)$user['is_admin'] == 1) ? 'checked' : FALSE))); ?>
                            <span><?php echo lang('core text yes'); ?></span>
                          </label>
                      </div>
                  </div>

                  <?php // verifi status ?>
                  <div class="form-group col-sm-3<?php echo form_error('verifi_status') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('admin input verifi_status'), '', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <div>
                          <label style="font-weight:500">
                              <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'verifi_status', 'id'=>'verifi_status-1', 'value'=>'1', 'checked'=>((isset($user['verifi_status']) && (int)$user['verifi_status'] == 1) ? 'checked' : FALSE))); ?>
                              <span><?php echo lang('admin input verifi_ok'); ?></span>
                          </label>
                      </div>
                      <div>
                          <label style="font-weight:500">
                              <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'verifi_status', 'id'=>'verifi_status-3', 'value'=>'2', 'checked'=>((isset($user['verifi_status']) && (int)$user['verifi_status'] == 2) ? 'checked' : FALSE))); ?>
                              <span><?php echo lang('admin input business'); ?></span>
                          </label>
                      </div>
                       <div>
                          <label style="font-weight:500">
                              <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'verifi_status', 'id'=>'verifi_status-4', 'value'=>'3', 'checked'=>((isset($user['verifi_status']) && (int)$user['verifi_status'] == 3) ? 'checked' : FALSE))); ?>
                              <span><?php echo lang('admin input waiting'); ?></span>
                          </label>
                      </div>

                          <div>
                              <label style="font-weight:500">
                                  <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'verifi_status', 'id'=>'verifi_status-2', 'value'=>'0', 'checked'=>((isset($user['verifi_status']) && (int)$user['verifi_status'] == 0) ? 'checked' : FALSE))); ?>
                                  <span><?php echo lang('admin input anonymous'); ?></span>
                              </label>
                          </div>

                  </div>
                  <?php // fraud status ?>
                  <div class="form-group col-sm-3<?php echo form_error('verifi_status') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('admin input fraud_status'), '', array('class'=>'control-label')); ?>
                      <span class="required">*</span>
                      <div>
                          <label style="font-weight:500">
                              <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'fraud_status', 'id'=>'fraud_status-1', 'value'=>'0', 'checked'=>((isset($user['fraud_status']) && (int)$user['fraud_status'] == 0) ? 'checked' : FALSE))); ?>
                            <span><?php echo lang('admin input fraud_none'); ?></span>
                          </label>
                      </div>
                      <div>
                          <label style="font-weight:500">
                              <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'fraud_status', 'id'=>'fraud_status-2', 'value'=>'1', 'checked'=>((isset($user['fraud_status']) && (int)$user['fraud_status'] == 1) ? 'checked' : FALSE))); ?>
                            <span><?php echo lang('admin input no_withdrawal'); ?></span>
                          </label>
                      </div>

                          <div>
                              <label style="font-weight:500">
                                  <?php echo form_radio(array('class'=>'radio', 'type'=>'radio', 'name'=>'fraud_status', 'id'=>'verifi_status-3', 'value'=>'2', 'checked'=>((isset($user['fraud_status']) && (int)$user['fraud_status'] == 2) ? 'checked' : FALSE))); ?>
                                <span><?php echo lang('admin input fraud_banned'); ?></span>
                              </label>
                          </div>

                  </div>
              </div>

              <div class="row">
                  <?php // password ?>
                  <div class="form-group col-sm-6<?php echo form_error('password') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input password'), 'password', array('class'=>'control-label')); ?>
                      <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
                      <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control underlined', 'autocomplete'=>'off')); ?>
                  </div>

                  <?php // password repeat ?>
                  <div class="form-group col-sm-6<?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
                      <?php echo form_label(lang('users input password_repeat'), 'password_repeat', array('class'=>'control-label')); ?>
                      <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
                      <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control underlined', 'autocomplete'=>'off')); ?>
                  </div>
                <?php // buttons ?>
              <div class="pull-right">
                <div class="col-md-12">
                  <a class="btn btn-secondary btn-sm" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                  <button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo lang('core button save'); ?></button>
                </div>
              </div>
              </div>

          
          </div>
          <?php echo form_close(); ?>

        </div>
     </div>
    </div>
  </div>
</div>