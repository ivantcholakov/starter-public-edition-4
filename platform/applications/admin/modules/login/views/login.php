
<!-- Content -->

  <div class="authentication-wrapper authentication-3">
    <div class="authentication-inner">

      <!-- Side container -->
      <!-- Do not display the container on extra small, small and medium screens -->
      <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('https://res.cloudinary.com/lmj6rf6tz/image/upload/v1491859459/bg-intro-2_lmie9z.jpg');">
        <div class="ui-bg-overlay bg-dark opacity-50"></div>

        <!-- Text -->
        <div class="w-100 text-white px-5">
          <h1 class="display-3 font-weight-bold mb-4">Manage Your
            <br>Commerce</h1>
          <div class="text-large font-weight-light">
       
          </div>
        </div>
        <!-- /.Text -->
      </div>
      <!-- / Side container -->

      <!-- Form container -->
      <div class="d-flex col-lg-4 align-items-center bg-white p-5">
        <!-- Inner container -->
        <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
        <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
          <div class="w-100">

            <!-- Logo -->
             <div class="d-flex justify-content-center align-items-center mt-0">
              <div class="ui-w-0">
<img src="https://res.cloudinary.com/lmj6rf6tz/image/upload/v1496853370/everpay-rnd-logo_s7wmeh.png" class="image position-relative" />
              </div>
            </div>
          <!-- / Logo -->
          

<h4 class="text-center text-lighter font-weight-normal mt-5 mb-0">Login to Your Account</h4>
<?php $this->load->view("error");?>
<form method="post" method="post" class="ui form my-5" id="login_form" name="login_form" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo site_url("login_user") ?>"> 
<?php /*?>{{ form_open('', 'method="post" class="ui form my-5" id="login_form"') }}
<?php */?>
                <div class="ui segment">
                    <div class="form-group">
                       <?php /*?> {{ widget('feedback_messages_widget', {
                            'feedback_message_target': feedback_message_target,
                            'normal_message': normal_message,
                            'confirmation_message': confirmation_message,
                            'warning_message': warning_message,
                            'error_message': error_message,
                            'with_javascript': false
                        }) }}<?php */?>
                    </div>

                    <div class="form-group">
                        <div class="ui big left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="username" class="form-control" id="username" value="<?php echo set_value('username');?>" placeholder="*Username" maxlength="256">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="ui big left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" class="form-control" id="password" value="<?php echo set_value('password');?>" placeholder="*Password" maxlength="256">
                        </div>
                    </div>

					 <div class="d-flex justify-content-between align-items-center m-0">
				<button class="ui btn btn-round btn-lg btn-primary pl-5 pr-5 align-center" type="submit">
					<?php echo lang('ui_login');?> </button>
					</div>
                </div>
</form>
         <?php /*?>   {{ form_close() }}<?php */?>



<form  method="post" class="hidden segment my-5" id="login_form">
    <?php /*?>{{ form_open('', 'method="post" class="hidden segment my-5" id="login_form"') }}<?php */?>
      
                      <div class="form-group">
                        <!--{{ widget('feedback_messages_widget', {
                            'feedback_message_target': feedback_message_target,
                            'normal_message': normal_message,
                            'confirmation_message': confirmation_message,
                            'warning_message': warning_message,
                            'error_message': error_message,
                            'with_javascript': false
                        }) }}-->
                    </div>
                    
					 <div class="form-group{% if validation_errors['username'] %} error{% endif %}">
										   
									<label class="form-label">Email</label>
											<div class="ui big left icon input">
												<i class="user icon"></i>
												<input type="text" name="username" class="form-control" id="username" value="{{ set_value('username') }}" placeholder="* {{ lang('ui_username')|e('html_attr') }}" maxlength="256">
											</div>
										</div>
      				 <div class="form-group{% if validation_errors['password'] %} error{% endif %}">
											  <label class="form-label d-flex justify-content-between align-items-end">
									  <div>Password</div>
									  <a href="{{ site_url('reset_password') }}" class="d-block small">Forgot password?</a>
									</label> 
											
											<div class="ui big left icon input">
												<i class="lock icon"></i>
												<input type="password" name="password" class="form-control" id="password" value="{{ set_value('password') }}" placeholder="* {{ lang('ui_password')|e('html_attr') }}" maxlength="256">
											</div>
										</div>
                    
					  <div class="d-flex justify-content-between align-items-center m-0">
						<label class="custom-control custom-checkbox m-0">
						  <input type="checkbox" class="custom-control-input">
						  <span class="custom-control-label">Remember me</span>
						</label>
					<button type="submit" class="btn btn-primary pl-4 pr-4" type="submit">
							<i class="sign in icon"></i>
						</button>
					  </div>
        </form>
<?php /*?>{{ form_close() }}<?php */?>
            <!-- / Form -->

            <div class="text-center text-muted">
              Don't have an account yet?
              <?php /*?><a href="{{ site_url('signup') }}">Sign Up &nbsp;</a><?php */?>
			  <a href="<?php echo site_url('signup');?>">Sign Up &nbsp;</a>
            </div>

          </div>
        </div>
      </div>
      <!-- / Form container -->

    </div>
  </div>

  <!-- / Content -->
<script type="text/javascript">
    //<![CDATA[

    $(function () {

        $('#login_form').on('submit', function(e) {

            $('> .segment', this).addClass('loading');
        });
    });

    //]]>
    </script>
	
<script type="text/javascript">
$(document).ready(function(){
    $("#login_form").validate(
    {
		rules:
		{
		  username:
		  {
			required:true
		  },
		  password:
		  {
			required: true
		  },
		  message:
		  {
			 required:true

		  },
		},
	   messages:
	   {
		  username:
		  {
			required:"Please Enter User Name"
		  },
		  password:
		  {
			required: "Please Enter Password",
		  },
		  message:
		  {
			required:"Please Enter Message"
		  }
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
</script>	
