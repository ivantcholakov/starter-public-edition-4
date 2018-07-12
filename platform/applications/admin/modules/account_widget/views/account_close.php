<?=$this->load->view(branded_view('cp/header'), array('head_files' => '
<script type="text/javascript" src="' . branded_include('js/form.address.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/jquery.inputlimiter.1.3.1.min.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/jquery.maskedinput.min.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/pwdwidget.js') . '"></script>
<link rel="stylesheet" type="text/css" href="' . branded_include('css/pwdwidget.css') . '" />
<script type="text/javascript" src="' . branded_include('js/formmapper.js') . '"></script>')); ?>


<style type="text/css">


.account-status-marker-activated {
  margin: 1px 2px 0 0;
  padding: 5px 7.8px;
  border: 1px solid #7ae498;
  font-size: 12px;
  letter-spacing: 1.3px;
  color: #7ae498!important;
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
  padding-top: 67px;
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


</style>



<!-- BEGIN PROFILE PAGE -->


<div id="account">

<div id="content-inner">

<div id="sidebar">
	<div class="visible-xs">
	</div>
	<h2 style="font-size: 16px; padding-left:20px;padding-top:20px;"></h2>
	<ul class="menu">
		<li>
			<a class="active" href="<?= site_url('account/'); ?>">
				<i class="ion-ios7-person-outline"></i>
				Profile
			</a>
		</li>
		<li>
			<a href="<?= site_url('account/billing/'); ?>">
				<i class="ion-card"></i>
				Billing
			</a>
		</li>
		<li>
			<a href="<?= site_url('account/notifications/'); ?>">
				<i class="ion-ios7-email-outline"></i>
				Notifications
			</a>
		</li>
<li>
			<a href="<?= site_url('account/upgrade/'); ?>">
				<i class="ion-arrow-graph-up-right"></i>
				Upgrade
			</a>
		</li>
		<li>
			<a href="<?= site_url('account/help/'); ?>">
				<i class="ion-ios7-help-outline"></i>
				Support
			</a>
		</li>
<li>
			<a href="<?= site_url('account/close/'); ?>">
				<i class="ion-close-round"></i>
				Close
			</a>
		</li>
	</ul>

  </div><!-- END/ #sidebar-->



<div class="content-wrapper">
<div class="clearfix" style="height: auto;">


<div id="panel" class="profile">

                <div class="row-fluid">

        <!-- BEGIN FORM Content-->
<div id="form_container">
            <!--Form content-->
            <div class="form-content-wrap" style="background-color: rgb(255, 255, 255);">

                <div class="form-content" style="background-color: rgb(255, 255, 255);">
                    <div class="form_column_two" id="form_wraper_div">
<form class="view_form" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">


<div class="view_header" style="font-family: 'Source Sans Pro';">


 <h1>               </h1>

<h2 id="form_setting_para_2" style="font-family: 'Source Sans Pro'; color: rgb(144, 141, 141);"> Are you sure you want to close it?</h2>

</div>

<ul id="unorder_list_container" style="font-family: 'Source Sans Pro';">


<li>

			      	<div class="modal-body well">
				<p class="lead">This action will NOT delete your data, you can always come back and re-activate your account later.</p>
			      	</div>
	

</li>

<li>

<div class="form-group inline center">
<label class="control-label">Yes <span class="required" aria-required="true"></span>
													</label>
													<div class="col-md-12">
														<div class="radio-list">
<label class="radio-inline" for="suspended"></label>
			
<input type="radio" class="required" style="display: none;" id="suspended" name="suspended" <? if ($form['suspended'] == '1') { ?> checked="checked" <? } ?> value="1"/>&nbsp;&nbsp;<input type="radio" class="required" id="suspended" name="suspended" <? if ($form['suspended'] == '1') { ?> checked="checked" <? } ?> value="0" />
		
		</div>


</li>


</ul>

</div><!--/.widget-body-->

<br />
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="actions submit center">
<input type="submit" class="btn btn-danger btn-lg btn-block center sweet-13 ladda-button" data-style="expand-right" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Warning']);" name="close_account" data-toggle="confirmation" data-btn-ok-label="Continue" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="Stoooop!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" value=" Close It" /> 
</div>

</div><!--/.col-md-6-->
</div><!--/.row-->



	
</form>

</div><!--/#form-wrap_div-->

</div><!--/,form-content-->


  </div><!-- END/ #form_container -->







 </div><!-- END/ . ROW-fluid-->


</div><!-- END/ #PANEL -->


  </div><!-- END/.clearfix-->

 </div><!-- END/.content-wrapper-->


 </div><!-- END/ #content-->


 </div><!-- END/ #account-->


<!-- END PROFILE PAGE -->





<!-- END MODALS -->




<?=$this->load->view(branded_view('cp/footer'));?>