<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>
    <div class="row">
      <div class="col-md-6">
         <h4 class="title"><?php echo lang('users title about'); ?></h4>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <?php // first name ?>
              <div class="form-group<?php echo form_error('first_name') ? ' has-error' : ''; ?>">
                  <?php echo form_label(lang('users input first_name'), 'first_name', array('class'=>'control-label')); ?>
                  <span class="required">*</span>
                  <?php echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control')); ?>
              </div>
              <?php // email ?>
                <div class="form-group<?php echo form_error('email') ? ' has-error' : ''; ?>">
                    <?php echo form_label(lang('users input email'), 'email', array('class'=>'control-label')); ?>
                    <span class="required">*</span>
                    <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control', 'type'=>'email')); ?>
                </div>
              <?php // password ?>
              <div class="form-group<?php echo form_error('password') ? ' has-error' : ''; ?>">
                  <?php echo form_label(lang('users input password'), 'password', array('class'=>'control-label')); ?>
                  <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
                  <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
              </div>
          </div>
          
          <div class="col-md-6">
            <?php // last name ?>
              <div class="form-group<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
                  <?php echo form_label(lang('users input last_name'), 'last_name', array('class'=>'control-label')); ?>
                  <span class="required">*</span>
                  <?php echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name', (isset($user['last_name']) ? $user['last_name'] : '')), 'class'=>'form-control')); ?>
              </div>
              <?php // language ?>
              <div class="form-group<?php echo form_error('language') ? ' has-error' : ''; ?>">
                  <?php echo form_label(lang('users input language'), 'language', array('class'=>'control-label')); ?>
                  <span class="required">*</span>
                  <?php echo form_dropdown('language', $this->languages, (isset($user['language']) ? $user['language'] : $this->config->item('language')), 'id="language" class="form-control"'); ?>
              </div>
            <?php // email ?>
                <div class="form-group<?php echo form_error('phone') ? ' has-error' : ''; ?>">
                    <?php echo form_label(lang('users input phone'), 'phone', array('class'=>'control-label')); ?>
                    <span class="required">*</span>
                    <?php echo form_input(array('name'=>'phone', 'value'=>set_value('phone', (isset($user['phone']) ? $user['phone'] : '')), 'class'=>'form-control', 'type'=>'text')); ?>
                </div>
              <div class="form-group<?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
                <?php echo form_label(lang('users input password_repeat'), 'password_repeat', array('class'=>'control-label')); ?>
                <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
                <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
            </div>
          </div>
          <div class="col-md-12">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">
                    <?php echo lang('users verifi save'); ?>
                  </button>
                </div>
              </div>
       </div>
      </div>
    </div>
<?php echo form_close(); ?>      
          