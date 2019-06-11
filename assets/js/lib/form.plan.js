$(document).ready(function () {
	// amount: move check on textbox focus
	$('#amount').focus(function() {
		$('[name="plan_type"][value="paid"]').attr('checked',true);
	});
	
	// occurrences: move check on textbox focus
	$('#occurrences').focus(function() {
		$('[name="occurrences_radio"][value="1"]').attr('checked',true);
	});
	
	// free_trial: move check on textbox focus
	$('#free_trial').focus(function() {
		$('[name="free_trial_radio"][value="1"]').attr('checked',true);
	});
});