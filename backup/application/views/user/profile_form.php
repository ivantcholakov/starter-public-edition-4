<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

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
<a href="<?php echo base_url('login/'); ?>" target="_blank" class="enterprise-panel__button m-bottom-md-10"> Login</a>
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
							Already have an account?
						</span>
						<a href="<?php echo base_url('login/'); ?>" class="main-panel__switch__button">
							Login
						</a>
					</div>

					<div class="main-panel__content">

						<h1 class="main-panel__heading">
							Get Started for Free
                         <small class="main-panel__subheading">
							Connect to your merchant account, and start accepting payments.
							</small>
						</h1>



    <div class="widget-box">
      <div class="box-highlight">
          
        <div class="alert alert-danger hidden" id="em"><?php echo lang('email signup validation'); ?></div>
        <div class="alert alert-danger hidden" id="unm"><?php echo lang('username signup validation'); ?></div><br>

        <form id="regForm" name="regForm" method="post">
     
     
                  <div class="field">
          <div class="form-group float-label-control">
            <label for="" class="control-label">Register As<?php //echo lang('users input email'); ?><span class="required">*</span></label>
                    <select name="is_admin" id="is_admin" class='form-control select2 form__input' data-rule-required="true">
                        <option value="">- Select -</option>
                        <option value="2">User</option>
                        <option value="3">Partners</option>
                        <option value="4">Developer</option>
                        <!--<option value="5">Merchant</option>-->
                    </select>
                  </div>
              </div>
              
              
                <div class="field">
          <div class="form-group float-label-control">
            <label for="InputEmail" class="control-label"><?php echo lang('users input email'); ?><span class="required">*</span></label>
                    <div class="form-wrap">
                        <input class="form__input" type="text" id="email" name="email" value=""/>
                    </div>
                </div>
            </div>
            
                 <div class="field">
          <div class="form-group float-label-control">
            <label for="username" class="control-label"><?php echo lang('users input username'); ?><span class="required">*</span></label>
                    <div class="form-wrap">
                        <input class="form__input" type="text" id="username" name="username" value=""/>
                    </div>
                </div>
        </div>

            <div style="margin-top:25px;">
            <center> 
			
                <a class="btn btn-link" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                <?php if ($this->session->userdata('logged_in')) : ?>
                    <button type="submit" name="submit" class="form__button"></span> <?php echo lang('core button save'); ?></button>
                <?php else : ?>
                    <button type="submit" name="submit" class="sign-up__button form__button"></span> <?php echo lang('users button sign_up'); ?> &nbsp;<i class="fa fa-arrow-right"></i></button>
                <?php endif; ?>

            </center>
        </div>

         </form>

     </div>
  </div>


<script type="text/javascript">
$(document).ready(function(){
    $("#regForm").validate(
    {
        rules:
        {
          email:
          {
            required: true,
            email:true
          },
          username:
          {
             required:true

          },
          is_admin:
          {
             required:true

          },
        },
        messages:
        {
          email:
          {
            required: "Please Enter Email",
            email:"email like abc@example.com"
          },
          username:
          {
            required:"Please Enter User Name"
          },
           is_admin:
          {
            required:"Please Enter Register As"
          }
        },
        submitHandler: function(form) {

           $('#em').addClass('hidden');
           $('#unm').addClass('hidden');

            var email = $('#email').val();
            var username = $('#username').val();
            var is_admin = $('#is_admin').val();

            $.ajax({
                url: '<?php echo site_url("user/reg_email") ?>',
                type: 'POST',
                data: { email:email , username:username , is_admin:is_admin  },
                // async: true,
                success: function(data) {
                    if(data=='email'){
                      $('#em').removeClass('hidden');
                    }else if(data=='unm'){
                      $('#unm').removeClass('hidden');
                    }else{
                        if(data=='2'){
                          window.location.href = '<?php echo site_url("user"); ?>';
                        }else if(data=='3'){
                          window.location.href = '<?php echo site_url("partners"); ?>';
                        }else if(data=='4'){
                          window.location.href = '<?php echo site_url("developer"); ?>';
                        }else if(data=='5'){
                          window.location.href = '<?php echo site_url("merchant"); ?>';
                        }
                     
                    }
                }
            });
        }
    });
});
</script>
	<script>


		$(".sign-up__button").on("click", function(ev) {
			ev.preventDefault();

			if (window.analytics) {
				window.analytics.track("Account.SignUpStarted");
			}

			window.location.href = $(this).attr("href");
		});

		if( window.location.hash ){
			$('#redirHash').val( window.location.hash.substr(1) );
		}

		(function() {
				var form = document.getElementsByTagName( "form" );
				if ( ! form.length || ! form[ 0 ].addEventListener ) {
						return;
				}
				// Keep track of any current form submission in progress in order to prevent
				// double-submission of the form. This is critical because the form contains
				// a one-time-use token that will cause the subsequent submit to fail.
				var isSubmitting = false;
				form[ 0 ].addEventListener(
						"submit",
						function handleSubmit( event ) {
								// Enforce a single form transmission.
								if ( isSubmitting ) {

										event.preventDefault();
										return( false );
								}
								isSubmitting = true;
						}
				);
		})();
	</script>
