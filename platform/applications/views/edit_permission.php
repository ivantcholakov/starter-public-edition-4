<h1>Add Permission</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open();?>

<p>
    <?php echo form_label('Key:', 'perm_key');?> <br />
    <?php echo form_input('perm_key', set_value('perm_key', $permission->perm_key)); ?> <br />
    <?php echo form_error('perm_key'); ?>
</p>

<p>
    <?php echo form_label('Name:', 'perm_name');?> <br />
    <?php echo form_input('perm_name', set_value('perm_name', $permission->perm_name)); ?> <br />
    <?php echo form_error('perm_name'); ?>
</p>

<p>
    <?php echo form_submit('submit', 'Save');?>
    <?php echo form_submit('cancel', 'Cancel');?>
</p>

<?php echo form_close();?>
