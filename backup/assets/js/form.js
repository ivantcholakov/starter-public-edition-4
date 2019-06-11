/**
* Form Helpers with jQuery
*
* This is a selection of automatic jQuery code which brings some much-needed
* dynamics to standard HTML forms.
*
* 1) Marks all empty fields with a piece of text (set class="mark_empty")
* 2) Validates "required", "email", "numeric" fields and displays notices in a "#notices" div (set
*    form class to "validate")
* 3) Field names should be stored in a "label" with a proper "for", else the label will be taken from
*    the "rel" attribute of the field
*
* @copyright Electric Function, Inc.
*
*/

$(document).ready(function () {
	MarkEmpty();
		
	$('form.validate').submit(function() {
		var errors_in_form = false;
		
		// check for empty required fields
		var field_names = '';
		$(this).find('.required').each(function() {
			// radio button mod
			if ($(this).attr('type') == 'radio' && $('input[name=\''+$(this).attr('name')+'\']:checked').length == 0) {
				if ($('label[for="'+$(this).attr('id')+'"]').text() != "") {
					field_label = $('label[for="'+$(this).attr('id')+'"]').text();
				}
				else {
					field_label = $(this).attr('rel');
				}
				// adds the label contents to the list of required fields
				if (field_names.indexOf(field_label) == -1) {
					field_names = field_names + '"'+field_label + '", ';
				}
				errors_in_form = true;
			}
			if ($(this).attr('type') != 'radio' && ($(this).val() == '' || $(this).hasClass('highlight_empty'))) {
				if ($('label[for="'+$(this).attr('id')+'"]').text() != "") {
					field_label = $('label[for="'+$(this).attr('id')+'"]').text();
				}
				else {
					field_label = $(this).attr('rel');
				}
				// adds the label contents to the list of required fields
				field_names = field_names + '"'+field_label + '", ';
				errors_in_form = true;
			}
		});
		
		// output required field errors
		if (field_names != '') {
			field_names = rtrim(field_names,', '); // trim commas
			form_error('Required fields are empty: '+field_names+'.');
			return false;
		}
		
		// validate emails
		$(this).find('.email').each(function() {
			if ($(this).val() != '' && !isValidEmail($(this).val())) {
				if ($('label[for="'+$(this).attr('id')+'"]').text() != "") {
					field_label = $('label[for="'+$(this).attr('id')+'"]').text();
				}
				else {
					field_label = $(this).attr('rel');
				}
				form_error('"'+field_label + '" must be a valid email address.');
				errors_in_form = true;
				return false;
			}
		});
		
		// validate input.number fields
		$(this).find('input.number, input.numeric').each(function() {
			if ($(this).val() != '' && !isNumeric($(this).val())) {
				if ($('label[for="'+$(this).attr('id')+'"]').text() != "") {
					field_label = $('label[for="'+$(this).attr('id')+'"]').text();
				}
				else {
					field_label = $(this).attr('rel');
				}
				form_error('"'+field_label + '" must be in valid numeric format.');
				errors_in_form = true;
			}
		});
		
		if (errors_in_form == true) {
			return false;
		}
		
		// no errors, looks like we're continuing with the submission!
		// let's make sure those empty_highlighted fields are value-less though
		$('.highlight_empty').val('');
	});
	
});

// form functions

function MarkEmpty () {
	// convert HTML5 "placeholder" to mark_empty below, if we don't have placeholder support
	var input = document.createElement('input');
	var has_placeholder_support = ('placeholder' in input);
	
	if (has_placeholder_support == false) {
		$('*[placeholder]').each(function() {
			$(this).addClass('mark_empty');
			$(this).attr('rel',$(this).attr('placeholder'));
		});
	}
	
	$('.mark_empty').each(function () {
		var field_name = $(this).attr('rel');
		
		if ($(this).val() == '') {
			$(this).val(field_name);
			$(this).addClass('highlight_empty');
		}
		else if ($(this).val() == field_name) {
			$(this).addClass('highlight_empty');
		}
		
		$(this).focus(function () {
			if ($(this).val() == field_name) {
				$(this).removeClass('highlight_empty');
				$(this).val('');
			}
		});
		
		$(this).blur(function () {
			if ($(this).val() == '') {
				$(this).val(field_name);
				$(this).addClass('highlight_empty');
			}
		});
	});
}

function form_error(message) {
	$('#notices').append('<div class="error">'+message+'</div>');
	$('#notices div').each(function () {
		$(this).animate({top:$(window).scrollTop()+5+"px" },{queue: false, duration: 0});
		$(this).animate({opacity: 1.0},4000).fadeOut('slow');
	});
	
	$(window).scroll(function() {
	  $('#notices div').animate({top:$(window).scrollTop()+5+"px" },{queue: false, duration: 0});
	});
}

function rtrim ( str, charlist ) {
    charlist = !charlist ? ' \\s\u00A0' : (charlist+'').replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\\$1');
    var re = new RegExp('[' + charlist + ']+$', 'g');    return (str+'').replace(re, '');
}

function isValidEmail(str) {
   return (str.indexOf(".") > 0) && (str.indexOf("@") > 0);
}	

function isNumeric(sText) {
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
 
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
      {
         IsNumber = false;
      }
   }
   return IsNumber;
}