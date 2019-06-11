<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/new_style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custome-validate.css">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/ico/apple-touch-icon-57-precomposed.png">

    </head>
<style type="text/css">
.ui-datepicker-calendar {
	display: none;
}
</style>
    <?php
        $business_customer = 'Business';
        if($this->session->userdata('reg_is_admin') == 2)
        {
            $business_customer = "Customer";
        }
    ?>
	<body>

        <div class="top-content" style="background-image:url('<?php echo base_url(); ?>assets/img/backgrounds/1.jpg')">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>Welcome to Just Wallet</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 form-box">


                    	<form role="form" id="regForm" name="regForm" method="post" class="f1" action="<?php echo site_url("add-register-data") ?>">

                    		<h3>Register</h3>
                    		<div class="f1-steps">
                    			<div class="f1-progress">
                    			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                    			</div>
                    			<div class="f1-step active">
                    				<div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    				<p>About</p>
                    			</div>
                    			<div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-bank"></i></div>
                    				<p><?php echo $business_customer; ?> Information</p>
                    			</div>
                    		    <div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-info"></i></div>
                    				<p>Processing Information</p>
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
	                                    <!-- <input type="text"class="f1-last-name form-control" id="phone" name="phone" onKeyPress="return isNumberKey(event)"> -->
                                         <input type="text" class="f1-last-name form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask id="phone" name="phone" onKeyPress="return isNumberKey(event)">
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
                                    <?php if($this->session->userdata('reg_is_admin') == 2 ){ ?>
                                        <div class="form-group">
                                            <label><?php echo $business_customer; ?> Address</label>
                                            <input type="text"class="f1-last-name form-control" id="business_address" name="business_address" >
                                        </div>
                                    <?php }else{ ?>
                                         <div class="row">
                                            <div class="form-group col-sm-6" style="width:50%">
                                                <label><?php echo $business_customer; ?> Name</label>
                                                <input type="text" class="f1-last-name form-control" id="business_name" name="business_name" >
                                            </div>
                                            <div class="form-group col-sm-6" style="width:50%">
                                                <label><?php echo $business_customer; ?> Type</label>
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
                                    <?php } ?>

                                    <?php if($this->session->userdata('reg_is_admin') == 2 ){ ?>
                                        <div class="form-group">
                                        <label><?php echo $business_customer; ?> Phone</label>
                                        <!-- <input type="text" class="f1-last-name form-control" id="business_phone" name="business_phone" onKeyPress="return isNumberKey(event)"> -->
                                        <input type="text" class="f1-last-name form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask id="business_phone" name="business_phone" onKeyPress="return isNumberKey(event)">
                                    </div>
                                    <?php }else{ ?>
                                       <div class="row">
        	                                <div class="form-group col-sm-6" style="width:50%">
        	                                    <label><?php echo $business_customer; ?> Phone</label>
        	                                   <!--  <input type="text" class="f1-last-name form-control" id="business_phone" name="business_phone" onKeyPress="return isNumberKey(event)"> -->
                                               <input type="text" class="f1-last-name form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask id="business_phone" name="business_phone" onKeyPress="return isNumberKey(event)">

        	                                </div>
        	                                <div class="form-group col-sm-6" style="width:50%">
        	                                    <label>Website</label>
        	                                    <input type="text"class="f1-last-name form-control" id="website" name="website" >
        	                                </div>
        	                              </div>
                                    <?php } ?>

	                              <div class="form-group">
	                                    <label><?php echo $business_customer; ?> Address</label>
	                                    <input type="text"class="f1-last-name form-control" id="business_address" name="business_address" >
	                                </div>

	                            <div class="row">
	                                <div class="form-group col-sm-6"  style="width:50%">
	                                    <label>Postal Code</label>
	                                    <input type="text"class="f1-last-name form-control" id="postal_code" name="postal_code" >
	                                </div>
                                    <div class="form-group col-sm-6"  style="width:50%">

                                        <label>Country</label>

                                        <select class="f1-last-name form-control" id="country" name="country" style="height: 46px;" >
                                            <option value="">Select</option>
                                            <?php
                                            $sql = "SELECT * FROM countries";
                                            $counrty = $this->db->query($sql);
                                            foreach($counrty->result_Array() as $counrty_list){ ?>
                                                 <option value="<?php echo $counrty_list['country_id']; ?>"><?php echo $counrty_list['name']; ?></option>
                                            <?php } ?>
                                        </select>

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
                            <?php if($this->session->userdata('reg_is_admin') != 2 ){ ?>
                                <div class="form-group">
                                    <label>Business Start Date</label>
                                    <input class="f1-last-name form-control date-picker" id="sdate" name="sdate" readonly  style="height: 46px;">
                                </div>
                            <?php } ?>

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

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/retina-1.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

    	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>
        <!-- InputMask -->
            <script src="<?php echo base_url('assets/input-mask/jquery.inputmask.js'); ?>"></script>
            <script src="<?php echo base_url('assets/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
            <script src="<?php echo base_url('assets/input-mask/jquery.inputmask.extensions.js'); ?>"></script>
        <!-- InputMask -->
    </body>
</html>

<script type="text/javascript">

$(function () {
  $("#sdate").datepicker({
        autoclose: true,
        todayHighlight: true,
        format:'d MM,yyyy'
  }).datepicker('update', new Date());
  $('[data-mask]').inputmask();
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