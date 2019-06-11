<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/code_verfiy/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/code_verfiy/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/default/css/custome-validate.css">

 <!-- Latest CDN production Javascript and CSS: 2.9.0 -->
<script
  src="https://ok1static.oktacdn.com/assets/js/sdk/okta-signin-widget/2.9.0/js/okta-sign-in.min.js"
  type="text/javascript"></script>
<link
  href="https://ok1static.oktacdn.com/assets/js/sdk/okta-signin-widget/2.9.0/css/okta-sign-in.min.css"
  type="text/css"
  rel="stylesheet"/>

<!-- Theme file: Customize or replace this file if you want to override our default styles -->
<link
  href="https://ok1static.oktacdn.com/assets/js/sdk/okta-signin-widget/2.9.0/css/okta-theme.css"
  type="text/css"
  rel="stylesheet"/>

<script type="text/javascript">
	
	(function( thisFrame, topFrame ) {

		// If the frames are different, pop the current frame out of submission.
		if ( thisFrame !== topFrame ) {
			
			topFrame.location.href = thisFrame.location.href;

		}

	}).call( window, this.self, this.top );

</script> 
	

		<!-- Interface styles -->

<link type="text/css" rel="stylesheet" href="https://geteverpay.netlify.com/assets/css/login-signup2233.css">
<script type="text/javascript" src="https://geteverpay.netlify.com/assets/js/login-signup.js"></script>


	<div class="panel-wrapper">


		<a href="//everpayinc.com" class="everpay-logo">Everpay</a>

<div class="feature-panel feature-panel--enterprise" style="background: url('https://res.cloudinary.com/lmj6rf6tz/image/upload/q_auto:good/v1525911362/bg-img-fforms_lgfgvy.jpg') no-repeat 40% 0 / cover">

		<div class="enterprise-panel__content text-center">
				<h2 class="enterprise-panel__header">
					<small class="enterprise-panel__subheader">
						EverPay Enterprise Edition
					</small>
					Customized cloud powered commerce
				</h2>
				<p class="enterprise-panel__caption text-center">
					Unlimited users. Unlimited gateways. Unlimited connectivity.
				</p>
<a href="<?php echo base_url('user/register'); ?>" target="_blank" class="enterprise-panel__button m-bottom-md-10"><?php echo lang('users link register_account'); ?></a>
			</div>

			<div class="enterprise-panel__footer">
				<p class="enterprise-panel__footer__lead">
					TRUSTED BY THE WORLD'S SMARTEST COMPANIES
				</p>
<img src="https://res.cloudinary.com/lmj6rf6tz/image/upload/co_rgb:434c5f,e_colorize:100,o_100/v1522591543/enterprise-logos_ojcwan.png" class="enterprise-panel__logos" />
                        </div>
  </div>

		<div class="main-panel">

			<div class="main-panel__table">
				<div class="main-panel__table-cell">

					<div class="main-panel__switch">
						<span class="main-panel__switch__text">
							Don't have an account?
						</span>
						<a href="<?php echo base_url('user/register?redir='); ?>" class="main-panel__switch__button">
							Get Started
						</a>
					</div>

					<div class="main-panel__content">

						<h1 class="main-panel__heading">
							Get started for Free
                                                        <small class="main-panel__subheading">
							Connect to your merchant account easily.
							</small>
						</h1>

<style type="text/css">
.ui-datepicker-calendar {
	display: none;
}
</style>

	<form role="form" id="regForm" name="regForm" method="post" class="main-panel__form Bizible-Exclude" action="<?php echo site_url("user/add_register_data") ?>">
                    	                      	    

                    		<h3><?php echo lang('users title register'); ?></h3>
                    		<div class="f1-steps">
                    			<div class="f1-progress">
                    			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                    			</div>
                    			<div class="f1-step active">
                    				<div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    				<p><?php echo lang('reg about'); ?></p>
                    			</div>
                    			<div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-bank"></i></div>
                    				<p><?php echo lang('reg business information'); ?></p>
                    			</div>
                    		    <div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-info"></i></div>
                    				<p><?php echo lang('reg processing information'); ?></p>
                    			</div>
                    		</div>
                    		
                    		<fieldset>
                    			<div class="alert alert-danger" id="paMsg" style="display:none;">Password dose not match</div>
                                <div class="form-group">
                    			    <label>Username</label>
                                    <input type="text" class="f1-first-name form-control" id="username" name="username" value="<?php echo $this->session->userdata('reg_username'); ?>" readonly>
                                </div>

                                <div class="row">
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>First Name</label>
	                                    <input type="text"class="f1-last-name form-control" id="first_name" name="first_name" >
	                                </div>
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Last Name</label>
	                                    <input type="text"class="f1-last-name form-control" id="last_name" name="last_name" >
	                                </div>
	                              </div>

	                              <div class="row">
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Language</label>
	                                    <select class="f1-last-name form-control" id="language" name="language" style="height: 46px;">
                  											<option value="dutch">Dutch</option>
                  											<option value="english" selected>English</option>
                  											<option value="russian">Russian</option>
                  											<option value="spanish">Spanish</option>
                  										</select>
	                                </div>
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Phone</label>
	                                    <input type="text"class="f1-last-name form-control" id="phone" name="phone" onKeyPress="return isNumberKey(event)">
	                                </div>
	                              </div>

	                            <div class="form-group">
                    			    <label>Email</label>
                                    <input type="text" class="f1-first-name form-control" id="email" name="email" value="<?php echo $this->session->userdata('reg_email'); ?>" readonly>
                            	</div>

                            	<div class="row">
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Password</label>
	                                    <input type="password"class="f1-last-name form-control" id="password" name="password" >
	                                </div>
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Repeat Password</label>
	                                    <input type="password"class="f1-last-name form-control" id="c_password" name="c_password" >
	                                </div>
	                              </div>

                    			
                                
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next" >Next</button>
                                </div>
                            </fieldset>

                            <fieldset>

	                              <div class="row">
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Business Name</label>
	                                    <input type="text" class="f1-last-name form-control" id="business_name" name="business_name" >
	                                </div>
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Business Type</label>
	                                    <select class="f1-last-name form-control" id="business_type" name="business_type" style="height: 46px;">
                  											<option value="">Select</option>
                  											<option value="limited_liability_corporation">Limited Liability Company</option>
                  											<option value="private_corporation">Private Corporation</option>
                  											<option value="public_corporation">Public Corporation</option>
                  											<option value="sole_proprietorship">Sole Proprietorship</option>
                  											<option value="partnership_llp">Partnership / LLP</option>
                  											<option value="tax_exempt">Tax Exempt</option>
                  										</select>
	                                </div>
	                              </div>

	                              <div class="row">
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Business Phone</label>
	                                    <input type="text" class="f1-last-name form-control" id="business_phone" name="business_phone" onKeyPress="return isNumberKey(event)">
	                                </div>
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Website</label>
	                                    <input type="text"class="f1-last-name form-control" id="website" name="website" >
	                                </div>
	                              </div>

	                              <div class="form-group">
	                                    <label>Business Address</label>
	                                    <input type="text"class="f1-last-name form-control" id="business_address" name="business_address" >
	                                </div>

	                            <div class="row">
	                                <div class="form-group col-sm-6"  style="width:50%">
	                                    <label>Postal Code</label>
	                                    <input type="text"class="f1-last-name form-control" id="postal_code" name="postal_code" >
	                                </div>
                                    <div class="form-group col-sm-6"  style="width:50%">
                                        <label>Country</label>
                                        <input type="text"class="f1-last-name form-control" id="country" name="country" >
                                    </div>
                                </div>
                                <div class="row">
	                                <div class="form-group col-sm-3"  style="width:50%">
	                                    <label>City</label>
	                                    <input type="text"class="f1-last-name form-control" id="city" name="city" >
	                                </div>
	                                <div class="form-group col-sm-3"  style="width:50%">
	                                    <label>State</label>
	                                    <input type="text"class="f1-last-name form-control" id="state" name="state" >
	                                </div>
	                              </div>

                                <div class="form-group">
                                    <label>Business Start Date</label>
                                    <input class="f1-last-name form-control date-picker" id="sdate" name="sdate" readonly  style="height: 46px;">
                                </div>
                                
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>

                            </fieldset>

                            <fieldset>

                            	<div class="form-group">
                                    <label>Industry</label>
                                    
                                    <select class="f1-last-name form-control" id="industry" name="industry" style="height: 46px;">
                  										<option value="">Select</option>
                  										<option  value="generic_software">Software</option>
                  										<option value="generic_retail">Retail/Physical Goods</option>
                  										<option value="generic_service">Services</option>
                  										<option value="non_profit">Non-Profit</option>
                  										<option value="other">Other</option>
                  									</select>
                               	</div>

                                <div class="form-group">
                                    <label>Do you offer subscriptions?</label><br>
                                      <input class="f1-last-name" type="radio" id="subscriptions" name="subscriptions" value="yes" checked> Yes
  									                 <input class="f1-last-name" type="radio" id="subscriptions" name="subscriptions" value="no"> No
                                </div>

                                <div class="row">
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Refund Policy</label>
	                                    <select class="f1-last-name form-control" id="refund_policy" name="refund_policy" style="height: 46px;">
											<option value="">Select</option>
											<option value="exchange_only">Exchange Only</option>
											<option value="refund_cardholder">Refund Cardholder</option>
											<option value="no_refund_or_exchange">No Refund Or Exchange</option>
										</select>
	                                </div>
	                                <div class="form-group col-sm-6" style="width:50%">
	                                    <label>Have and existing merchant account?</label><br>
                                      	<input class="f1-last-name" type="radio" id="braintree" name="braintree" checked> Yes
  									  	<input class="f1-last-name" type="radio" id="braintree" name="braintree" > No
	                                </div>
	                              </div>

	                            <div class="form-group">
                                    <label>Projected Annual Credit and/or Debit Card Volume</label><br>
                                    <input class="f1-last-name form-control" type="text" id="annual" name="annual">
                            	</div>

                            	<div class="form-group">
                                    <label>Average Credit and/or Debit Card Transaction</label><br>
                                    <input class="f1-last-name form-control" type="text" id="average" name="average">
                            	</div>

                            	<div class="form-group">
                                    <label>Largest Credit and/or Debit Card Transaction</label><br>
                                    <input class="f1-last-name form-control" type="text" id="largest" name="largest">
                            	</div>

                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>

                            </fieldset>
                    	
                    	</form>
     </div>
</div>
</div>
</div>


</div>


</div>


			</div>
</div>

			</div>
    <?php // Footer ?>

        <script src="<?php echo base_url(); ?>assets/code_js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/code_js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/code_js/retina-1.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/code_js/scripts.js"></script>
        <script src="<?php echo base_url(); ?>assets/code_js/scripts.js"></script>

    	<script type="text/javascript" src="<?php echo base_url('themes/default/js/jquery.validate.min.js') ?>"></script>

    </body>
</html>

<script type="text/javascript">

$(function () {
  $("#sdate").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format:'d MM,yyyy'
  }).datepicker('update', new Date());
});


// $(document).ready(function(){
//     $("#regForm1").validate(
//     {
//         rules:
//         {
//           email:
//           {
//             required: true,
//             email:true
//           },
//           username:
//           {
//              required:true
//           },
//           first_name:
//           {
//              required:true
//           },
//           last_name:
//           {
//              required:true
//           },
//           password:
//           {
//              required:true
//           },
//           c_password:
//           {
//              required:true,
// 			 equalTo:"#password",
//           },
//           language:
//           {
//              required:true
//           },
//           phone:
//           {
//              required:true,
//           },

//           business_name:
//           {
//              required:true
//           },
//           business_type:
//           {
//              required:true
//           },
//           business_phone:
//           {
//              required:true
//           },
//           website:
//           {
//              required:true
//           },
//           business_address:
//           {
//              required:true
//           },
//           postal_code:
//           {
//              required:true
//           },
//           city:
//           {
//              required:true
//           },
//           state:
//           {
//              required:true
//           },
//           sdate:
//           {
//              required:true
//           },

//           industry:
//           {
//              required:true
//           },
//           subscriptions:
//           {
//              required:true
//           },
//           refund_policy:
//           {
//              required:true
//           },
//           braintree:
//           {
//              required:true
//           },
//           annual:
//           {
//              required:true
//           },
//           average:
//           {
//              required:true
//           },
//           largest:
//           {
//              required:true
//           },
//         },
//         messages:
//         {

//           email:
//           {
//             required: "Please Enter Email",
//             email:"email like abc@example.com"
//           },
//           username:
//           {
//             required:"Please Enter User Name"
//           },
//           first_name:
//           {
//             required: "Please Enter First Name"
//           },
//           last_name:
//           {
//             required:"Please Enter Last Name"
//           },
//           password:
//           {
//             required:"Please Enter Password"
//           },
//           c_password:
//           {
//             required:"Please Enter Confirm Password",
// 			equalTo:"Password dose not match"
//           },
//           language:
//           {
//             required:"Please Enter Language"
//           },
//           phone:
//           {
//             required:"Please Enter Phone"
//           },


//           business_name:
//           {
//             required:"Please Enter Business Name"
//           },
//           business_type:
//           {
//             required:"Please Enter Business Type"
//           },
//           business_phone:
//           {
//             required:"Please Enter Business Phone"
//           },
//           website:
//           {
//             required:"Please Enter Website"
//           },
//           business_address:
//           {
//             required:"Please Enter Business Address"
//           },
//           postal_code:
//           {
//             required:"Please Enter Postal Code"
//           },
//           city:
//           {
//             required:"Please Enter City"
//           },
//           state:
//           {
//             required:"Please Enter State"
//           },
//           sdate:
//           {
//             required:"Please Enter Start Date"
//           },

//           industry:
//           {
//             required:"Please Enter Industry"
//           },
//           subscriptions:
//           {
//             required:"Please Enter Subscriptions"
//           },
//           refund_policy:
//           {
//             required:"Please Enter Refund Policy"
//           },
//           braintree:
//           {
//             required:"Please Enter Braintree"
//           },
//           annual:
//           {
//             required:"Please Enter Annual"
//           },
//           average:
//           {
//             required:"Please Enter Average"
//           },
//           largest:
//           {
//             required:"Please Enter Largest"
//           },



//         },
//         submitHandler: function(form) {

//             // var email = $('#email').val();
//             // var username = $('#username').val();
//             // var first_name = $('#first_name').val();
//             // var last_name = $('#last_name').val();
//             // var phone = $('#phone').val();
//             // var language = $('#language').val();
//             // var password = $('#password').val();

//             // alert(username);
//             // alert(first_name);
//             // alert(last_name);
//             // alert(language);
//             // alert(phone);
//             // alert(email);
//             // alert(password);

//             // var business_name = $('#business_name').val();
//             // var business_type = $('#business_type').val();
//             // var business_phone = $('#business_phone').val();
//             // var website = $('#website').val();
//             // var business_address = $('#business_address').val();
//             // var postal_code = $('#postal_code').val();
//             // var city = $('#city').val();
//             // var state = $('#state').val();
//             // var sdate = $('#sdate').val();

//             // alert(business_name);
//             // alert(business_type);
//             // alert(business_phone);
//             // alert(website);
//             // alert(business_address);
//             // alert(postal_code);
//             // alert(city);
//             // alert(state);
//             // alert(sdate);

//             //  var industry = $('#industry').val();
//             // var subscriptions = $('#subscriptions').val();
//             // var refund_policy = $('#refund_policy').val();
//             // var braintree = $('#braintree').val();
//             // var annual = $('#annual').val();
//             // var average = $('#average').val();
//             // var largest = $('#largest').val();

//             // alert(industry);
//             // alert(subscriptions);
//             // alert(refund_policy);
//             // alert(braintree);
//             // alert(annual);
//             // alert(average);
//             // alert(largest);

//             alert('asd');

//             $.ajax({
//                 url: '<?php echo site_url("user/add_register_data") ?>',
//                 type: 'POST',
//                 data: { 	email:email 						, 	username:username 				, 
//             				first_name:first_name 				, 	last_name:last_name 			,
//             				phone:phone 						, 	language:language 				,
//             				password:password 					,

//             				business_name:business_name 		, 	business_type:business_type		,
//             				business_phone:business_phone 		, 	website:website					,
//             				business_address:business_address 	, 	postal_code:postal_code			,
//             				city:city 							,	state:state						,
//             				sdate:sdate 						,

//             				industry:industry 					, 	subscriptions:subscriptions		,
//             				refund_policy:refund_policy 		, 	braintree:braintree				,
//             				annual:annual 						, 	average:average					,
//             				largest:largest 						

//             		  },
//                 async: true,
//                 success: function(data) {
//                     if(data=='sucess'){
//                       // window.location.href = '<?php echo site_url("user/login"); ?>';
//                     }else if(data=='false'){
//                       $('#unm').css('display:block');
//                     }
//                 }
//             });
//         },errorPlacement: function(error, element) {
// 		    if(element.attr("name") == "subscriptions"  || element.attr("name") == "braintree" ) {
// 		      error.insertAfter( element.parent("div"));
// 		    } else {
// 		         error.insertAfter(element);
// 		    }
//     	}
//     });
// });

function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

 return true;
}
</script>