<?=$this->load->view(branded_view('cp/header'), array('head_files' => '
<script type="text/javascript" src="' . branded_include('js/form.address.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/jquery.inputlimiter.1.3.1.min.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/jquery.maskedinput.min.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/pwdwidget.js') . '"></script>
<link rel="stylesheet" type="text/css" href="' . branded_include('css/pwdwidget.css') . '" />
<script type="text/javascript" src="' . branded_include('js/formmapper.js') . '"></script>')); ?>

 <link rel="stylesheet" href="https://cdnjs.com/libraries/css-social-buttons">
 
<style type="text/css">

.account-status-marker-activated {
    margin: -3px 2px 0px 0;
    padding: 4px 5px!important;
    border: 1px solid #7ae498;
    font-size: 10px!important;
    letter-spacing: 1.3px;
    color: #7ae498;
    border-radius: 25px;
    font-weight: 600;
    text-shadow: 0 0px 0 #000;
}


.account-status-marker-pending {
  margin: -6px 2px 0px 0;
  padding: 4px 5px;
  border: 1px solid #f0ad4e;
  font-size: 10px;
  letter-spacing: 1.3px;
  color: #f0ad4e;
  font-weight: 600;
  text-shadow: 0 0px 0 #000;
}


.linksColumn {
  float: left;
  margin-right: 10px;
  margin-left: 20px;
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
  margin-left: 10px;
  list-style-type: none;
}

.linksColumn li {
color: #FFFFFF;
font-weight: 500;
  font-size: 14px;
  list-style-type: none;
}



.pageColumn {
  float: left;
  margin-right: 20px;
  margin-left: 20px;
  width: 100%;
  line-height: 18px;
  padding: 10px;
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
  margin-right: 20px;
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
  background: transparent;
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

.details {
  padding: 0 20px;
  margin-top: 20px;
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


.fa-lg {
  font-size: 24px !important;
}

#content .content-wrapper {
  margin-top: 0px;
}

@media (max-width: 767px)
#content {
  margin-left: 0px;
  z-index: 9999;
  padding-left: 0px!important;
  padding-right: 20px;
}

.pageColumn h2 {
  margin-top: 2px;
  margin-bottom: 20px;
  color: #FEFEFE;
}

select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
  display: inline-block;
  height: 38px!important;
  padding: 8px 10px!important;
  margin-bottom: 8px;
  font-size: 16px!important;
  line-height: 18px;
  color: #555;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  vertical-align: middle;
}


input[type="button" i], input[type="submit" i], input[type="reset" i], input[type="file" i]::-webkit-file-upload-button, button {
  padding: 5px 8px!important;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 5px!important;
}
label {
  margin-bottom: 8px;
}

#content {
  background: #FFF;
  margin-left: 180px!important;
  padding: 40px;
  padding-top: 70px;
  position: relative;
  min-height: 720px;
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -ms-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}

#form_container {
  top: 20px;
}

.xe-widget.xe-counter-block, .xe-widget.xe-progress-counter {
  color: #fff;
  background: #cecece!important;
  margin-bottom: 20px!important;
  border-radius: 10px!important;
}
.nav.nav-justified > li > a { position: relative; }
.nav.nav-justified > li > a:hover,
.nav.nav-justified > li > a:focus { background-color: transparent; }
.nav.nav-justified > li > a > .quote {
    position: absolute;
    left: 0px;
    top: 0;
    opacity: 0;
    width: 30px;
    height: 30px;
    padding: 5px;
    background-color: #9585bf;
    border-radius: 15px;
    color: #fff;  
}
.nav.nav-justified > li.active > a > .quote { opacity: 1; }
.nav.nav-justified > li > a > img { box-shadow: 0 0 0 5px #9585bf; }
.nav.nav-justified > li > a > img { 
    max-width: 100%; 
    opacity: .3; 
    -webkit-transform: scale(.8,.8);
            transform: scale(.8,.8);
    -webkit-transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
				width: 96px;
		
}
.nav.nav-justified > li.active > a > img,
.nav.nav-justified > li:hover > a > img,
.nav.nav-justified > li:focus > a > img { 
    opacity: 1; 
    -webkit-transform: none;
            transform: none;
    -webkit-transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
				width: 96px;
}
.tab-pane .tab-inner { padding: 2px 0 20px; }

@media (min-width: 768px) {
    .nav.nav-justified > li > a > .quote {
        left: auto;
        top: auto;
        right: 20px;
        bottom: 0px;
    }  
	
.nav.nav-justified > li > a {
    margin-bottom: 20px;
}
	
	.tab-pane {
    position: relative;
    padding-top: 5px!important;
}

.wrapper h5 {
    text-transform: uppercase;
    border-bottom: 1px solid #d0d2d3;
    padding-bottom: 6px;
    letter-spacing: .5px;
    font-size: 1rem;
}

p {
    margin: 0px 0!important;
}

.account-edit-btn {
    margin-top: 1px;
    margin-right: 20px;
	    position: relative;
}

#account-edit-btn {
    margin-top: 1px;
    margin-right: 20px;
	    position: relative;
}

</style>

<!-- END PAGE HEADER-->

<div class="content-wrapper">

<!-- BEGIN PROFILE PAGE -->

<div id="account" style="height: auto;">

<div class="[ row ]">

<div class="[ row-fluid text-center ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 ]" role="tabpanel">
		<form class="view_form" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
				
            <div class="[ col-xs-4 col-sm-12 ]">
                <!-- Nav tabs -->
                <ul class="[ nav nav-justified ]" id="nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#personal" aria-controls="personal" role="tab" title="Edit Owner Info"data-placement="bottom" data-toggle="tab">
						<?php $email = $this->user->Get('email');
$size = 96; $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
?>                            <img class="img-circle" src="<?php echo $grav_url; ?>" />
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#business" aria-controls="business" role="tab" data-placement="bottom" title="Edit Business Info" data-toggle="tab">
      <img class="img-circle" src="<?= branded_include('img/circle-icons/one-color/briefcase.png'); ?>" width="128"/>
							
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#banking" aria-controls="banking" role="tab" data-placement="bottom" title="Edit Deposit Info" data-toggle="tab">
                            <img class="img-circle" src="<?= branded_include('img/circle-icons/one-color/money.png'); ?>" width="128"/> 
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#security" aria-controls="security" role="tab" data-placement="bottom" title="Edit Security" data-toggle="tab">
                            <img class="img-circle" src="<?= branded_include('img/circle-icons/one-color/security.png'); ?>" />
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
			
            <div class="[ col-xs-12 col-sm-12 ]">
                <!-- Tab panes -->
                <div class="tab-content" id="tabs-collapse">    
				
                    <div role="tabpanel" class="tab-pane fade in active" id="personal">
                		<div class="tab-inner"> 
						<div class="row">
<div class="col-xs-12 col-md-12 col-sm-12">

<div class="row">
<span id="" type="button" class="pull-right btn btn-primary btn-xs account-edit-btn" data-toggle="modal" data-target="#modal-owner-info">
  Edit Profile Info
</span>
<span><h4>Profile Information</h4></span>   
</div>
				
<div class="profile-user-info">

<div class="profile-info-row">
<div class="profile-info-name"><span>Merchant ID:</span> </div>
<div class="profile-info-value"> <i class="fa fa-map-marker light-orange bigger-110"></i> <span>EV3222<?= $this->user->Get('client_id') ?></span></div>														</div><!-- END/.profile-info-row-->
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name"><span>Merchant Since:</span> </div>
<div class="profile-info-value"><span><?=$form['create_date'];?></span></div>
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name"><span>Status:</span></div>
<div class="profile-info-value">
<? if ($row['suspended'] == '1') { ?>
<span class="label label-danger suspended arrowed-in-right">
<img src="<?= branded_include('images/failed.png'); ?>" alt="De-Activated" /> Suspended <span class="fa fa-remove"></span></span><? } else { ?><span class="account-status-marker-activated"> Activated<? } ?>													</span></span>
</div>
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name"><span>Name:</span> </div>
<div class="profile-info-value"><span><?=$form['first_name'];?> <?=$form['last_name'];?></span></div><!-- END/.profile-info-value-->
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">					
<div class="profile-info-name"><span>Email:</span></div>												
<div class="profile-info-value"><span><?=$form['email'];?></span></div>
</div><!-- END/.profile-info-row-->	

<div class="profile-info-row">
<div class="profile-info-name"><span>Password:</span></div>
<div class="profile-info-value"><span><?=$form['password'];?></span></div>
</div><!-- END/.profile-info-row-->							

<div class="profile-info-row">
<div class="profile-info-name"><span>Last Session:</span> </div>
<div class="profile-info-value"><span>ago</span></div>		
</div><!-- END/.profile-info-row-->

</div><!-- END/.profile-user-info-->
  </div><!-- END/ .col-md-10-->
  <div class="[ row-fluid text-center hidden]">
    <div class="[ row ]">
        <div class="[ col-xs-12 ]" style="padding-bottom: 30px;">
				<br />
            <p> You can configure your gateway settings <a target="_parent" href="<?= site_url('settings/'); ?>">here</a> to access more features.</p>
        </div>
    </div>
</div>
				</form><!--/form-->
   </div><!--/.tab-inner-->
   
	 </div><!--/.tab-pane-->
		 
                    
                    <div role="tabpanel" class="tab-pane fade" id="business">
                        <div class="tab-inner">
						
                   <form><!--Start form-->         
				   <div class="row">
<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">

<div class="row">
<span id="account-edit-btn" type="button" class="pull-right btn btn-primary btn-xs account-edit-btn" data-toggle="modal" data-target="#modal-business-info">
  Edit Business Info
</span>
<span><h4>Business Information</h4></span>  
		</div>
		
<div class="profile-user-info">

<div class="profile-info-row">
<div class="profile-info-name"><span>Business Name:</span> </div>
<div class="profile-info-value"><span><?=$form['company'];?></span></div>
</div><!-- END/.profile-info-row-->	
<div class="profile-info-row">
<div class="profile-info-name"><span>Business Website:</span> </div>
<div class="profile-info-value"> <span><?= $this->user->Get('business_url') ?></span></div>														</div><!-- END/.profile-info-row-->
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name"><span>Business Contact:</span> </div>
<div class="profile-info-value"><span><?=$form['first_name'];?> <?=$form['last_name'];?></span></div><!-- END/.profile-info-value-->
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">					
<div class="profile-info-name"><span>Business Email:</span></div>												
<div class="profile-info-value"><span><?=$form['email'];?></span></div>
</div><!-- END/.profile-info-row-->	

<div class="profile-info-row">
<div class="profile-info-name"><span>Business Address:</span> </div>
<div class="profile-info-value"><span><?=$form['business_address'];?></span>, <span><?=$form['business_city'];?>, <?=$form['business_state'];?>, <?=$form['business_zipcode'];?> </span>
</div>		
</div><!-- END/.profile-info-row-->	

<div class="profile-info-row">
<div class="profile-info-name"><span>Business Country:</span> </div>
<div class="profile-info-value"><span><?=$form['business_country'];?></span></div>
				
</div><!-- END/.profile-info-row-->	

<div class="profile-info-row">
<div class="profile-info-name"><span>Business Phone:</span> </div>
<div class="profile-info-value"><span><?=$form['business_phone'];?></span></div>
</div><!-- END/.profile-info-row-->																			

</div><!-- END/.profile-user-info-->
  </div><!-- END/ .col-md-10-->
  <div class="[ row-fluid text-center hidden]">
    <div class="[ row ]">
        <div class="[ col-xs-12 ]" style="padding-bottom: 30px;">
            <p> You can configure your gateway settings <a target="_parent" href="<?= site_url('settings/'); ?>">here</a> to access more features.</p>
        </div>
    </div>
</div>
				</form><!--/form-->
						   </div><!--/.tab-inner-->
                    </div><!--/.tab-panel-->
                    
                 <div role="tabpanel" class="tab-pane fade" id="banking">				
					
                     <div class="tab-inner">
						<form><!--Start form-->
                            <div class="row">
							
<div class="col-xs-12 col-md-12 col-sm-12">
<div class="row">	
<span id="account-edit-btn" type="button" class="pull-right btn btn-primary btn-xs account-edit-btn" data-toggle="modal" data-target="#modal-deposit-info">
  Edit Deposit Info
</span>
<span><h4>Deposit Information</h4></span>   
</div>	
						
<div class="profile-user-info">

<div class="profile-info-row">					
<div class="profile-info-name"><span>Bank Name:</span></div>												
<div class="profile-info-value"><span><?=$form['bank_name'];?></span></div>
</div><!-- END/.profile-info-row-->	

<div class="profile-info-row">
<div class="profile-info-name"><span>Bank Address:</span> </div>
<div class="profile-info-value"><span><?=$form['bank_address'];?></span></div>
</div><!-- END/.profile-info-row-->	
						

<div class="profile-info-row">
<div class="profile-info-name"><span>Account Name:</span> </div>
<div class="profile-info-value"><span><?=$form['bank_acc_name'];?></span></div>
</div><!-- END/.profile-info-row-->	
								
<div class="profile-info-row">
<div class="profile-info-name"><span>Account Type:</span> </div>
<div class="profile-info-value"><span><?=$form['bank_acc_type'];?> </span></div>
</div>

</div><!-- END/.profile-info-row-->	
<div class="profile-info-row">
<div class="profile-info-name"><span>Routing #:</span> </div>
<div class="profile-info-value"> <span><?= $this->user->Get('bank_routing_number') ?></span></div>														</div><!-- END/.profile-info-row-->
</div><!-- END/.profile-info-row-->										

<div class="profile-info-row">
<div class="profile-info-name"><span>Account #:</span> </div>
<div class="profile-info-value"> <span><?= $this->user->Get('bank_acc_number') ?></span></div><!-- END/.profile-value-->

</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name"><span>Bank Swift:</span> </div>
<div class="profile-info-value"><span><?=$form['bank_swift_number'];?></span></div>
</div><!-- END/.profile-info-row-->
<hr>
<div class="profile-info-row"> 

<div class="profile-info-name"><span>BTC Address:</span> <button type="button" class="btn-link btn-xs pull-right" data-toggle="modal" data-target="#modal-btc-address">
  Change Bitcoin Address
</button></div>
<div class="profile-info-value"><span><?=$form['bitcoin_address'];?></span></div>
</div><!-- END/.profile-info-row-->


</div><!-- END/.profile-user-info-->
  </div><!-- END/ .col-md-10-->
  
	
	<div class="[ row-fluid text-center hidden]">
    <div class="[ row ]">
        <div class="[ col-xs-12 ]" style="padding-bottom: 30px;">
		<br />
            <p> You can configure your gateway settings <a target="_parent" href="<?= site_url('settings/'); ?>">here</a> to access more features.</p>
        </div>
    </div>
</div>
  	</form><!--/form-->
                    </div><!--/.tab-panel-->
                    
					
                    <div role="tabpanel" class="tab-pane fade" id="security">
					
                        <div class="tab-inner">
			<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
 <div class="row">
 
<div class="col-xs-12 col-md-12 col-sm-12">

<div class="row">	
<span id="account-edit-btn" type="button" class="pull-right btn btn-primary btn-xs account-edit-btn" data-toggle="modal" data-target="#modal-deposit-info">
Change
</span>
<span><h4>Multifactor Auth</h4></span>   
</div>							

<div id="multifactor-content">

<div class="widget-title">
  <div class="row">
  
    <div class="col-xs-3">
      <strong class="">Enable Multifactor </strong>
  </div><!--/.col-xs-3-->
	
    <div class="col-xs-4">
      <div class="switch switch-small enable-mfa-provider  has-switch" data-on="primary" data-off="danger">
        <div class="switch-animate switch-on">
	<label>
<input class="uiswitch ace ace-switch ace-switch-3" type="checkbox" style="margin-top: -6px;" name="two_step_verification" id="two_step_verification" <?php
			if(intval($form['two_step_verification']) == 1) {
				echo 'checked="checked"';
			} ?>/>
					<span class="lbl"><label class="switch-small">&nbsp;</label></span>
				</label>
</div><!--/.switch-anitmate-->
</div><!--/.switch-small-->
</div><!--/.col-xs-4-->
	
</div><!--/.row-->
</div><!--/.widget-title-->

  

<fieldset class="mfa-provider">

  <div class="widget-content box-highlight logo-selector clearfix">
  
    <div class="list-unstyled row">
      
        <div class="col-xs-8">
          <button class="js-select-provider logo-selector-item disabled" id="google-authenticator-mfa">
            <div class="provider-icon logo" data-logo="two Factor Authenticator">
              <span class="logo-child"></span>
        </div>
		  <div class="row">
				<label>(<?php
			if(intval($form['two_step_verification']) == 1) {
				echo 'Currently this feature is enabled';
			} else {
				echo 'Currently this feature is disabled.';
			}?>)
			
<?php
		if(intval($form['two_step_verification']) == 1) { ?>
			<label class="info" for="">Backup Codes</label>
			&nbsp;
		<p><?php echo $form['backup_codes'];?></p>
					<span class="lbl"></span>
				</label>
		
			</div><!--/END.row-->
 	
          </button>
      
</div><!--/END.col-xs-8-->

        <div class="col-xs-4">
		
          <div class="js-select-provider logo-selector-item " id="duo-mfa">
            <div class="provider-icon logo" data-logo="Duo">
 <span class="logo-child"></span>
            </div> 
			 <button type="submit" class="btn btn-primary btn-sm" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>

		<button type="submit" class="ladda-button" name="go_account" data-color="green" data-style="expand-right" data-size="xs"><span class="ladda-label">Get New Codes</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
				
		<?php } ?>
		
</div><!--/.col-xs-4-->
 
</div><!--/.list-style-row-->
     	 
 
</div><!--/.widget-content-->
</fieldset>
  
  <div class="form-group hidden mfa-custom-code"> </div>
  		
		<hr>		
	<div class="[ row-fluid text-center]">
    <div class="[ row ]">
        <div class="[ col-xs-12 ]" style="padding-bottom: 30px;">
				<br />
            <p class="lead"> You can configure your gateway settings <a class="btn btn-link btn-sm" target="_parent" href="<?= site_url('settings/'); ?>">here</a> to access more features.</p>
        </div><!-- END/ .col-md-12-->
    </div><!-- END/ .row-->
</div><!-- END/.row-fluid-->



</div><!--/.col-md-12-->
</div><!--/.row-->
 </form><!--/form-->
</div><!--/.tab-inner-->
</div><!--/.tab-panel-->



</div><!--/END.col-lg-12-->

</div><!--/END.tab-content-->

</div><!--/END.row-->
  </div><!-- END/ #account-->
  
  </div><!-- END/ .content-wrapper-->
		
		
<?=$this->load->view(branded_view('cp/footer'));?>