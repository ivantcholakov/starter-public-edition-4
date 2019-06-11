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
						<span class="main-panel__switch__text">
							Don't have an account?
						</span>
						<a href="<?php echo base_url('signup?redir='); ?>" class="main-panel__switch__button">
							Get Started
						</a>
					</div>

					<div class="main-panel__content">

						<h1 class="main-panel__heading">
							Welcome Back
                                                        <small class="main-panel__subheading">
							Connect to your dashboard, and manage your payments.
							</small>
						</h1>

  <?php echo form_open('', array('class'=>'main-panel__form Bizible-Exclude', 'id'=>'login_form')); ?>

    <div class="widget-box">
      <div class="box-highlight">

<div class="field">
          <div class="form-group float-label-control">
            <label for="exampleInputEmail1" class="control-label"><?php echo lang('users input username_email'); ?></label>
            <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form__input', 'placeholder'=>' username', 'maxlength'=>256)); ?>
          </div>
</div>

<div class="field">
          <div class="form-group float-label-control">
            <label for="exampleInputEmail1" class="control-label"><?php echo lang('users input password'); ?></label>
<?php echo form_password(array('name'=>'password', 'id'=>'password', 'class'=>'form__input', 'placeholder'=>' ************', 'maxlength'=>72, 'autocomplete'=>'off')); ?>

<a href="<?php echo base_url('forgot-password/'); ?>" class="form__help text-left margin-top-10"><?php echo lang('users link forgot_password'); ?></a>
          </div>

</div>

<div class="text--center">
          <?php echo form_submit(array('name'=>'submit', 'class'=>'form__button'), lang('core button login')); ?>

</div>
</div>
</div>
        <?php echo form_close(); ?>

					</div>
		</div>




			</div>

		</div>
</div>





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



<section id="signup--process" class="hidden tp--section tp--featured tp--dark-green2 tp--diagonal tp--diagonal-1">
<div class="row-fluid g-heading-v7">

<div class="login-page" role="main">

<div class="panel-wrapper">

		<a href="//everpayinc.com" class="everpay-logo">Everpay</a>
		<div class="feature-panel feature-panel--enterprise text-center">

			<div class="enterprise-panel__content">
				<h2 class="enterprise-panel__header">
					<small class="enterprise-panel__subheader">
						EverPay Enterprise Edition
					</small>
					Customized cloud powered commerce
				</h2>
				<p class="enterprise-panel__caption">
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

<div class="enterprise-panel__line"></div>
         </div>

		<div class="main-panel">

			<div class="main-panel__table text-center">
				<div class="main-panel__table-cell">

					<div class="main-panel__switch">
						<span class="main-panel__switch__text">
							Don't have an account?
						</span>
<a href="<?php echo base_url('user/register'); ?>" class="main-panel__switch__button"><?php echo lang('users link register_account'); ?></a>
					</div>

					<div class="main-panel__content text-left margin-top-10">

						<h1 class="main-panel__heading m-top-md-10">
							Welcome Back
							<small class="main-panel__subheading">
							Connect to your dashboard, and manage your payments.
							</small>
						</h1>

   <?php echo form_open('', array('class'=>'main-panel__form Bizible-Exclude', 'id'=>'login_form')); ?>

    <div class="widget-box">
      <div class="box-highlight">

<div class="field">
          <div class="form-group float-label-control">
            <label for="exampleInputEmail1" class="control-label"><?php echo lang('users input username_email'); ?></label>
            <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form__input', 'placeholder'=>'* username', 'maxlength'=>256)); ?>
          </div>
</div>

<div class="field">
          <div class="form-group float-label-control">
            <label for="exampleInputEmail1" class="control-label"><?php echo lang('users input password'); ?></label>
<?php echo form_password(array('name'=>'password', 'id'=>'password', 'class'=>'form__input', 'maxlength'=>72, 'autocomplete'=>'off')); ?>
<a href="<?php echo base_url('user/forgot'); ?>" class="form__help"><?php echo lang('users link forgot_password'); ?></a>
          </div>
</div>

<div class="text--center">
          <?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-primary outline'), lang('core button login')); ?>
</div>
</div>
</div>
        <?php echo form_close(); ?>
			
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

<footer class="app-footer hidden-print margin-top-10">
<div class="row">
<div class="container">
<div class="footer-inner margin-top-10">

<span class="float-left m-top-md-5">

<span class="footer-text footer-site-links text-lg-left text-xs-center text-xs-center copyright p-top-md-10">&copy; <?php echo date('Y'); ?> <strong><?php echo $this->settings->site_name; ?></strong> 
</span> 

<span class="dropdown dropup hidden">
                            <button id="session-language" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-footer">
                               <i class="icon-globe icons"></i> <?php echo lang('core menu lang'); ?>
                                <span class="caret"></span>
                            </button>
                            <ul id="session-language-dropdown" class="dropdown-menu" role="menu" aria-labelledby="session-language">
                                <?php foreach ($this->languages as $key=>$name) : ?>
                                    <li>
                                        <a href="#" rel="<?php echo $key; ?>">
                                            <?php if ($key == $this->session->language) : ?>
                                                <i class="fa fa-check selected-session-language"></i>
                                            <?php endif; ?>
                                            <?php echo $name; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </span>
</span> 

<span class="float-right pull-right m-top-md-0">
<ul class="site-footer-links text-lg-left text-xs-center text-xs-center list-inline m-top-md-0">

<li class="cpl-link2 m-top-md-5 m-top-sm-5"><a href="//everpayinc.com/privacy/" target="_blank" ><?php echo lang('core menu privacy'); ?></a></li>
<li class="cpl-link1 m-top-md-5 m-top-sm-5"><a href="//everpayinc.com/terms/" target="_blank" ><?php echo lang('core menu terms'); ?></a></li>
<li class="cpl-link0 m-top-md-5 m-top-sm-5"><small>Powered by&nbsp;<b><a href="https://elektropay.com" target="_blank" >Elektropay<sup>™</sup></a></b></small></li>
</ul>					
</span>

</div><!-- /footer-inner -->
</div><!-- /container -->
</div><!-- /row -->
</footer>
</section>


<div class="container theme-showcase" role="main" style="display: none;">

  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
      <div class="panel-body">
        <?php  $this->load->view("error");?>
        <?php echo form_open('', array('class'=>'form-signin')); ?>
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo lang('users input username_email'); ?></label>
            <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form-control', 'maxlength'=>256)); ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo lang('users input password'); ?></label>
             <?php echo form_password(array('name'=>'password', 'id'=>'password', 'class'=>'form-control', 'maxlength'=>72, 'autocomplete'=>'off')); ?>
          </div>
          <?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-primary pull-right'), lang('core button login')); ?>
          <p><br /><a href="<?php echo base_url('user/forgot'); ?>"><?php echo lang('users link forgot_password'); ?></a></p>
          <p><a href="<?php echo base_url('user/register'); ?>"><?php echo lang('users link register_account'); ?></a></p>
        <?php echo form_close(); ?>
      </div>
    </div>
    </div>
  </div>

</div>
