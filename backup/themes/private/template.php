<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Default Public Template
 */
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=<?php echo $this->settings->site_version; ?>">
	<link rel="icon" type="image/x-icon" href="/favicon.ico?v=<?php echo $this->settings->site_version; ?>">
    <title><?php echo $page_title; ?> - <?php echo $this->settings->site_name; ?></title>
    <meta name="keywords" content="<?php echo $this->settings->meta_keywords; ?>">
    <meta name="description" content="<?php echo $this->settings->meta_description; ?>">
	
	<link rel="stylesheet" href="<?php echo base_url();?>themes/private/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>themes/private/css/default.css">
	<link rel="stylesheet" href="<?php echo base_url();?>themes/private/css/lofin.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php // Fixed navbar ?>
		<div id="nav-wrapper" data-spy="affix" data-offset-top="230">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php echo lang('core button toggle_nav'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
									<img class="img-responsive" src="<?php echo base_url();?>themes/default/img/logo-white.png" alt="<?php echo $this->settings->site_name; ?>">
							</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <?php // Nav bar left ?>
                <ul class="nav navbar-nav">
                    <li class="<?php echo (uri_string() == '') ? 'active' : ''; ?>"><a href="<?php echo base_url('/'); ?>"><?php echo lang('core button home'); ?></a></li>
										<li class="<?php echo (uri_string() == 'features') ? 'active' : ''; ?>"><a href="<?php echo base_url('/features'); ?>"><?php echo lang('core button features'); ?></a></li>
                    <li class="<?php echo (uri_string() == 'merchant') ? 'active' : ''; ?>"><a href="<?php echo base_url('/mecrhant'); ?>"><?php echo lang('core button mecrhant'); ?></a></li>
										<li class="<?php echo (uri_string() == 'protect') ? 'active' : ''; ?>"><a href="<?php echo base_url('/protect'); ?>"><?php echo lang('core button protect'); ?></a></li>
										<li class="<?php echo (uri_string() == 'help') ? 'active' : ''; ?>"><a href="<?php echo base_url('/help'); ?>"><?php echo lang('core button help'); ?></a></li>
										<li class="<?php echo (uri_string() == 'contact') ? 'active' : ''; ?>"><a href="<?php echo base_url('/contact'); ?>"><?php echo lang('core button contact'); ?></a></li>
										
                </ul>
                <?php // Nav bar right ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <?php if ($this->user['is_admin']) : ?>
                            <li>
                                <a href="<?php echo base_url('admin'); ?>"><?php echo lang('core button admin'); ?></a>
                            </li>
                        <?php endif; ?>
                     				<a href="<?php echo base_url('/account/dashboard'); ?>" class="btn btn-primary navbar-btn"><i class="icon-home icons"></i> <?php echo lang('core button dashboard'); ?></a>
                            <a href="<?php echo base_url('logout'); ?>" class="btn btn-danger navbar-btn"><i class="icon-logout icons"></i> <?php echo lang('core button logout'); ?></a>
                    
                    <?php else : ?>
                        
                            <a href="<?php echo base_url('login'); ?>" class="btn btn-primary navbar-btn"><i class="icon-user icons"></i> <?php echo lang('core button login'); ?></a>
                        
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
		</div>
    <?php // Main body ?>
		<div class="header-bg">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-6 col-xs-7">
						<h4><?php echo lang('users dashboard ballance'); ?></h4>
						<h1><?php echo $user['debit_base'] ?> <?php echo $this->currencys->display->base_code ?> <a href="#" id="ballance" data-html="true" data-container="body" rel="popover" data-toggle="popover" data-placement="left" data-title="<?php echo lang('users dashboard other_ballance'); ?>" data-content="<?php if($this->currencys->display->extra1_check) : ?><b><?php echo $this->currencys->display->extra1_code ?>:</b> <?php echo $user['debit_extra1'] ?> </br><?php endif; ?><?php if($this->currencys->display->extra2_check) : ?><b><?php echo $this->currencys->display->extra2_code ?>:</b> <?php echo $user['debit_extra2'] ?> </br><?php endif; ?><?php if($this->currencys->display->extra3_check) : ?><b><?php echo $this->currencys->display->extra3_code ?>:</b> <?php echo $user['debit_extra3'] ?> </br><?php endif; ?><?php if($this->currencys->display->extra4_check) : ?><b><?php echo $this->currencys->display->extra4_code ?>:</b> <?php echo $user['debit_extra4'] ?> </br><?php endif; ?><?php if($this->currencys->display->extra5_check) : ?><b><?php echo $this->currencys->display->extra5_code ?>:</b> <?php echo $user['debit_extra5'] ?> <?php endif; ?>"><span class="icon-info icons h4"></span></a></h1>

					</div>
					<div class="col-md-3 col-sm-6 col-xs-5 hidden-print">
						<div class="btn-group pull-right">
							<a href="<?php echo base_url('/account/deposit'); ?>" class="btn btn-line btn-lg"><?php echo lang('users dashboard deposit'); ?></a>
							<a href="<?php echo base_url('/account/withdrawal'); ?>" class="btn btn-line btn-lg"><?php echo lang('users dashboard withdrawal'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?if($user['fraud_status']>0){?>
		<div class="alert-fraud">
			<strong><?php echo lang('users error warning'); ?></strong> <?php echo lang('users error not_fraud'); ?>
		</div>
		<?}else{?>
    <?}?>
    <div class="container theme-showcase" role="main">

        <?php // Page title ?>
        <div class="page-header">
            <h2><?php echo $page_header; ?></h2>
        </div>
			
				<?php // User menu ?>
				<div class="row">
					<div class="col-md-3 hidden-print">
    
						<div class="list-group" >
							<a href="<?php echo base_url('/account/dashboard'); ?>" class="list-group-item <?php echo (uri_string() == 'account/dashboard') ? 'active' : ''; ?>">
								<?php echo lang('users menu dashboard'); ?>
								<i class="icon-home icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/money_transfer'); ?>" class="list-group-item <?php echo (uri_string() == 'account/money_transfer') ? 'active' : ''; ?>">
								<?php echo lang('users menu transfer'); ?>
								<i class="icon-paper-plane icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/exchange'); ?>" class="list-group-item <?php echo (uri_string() == 'account/exchange') ? 'active' : ''; ?>">
								<?php echo lang('users menu exchange'); ?>
								<i class="icon-calculator icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/history'); ?>" class="list-group-item <?php echo (uri_string() == 'account/history') ? 'active' : ''; ?>">
								<?php echo lang('users menu history'); ?>
								<i class="icon-hourglass icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/dispute'); ?>" class="list-group-item <?php echo (uri_string() == 'account/dispute') ? 'active' : ''; ?>">
								<?php echo lang('users menu dispute'); ?>
								<i class="icon-shield icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/request'); ?>" class="list-group-item <?php echo (uri_string() == 'account/request') ? 'active' : ''; ?>">
								<?php echo lang('users menu request'); ?>
								<i class="icon-briefcase icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/merchants'); ?>" class="list-group-item <?php echo (uri_string() == 'account/merchants') ? 'active' : ''; ?>">
								<?php echo lang('users menu acceptance'); ?>
								<i class="icon-credit-card icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/vouchers'); ?>" class="list-group-item <?php echo (uri_string() == 'account/vouchers') ? 'active' : ''; ?>">
								<?php echo lang('users vouchers menu'); ?>
								<i class="icon-diamond icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/support'); ?>" class="list-group-item <?php echo (uri_string() == 'account/support') ? 'active' : ''; ?>">
								<?php echo lang('users menu support'); ?>
								<i class="icon-support icons pull-right"></i>
							</a>
							<a href="<?php echo base_url('/account/user_settings'); ?>" class="list-group-item <?php echo (uri_string() == 'account/user_settings') ? 'active' : ''; ?>">
								<?php echo lang('users menu settings'); ?>
								<i class="icon-wrench icons pull-right"></i>
							</a>

						</div>

					</div>
			
				<div class="col-md-9">

					<?php // System messages ?>
					<?php if ($this->session->flashdata('message')) : ?>
							<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php echo $this->session->flashdata('message'); ?>
							</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
							<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php echo $this->session->flashdata('error'); ?>
							</div>
					<?php elseif (validation_errors()) : ?>
							<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php echo validation_errors(); ?>
							</div>
					<?php elseif ($this->error) : ?>
							<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php echo $this->error; ?>
							</div>
					<?php endif; ?>

					<?php // Main content ?>
					<?php echo $content; ?>
					
				</div>
			</div>
    </div>

    <?php // Footer ?>
    <footer>
			<div class="footer hidden-print">
        <div class="container">
					<div class="row">
						<div class="col-md-3">
							<ul class="list-group">
								<li class="list-group-item text-white"><i class="icon-phone icons"></i> +<?php echo $this->settings->site_phone; ?></a></li>
								<li class="list-group-item text-white"><i class="icon-envelope-letter icons"></i> <?php echo $this->settings->site_email; ?></li>
								<li class="list-group-item text-white"><i class="icon-social-skype icons"></i> <?php echo $this->settings->site_skype; ?></li>
							</ul>
							<span class="dropdown dropup">
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
						</div>
						<div class="col-md-3">
							<ul class="list-group">
								<li class="list-group-item text-white"><strong><?php echo lang('core menu support'); ?></strong></li>
								<li class="list-group-item"><a href="<?php echo base_url('faq'); ?>"><?php echo lang('core menu faq'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('contact'); ?>"><?php echo lang('core menu feedback'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/support'); ?>"><?php echo lang('core menu ticket'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('developers'); ?>"><?php echo lang('core menu api_doc'); ?></a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="list-group">
								<li class="list-group-item text-white"><strong><?php echo lang('core menu payment'); ?></strong></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/money_transfer'); ?>"><?php echo lang('core menu transfer'); ?></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/exchange'); ?>"><?php echo lang('core menu excnage'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/request'); ?>"><?php echo lang('core menu request'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/merchants'); ?>"><?php echo lang('core menu acceptance'); ?></a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="list-group">
								<li class="list-group-item text-white"><strong><?php echo lang('core menu my_acc'); ?></strong></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/history'); ?>"><?php echo lang('core menu history'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/dispute'); ?>"><?php echo lang('core menu resolution'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/identification'); ?>"><?php echo lang('core menu verifi'); ?></a></li>
								<li class="list-group-item"><a href="<?php echo base_url('/account/user_settings'); ?>"><?php echo lang('core menu settings'); ?></a></li>
							</ul>
						</div>
					</div>
				</div>
        <hr>
				<div class="container">
            <p class="text-muted text-center">
             <a href="<?php echo base_url('agreement'); ?>"><?php echo lang('core menu terms'); ?></a> | <a href="<?php echo base_url('privacy'); ?>" ><?php echo lang('core menu privacy'); ?></a>
            </p>
        </div>
			</div>
    </footer>

    <?php // Javascript files ?>
    <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
		<script src="<?php echo base_url();?>themes/private/js/bootstrap.js"></script>
		<script>
			$(function(){
				$('body').tooltip({
						selector: "[rel=tooltip]",
						placement: "right" 
				});
		});
		</script>
		<script>
			$(function() {
			$('#ballance').popover({
			placement: "right",
			trigger: "hover"
			});
			});
		</script>
    <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
        <?php foreach ($js_files_i18n as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
	
</body>
</html>
