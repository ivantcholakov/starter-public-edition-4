<div class="authentication-wrapper authentication-3">

    <div class="authentication-inner">

      <!-- Side container -->

      <!-- Do not display the container on extra small, small and medium screens -->

      <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('https://res.cloudinary.com/lmj6rf6tz/image/upload/v1491859461/bg-intro-1_otljy4.jpg');">

        <div class="ui-bg-overlay bg-dark opacity-50"></div>



        <!-- Text -->

        <div class="w-100 text-white px-5">

          <h1 class="display-3 font-weight-bold mb-4">Get Everpay

            <br>For free</h1>

          <div class="text-large font-weight-light">

           Everpay enables businesses of all sizes with a simple, secure way to pay people and also to do big commerce.

          </div>

        </div>

        <!-- /.Text -->

      </div>

      <!-- / Side container -->





      <div class="d-flex col-lg-4 align-items-center bg-white p-5">

        <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">

          <div class="w-100">



            <div class="d-flex justify-content-center align-items-center mt-0">

              <div class="ui-w-0">

<img src="https://res.cloudinary.com/lmj6rf6tz/image/upload/v1496853370/everpay-rnd-logo_s7wmeh.png" class="image position-relative" />



              </div>

            </div>



            <h4 class="text-center text-lighter font-weight-normal mt-4 mb-0">Claim Your Account</h4>





<form method="post" class="ui sw-main sw-theme-default my-5" id="get-everpay" name="get-everpay" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo site_url("signup_reg_email") ?>">



<?php /*?>{{ form_open('', 'method="post" class="ui sw-main sw-theme-default my-5" id="get-everpay" name="get-everpay" ') }}<?php */?>



     				<div class="field">

                        <?php /*?>{{ widget('feedback_messages_widget', {

                            'feedback_message_target': feedback_message_target,

                            'normal_message': normal_message,

                            'confirmation_message': confirmation_message,

                            'warning_message': warning_message,

                            'error_message': error_message,

                            'with_javascript': false

                        }) }}<?php */?>

                    </div>

              <?php $this->load->view("error");?>
              <div class="alert alert-danger hidden" id="em">Emai Is Allready Exits</div>
        			<div class="alert alert-danger hidden" id="unm">Username Is Allready Exits</div><br>




				  <div class="d-flex justify-content-center align-items-center">

  					  <div id="icon-ios-person" data-title=".ion.ion-ios-person" class="card icon-example d-inline-flex justify-content-center align-items-center my-2 mx-2 img-radio">
  						    <button type="button" class="btn btn-default btn-radio" id="consumer-selection" onclick="sel_consumer();">
  						        <i class="ion ion-ios-person fa-5x d-block"></i> Consumer</button>
  								    <input type="checkbox" id="consumer" name="consumer" value='2' style="display:none;" checked>
  						</div>

  						<div id="icon-ios-business" data-title=".ion.ion-ios-business" class="card icon-example d-inline-flex justify-content-center align-items-center my-2 mx-2 img-radio">
  									<button type="button" class="btn btn-default btn-radio" id="business-selection" onclick="sel_business();"><i class="ion ion-ios-business fa-5x d-block"></i>	Business</button>
  										<input type="checkbox" id="business" name="business" value='3' style="display:none;">
  						</div>

                <input type="text" id="is_admin" name="is_admin" value="" style="display:none;">

						</div>



							



				  <div class="{% if validation_errors['username'] %} error{% endif %}">

							  <div class="form-group">

								<label class="form-label">Username</label>

								<input type="text" name="username" id="username" class="form-control" value="<?php echo  set_value('username');?>" placeholder=" <?php echo lang('ui_username');?>" autocomplete="off" maxlength="256">

							  </div> </div>



				  <div class="{% if validation_errors['email'] %} error{% endif %}">

							  <div class="form-group">

								<label class="form-label">Your email</label>

								 <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email');?>" placeholder="Your email" autocomplete="off" maxlength="256">

							  </div> </div>

                  <div class="{% if validation_errors['password'] %} error{% endif %}">

               </div>



              <button type="submit" class="btn btn-primary btn-block mt-4" type="submit"><?php echo lang('ui_signup');?>

              	<i class="sign in icon"></i>

				</button>

              <div class="text-light small mt-4">

               <font color="#4E5155"> By clicking "Sign Up", you agree to our</font>

                <a href="https://everpayinc.com/terms">terms of service and privacy policy</a>. <font color="#4E5155">We’ll occasionally send you account related emails.</font>

              </div>



<?php /*?>{{ form_close() }}<?php */?>



</form>

            <div class="text-center text-muted">

              Already have an account?

              <a href="<?php echo site_url('login');?>"><?php echo lang('ui_login');?></a>

            </div>



          </div>

        </div>

      </div>





    </div>

  </div>





<script type="text/javascript">

$(document).ready(function(){

    $('#consumer-selection').css("background-color", "rgb(177, 178, 181)");
    $('#is_admin').val('2');

    $("#get-everpay").validate(
    {
	   rules:
	   {

		  username:

		  {

			required:true

		  },

		  is_admin:

		  {

			required:true



		  },

		  email:

		  {

			required: true,

			email:true

		  },

		},
	   messages:
	   {

		  username:

		  {

			required:"Please Enter User Name"

		  },

		  is_admin:

		  {

			required:"Please Enter is_admin"

		  },

		  email:

		  {

			required: "Please Enter Email",

			email:"email like abc@example.com"

		  },

		}
    });
});

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
   return true;
}

function sel_consumer()
{
    $('#consumer').prop('checked', true);
    $('#business').prop('checked', false); 
    $('#is_admin').val($('#consumer').val());
    $('#business-selection').css("background-color", "white");
    $('#consumer-selection').css("background-color", "rgb(177, 178, 181)");
}

function sel_business()
{  
    $('#business').prop('checked', true);
    $('#consumer').prop('checked', false); 
    $('#is_admin').val($('#business').val());
    $('#consumer-selection').css("background-color", "white");
    $('#business-selection').css("background-color", "rgb(177, 178, 181)");
}
</script>