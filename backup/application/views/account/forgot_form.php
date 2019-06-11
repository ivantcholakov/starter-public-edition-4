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
<a href="<?php echo base_url('signup'); ?>" target="_blank" class="enterprise-panel__button m-bottom-md-10"><?php echo lang('users link register_account'); ?></a>
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
						
					</div>

					<div class="main-panel__content">

						<h1 class="main-panel__heading">
							Forgot Your Password?
                                                        <small class="main-panel__subheading">
							Enter your email address below to get a new one.
							</small>
						</h1>
        <?php echo form_open('', array('role'=>'form')); ?>
       <div class="field">
          <div class="form-group float-label-control">
            <label for="exampleInputEmail1" class="control-label"><?php echo lang('users input email'); ?></label>
            <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form__input', 'placeholder'=>'you@someaddress.com','type'=>'email')); ?>
          </div>
          </div>


          <?php echo form_submit(array('name'=>'submit', 'class'=>'form__button', 'value'=>'Get new')); ?>
          
        <?php echo form_close(); ?>

</div>
		</div>




			</div>

		</div>
</div>



