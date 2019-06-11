<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="header-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-6 col-xs-7">
						<h3><?php echo lang('core button open_new'); ?></h3>
					</div>
				</div>
			</div>
</div>
<div class="container theme-showcase" role="main">

   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
      <div class="panel-body">

<?php echo form_open('', array('role'=>'form')); ?>

    <div class="row">
        <?php // username ?>
        <div class="form-group col-sm-12<?php echo form_error('username') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input username'), 'username', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'username', 'value'=>set_value('username', (isset($user['username']) ? $user['username'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // first name ?>
        <div class="form-group col-sm-6<?php echo form_error('first_name') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input first_name'), 'first_name', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control')); ?>
        </div>

        <?php // last name ?>
        <div class="form-group col-sm-6<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input last_name'), 'last_name', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name', (isset($user['last_name']) ? $user['last_name'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // email ?>
        <div class="form-group col-sm-6<?php echo form_error('email') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input email'), 'email', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control', 'type'=>'email')); ?>
        </div>

         <?php // phone ?>
        <div class="form-group col-sm-6<?php echo form_error('phone') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input phone'), 'phone', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'phone', 'value'=>set_value('phone', (isset($user['phone']) ? $user['phone'] : '')), 'class'=>'form-control', 'type'=>'phone')); ?>
        </div>
    </div>

    <div class="row">
        <?php // language ?>
        <div class="form-group col-sm-12<?php echo form_error('language') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input language'), 'language', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_dropdown('language', $this->languages, (isset($user['language']) ? $user['language'] : $this->config->item('language')), 'id="language" class="form-control"'); ?>
        </div>
    </div>

    <div class="row">
        <?php // password ?>
        <div class="form-group col-sm-6<?php echo form_error('password') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input password'), 'password', array('class'=>'control-label')); ?>
            <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
            <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
        </div>

        <?php // password repeat ?>
        <div class="form-group col-sm-6<?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('users input password_repeat'), 'password_repeat', array('class'=>'control-label')); ?>
            <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
            <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
        </div>
        <?php if ( ! $password_required) : ?>
            <span class="help-block"><br /><?php echo lang('users help passwords'); ?></span>
        <?php endif; ?>
    </div>
        <?php // buttons ?>
      		<div class="pull-right">
            <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
            <?php if ($this->session->userdata('logged_in')) : ?>
                <button type="submit" name="submit" class="btn btn-primary"></span> <?php echo lang('core button save'); ?></button>
            <?php else : ?>
                <button type="submit" name="submit" class="btn btn-primary"></span> <?php echo lang('users button register'); ?></button>
            <?php endif; ?>
					</div>


<?php echo form_close(); ?>
        </div>
      </div>
     </div>
  </div>

</div>
