<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="header-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-6 col-xs-7">
						<h3><?php echo lang('core button contact'); ?></h3>
					</div>
				</div>
			</div>
</div>

<div class="container theme-showcase" role="main">
  
  <div class="row">
		<div class="col-md-10 col-md-offset-1">

<?php echo form_open('', array('role'=>'form')); ?>

    <div class="row">
        <?php  // name ?>
        <div class="form-group col-sm-12<?php echo form_error('name') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input name'), 'name', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'name', 'value'=>set_value('name'), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php  // email ?>
        <div class="form-group col-sm-12<?php echo form_error('email') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input email'), 'email', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'email', 'value'=>set_value('email'), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php  // message title ?>
        <div class="form-group col-sm-12<?php echo form_error('title') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input title'), 'title', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'title', 'value'=>set_value('title'), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php  // messsage body ?>
        <div class="form-group col-sm-12<?php echo form_error('message') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input message'), 'message', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_textarea(array('name'=>'message', 'value'=>set_value('message'), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php  // captcha ?>
        <div class="form-group col-sm-12<?php echo form_error('captcha') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('contact input captcha'), 'captcha', array('class'=>'control-label')); ?>
            <br />
            <?php echo $captcha_image; ?>
            <?php echo form_input(array('name'=>'captcha', 'id'=>'captcha', 'value'=>"", 'class'=>'form-control')); ?>
        </div>
    </div>

    <?php // buttons ?>
    <div class="row pull-right">
        <div class="form-group col-sm-12">
            <a class="btn btn-default" href="<?php echo base_url(); ?>"><?php echo lang('core button cancel'); ?></a>
            <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span> <?php echo lang('core button send'); ?></button>
        </div>
    </div>

<?php echo form_close(); ?>
    </div>
  </div>
  
</div>
