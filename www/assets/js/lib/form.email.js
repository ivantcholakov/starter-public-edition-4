$(document).ready(function () {
	// to_address: move check on textbox focus
	$('#to_address_email').focus(function() {
		$('[name="to_address"][value="email"]').attr('checked',true);
	});
	
	// bcc_address: move check on textbox focus
	$('#bcc_address_email').focus(function() {
		$('[name="bcc_address"][value="email"]').attr('checked',true);
	});
	
	// make sure the WYSIWYG edits save to source when we submit
    $("#form_email").submit(function() {
        editor.post(); 
    });
	
	// html toggle
	// do toggle if is_html == 1
	if ($('#is_html').val() == '1') {
		var editor = new TINY.editor.edit('editor', {
				id: 'email_body',
				width: 584,
				height: 175,
				cssclass: 'tinyeditor',
				controlclass: 'tinyeditor-control',
				rowclass: 'tinyeditor-header',
				dividerclass: 'tinyeditor-divider',
				controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
					'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
					'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
					'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
				footer: true,
				fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
				xhtml: true,
				cssfile: 'custom.css',
				bodyid: 'editor',
				footerclass: 'tinyeditor-footer',
				toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
				resize: {cssclass: 'resize'}
		});
	}
	
	// make it HTML if they click the link
	$('#make_html').click(function() {
		var editor = new TINY.editor.edit('editor', {
				id: 'email_body',
				width: 584,
				height: 175,
				cssclass: 'tinyeditor',
				controlclass: 'tinyeditor-control',
				rowclass: 'tinyeditor-header',
				dividerclass: 'tinyeditor-divider',
				controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
					'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
					'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
					'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
				footer: true,
				fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
				xhtml: true,
				bodyid: 'editor',
				footerclass: 'tinyeditor-footer',
				toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
				resize: {cssclass: 'resize'}
		});

		$('#is_html').val('1');
		
		$(this).remove();
		return false;
	});
	
	// pull available variables on trigger toggle
	$('#trigger').change(function() {
		if ($(this).val() != '') {
			$.get($('#base_url').html()+'settings/show_variables/'+$(this).val(),
			  function(data){
			    $('#email_variables').html(data);
			  });
		}	  
	});
	
	// handle preset trigger
	if ($('#trigger').val() != '') {
		$.get($('#base_url').html()+'settings/show_variables/'+$('#trigger').val(),
		  function(data){
		    $('#email_variables').html(data);
		  });
	}
});