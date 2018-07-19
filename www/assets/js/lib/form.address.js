$(document).ready(function () {
	// show State select when on United States/Canada
	$('select#state_select').hide();
	if ($('select#country').val() == 'US' || $('select#country').val() == 'CA') {
		$('select#state_select').show();
		$('input#state').hide();
	}
	$('select#country').change(function () {
		if ($(this).val() == 'US' || $(this).val() == 'CA') {
		 	$('select#state_select').show();
		 	$('input#state').hide();
	    } else {
	    	$('select#state_select').hide();
		 	$('input#state').show();
	    }
	});
});