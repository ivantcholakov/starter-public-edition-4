<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo js('lib/bootstrap3-dialog/bootstrap-dialog.min.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    // Author of the examples: nakupanda (CitHub name), https://github.com/nakupanda
    // License: The MIT License

    $(function () {

        // These are the original strings that are to be translated.
        //BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DEFAULT] = 'Information';
        //BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_INFO] = 'Information';
        //BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_PRIMARY] = 'Information';
        //BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_SUCCESS] = 'Success';
        //BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_WARNING] = 'Warning';
        //BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DANGER] = 'Danger';
        //BootstrapDialog.DEFAULT_TEXTS['OK'] = 'OK';
        //BootstrapDialog.DEFAULT_TEXTS['CANCEL'] = 'Cancel';
        //BootstrapDialog.DEFAULT_TEXTS['CONFIRM'] = 'Confirmation';

        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DEFAULT] = <?php echo json_encode($this->lang->line('ui_information')); ?>;
        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_INFO] = <?php echo json_encode($this->lang->line('ui_information')); ?>;
        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_PRIMARY] = <?php echo json_encode($this->lang->line('ui_information')); ?>;
        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_SUCCESS] = <?php echo json_encode($this->lang->line('ui_success')); ?>;
        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_WARNING] = <?php echo json_encode($this->lang->line('ui_warning')); ?>;
        BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DANGER] = <?php echo json_encode($this->lang->line('ui_danger')); ?>;
        BootstrapDialog.DEFAULT_TEXTS['OK'] = <?php echo json_encode($this->lang->line('ui_ok')); ?>;
        BootstrapDialog.DEFAULT_TEXTS['CANCEL'] = <?php echo json_encode($this->lang->line('ui_cancel')); ?>;
        BootstrapDialog.DEFAULT_TEXTS['CONFIRM'] = <?php echo json_encode($this->lang->line('ui_confirm')); ?>;

        $('#simple_test').on('click', function() {

            BootstrapDialog.show({
                message: 'Hi Apple!'
            });
        });

        $('#dialog_title').on('click', function() {

            BootstrapDialog.show({
                title: 'Say-hello dialog',
                message: 'Hi Apple!'
            });
        });

        $('#manipulating_dialog_title').on('click', function() {

            BootstrapDialog.show({
                title: 'Default Title',
                message: 'Click buttons below.',
                buttons: [{
                    label: 'Title 1',
                    action: function(dialog) {
                        dialog.setTitle('Title 1');
                    }
                }, {
                    label: 'Title 2',
                    action: function(dialog) {
                        dialog.setTitle('Title 2');
                    }
                }]
            });
        });

        $('#manipulating_dialog_message').on('click', function() {

            BootstrapDialog.show({
                message: $('<div></div>').load('<?php echo site_url('playground/bootstrap-modals/remote-html'); ?>')
            });
        });

        $('#loading_remote_page_1').on('click', function() {

            BootstrapDialog.show({
                message: function(dialog) {
                    var $message = $('<div></div>');
                    var pageToLoad = dialog.getData('pageToLoad');
                    $message.load(pageToLoad);

                    return $message;
                },
                data: {
                    'pageToLoad': '<?php echo site_url('playground/bootstrap-modals/remote-html'); ?>'
                }
            });
        });

        $('#loading_remote_page_2').on('click', function() {

            BootstrapDialog.show({
                message: function(dialog) {
                    var $message = $('<div></div>');
                    var pageToLoad = dialog.getData('pageToLoad');
                    $message.load(pageToLoad);

                    return $message;
                },
                data: {
                    'pageToLoad': '<?php echo site_url('playground/bootstrap-modals/remote-html'); ?>'
                }
            });
        });

        $('#buttons').on('click', function() {

            BootstrapDialog.show({
                message: 'Hi Apple!',
                buttons: [{
                    label: 'Button 1'
                }, {
                    label: 'Button 2',
                    cssClass: 'btn-primary',
                    action: function(){
                        alert('Hi Orange!');
                    }
                }, {
                    icon: 'glyphicon glyphicon-ban-circle',
                    label: 'Button 3',
                    cssClass: 'btn-warning'
                }, {
                    label: 'Close',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }]
            });
        });

        $('#manipulating_buttons').on('click', function() {

            BootstrapDialog.show({
                title: 'Manipulating Buttons',
                message: function(dialog) {
                    var $content = $('<div><button class="btn btn-success">Revert button status right now.</button></div>');
                    var $footerButton = dialog.getButton('btn-1');
                    $content.find('button').click({$footerButton: $footerButton}, function(event) {
                        event.data.$footerButton.enable();
                        event.data.$footerButton.stopSpin();
                        dialog.setClosable(true);
                    });

                    return $content;
                },
                buttons: [{
                    id: 'btn-1',
                    label: 'Click to disable and spin.',
                    action: function(dialog) {
                        var $button = this; // 'this' here is a jQuery object that wrapping the <button> DOM element.
                        $button.disable();
                        $button.spin();
                        dialog.setClosable(false);
                    }
                }]
            });
        });

        $('#button_hotkey').on('click', function() {

            BootstrapDialog.show({
                title: 'Button Hotkey',
                message: 'Try to press some keys...',
                onshow: function(dialog) {
                    dialog.getButton('button-c').disable();
                },
                buttons: [{
                    label: '(A) Button A',
                    hotkey: 65, // Keycode of keyup event of key 'A' is 65.
                    action: function() {
                        alert('Finally, you loved Button A.');
                    }
                }, {
                    label: '(B) Button B',
                    hotkey: 66,
                    action: function() {
                        alert('Hello, this is Button B!');
                    }
                }, {
                    id: 'button-c',
                    label: '(C) Button C',
                    hotkey: 67,
                    action: function(){
                        alert('This is Button C but you won\'t see me dance.');
                    }
                }]
            });
        });

        $('#keys_conflicts').on('click', function() {

            // Try to avoid doing similar in your code.
            BootstrapDialog.show({
                title: 'Button Hotkey',
                message: $('<textarea class="form-control" placeholder="Try to input multiple lines here..."></textarea>'),
                buttons: [{
                    label: '(Enter) Button A',
                    cssClass: 'btn-primary',
                    hotkey: 13, // Enter.
                    action: function() {
                        alert('You pressed Enter.');
                    }
                }]
            });
        });

        $('#opening_multiple_dialogs').on('click', function() {

            var shortContent = '<p>Something here.</p>';
            var longContent = '';
            for(var i = 1; i <= 200; i++) {
                longContent += shortContent;
            }
            BootstrapDialog.show({
                title: 'Another long dialog',
                message: longContent
            });
            BootstrapDialog.show({
                title: 'Another short dialog',
                message: shortContent,
                draggable: true
            });
            BootstrapDialog.show({
                title: 'A long dialog',
                message: longContent,
                draggable: true
            });
            BootstrapDialog.show({
                title: 'A short dialog',
                message: shortContent
            });
        });

        $('#creating_dialog_instances').on('click', function() {

            // Using init options
            var dialogInstance1 = new BootstrapDialog({
                title: 'Dialog instance 1',
                message: 'Hi Apple!'
            });
            dialogInstance1.open();

            // Construct by using setters
            var dialogInstance2 = new BootstrapDialog();
            dialogInstance2.setTitle('Dialog instance 2');
            dialogInstance2.setMessage('Hi Orange!');
            dialogInstance2.setType(BootstrapDialog.TYPE_SUCCESS);
            dialogInstance2.open();

            // Using chain callings
            var dialogInstance3 = new BootstrapDialog()
                .setTitle('Dialog instance 3')
                .setMessage('Hi Everybody!')
                .setType(BootstrapDialog.TYPE_INFO)
                .open();
        });

        $('#creating_dialog_instances_2').on('click', function() {

            // In fact BootstrapDialog.show(...) will also return the created dialog instance.
            // You can use dialogInstance later.
            var dialogInstance = BootstrapDialog.show({
                message: 'Hello Banana!'
            });
        });

        $('#open_close_multiple_dialogs').on('click', function() {

            var howManyDialogs = 5;
            for(var i = 1; i <= howManyDialogs; i++) {
                var dialog = new BootstrapDialog({
                    title: 'Dialog No.' + i,
                    message: 'Hello Houston, this is dialog No.' + i,
                    buttons: [{
                        label: 'Close this dialog.',
                        action: function(dialogRef){
                            dialogRef.close();
                        }
                    }, {
                        label: 'Close ALL opened dialogs',
                        cssClass: 'btn-warning',
                        action: function(){
                            // You can also use BootstrapDialog.closeAll() to close all dialogs.
                            $.each(BootstrapDialog.dialogs, function(id, dialog){
                                dialog.close();
                            });
                        }
                    }]
                });
                dialog.open();
            }
        });

        $('#button_with_identifier').on('click', function() {

            var dialog = new BootstrapDialog({
                message: 'Hi Apple!',
                buttons: [{
                    id: 'btn-1',
                    label: 'Button 1'
                }]
            });
            dialog.realize();
            var btn1 = dialog.getButton('btn-1');
            btn1.click({'name': 'Apple'}, function(event){
                alert('Hi, ' + event.data.name);
            });
            dialog.open();
        });

        $('#message_types').on('click', function() {

            var types = [BootstrapDialog.TYPE_DEFAULT,
                         BootstrapDialog.TYPE_INFO,
                         BootstrapDialog.TYPE_PRIMARY,
                         BootstrapDialog.TYPE_SUCCESS,
                         BootstrapDialog.TYPE_WARNING,
                         BootstrapDialog.TYPE_DANGER];

            $.each(types, function(index, type){
                BootstrapDialog.show({
                    type: type,
                    title: 'Message type: ' + type,
                    message: 'What to do next?',
                    buttons: [{
                        label: 'I do nothing.'
                    }]
                });
            });
        });

        $('#changing_dialog_type').on('click', function() {

            var types = [BootstrapDialog.TYPE_DEFAULT,
                         BootstrapDialog.TYPE_INFO,
                         BootstrapDialog.TYPE_PRIMARY,
                         BootstrapDialog.TYPE_SUCCESS,
                         BootstrapDialog.TYPE_WARNING,
                         BootstrapDialog.TYPE_DANGER];

            var buttons = [];
            $.each(types, function(index, type) {
                buttons.push({
                    label: type,
                    cssClass: 'btn-default btn-sm',
                    action: function(dialog) {
                        dialog.setType(type);
                    }
                });
            });

            BootstrapDialog.show({
                title: 'Changing dialog type',
                message: 'Click buttons below...',
                buttons: buttons
            });
        });

        $('#larger_dialog').on('click', function() {

            BootstrapDialog.show({
                size: BootstrapDialog.SIZE_LARGE,
                message: 'Hi Apple!',
                buttons: [{
                    label: 'Button 1'
                }, {
                    label: 'Button 2',
                    cssClass: 'btn-primary',
                    action: function(){
                        alert('Hi Orange!');
                    }
                }, {
                    icon: 'glyphicon glyphicon-ban-circle',
                    label: 'Button 3',
                    cssClass: 'btn-warning'
                }, {
                    label: 'Close',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }]
            });
        });

        $('#more_dialog_sizes').on('click', function() {

            BootstrapDialog.show({
                title: 'More dialog sizes',
                message: 'Hi Apple!',
                buttons: [{
                    label: 'Normal',
                    action: function(dialog){
                        dialog.setTitle('Normal');
                        dialog.setSize(BootstrapDialog.SIZE_NORMAL);
                    }
                }, {
                    label: 'Small',
                    action: function(dialog){
                        dialog.setTitle('Small');
                        dialog.setSize(BootstrapDialog.SIZE_SMALL);
                    }
                }, {
                    label: 'Wide',
                    action: function(dialog){
                        dialog.setTitle('Wide');
                        dialog.setSize(BootstrapDialog.SIZE_WIDE);
                    }
                }, {
                    label: 'Large',
                    action: function(dialog){
                        dialog.setTitle('Large');
                        dialog.setSize(BootstrapDialog.SIZE_LARGE);
                    }
                }]
            });
        });

        $('#rich_message').on('click', function() {

            var $textAndPic = $('<div></div>');
            $textAndPic.append('Who\'s this? <br />');
            $textAndPic.append('<img src="<?php echo image_url('lib/bootstrap3-dialog/pig.png'); ?>" />');

            BootstrapDialog.show({
                title: 'Guess who that is',
                message: $textAndPic,
                buttons: [{
                    label: 'Acky',
                    action: function(dialogRef){
                        dialogRef.close();
                    }
                }, {
                    label: 'Robert',
                    action: function(dialogRef){
                        dialogRef.close();
                    }
                }]
            });
        });

        $('#dialog_closable_unclosable').on('click', function() {

            BootstrapDialog.show({
                message: 'Hi Apple!',
                closable: false,
                buttons: [{
                    label: 'Dialog CLOSABLE!',
                    cssClass: 'btn-success',
                    action: function(dialogRef){
                        dialogRef.setClosable(true);
                    }
                }, {
                    label: 'Dialog UNCLOSABLE!',
                    cssClass: 'btn-warning',
                    action: function(dialogRef){
                        dialogRef.setClosable(false);
                    }
                }, {
                    label: 'Close the dialog',
                    action: function(dialogRef){
                        dialogRef.close();
                    }
                }]
            });
        });

        $('#more_controls_on_closing_a_dialog').on('click', function() {

            BootstrapDialog.show({
                message: 'Hi Apple!',
                message: 'You can not close this dialog by clicking outside and pressing ESC key.',
                closable: true,
                closeByBackdrop: false,
                closeByKeyboard: false,
                buttons: [{
                    label: 'Close the dialog',
                    action: function(dialogRef){
                        dialogRef.close();
                    }
                }]
            });
        });

        $('#disabling_animation').on('click', function() {

            BootstrapDialog.show({
                message: 'There is no fading effects on this dialog.',
                animate: false,
                buttons: [{
                    label: 'Close the dialog',
                    action: function(dialogRef){
                        dialogRef.close();
                    }
                }]
            });
        });

        $('#auto_spinning_icon').on('click', function() {

            BootstrapDialog.show({
                message: 'I send ajax request!',
                buttons: [{
                    icon: 'glyphicon glyphicon-send',
                    label: 'Send ajax request',
                    cssClass: 'btn-primary',
                    autospin: true,
                    action: function(dialogRef){
                        dialogRef.enableButtons(false);
                        dialogRef.setClosable(false);
                        dialogRef.getModalBody().html('Dialog closes in 5 seconds.');
                        setTimeout(function(){
                            dialogRef.close();
                        }, 5000);
                    }
                }, {
                    label: 'Close',
                    action: function(dialogRef){
                        dialogRef.close();
                    }
                }]
            });
        });

        $('#dialog_draggable').on('click', function() {

            BootstrapDialog.show({
                title: 'Draggable Dialog',
                message: 'Try to drag on dialog title to move your dialog.',
                draggable: true
            });
        });

        $('#manipulating_your_dialog').on('click', function() {

            var dialog = new BootstrapDialog({
                message: function(dialogRef){
                    var $message = $('<div>OK, this dialog has no header and footer, but you can close the dialog using this button: </div>');
                    var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                    $button.on('click', {dialogRef: dialogRef}, function(event){
                        event.data.dialogRef.close();
                    });
                    $message.append($button);

                    return $message;
                },
                closable: false
            });
            dialog.realize();
            dialog.getModalHeader().hide();
            dialog.getModalFooter().hide();
            dialog.getModalBody().css('background-color', '#0088cc');
            dialog.getModalBody().css('color', '#fff');
            dialog.open();
        });

        $('#additional_css_classes_to_your_dialog').on('click', function() {

            BootstrapDialog.show({
                title: 'Sign In',
                message: 'Your sign-in form goes here.',
                cssClass: 'login-dialog',
                buttons: [{
                    label: 'Sign In Now!',
                    cssClass: 'btn-primary',
                    action: function(dialog){
                        dialog.close();
                    }
                }]
            });
        });

        $('#adding_a_description_to_your_dialog').on('click', function() {

            BootstrapDialog.show({
                title: 'Add Description',
                message: 'The description is shown to screen readers.',
                description: 'This is a Bootstrap Dialog'
            });
        });

        $('#data_binding').on('click', function() {

            var data1 = 'Apple';
            var data2 = 'Orange';
            var data3 = ['Banana', 'Pear'];
            BootstrapDialog.show({
                message: 'Hi Apple!',
                data: {
                    'data1': data1,
                    'data2': data2,
                    'data3': data3
                },
                buttons: [{
                    label: 'See what you got',
                    cssClass: 'btn-primary',
                    action: function(dialogRef){
                        alert(dialogRef.getData('data1'));
                        alert(dialogRef.getData('data2'));
                        alert(dialogRef.getData('data3').join(', '));
                    }
                }]
            });
        });

        $('#dialog_events').on('click', function() {

            BootstrapDialog.show({
                message: 'Hello world!',
                onshow: function(dialogRef){
                    alert('Dialog is popping up, its message is ' + dialogRef.getMessage());
                },
                onshown: function(dialogRef){
                    alert('Dialog is popped up.');
                },
                onhide: function(dialogRef){
                    alert('Dialog is popping down, its message is ' + dialogRef.getMessage());
                },
                onhidden: function(dialogRef){
                    alert('Dialog is popped down.');
                }
            });
        });

        $('#stop_closing_your_dialog').on('click', function() {

            BootstrapDialog.show({
                message: 'Your most favorite fruit: <input type="text" class="form-control">',
                onhide: function(dialogRef){
                    var fruit = dialogRef.getModalBody().find('input').val();
                    if($.trim(fruit.toLowerCase()) !== 'banana') {
                        alert('Need banana!');
                        return false;
                    }
                },
                buttons: [{
                    label: 'Close',
                    action: function(dialogRef) {
                        dialogRef.close();
                    }
                }]
            });
        });

        $('#alert').on('click', function() {

            BootstrapDialog.alert('Hi Apple!');
        });

        $('#alert_with_callback').on('click', function() {

            BootstrapDialog.alert('Hi Apple!', function(){
                alert('Hi Orange!');
            });
        });

        $('#alert_with_customizations').on('click', function() {

            BootstrapDialog.alert({
                title: 'WARNING',
                message: 'Warning! No Banana!',
                type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                closable: true, // <-- Default value is false
                draggable: true, // <-- Default value is false
                buttonLabel: 'Roar! Why!', // <-- Default value is 'OK',
                callback: function(result) {
                    // result will be true if button was click, while it will be false if users close the dialog directly.
                    alert('Result is: ' + result);
                }
            });
        });

        $('#confirm').on('click', function() {

            BootstrapDialog.confirm('Hi Apple, are you sure?');
        });

        $('#confirm_with_callback').on('click', function() {

            BootstrapDialog.confirm('Hi Apple, are you sure?', function(result){
                if(result) {
                    alert('Yup.');
                }else {
                    alert('Nope.');
                }
            });
        });

        $('#confirm_with_customizations').on('click', function() {

            BootstrapDialog.confirm({
                title: 'WARNING',
                message: 'Warning! Drop your banana?',
                type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                closable: true, // <-- Default value is false
                draggable: true, // <-- Default value is false
                btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
                btnOKLabel: 'Drop it!', // <-- Default value is 'OK',
                btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
                callback: function(result) {
                    // result will be true if button was click, while it will be false if users close the dialog directly.
                    if(result) {
                        alert('Yup.');
                    }else {
                        alert('Nope.');
                    }
                }
            });
        });

    });

    //]]>
    </script>
