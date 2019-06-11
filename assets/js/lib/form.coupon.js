$(document).ready(function(){
	
	// Hook into our coupon type selector so we can 
	// show or hide options based on coupon type selected.
	$("#row_coupon_type select").change(function(){
		var coupon_type = $("#row_coupon_type select :selected").val();
				
		if (coupon_type == '1') {
			$('li.plan_select').fadeOut();
		}		
		else {
			$('li.plan_select').fadeIn();
		}
		
		switch (coupon_type)
		{
			case '1':		// Price Reduction
			case '2':
			case '3':
			case '4':
				$(".free-trial").css("display", "none");
				$(".reduction").fadeIn();
				break;
			case '5': 	// Free Trial
				$(".reduction").css("display", "none");
				$(".free-trial").fadeIn();
				break; 
		}
	});
	
	// Trigger our coupon type change event so everything looks correct
	$("#row_coupon_type select").trigger("change");
	
	// deselect checkboxes if we specify a value
	$('#coupon_end_date').click(function () {
		$('#no_expiry').attr('checked',false);
	});
	
	$('#coupon_max_uses').click(function () {
		$('#no_limit').attr('checked',false);
	});
});	