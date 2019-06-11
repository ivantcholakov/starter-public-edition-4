$(document).ready(function () {
	// login or create account?
	$('input[name="password"]').keyup(function () {
		$('input#existing_account').attr('checked','checked');
	});

	// billing and shipping address showing
	
	billing_address();
	shipping_address();
	
	$('input[name="billing_address"]').click(function () {
		billing_address();
	});
	
	$('input[name="shipping_address"]').click(function () {
		shipping_address();
	});
	
	// billing state selects
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
	
	// shipping state selects
	$('select#shipping_state_select').hide();
	
	if ($('select#shipping_country').val() == 'US' || $('select#shipping_country').val() == 'CA') {
		$('select#shipping_state_select').show();
		$('input#shipping_state').hide();
	}
	$('select#shipping_country').change(function () {
		if ($(this).val() == 'US' || $(this).val() == 'CA') {
		 	$('select#shipping_state_select').show();
		 	$('input#shipping_state').hide();
	    } else {
	    	$('select#shipping_state_select').hide();
		 	$('input#shipping_state').show();
	    }
	});
	
	// gateway external/CC info
	show_gateway_info();
	
	$('select#method').click(function () {
		show_gateway_info();
	});
});

function billing_address () {
	if ($('input[name="billing_address"]:checked').val() == 'new') {
		$('li.new_billing').show();	
	}
	else {
		$('li.new_billing').hide();
	}
}

function shipping_address () {
	if ($('input[name="shipping_address"]:checked').val() == 'new') {
		$('li.new_shipping').show();	
	}
	else {
		$('li.new_shipping').hide();
	}
}

function show_gateway_info () {
	if ($('select#method :selected').hasClass('no_credit_card')) {
		$('li.no_credit_card').show();
		$('li.credit_card').hide();
		$('li.external').hide();
	}
	else if ($('select#method :selected').hasClass('external')) {
		$('li.external').show();
		$('li.credit_card').hide();
	}
	else {
		$('li.external').hide();
		$('li.credit_card').show();
	}
}