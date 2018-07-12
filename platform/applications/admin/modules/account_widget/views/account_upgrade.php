<?=$this->load->view(branded_view('cp/header'), array('head_files' => '
<script type="text/javascript" src="' . branded_include('js/form.address.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/formmapper.js') . '"></script>')); ?>

<style type="text/css">
.linksColumn {
  float: left;
  margin-right: 10px;
  margin-left: -20px;
  width: 280px;
  line-height: 18px;
  padding: 20px;
  font-size: 14px;
  color: #fefefe;
}
.linksColumn h3 {
margin-top: 10px;
margin-bottom: 10px;
color: #FFFFFF;
}

.linksColumn ul, ol {
  margin-top: 0;
  margin-left: -10px;
  list-style-type: none;
}

.linksColumn li {
color: #FFFFFF;
font-weight: 500;
  font-size: 13px;
  list-style-type: none;
}

.pageColumn {
  float: left;
  margin-right: 10px;
  margin-left: -20px;
  width: 480px;
  line-height: 18px;
  padding: 20px;
  font-size: 14px;
  color: #fefefe;
}
.pageColumn h2 {
margin-top: 1px;
margin-bottom: 10px;
color: #FFFFFF;
}

.pageColumn ul, ol {
  margin-top: 0;
  margin-left: -20px;
  margin-right: 40px;
  list-style-type: none;
}

.pageColumn li {
color: #FFFFFF;
font-weight: 500;
  font-size: 14px;
  list-style-type: none;
}

select {
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
  display: inline-block;
  height: 42px!important;
width:99%;
 font-size: 14px;
}

.form-control {
 display: inline-block;
  height: 42px!important;
  padding: 8px 12px!important;
  font-size: 14px;
  line-height: 18px;
  font-weight: normal;
  margin-bottom: 8px;
  color: #555;
  background-color: #fff;
  border: 1px solid #e5e5e5;
  -webkit-border-radius: 4px!important;
  -moz-border-radius: 4px!important;
  border-radius: 4px!important;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}

.xe-widget.xe-counter, .xe-widget.xe-counter-block .xe-upper, .xe-widget.xe-progress-counter .xe-upper {
  background: #fff;
  padding: 28px;
  line-height: 1;
  display: inline-block!important;
  width: 100%;
  margin-bottom: 20px;
  overflow: inherit;
}

.profile-avatar {
  text-align: center;
  padding-top: 2px;
  padding-bottom: 10px;
  background-position: 50% 50%;
  background-size: cover;
  position: relative;
}
.avatar-name {
  text-align: center;
font-weight: 700;
color: #999;
}

.main-details {
  border-bottom: 1px solid #DFE2E9;
}


.avatar .social i {
  font-size: 19px;
  margin: 0 5px;
  color: #444;
}

.modal .modal-header h2 {
  font: normal normal normal 32px "Proxima Nova Semi Bold",arial,sans-serif;
  line-height: 0px;
  color: #000;
  padding: 0;
  margin: 0;
  margin-top: -25px;
}

#account #content #panel {
  top: 0!important;
  position: relative;
  width: 82%!important;
  margin-left: 22%!important;
  padding: 5px 65px!important;
  padding-bottom: 80px;
}

#account #content #sidebar {
  left: 0;
  top: 0;
  bottom: 0;
  position: absolute;
  width: 28%;
  background: #fcfcfc;
  border-right: 1px solid #E8ECF1;
}

#account #content #sidebar #panel {
  top: 0;
  position: relative;
  width: 70%;
  margin-left: 23%;
  padding: 24px 50px;
  padding-bottom: 80px;
}


#account #content #sidebar #panel #panel2 {
  top: 0;
  position: relative;
  width: 70%;
  margin-left: 25%;
  padding: 24px 50px;
  padding-bottom: 80px;
}

#content {
  background: #FFF;
  margin-left: 100px!important;
  padding: 20px;
  width: 88.5%;!important;
  padding-top: 50px!important;
  position: relative;
  min-height: 580px;
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -ms-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}

#content .content-wrapper {
  margin-top: 0px!important;
}

#account #content #panel.profile form {
  width: 95%!important;
  margin-top: 10px!important;
}

.fa-lg {
  font-size: 24px !important;
}




#pricing .pricing-wizard .step-panel.active {
  opacity: 1;
  z-index: 2;
}

#pricing .pricing-wizard .choose-plan {
  max-width: 540px;
  margin: 0 auto;
  margin-top: 5px;
  padding-left: 20px;
  left: 20px;
}

#pricing .pricing-wizard .choose-plan .plans .plan .price {
  float: left;
  width: 115px;
  padding-left: 10px;
  padding-right: 10px;
  font-size: 20px;
  position: relative;
  top: 10px;
  color: #81838A!important;
}

#pricing .pricing-wizard .choose-plan .plans .plan {
  margin-top: 10px;
  position: relative;
  padding-top: 0px!important;
  border-radius: 5px;
  cursor: pointer;
  -webkit-transition: all 0.15s linear;
  -moz-transition: all 0.15s linear;
  -ms-transition: all 0.15s linear;
  -o-transition: all 0.15s linear;
  transition: all 0.15s linear;
}

.price:hover {
  background: transparent;
 color: #444!important;
}

#pricing .pricing-wizard .choose-plan .plans .plan .info .name {
  font-size: 17px;
  font-weight: 600;
  color: #3e95f1;
  padding-top: 12px!important;
}

#pricing .pricing-wizard .choose-plan .plans .plan:hover .info .details {
  color: #73ACE9;
}

#pricing .pricing-wizard .choose-plan .plans .plan .info .details {
  color: #888;
}

#epagination span:hover, .active {
 background: #FFF!important;
  color: #999;
  cursor: pointer;
}

#pricing .pricing-wizard .choose-plan .plans .action {
  text-align: center!important;
  margin-top: 40px;
}


#pricing .pricing-wizard .choose-plan .plans .plan .current-plan {
  font-size: 16px;
padding-left: 10px;
}


.price {
  background: none repeat scroll 0 0 transparent!important;
  cursor: pointer;
  display: block;
  float: left;
  letter-spacing: -0.2px;
  margin: 0 4px 0 0!important;
  padding: 5px 10px;
  font-size: 1.6em!important;
}

.details {
  padding: 0 2px;
  margin-top: 5px;
}
</style>



<!-- BEGIN PROFILE PAGE -->
<div id="pricing">

<div id="account">

<div id="content">

<div id="sidebar">
	<div class="sidebar-toggler visible-xs">
		<i class="ion-navicon"></i>
	</div>
	<h2 style="font-size: 16px; padding-left:20px;padding-top:25px;"></h2>
	<ul class="menu">
		<li>
			<a href="<?= site_url('account'); ?>">
				<i class="ion-ios7-person-outline"></i>
				Profile
			</a>
		</li>
		<li>
			<a href="<?= site_url('account/billing'); ?>">
				<i class="ion-card"></i>
				Billing
			</a>
		</li>
		<li>
			<a href="<?= site_url('account/notifications'); ?>">
				<i class="ion-ios7-email-outline"></i>
				Notifications
			</a>
		</li>
<li>
			<a class="active" href="<?= site_url('account/upgrade'); ?>">
				<i class="ion-arrow-graph-up-right"></i>
				Upgrade
			</a>
		</li>
		<li>
			<a href="<?= site_url('account/support'); ?>">
				<i class="ion-ios7-help-outline"></i>
				Support
			</a>
		</li>
<li>
			<a href="<?= site_url('account/close'); ?>">
				<i class="ion-close-round"></i>
				Close
			</a>
		</li>
	</ul>

  </div><!-- END/ #sidebar-->



<div class="content-wrapper">
<div class="clearfix" style="height: auto;">


<div id="panel" class="profile">
 <div class="row">	
        <!-- BEGIN PANEL-->
        <div class="row-fluid">

 <div class="widget-body margin-top-10">


<div class="pricing-wizard">
		<div class="step-panel active choose-plan">
<div class="current-plan field">
		<p class="lead"><label><b>Your Current Plan:</b></label> <?= $this->user->Get('plan_name') ?>  ($<?=$plans[$this->user->Get('plan_id')]['amount']?>/month)</p>
			</div>
			<div class="instructions">
				<strong>Please choose a plan below</strong> that best suites your needs, you can cancel your account, upgrade or downgrade any time.
			</div>

			<div class="plans">
				<div class="plan clearfix">
					<div class="price">
						$9/mo
					</div>
					<div class="info">
						<div class="name">
							Start Up
						</div>
						<div class="details">
							1 user, 3% per transaction fee
						</div>
						<div class="select">
							<i class="fa fa-check"></i>
						</div>
					</div>
				</div>
				<div class="plan clearfix">
					<div class="price">
						$29/mo
					</div>
					<div class="info">
						<div class="name">
							Standard
						</div>
						<div class="details">
							5 users, 1.2% per transaction fee
						</div>
						<div class="select">
							<i class="fa fa-check"></i>
						</div>
					</div>
				</div>
				<div class="plan clearfix">
					<div class="price">
						$49/mo
					</div>
					<div class="info">
						<div class="name">
							Premium
						</div>
						<div class="details">
							10 users, no transaction fees
						</div>
						<div class="select">
							<i class="fa fa-check"></i>
						</div>
					</div>
				</div>
				<div class="plan clearfix">
					<div class="price">
						$199/mo
					</div>
					<div class="info">
						<div class="name">
							Enterprise
						</div>
						<div class="details">
							Unlimited users and no transaction fees
						</div>
						<div class="select">
							<i class="fa fa-check"></i>
						</div>
					</div>
				</div>

				<div class="action">
					<a href="#" class="btn btn-success btn-lg" data-step="1">
						Upgrade Now 
						<i class="fa fa-check"></i>
					</a>
				</div>
			</div>
		</div>

		<div class="step-panel billing">
			<div class="secure clearfix">
				<span class="lock pull-left">
					<i class="fa fa-lock"></i>
					Secure
				</span>
				<div class="accepted-cards pull-right">
					<img alt="Credit card types" src="/assets/app/images/credit_card_types.gif">
				</div>
			</div>

<form id="billing-form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
			  	<div class="form-group">
				    <label class="col-sm-3 control-label">Name on Card</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" placeholder="Your full name" name="customer[first_name]">
				    </div>
			  	</div>
			  	<div class="address">
			  		<div class="form-group">
					    <label class="col-sm-3 control-label">Address</label>
					    <div class="col-sm-9">
					      	<input type="text" class="form-control" placeholder="Address" name="customer[address]">
					    </div>
					</div>
					<div class="form-group">
					    <div class="col-sm-5 col-sm-offset-3">
					      	<input type="text" class="form-control mobile-margin-bottom" placeholder="City" name="customer[city]">
					    </div>
					    <div class="col-sm-4">
					      	<input type="text" class="form-control" placeholder="Zip/Postal" name="customer[state]">
					    </div>
				  	</div>
				  	<div class="form-group">
					    <div class="col-sm-5 col-sm-offset-3">
					      	<input type="text" class="form-control mobile-margin-bottom" placeholder="Country" name="customer[city]">
					    </div>
					    <div class="col-sm-4">
					      	<input type="text" class="form-control" placeholder="State" name="customer[state]">
					    </div>
				  	</div>
			  	</div>
			  	<div class="form-group">
				    <label class="col-sm-3 control-label">Card Number</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" placeholder="••••  ••••  ••••  ••••" name="customer[first_name]">
				    </div>
			  	</div>
			  	<div class="form-group">
			  		<label class="col-sm-3 control-label">Expiration &amp; CVC</label>
				    <div class="col-sm-5">
				      	<input type="text" class="form-control mobile-margin-bottom" placeholder="MM/YYY" name="customer[city]">
				    </div>
				    <div class="col-sm-4">
				      	<input type="text" class="form-control" placeholder="CVC" name="customer[state]">
				    </div>
			  	</div>
			  	
			  	<div class="instructions">
			  		Your credit card will be charged for the monthly <strong>Business plan of $59.00 USD</strong> on April 12, 2014. This will cover your subscription from: April 12, 2014 to May 12, 2014.
			  	</div>

			  	<div class="action clearfix">
			  		<a href="#" data-step="0" class="btn btn-default pull-left">
			  			<i class="fa fa-chevron-left"></i>
			  			Plans
			  		</a>
					<a href="#" class="btn btn-success pull-right">
						Start my subscription
						<i class="fa fa-chevron-right"></i>
					</a>
				</div>
			
		</div>
	</div>
</div><!--/widget-body-->
</form><!--/form-->

<div class"clearfix"></div>


  </div><!-- END/ #Pricing -->

</div><!--/#panel2-->
</div><!--/widget-body-->


</div><!--/.clearfix-->
 </div><!-- END/ #content-wrapper-->


  </div><!-- END/ #PANEL -->
  </div><!-- END/ . ROW-->



 
  </div><!-- END/ #account-->

 </div><!-- END/ #content-->




<!-- anooj -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>

<!-- richard -->
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('repeatpwddiv','repeatpwd');
    pwdwidget.enableGenerate = false;
    pwdwidget.enableShowStrength=false;
    pwdwidget.enableShowStrengthStr =false;
    pwdwidget.MakePWDWidget(false);
    
    var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
    pwdwidget.MakePWDWidget();
        
    var frmvalidator  = new Validator("changepwd");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("newpwd","req","Please provide a new password");
    

// ]]>
</script>

<script>
  $(function(){ 

       $("#address_1").formmapper({details:"div.widget-body"}); 

        });
</script>
<!-- anooj -->

<!-- richard -->
<script>
$(document).ready(function() {
  $("abbr.timeago").timeago();
});
</script>
<!-- richard -->


<?=$this->load->view(branded_view('cp/footer'));?>
