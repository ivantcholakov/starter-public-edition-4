<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin template edit'); ?></h3>
        </div>
     </div>
     <section class="example">
      <?php echo form_open('', array('role'=>'form')); ?>
      <?php // hidden id ?>
      <?php if (isset($email_templates_id)) : ?>
        <?php echo form_hidden('id', $email_templates_id); ?>
      <?php endif; ?>
     <div class="card-block">
      <div class="row">
        <div class="form-group col-sm-12">
            <label><?php echo lang('admin tickets title'); ?></label>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'title', 'value'=>set_value('title', (isset($email_templates['title']) ? $email_templates['title'] : '')), 'class'=>'form-control underlined')); ?>
        </div>
        <div class="form-group col-sm-12">
            <label><?php echo lang('admin tickets message'); ?></label>
            <span class="required">*</span>
            <textarea class="form-control underlined" name="message" rows="20" id="message" value=""><?php echo $email_templates['message']; ?></textarea>
          <script>
                CKEDITOR.replace( 'message', { height:['550px'] } );
                CKEDITOR.config.allowedContent = true;
                CKEDITOR.replace('body', {height: 500});
            </script>
        </div>
      </div>
     </div>
     <div class="card-footer" style="text-align:right"> 
      <button type="submit"  class="btn btn-primary btn-sm"> <?php echo lang('core button save'); ?></button>
    </div>
    
    </section>
  </div>
 </div>
</div>