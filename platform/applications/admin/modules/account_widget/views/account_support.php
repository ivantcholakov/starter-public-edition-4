<?=$this->load->view(branded_view('cp/header'), array('head_files' => '
<script type="text/javascript" src="' . branded_include('js/form.address.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/pwdwidget.js') . '"></script>
<link rel="stylesheet" type="text/css" href="' . branded_include('css/pwdwidget.css') . '" />
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
  min-height: 680px;
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -ms-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}

#account #content #panel.profile form {
  width: 95%!important;
  margin-top: 10px!important;
}

.fa-lg {
  font-size: 24px !important;
}


</style>



<!-- BEGIN PROFILE PAGE -->


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
			<a href="<?= site_url('account/upgrade'); ?>">
				<i class="ion-arrow-graph-up-right"></i>
				Upgrade
			</a>
		</li>
		<li>
			<a class="active" href="<?= site_url('account/help'); ?>">
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

<div id="panel2" class="profile" style="margin-left:20px;">
	<p class="intro" style="margin-left:10px;">
		Change your account information, avatar, login credentials, etc.
	</p>
<br />
<form class="form-horizontal well" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">

<div class="widget-body">


</div><!--/widget-body-->
</form><!--/form-->

<div class"clearfix"></div>

</div><!--/#panel2-->
</div><!--/widget-body-->

</div><!--/row-fluid-->

</div><!--/row-->

  </div><!-- END/ #PANEL -->
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
