<h1>Delete Permission</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open();?>

<p>
    <?php echo form_submit('delete', 'Delete');?>
    <?php echo form_submit('cancel', 'Cancel');?>
</p>

<?php echo form_close();?>
