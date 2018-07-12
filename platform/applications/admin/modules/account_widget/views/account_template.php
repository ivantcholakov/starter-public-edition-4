<?=$this->load->view(branded_view('cp/header'), array('head_files' => '
<script type="text/javascript" src="' . branded_include('js/form.address.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/jquery.inputlimiter.1.3.1.min.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/jquery.maskedinput.min.js') . '"></script>
<script type="text/javascript" src="' . branded_include('js/pwdwidget.js') . '"></script>
<link rel="stylesheet" type="text/css" href="' . branded_include('css/pwdwidget.css') . '" />
<script type="text/javascript" src="' . branded_include('js/formmapper.js') . '"></script>')); ?>


<style type="text/css">

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



<? if ($this->user->Get('client_type_id') == '3') { ?>

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
			<a href="<a href="<?= site_url('account/support'); ?>">
				<i class="ion-ios7-help-outline"></i>
				Support
			</a>
		</li>
<li>
			<a href="<a href="<?= site_url('account/close'); ?>">
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

<div class="pull-right submit">
&nbsp;
<button class="btn btn-link btn-lsm center" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Edit Account &nbsp; <i class="fa fa-pencil"></i>
</button>
&nbsp;
 </div><!-- col-md-6-->

<p id="form_setting_para_2" style="font-family: 'Source Sans Pro'; color: rgb(144, 141, 141);">Your profile information.</p>

</div>

<ul id="unorder_list_container" style="font-family: 'Source Sans Pro';">


<li>
<div class="row margin-top-20">
<div class="col-xs-12 col-md-2">


<div class="profile-info" style="width: 96px;">
		<div class="profile-avatar">
	<span class="profile-picture center">
			<?php $logo=$form['company_logo'];
			if($logo!=""){ ?>
	<img src="<?php echo site_url();?>upload/<?php echo $form['company_logo'];?>"class="editable img-responsive" height="148" width="148"><?php } else{?>
             <img src="<?php echo site_url();?>upload/avatar.png" class="editable img-responsive" height="148" width="148"/>
			<?php }?>
															</span>
<div class="space space-4"></div>
<div class="avatar-name"><span class=""></div>

<p>
			<!--<div class="social">
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
			</div>-->
</div><!-- /.avatar -->
</div><!-- /.profile-info -->
</div><!-- /.col-md-2 -->

<div class="col-xs-12 col-md-10">
													
<div class="profile-user-info">

<div class="profile-info-row">

<div class="profile-info-name"><span>Status</span></div>
<div class="profile-info-value">
<? if ($row['suspended'] == '1') { ?>
<span class="label label-danger suspended arrowed-in-right">
<img src="<?= branded_include('images/failed.png'); ?>" alt="Suspended" /> Suspended <span class="fa fa-remove"></span></span><? } else { ?><span class="label label-success arrowed-in-right" style="color:#fff;"> Activated <span class="fa fa-check"></span><? } ?>													</span></span>
</div>
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name">Name </div>
<div class="profile-info-value"><span><?=$form['first_name'];?> <?=$form['last_name'];?></span></div><!-- END/.profile-info-value-->
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">					
<div class="profile-info-name">Email</div>												
<div class="profile-info-value"><span><?=$form['email'];?></span></div>
</div><!-- END/.profile-info-row-->	

<div class="profile-info-row">
<div class="profile-info-name">Address </div>
<div class="profile-info-value"><span><?=$form['address_1'];?></span><span><?=$form['city'];?>,<?=$form['state'];?>, <?=$form['zipcode'];?> </span>
</div>
</div><!-- END/.profile-info-row-->	


<div class="profile-info-row">
<div class="profile-info-name">Phone </div>
<div class="profile-info-value"><span><?=$form['phone'];?></span></div>
</div><!-- END/.profile-info-row-->	

<div class="profile-info-row">
<div class="profile-info-name">Password </div>
<div class="profile-info-value"><span>**********</span></div>
</div><!-- END/.profile-info-row-->							

<div class="profile-info-row">
<div class="profile-info-name">Business Name </div>
<div class="profile-info-value"><span><?=$form['company'];?></span></div>
</div><!-- END/.profile-info-row-->																			

<div class="profile-info-row">
<div class="profile-info-name"> Merchant ID </div>
<div class="profile-info-value"> <i class="fa fa-map-marker light-orange bigger-110"></i> <span>EV3222<?= $this->user->Get('client_id') ?></span></div>														</div><!-- END/.profile-info-row-->
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name"> Signed Up </div>
<div class="profile-info-value"><span><?=$form['create_date'];?></span></div>
</div><!-- END/.profile-info-row-->

<div class="profile-info-row">
<div class="profile-info-name"> Last Session </div>
<div class="profile-info-value"><span>ago</span></div>		
</div><!-- END/.profile-info-row-->

</div><!-- END/.profile-user-info-->

  </div><!-- END/ .col-md-10-->
  </div><!-- END/ . ROW-->
</li>

</ul>

</form><!--/form-->

</div><!--/.form_column_two-->

<div class"clearfix"></div>


<div class="widget-body margin-top-20">

<div class="collapse" id="collapseExample">
		
<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">

<div class="widget-body">
<fieldset>
<div class="xe-widget xe-counter-block" style="margin-left:20px;"> 
<div class="xe-upper"> 
<div class="pageColumn portlet-body">
	<h2>System Information</h2>
	
	<ul class="form-body">

		<li>
<div>
					<label for="email">Email Address
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
<input type="text" autocomplete="off" class="form-control email mark_empty" rel="email@example.com" id="email" name="email" value="<?=$form['email'];?>" />
					</div>
				</div>
			
		</li>
<hr>
		<li>
<div>
			<label for="password">Password</label>
<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-key"></i>
					</span>
			<input type="password" autocomplete="off" class="form-control" id="password" name="password" value="" />

					</div>
				</div>
		</li>
<hr>
		<li>
<div>

			<label for="password2">Repeat Password</label>
<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-key"></i>
					</span>
			<input type="password" autocomplete="off" class="form-control" id="password2" name="password2" value="" />
</div>
				</div>
		</li>

		<li>
			<div class="help">Leave password fields blank to keep your current password.</div>
		</li>

	</ul>
</div>
</div>
</fieldset>
<div class="hr hr-8"></div>
<fieldset>	
<div class="xe-widget xe-counter-block" style="margin-left:20px;"> 
<div class="xe-upper"> 
<div class="pageColumn portlet-body">
	<h2>Personal Information</h2>
	<ul class="form-body">

		<li>
<div>
<label for="first_name">
First Name
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-user"></i>
					</span>
<input class="form-control mark_empty" type="text" rel="First Name" id="first_name" name="first_name" value="<?=$form['first_name'];?>" />
</div></div>		
<hr>
<div>
<label for="last_name">
Last Name
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-user"></i>
					</span>
<input  class="form-control mark_empty" rel="Last Name" type="text" id="last_name" name="last_name" value="<?=$form['last_name'];?>" />
</div></div>		
		</li>
<hr>
		<li>
<div>
					<label for="address_1">
Mailing Address
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
			<input type="text" class="form-control required" name="address_1" id="address_1" value="<?=$form['address_1'];?>" />
</div>
</div>		

</li>
<hr>
		<li>

<div>
					<label for="address_2">
Address Line 2
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
			<input type="text" class="form-control" name="address_2" id="address_2" value="<?=$form['address_2'];?>" />
</div>
</div>
		</li>
<hr>
		<li>


<div>
					<label for="city">
City
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-globe"></i>
					</span>
			<input type="text" class="form-control required" name="city" id="city" value="<?=$form['city'];?>" geoname="locality" />
</div>
</div>
		</li>
<hr>
		<li>

<div>
					<label for="Country">
Country
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-globe"></i>
					</span>
			<select id="country" name="country" class="form-control required" geoname="country"><?php
			foreach ($countries as $country) {
				if ($form['country'] == $country['iso2']) { ?>
					<option  selected="selected" geoname="country"  value="<?php echo $country['iso2'];?>" ><?php echo $country['name'];?></option><?php
				} else { ?>
					<option><?php echo $country['name']; ?></option><?php
				}
			} ?></select>
</div>
</div>
		</li>
<hr>
		<li>

<div>
					<label for="state">
Region
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
			<input geoname="administrative_area_level_1" type="text" class="form-control text" name="state" id="state" value="<?=$form['state'];?>" />
			<select geoname="administrative_area_level_1_short" id="state_select" class="form-control" name="state_select"><?php
			foreach ($states as $state) {
				if ($form['state'] == $state['code']) { ?>
					<option  selected="selected"  value="<?=$state['code'];?>"><?=$state['name'];?></option><?php
				} else { ?>
					<option value="<?=$state['code'];?>"><?=$state['name'];?></option><?php
				}
			} ?></select>


</div>
</div>
		</li>
<hr>
		<li>
<div>
					<label for="postal_code">
                                            Postal Code
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>

			<input geoname="postal_code" type="text" class="form-control required" name="postal_code" id="postal_code" value="<?=$form['postal_code'];?>" />
</div>
</div>
		</li>
<hr>
		<li>
<div>
					<label for="phone">
						Phone
						<small class="text-warning">(999) 999-9999</small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-phone"></i>
					</span>

		<input class="form-control mask-phone valid" type="text" id="phone" name="phone" value="<?=$form['phone'];?>" />
					</div>
				</div>
		</li>
<hr>
		<li>

<div>
					<label for="timezone">
						Timezone
						<small class="text-warning">(GMT)</small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-globe"></i>
					</span>
<?=timezone_menu($form['gmt_offset']);?>
</div>
				</div>
		</li>
	</ul>
</div>
</div>
</div>
</fieldset>

<div class="hr hr-8"></div>

<fieldset>
<div class="xe-widget xe-counter-block" style="margin-left:20px;"> 
<div class="xe-upper"> 
<div class="pageColumn portlet-body">
	<h2>Business Info</h2>
	<ul class="form-body">
<hr>

		<li>
<div>

<label for="company">
Business Name
						<small class="text-warning"></small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
			<input type="text" class="form-control required" id="company" name="company" value="<?=$form['company'];?>" />
</div></div>		
</li>
<hr>
		<li>

<label class="ace-file-input" for="company_logo"> Company Logo</label>

<?php $logo=$form['company_logo'];
			if($logo!=""){ ?>
			<img src="<?php echo site_url();?>upload/<?php echo $form['company_logo'];?>" height="72" width="72"/>
			<?php } else{?>
             <img src="<?php echo site_url();?>upload/avatar.png" height="72" width="72"/>
			<?php }?>
<br />
<div class="input-group">
<span class="ace-file-container">
<input type="file" class="ace-file-input text" id="company_logo" name="company_logo"  />
</span>
</div>

		</li>
<hr>
		
		<li>
			<div>
				<label for="business_category">Business Category
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<select class="form-control required mark_empty" id="business_category" name="business_category">
						<option value="">--Select--</option>
						<?php foreach($business_categories as $category) { ?>
						<option <?php if($form['business_category'] == $category->id) echo 'selected="selected"'; ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
						<?php } ?>
					</select>
					<!-- <input class="form-control required mark_empty" type="text" id="business_category" name="business_category" value="<?=$form['business_category'];?>" /> -->
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="business_address">Business Address
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
					<input class="form-control required mark_empty" type="text" id="business_address" name="business_address" value="<?=$form['business_address'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="business_city">Business City
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-globe"></i>
					</span>
					<input class="form-control required mark_empty" type="text" id="business_city" name="business_city" value="<?=$form['business_city'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="business_state">Business State
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
					<input class="form-control required mark_empty" type="text" id="business_state" name="business_state" value="<?=$form['business_state'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="business_zip">Business Zip
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
					<input class="form-control required mark_empty" type="text" id="business_zip" name="business_zip" value="<?=$form['business_zip'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="business_country">Business Country
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
					<select class="form-control required mark_empty" id="business_country" name="business_country">
						<option value="">--Select--</option>
						<?php foreach($business_countries as $country) { ?>
						<option <?php if($form['business_country'] == $country->country_id) echo 'selected="selected"';?> value="<?php echo $country->country_id; ?>"><?php echo $country->name; ?></option>
						<?php } ?>
					</select>
					<!-- <input class="form-control required mark_empty" type="text" id="business_country" name="business_country" value="<?=$form['business_country'];?>" /> -->
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="business_phone">Business Phone
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-phone"></i>
					</span>
					<input class="form-control mask-phone valid" type="text" id="business_phone" name="business_phone" value="<?=$form['business_phone'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="business_fax">Business Fax
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-fax"></i>
					</span>
					<input class="form-control mask-phone valid" type="text" id="business_fax" name="business_fax" value="<?=$form['business_fax'];?>" />
				</div>
			</div>
		</li>
</div>
</div>
</div>

<div class="xe-widget xe-counter-block" style="margin-left:20px;"> 
<div class="xe-upper"> 
<div class="pageColumn portlet-body">
<h2>Bank Account Info</h2>
<hr>
	<ul class="form-body">
		<li>
			<div>
				<label for="bank_routing_number">Bank Routing Number
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<input class="form-control mark_empty" type="text" id="bank_routing_number" name="bank_routing_number" value="<?=$form['bank_routing_number'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="bank_acc_number">Bank Account Number
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<input class="form-control mark_empty" type="text" id="bank_acc_number" name="bank_acc_number" value="<?=$form['bank_acc_number'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="bank_acc_type">Bank Account Type
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<select  class="form-control  mark_empty" id="bank_acc_type" name="bank_acc_type">
						<option value="">--Select--</option>
						<option <?php if($form['bank_acc_type'] == 'CHECKING') echo 'selected="selected"';?> value="CHECKING">CHECKING</option>
						<option <?php if($form['bank_acc_type'] == 'CURRENT') echo 'selected="selected"';?> value="CURRENT">CURRENT</option>
						<option <?php if($form['bank_acc_type'] == 'PERSONAL') echo 'selected="selected"';?> value="PERSONAL">PERSONAL</option>
						<option <?php if($form['bank_acc_type'] == 'TRANSACTION') echo 'selected="selected"';?> value="TRANSACTION">TRANSACTION</option>
					</select>
					<!-- <input class="form-control required mark_empty" type="text" id="bank_acc_type" name="bank_acc_type" value="<?=$form['bank_acc_type'];?>" /> -->
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="bank_name">Bank Name
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<input class="form-control mark_empty" type="text" id="bank_name" name="bank_name" value="<?=$form['bank_name'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="bank_acc_name">Account Name
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<input class="form-control mark_empty" type="text" id="bank_acc_name" name="bank_acc_name" value="<?=$form['bank_acc_name'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="is_non_us">Is Non-US Bank
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<input type="checkbox" name="is_non_us" id="is_non_us" <?php if($form['is_non_us'] == 1) echo 'checked="checked"'; ?> class="checkbox" />
					<!-- <input class="form-control mark_empty" type="text" id="is_non_us" name="is_non_us" value="<?=$form['is_non_us'];?>" /> -->
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="bank_swift_number">Bank Swift Number
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<input class="form-control mark_empty" type="text" id="bank_swift_number" name="bank_swift_number" value="<?=$form['bank_swift_number'];?>" />
				</div>
			</div>
		</li>
		<hr>
		<li>
			<div>
				<label for="bank_address">Bank Address
					<small class="text-warning"></small>
				</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
					<input class="form-control mark_empty" type="text" id="bank_address" name="bank_address" value="<?=$form['bank_address'];?>" />
				</div>
			</div>
		</li>
	</ul>
</div>
</div>
</div>
</fieldset>

<div class="hr hr-8"></div>

<fieldset>
<div class="xe-widget xe-counter-block" style="margin-left:20px;"> 
<div class="xe-upper"> 
<div class="pageColumn portlet-body">
	<h2>Security</h2>
<hr>
	<ul class="form-body">

<div class="form-group">
	<li>
<label for="two_step_verification" class="control-label col-xs-12 col-sm-4 pull-left">Two-Step Verification</label>
<br>
	<div class="controls col-xs-12 col-sm-12">
		<div class="row">
			<div class="col-xs-6">
				<label>
<input class="ace ace-switch ace-switch-2" type="checkbox" name="two_step_verification" id="two_step_verification" <?php
			if(intval($form['two_step_verification']) == 1) {
				echo 'checked="checked"';
			} ?>/>
					<span class="lbl"></span>
				</label>
			</div><!--/col-xs-3-->

			<div class="col-xs-6">
				<label>(<?php
			if(intval($form['two_step_verification']) == 1) {
				echo 'Currently this feature is enabled';
			} else {
				echo 'Currently this feature is disabled.';
			}?>)</li>
<?php
		if(intval($form['two_step_verification']) == 1) { ?>
		<li class="col-xs-9">
<br>
			<label class="info" for="">Backup Codes</label>
			&nbsp;
			<?php echo $form['backup_codes'];?>
			&nbsp;<p>
			<a class="btn btn-success btn-xs center" href="<?=site_url('account/regenerate_codes');?>">Regenerate Codes</a></p>
		</li>
		<?php } ?>
					<span class="lbl"></span>
				</label>
			</div><!--/col-xs-6-->	
</div><!--/row-->

	</div><!--/col-xs-12-->
</div><!--/.form-group-->

</ul>

</fieldset>
</div><!--/.widget-body-->

<div class="row">
<div class="col-md-offset-3 col-md-6">

<div class="form-actions submit">
<button type="submit" class="btn btn-success btn-lg center" name="go_account" value="" /> Update Account <i class="fa fa-check"></i></button>
</div>

</div><!--/.col-md-6-->
</div><!--/.row-->



	
</form>


</div>
</div><!--/collapse-->

</div><!--/widget-->

</div><!--/,form-content-->
</div><!--/.form-content-wrap-->

  </div><!-- END/ #form_container -->







 </div><!-- END/ . ROW-->


</div><!-- END/ #PANEL -->


  </div><!-- END/.clearfix-->

 </div><!-- END/.content-wrapper-->


 </div><!-- END/ #content-->


 </div><!-- END/ #account-->


<!-- END PROFILE PAGE -->


<div class="row-fluid" style="height: auto; display:none;">

<div class="row"> 
<div class="col-sm-6"> 
<div class="xe-widget xe-counter-block" style="margin-right:2px;"> 
<div class="xe-upper"> 
<div class="linksColumn portlet-body">
            <h3>Account information</h3>
            <ul>
                <li>
<a href="javascript:;" onclick="jQuery('#modal-email').modal('show', {backdrop: 'static'});" title="Manage your email preferences." class="autoTooltip">
                        Email</a></li>

                <li>
  <a href="javascript:;" onclick="jQuery('#modal-password').modal('show', {backdrop: 'static'});" title="Manage your password and security questions." class="autoTooltip">
                        Password</a></li>

                   <li>
<a href="javascript:;" onclick="jQuery('#modal-address-info').modal('show', {backdrop: 'static'});" title="Manage your street addresses." class="autoTooltip">
   Street address</a></li>

   <li>
 <a href="javascript:;" onclick="jQuery('#modal-business-info').modal('show', {backdrop: 'static'});" title="Update Your Business Information" class="autoTooltip">
                        Business information</a> </li>

                <li>
   <a href="javascript:;" onclick="jQuery('#modal-phone-numbers').modal('show', {backdrop: 'static'});" title="Manage your phone numbers, and activate Everpay Mobile." class="autoTooltip">
                        Phones and mobile payments</a></li>
				
                <li>
   <a href="javascript:;" onclick="jQuery('#modal-2factor-auth').modal('show', {backdrop: 'static'});" title="Add an extra layer of protection to your account, with a verification code sent via SMS or voice call." class="autoTooltip">
                  Two-Factor Authentication </a></li>
                      
                 <li>
   <a href="javascript:;" onclick="jQuery('#modal-time-zone').modal('show', {backdrop: 'static'});" title="Select the time zone you want to use for transactions." class="autoTooltip">
                        Time zone</a></li>

          
            </ul>
            
        </div>
   </div>
</div> 
</div> 

<div class="col-sm-6"> 
<div class="xe-widget xe-counter-block" style="margin-left:2px;"> 
<div class="xe-upper"> 
<div class="linksColumn portlet-body">
<h3>Financial information</h3>
            <ul>
                 <li>
 <a href="javascript:;" onclick="jQuery('#modal-settlement-account').modal('show', {backdrop: 'static'});" title="Set your primary bank account." class="autoTooltip"> Bank Account</a> 
</li>

                <li>
                    <a href="javascript:;"onclick="jQuery('#modal-ccaccount').modal('show', {backdrop: 'static'});" title="Add credit and debit cards to your account." class="autoTooltip">
                        Credit cards</a></li>

                <li>
   <a href="javascript:;" onclick="jQuery('#modal-bitcoin-address').modal('show', {backdrop: 'static'});" title="Add Bitcoin Address" class="autoTooltip"> Bitcoin Address</a>
                </li>
                            	
                <li>
                    <a href="javascript:;" title="Add your bitcoin Address To receive your bitcoin payments." class="autoTooltip">
                        Update BTC Address</a>
                </li>
                <li>
                    <a href="javascript:;" title="Create, purchase, or sell gift certificates." class="autoTooltip">
                        Redemption codes</a>
                </li>
               
                <!-- removed paylist link -->

                <li>
                    <a href="javascript:;">
                        Preapproved Payments</a>
                </li>

                
                <li>
                    <a href="javascript:;">
                            Recurring payments Overview</a>
                </li>

                
</div>

</div> 
</div> 
</div> 

  </div><!-- END/ . ROW-->

<div class="row"> 

<div class="col-sm-6"> 
<div class="xe-widget xe-counter-block" style="margin-right:2px;"> 
<div class="xe-upper"> 
<div class="linksColumn portlet-body">
                    <h3>Hosted payment settings</h3>
                    <ul>
                       <li>
                            <a href="javascript:;" class="autoTooltip">
                              Website payments preferences</a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                Website payment certificates</a>
                        </li>
                
            
                    <li>
                        <a href="javascript:;" title="Match Everpay custom payments pages with your site's look and feel." class="autoTooltip">
                            Custom page styles</a>
                    </li>
                    <li>
                        <a href="javascript:;" title="Set up domestic and international tax and VAT rates." class="autoTooltip">
                            Tax</a>
                    </li>
                    
                    <li>
                        <a href="javascript:;" title="Calculate domestic and international shipping amounts." class="autoTooltip">
                            Shipping calculator</a>
                    </li>
              
             </ul>
</div>

</div> 
</div> 
</div> 

<div class="col-sm-6"> 
<div class="xe-widget xe-counter-block" style="margin-left:2px;"> 
<div class="xe-upper"> 
<div class="linksColumn portlet-body">
       <h3>Gateway Settings</h3>

 <ul>
                <li>
                           <a href="<?= site_url('settings/api'); ?>">
                   Get API credentials</a>
                </li>        

            <li>
                        <a href="<?= site_url('settings/new_gateway'); ?>" class="autoTooltip">
                            Add New Gateway</a>
                    </li>
    
                    <li>
                        <a href="javascript:;" title="Give multiple users different levels of access to your account." class="autoTooltip">
                            Manage Users</a>
                    </li>

                    <li>
                        <a href="javascript:;" title="Pick The Information you would like to share with Everpay partners" class="autoTooltip">
                           Notification/information sharing</a>
                    </li>
                    
                    <li>
                        <a href="javascript:;" onclick="jQuery('#modal-upgrade').modal('show', {backdrop: 'static'});" title="Upgrade Your Account" class="autoTooltip">
                            Upgrade Account</a>
                    </li>
              
             </ul>
</div>
</div> 
</div> 
</div> 

  </div><!-- END/ . ROW-->

</div><!--/.profile-content-->
  </div><!-- END/ . ROW-->

<? } ?>

<!-- BEGIN MODALS -->


<!-- BEGIN MODAL-EMAIL -->
<div class="modal fade" id="modal-email" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h2 class="modal-title">Email Preferences</h2> </div> 
<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">

<div class="form-body well">

<div class="row"> 
	  		<div class="form-group">
			    <label class="col-sm-4 col-md-3 control-label" for="email"> Email Address
						<small class="text-warning"></small>
					</label> 
<div class="col-sm-8"> 
<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
<input type="text" autocomplete="off" class="form-control required email mark_empty" rel="email@example.com" id="email" name="email" value="<?=$form['email'];?>" />
					</div><!--/input-group-->

</div><!--/col-sm-9-->

</div><!--/form-group-->
</div><!--/row-->
</div><!--/form-body-->

</div><!--/modal-body-->

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update Email <i class="fa fa-check"></i></button>
&nbsp;
</div>
</form>

</div><!--/modal-footer-->

</div><!--/modal-content--> 
</div><!--/modal-dialog--> 
</div>
<!-- END .Modal-EMAIL-->


<!-- BEGIN MODAL-PASSWORD -->
<div class="modal fade" id="modal-password" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h2 class="modal-title">Change Password</h2> </div> 
<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">

<div class="form-body well">
<div class="row"> 
	
<div class="col-md-6"> 
			<label for="password">Password</label>
<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-key"></i>
					</span>
			<input type="password" autocomplete="off" class="form-control" id="password" name="password" value="" />
					</div>
</div>

<div class="col-md-6">
<label for="password2">Repeat Password</label>
<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-key"></i>
					</span>
			<input type="password" autocomplete="off" class="form-control" id="password2" name="password2" value="" />
</div>
			</div>
 <br />
	<div class="help" style="text-align: center;"><p>Leave password fields blank to keep your current password.</p></div>
</div> 
</div> 

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Change <i class="fa fa-check"></i></button>
&nbsp;
</form>

</div>
</div> 

</div> 

</div> 
</div>
</div>
<!-- END .Modal-password -->



<!-- BEGIN MODAL-ADDRESS-->
<div class="modal fade" id="modal-address-info" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h2 class="modal-title">Your Address Information.</h2> </div> 

<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
    <li role="presentation"><a href="#business-addy" aria-controls="business-addy" role="tab" data-toggle="tab">Business</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
<div class="form-body well">

<div class="row">
<div class="form-group"> 
					<label class="col-sm-4 col-md-3 control-label" for="address_1">
Address
						<small class="text-warning"></small>
					</label>
<div class="col-md-9"> 
					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
			<input type="text" class="form-control required" name="address_1" id="address_1" value="<?=$form['address_1'];?>" />
                                        </div>
</div> <!-- END .col-md-9-->
</div> <!-- END .form-group-->
</div> <!-- END .ROW-->

<div class="row">
<div class="form-group"> 
					<label class="col-sm-4 col-md-3 control-label" for="address_2">
Address 2
						<small class="text-warning"></small>
					</label>
<div class="col-md-9"> 
					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
			<input type="text" class="form-control" name="address_2" id="address_2" value="<?=$form['address_2'];?>" />
                                        </div>
</div> <!-- END .col-md-9-->
</div> <!-- END .form-group-->
</div> <!-- END .ROW-->

<div class="row">
<div class="form-group"> 
					<label class="col-sm-4 col-md-3 control-label" for="city">
City
						<small class="text-warning"></small>
					</label>
<div class="col-md-9"> 
					<div class="input-group">
					<span class="input-group-addon">
						<i class="ace-icon fa fa-globe"></i>
					</span>
<input type="text" class="form-control required" name="city" id="city" value="<?=$form['city'];?>" geoname="locality" />
                                        </div>
</div> <!-- END .col-md-9-->
</div> <!-- END .form-group-->
</div> <!-- END .ROW-->

<div class="row">
<div class="form-group"> 
					<label class="col-sm-4 col-md-3 control-label" for="state">
State
						<small class="text-warning"></small>
					</label>
<div class="col-md-9"> 
					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
			<input geoname="administrative_area_level_1" type="text" class="text" name="state" id="state" value="<?=$form['state'];?>" />
			<select geoname="administrative_area_level_1_short" id="state_select" class="form-control" name="state_select"><?php
			foreach ($states as $state) {
				if ($form['state'] == $state['code']) { ?>
					<option  selected="selected"  value="<?=$state['code'];?>"><?=$state['name'];?></option><?php
				} else { ?>
					<option value="<?=$state['code'];?>"><?=$state['name'];?></option><?php
				}
			} ?></select>
                                        </div>
</div> <!-- END .col-md-9-->
</div> <!-- END .form-group-->
</div> <!-- END .ROW-->
<div class="row">
<div class="form-group"> 
					<label class="col-sm-4 col-md-3 control-label" for="postal_code">
Zip/ Postal
						<small class="text-warning"></small>
					</label>
<div class="col-md-9"> 
					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-building"></i>
					</span>
		
			<input geoname="postal_code" type="text" class="form-control required" name="postal_code" id="postal_code" value="<?=$form['postal_code'];?>" />
                                        </div>
</div> <!-- END .col-md-9-->
</div> <!-- END .form-group-->
</div> <!-- END .ROW-->

<div class="row">
<div class="form-group"> 
					<label class="col-sm-4 col-md-3 control-label" for="country">
Country
						<small class="text-warning"></small>
					</label>
<div class="col-md-9"> 
					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-globe"></i>
					</span>
			<select id="country" name="country" class="form-control required" geoname="country"><?php
			foreach ($countries as $country) {
				if ($form['country'] == $country['iso2']) { ?>
					<option  selected="selected" geoname="country"  value="<?php echo $country['iso2'];?>" ><?php echo $country['name'];?></option><?php
				} else { ?>
					<option><?php echo $country['name']; ?></option><?php
				}
			} ?></select>
                                        </div>
</div> <!-- END .col-md-9-->
</div> <!-- END .form-group-->
</div> <!-- END .ROW-->


  </div><!-- END .form-body -->

</div><!-- END .tab -->
  </div><!-- END .tab-content -->
</div> <!-- END .MODAL-BODY-->

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Change <i class="fa fa-check"></i></button>
&nbsp;
</form>

</div>
</div> <!-- END .MODAL-FOOTER-->

</div> <!-- END .MODAL-CONTENT-->
</div> <!-- END .MODAL-DIALOG-->
</div>
<!-- END .MODAL-ADDRESS-->


<!-- BEGIN MODAL-business-info -->
<div class="modal fade" id="modal-business-info" tabindex="-1" role="dialog" aria-labelledby="modal-business-infoLabel" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h2 class="modal-title">Manage Your Business Info And Settings</h2> </div> 
<div class="modal-body"> 
<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">

<div class="form-body well">
<div class="row">
<div class="col-md-12"> 
<div class="form-group"> 
<label class="col-sm-4 col-md-3 control-label" for="business_url">Business Name
					<small class="text-warning"></small></label> 
<div class="col-sm-8">
                              <div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-link"></i>
					</span>
					<input class="form-control mark_empty" type="text" id="company" name="company" placeholder="my company" value="<?=$form['company'];?>" />
				</div>
</div> 
</div> 
	

<div class="form-group"> 
<label class="col-sm-4 col-md-3 control-label" for="business_url">Business URL
					<small class="text-warning"></small></label> 
<div class="col-sm-8">
                              <div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-link"></i>
					</span>
					<input class="form-control required mark_empty" type="text" id="business_url" name="business_url" placeholder="http://www.website.com" value="<?=$form['business_url'];?>" />
				</div>
</div> 
</div> 
			
<div class="form-group"> 
<label class="col-sm-4 col-md-3 control-label" for="tax_id">Tax ID
					<small class="text-warning"></small>
				</label>
<div class="col-sm-8">
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<input class="form-control required mark_empty" type="text" id="tax_id" name="tax_id" value="<?=$form['tax_id'];?>" />
				</div>
			</div>
</div>

<div class="form-group"> 
<label class="col-sm-4 col-md-3 control-label" for="business_start">Start Date
					<small class="text-warning"></small>
				</label>
<div class="col-sm-8">
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-date"></i>
					</span>
					<input class="form-control required mark_empty" type="text" id="business_start" name="business_start" value="<?=$form['business_start'];?>" />
				</div>
			</div>

</div>

<div class="form-group"> 
<label class="col-sm-4 col-md-3 control-label" for="business_monthly_vol">Monthly Volume
					<small class="text-warning"></small>
				</label>
<div class="col-sm-8"> 
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-dollar"></i>
					</span>
					<select  class="form-control required mark_empty" id="business_monthly_vol" name="business_monthly_vol">
						<option value="">--Select--</option>
						<?php foreach($monthly_vol_list as $key=>$val) { ?>
						<option <?php if($form['business_monthly_vol'] == $key) echo 'selected="selected"';?> value="<?php echo $key; ?>" ><?php echo $val; ?></option>
						<?php } ?>
					</select>
					<!-- <input class="form-control mark_empty" type="text" id="business_monthly_vol" name="business_monthly_vol" value="<?=$form['business_monthly_vol'];?>" /> -->
				</div>
			</div>

</div>
<div class="form-group"> 
				<label class="col-sm-4 col-md-3 control-label" for="business_category"> Business Category
					<small class="text-warning"></small>
				</label>
<div class="col-sm-8"> 
				<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
					<select class="form-control required mark_empty" id="business_category" name="business_category" style="size" 80%;">
						<option value="">--Select--</option>
						<?php foreach($business_categories as $category) { ?>
						<option <?php if($form['business_category'] == $category->id) echo 'selected="selected"'; ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
						<?php } ?>
					</select>
					<!-- <input class="form-control required mark_empty" type="text" id="business_category" name="business_category" value="<?=$form['business_category'];?>" /> -->
				</div>
</div>
</div>
<hr>


</div> 
</div> 


<div class="row"> 

<div class="col-md-6"> 
<div class="form-group"> 
<label for="field-1" class="control-label">Name</label> 
<input type="text" class="form-control" id="field-1" placeholder="John"> 
</div> 
</div> 

<div class="col-md-6"> 
<div class="form-group"> 
<label for="field-2" class="control-label">Surname</label> 
<input type="text" class="form-control" id="field-2" placeholder="Doe"> 
</div> 
</div> 

</div> 

<div class="row">
<div class="col-md-12"> 
<div class="form-group"> 
<label for="field-3" class="control-label">Address</label> 
<input type="text" class="form-control" id="field-3" placeholder="Address"> 
</div> 
</div> 
</div> 

<div class="row">

 <div class="col-md-4"> 
<div class="form-group"> 
<label for="field-4" class="control-label">City</label> 
<input type="text" class="form-control" id="field-4" placeholder="Boston"> 
</div> 
</div> 

<div class="col-md-4"> 
<div class="form-group"> 
<label for="field-5" class="control-label">Country</label> 
<input type="text" class="form-control" id="field-5" placeholder="United States"> 
</div> 
</div> 

<div class="col-md-4"> 
<div class="form-group"> 
<label for="field-6" class="control-label">Zip</label> 
<input type="text" class="form-control" id="field-6" placeholder="123456"> 
</div> 
</div>

</div> 
</div>

</div> 

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
<button type="button" class="btn btn-white btn-lg" data-dismiss="modal">Close <i class="fa fa-times"></i></button> 
&nbsp;
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>
</form>

</div>
</div> 

</div> 

</div> 
</div>
<!-- END .Modal-business-info -->

<!-- BEGIN MODAL-CONTACT PHONE -->
<div class="modal fade" id="modal-phone-numbers" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h4 class="modal-title">Your Contact Numbers</h4> </div> 
<div class="modal-body"> 
<br />
<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
<div id="user-profile" class="profile-content">
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs big-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#persy" aria-controls="persy" role="tab" data-toggle="tab">Personal</a></li>
    <li role="presentation"><a href="#bizness" aria-controls="bizness" role="tab" data-toggle="tab">Business</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

<div role="tabpanel" class="tab-pane active" id="persy">
<div class="form-body well">
<div class="row"> 
<div class="col-md-6">
					<label for="phone">
						Mobile
						<small class="text-warning">(999) 999-9999</small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-phone"></i>
					</span>
<input class="form-control input-mask-phone" type="text" id="phone" name="phone" value="<?=$form['phone'];?>" />
                                        </div>
<div class="help">Your mobile number</div>
</div>

<div class="col-md-6">
					<label for="phone">
						Home
						<small class="text-warning">(999) 999-9999</small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-phone"></i>
					</span>
<input class="form-control input-mask-phone" type="text" id="phone" name="phone" value="<?=$form['home_phone'];?>" />
                                        </div>
<div class="help">Your home number</div>

</div><!--/col-md-6-->

</div><!--/row-->
</div><!--/form-body-->
</div><!--/tab-->

<div role="tabpanel" class="tab-pane" id="bizness">
<div class="form-body well">
<div class="row"> 
<div class="col-md-6"> 
<label for="email" class="control-label"> Business Phone
					<small class="text-warning">(999) 999-9999</small>
					</label> 
                                        <div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-phone"></i>
					</span>
					<input class="form-control required mark_empty input-mask-phone" type="text" id="business_phone" name="business_phone" value="<?=$form['business_phone'];?>" />
					</div>
<div class="help">The business phone number</div>
</div> 

<div class="col-md-6"> 
<label for="business_fax" class="control-label"> Business Fax
					<small class="text-warning">(999) 999-9999</small>
					</label> 
                                        <div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-fax"></i>
					</span>
					<input class="form-control required mark_empty input-mask-phone" type="text" id="business_fax" name="business_fax" value="<?=$form['business_fax'];?>" />
					</div>
<div class="help">The business fax number</div>
</div><!--/col-md-6-->	

</div> <!--/row-->	

</div><!--/form-body-->
</div><!--/tab-->

</div> <!--/tab-content-->

</div> <!--/profile-content-->
</div> <!--/modal-body-->	

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i>
</button>
&nbsp;
</div>
</form>
</div> 

</div> 

</div> 
</div>
<!-- END .modal-phone-numbers-->

<!-- BEGIN MODAL-UPGRADE -->
<div class="modal fade" id="modal-upgrade" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h4 class="modal-title">Manage Your Password And Security Questions</h4> </div> 
<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">

<div class="form-body well">
<div class="row"> 

<div class="col-md-6"> 
<div class="form-group"> 
<label for="field-1" class="control-label">Name</label> 
<input type="text" class="form-control" id="field-1" placeholder="John"> 
</div> 
</div> 

<div class="col-md-6"> 
<div class="form-group"> 
<label for="field-2" class="control-label">Surname</label> 
<input type="text" class="form-control" id="field-2" placeholder="Doe"> 
</div> 
</div> 

</div> 

<div class="row">
<div class="col-md-12"> 
<div class="form-group"> 
<label for="field-3" class="control-label">Address</label> 
<input type="text" class="form-control" id="field-3" placeholder="Address"> 
</div> 
</div> 
</div> 

<div class="row">

 <div class="col-md-4"> 
<div class="form-group"> 
<label for="field-4" class="control-label">City</label> 
<input type="text" class="form-control" id="field-4" placeholder="Boston"> 
</div> 
</div> 

<div class="col-md-4"> 
<div class="form-group"> 
<label for="field-5" class="control-label">Country</label> 
<input type="text" class="form-control" id="field-5" placeholder="United States"> 
</div> 
</div> 

<div class="col-md-4"> 
<div class="form-group"> 
<label for="field-6" class="control-label">Zip</label> 
<input type="text" class="form-control" id="field-6" placeholder="123456"> 
</div> 
</div>
</div> 

</div>
</div> 

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
<button type="button" class="btn btn-white btn-lg" data-dismiss="modal">Close <i class="fa fa-times"></i></button> 
&nbsp;
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>
</form>

</div>
</div> 

</div> 

</div> 
</div>
<!-- END .Modal-UPGRADE -->


<!-- BEGIN MODAL-NOTIFICATION -->
<div class="modal fade" id="modal-2factor-auth" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 

<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h4 class="modal-title">Add An Extra Layer Of Protection To Your Account.</h4> </div> 

<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
<div class="row"> 
<div class="form-body well">

<div class="form-group">

<label for="two_step_verification" class="control-label col-xs-12 col-sm-4 pull-left">Two-Step Verification</label>
<br />
	<div class="controls col-xs-12 col-sm-12">
		<div class="row">
			<div class="col-sm-4">
				<label>
<input class="ace ace-switch ace-switch-2" type="checkbox" name="two_step_verification" id="two_step_verification" <?php
			if(intval($form['two_step_verification']) == 1) {
				echo 'checked="checked"';
			} ?>/>
					<span class="lbl"></span>
				</label>
			</div><!--/col-sm-4-->

			<div class="col-sm-4">
				<label>(<?php
			if(intval($form['two_step_verification']) == 1) {
				echo 'Currently this feature is enabled';
			} else {
				echo 'Currently this feature is disabled.';
			}?>)</div>
<?php
		if(intval($form['two_step_verification']) == 1) { ?>
		<div class="col-sm-4">
<br>
			<label class="info" for="">Backup Codes</label>
			&nbsp;
			<?php echo $form['backup_codes'];?>
			&nbsp;<p>
			<a class="btn btn-success btn-xs center" href="<?=site_url('account/regenerate_codes');?>">Regenerate Codes</a></p>
		
		<?php } ?>
					<span class="lbl"></span>
				</label>
			</div><!--/col-sm-4-->	
</div><!--/row-->
	</div><!--/col-xs-12-->

</div><!--/.form-group-->

</div><!--/.form-body-->


</div> <!--/.modal-body-->

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
<button type="button" class="btn btn-white btn-lg" data-dismiss="modal">Close <i class="fa fa-times"></i></button> 
&nbsp;
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>
</form>
</div>
</div> <!--/.modal-footer-->

</div> 
</div> 
</div>
</div> 
<!-- END .Modal-NOTIFICATION -->



<!-- BEGIN MODAL-UPGRADE -->
<div class="modal fade" id="modal-newaccount" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h4 class="modal-title">Create A New Account</h4> </div> 
<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">

<div class="form-body well">

<div class="row"> 

<div class="col-md-6"> 
<label for="email" class="control-label"> Email Address
						<small class="text-warning"></small>
					</label> 
<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-envelope"></i>
					</span>
<input type="text" autocomplete="off" class="form-control required email mark_empty" rel="email@example.com" id="email" name="email" value="<?=$form['email'];?>" />
					</div>
<div class="help">add a new user account</div>
</div> 

	</div>
</div> 

</div> 

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
<button type="button" class="btn btn-white btn-lg" data-dismiss="modal">Close <i class="fa fa-times"></i></button> 
&nbsp;
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>
</div>
</form>
</div> 

</div> 

</div> 
</div>
<!-- END .modal-NewAccount-->


<!-- BEGIN MODAL-CLOSE-ACCOUNT -->
<div class="modal fade" id="modal-close-account" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 
<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h4 class="modal-title">Manage Your Password And Security Questions</h4> </div> 
<div class="modal-body"> 

<div class="form-body well">

<div class="row">
<div class="col-md-12"> 
<div class="form-group"> 
<label for="field-3" class="control-label">Address</label> 
<input type="text" class="form-control" id="field-3" placeholder="Address"> 
</div> 
</div> 
</div> 

</div><!--/.form-body-->
</div> 

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
<button type="button" class="btn btn-white btn-lg" data-dismiss="modal">Close <i class="fa fa-times"></i></button> 
&nbsp;
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>
</form>
</div>
</div> 

</div> 
</div> 
</div>
<!-- END .Modal-CLOSE-ACCOUNT -->



<!-- BEGIN MODAL SETTLEMENT ACCOUNT -->
<div class="modal fade" id="modal-settlement-account" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 

<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h4 class="modal-title">Update Your Bank Account Information</h4> </div> 
<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
<div class="form-body well"> 

<div class="address">
	  		<div class="form-group">
			    <label class="col-sm-3 col-md-2 control-label" for="bank_name">Account</label>
			    <div class="col-sm-9 col-md-8">
<input class="form-control mark_empty" type="text" id="bank_acc_name" name="bank_acc_name" placeholder="Name on the account" value="<?=$form['bank_acc_name'];?>" />
			    </div>
			</div>
			<div class="form-group">
			    <div class="col-sm-3 col-sm-offset-2">
		<input class="form-control mark_empty" type="text" id="bank_routing_number" placeholder="010111222" name="bank_routing_number" value="<?=$form['bank_routing_number'];?>" />
			    </div>
			    <div class="col-sm-3">
<input class="form-control mark_empty" type="text" id="bank_acc_number" placeholder="012345678" name="bank_acc_number" value="<?=$form['bank_acc_number'];?>" />
			    </div>
			    <div class="col-sm-3 col-md-2">
			      <input class="form-control mark_empty" type="text" placeholder="BOFCAT12"  id="bank_swift_number" name="bank_swift_number" value="<?=$form['bank_swift_number'];?>" />
			    </div>
		  	</div>

<div class="form-group">
			    <label class="col-sm-3 col-md-2 control-label">Type</label>
			    <div class="col-sm-9 col-md-8">
<select class="form-control  mark_empty" id="bank_acc_type" name="bank_acc_type">
						<option value="">--Select--</option>
						<option <?php if($form['bank_acc_type'] == 'CHECKING') echo 'selected="selected"';?> value="CHECKING">CHECKING</option>
						<option <?php if($form['bank_acc_type'] == 'CURRENT') echo 'selected="selected"';?> value="CURRENT">CURRENT</option>
						<option <?php if($form['bank_acc_type'] == 'PERSONAL') echo 'selected="selected"';?> value="PERSONAL">PERSONAL</option>
						<option <?php if($form['bank_acc_type'] == 'TRANSACTION') echo 'selected="selected"';?> value="TRANSACTION">TRANSACTION</option>
					</select>
					<!-- <input class="form-control required mark_empty" type="text" id="bank_acc_type" name="bank_acc_type" value="<?=$form['bank_acc_type'];?>" /> -->
			    </div>
</div>

<div class="form-group">
 <label class="col-sm-6 col-md-6 control-label" for="is_non_us">Is Non-US Bank?
					<small class="text-warning"></small>
				</label>
			    <div class="col-sm-6 col-md-6">
		<input type="checkbox" name="is_non_us" id="is_non_us" <?php if($form['is_non_us'] == 1) echo 'checked="checked"'; ?> class="checkbox" />
					<!-- <input class="form-control mark_empty" type="text" id="is_non_us" name="is_non_us" value="<?=$form['is_non_us'];?>" /> -->
			    </div>
		  	</div>

	  	</div><!--/.address-->
<hr>

<div class="address">
<div class="form-group">
			    <label class="col-sm-2 col-md-2 control-label" for="bank_name">Bank</label>
			    <div class="col-sm-10 col-md-8">
<input class="form-control mark_empty" type="text" id="bank_name" name="bank_name" placeholder="Bank Of Deposits" value="<?=$form['bank_name'];?>" />
			    </div>
			</div>

	  		<div class="form-group">
			    <label class="col-sm-2 col-md-2 control-label">Address</label>
			    <div class="col-sm-10 col-md-8">
<input class="form-control mark_empty" type="text" id="bank_address" name="bank_address"  placeholder="123 Bank Dr, Bank City, Anytown, Bank Country" value="<?=$form['bank_address'];?>" />
			    </div>
			</div>

	  	</div><!--/.address-->


</div><!--/.form-body well-->

</div><!--/.modal-body-->


<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
<button type="button" class="btn btn-white btn-lg" data-dismiss="modal">Close <i class="fa fa-times"></i></button> 
&nbsp;
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>
</form>
</div>
</div><!--/.modal-footer--> 

</div><!--/.modal-content--> 
</div><!--/.modal-dialog-->
</div>
<!-- END .Modal-SETTLEMENT-ACCOUNT -->


<!-- BEGIN MODAL BTC ADDRESS -->
<div class="modal fade" id="modal-bitcoin-address" aria-hidden="true" style="display: none;"> 
<div class="modal-dialog"> 
<div class="modal-content"> 

<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
<h2 class="modal-title">Update Bitcoin Address</h2> </div> 
<div class="modal-body"> 

<form class="form-horizontal" id="form_account" method="post" enctype="multipart/form-data" action="<?=site_url($form_action);?>">
<div class="form-body well"> 
<div class="row">
<div class="col-sm-12">
<div class="form-group"> 
					<label for="timezone" class="control-label">
						Timezone
						<small class="text-warning">(GMT)</small>
					</label>

					<div class="input-group">
					<span class="input-group-addon">
					<i class="ace-icon fa fa-globe"></i>
					</span>
<?=timezone_menu($form['gmt_offset']);?>
</div><!--/.input-group-->

</div><!--/.form-group->

</div><!--/.col-md-12-->
</div><!--/.row-->

</div><!--/.form-body well-->

</div><!--/.modal-body-->

</div> 

<div class="modal-footer"> 
<div class="form-actions center submit col-md-offset-2 col-md-6">
<button type="button" class="btn btn-white btn-lg" data-dismiss="modal">Close <i class="fa fa-times"></i></button> 
&nbsp;
&nbsp;
<button type="submit" class="btn btn-success btn-lg" name="go_account" value="" /> Update <i class="fa fa-check"></i></button>
</form>
</div>
</div>  


</div> 
</div>
<!-- END .Modal-BTC-ADDRESS -->




<!-- END MODALS -->
<?=$this->load->view(branded_view('cp/footer'));?>

<!-- anooj -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="https://everpayinc.com/assets/js/formmapper.js"></script>
<script>
  $(function(){ 

       $("#address_1").formmapper({details:"div.widget-body"}); 

        });
</script>
<!-- anooj -->

<!-- richard -->
<script>
jQuery(function($) {
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
				
				$('textarea[class*=autosize]').autosize({append: "\n"});
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

                                $('#company_logo , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php|html|js|xls'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			                                



                                $('#id-input-file-3').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
</script>
<!-- richard -->

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
