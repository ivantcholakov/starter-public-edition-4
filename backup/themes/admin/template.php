<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Template
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

    <?php // CSS files ?>
    <?php if (isset($css_files) && is_array($css_files)) : ?>
        <?php foreach ($css_files as $css) : ?>
            <?php if ( ! is_null($css)) : ?>
                <link rel="stylesheet" href="<?php echo $css; ?>?v=<?php echo $this->settings->site_version; ?>"><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php // Fixed navbar ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php echo lang('core button toggle_nav'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><?php echo $this->settings->site_name; ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <?php // Nav bar left ?>
                <ul class="nav navbar-nav">
                    <li class="<?php echo (uri_string() == 'admin' OR uri_string() == 'admin/dashboard') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin'); ?>"><?php echo lang('admin button dashboard'); ?></a></li>
                    <li class="dropdown<?php echo (strstr(uri_string(), 'admin/users')) ? ' active' : ''; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('admin button users'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="<?php echo (uri_string() == 'admin/users') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/users'); ?>"><?php echo lang('admin button users_list'); ?></a></li>
														<li class="<?php echo (uri_string() == 'admin/users/blocked_users') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/users/blocked_users'); ?>"><?php echo lang('admin button blocked_users'); ?></a></li>
														<li class="<?php echo (uri_string() == 'admin/users/users_verification') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/users/users_verification'); ?>"><?php echo lang('admin button users_verification'); ?></a></li>
														<li class="<?php echo (uri_string() == 'admin/users/users_business') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/users/users_business'); ?>"><?php echo lang('admin button users_business'); ?></a></li>
                            <li class="<?php echo (uri_string() == 'admin/users/add') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/users/add'); ?>"><?php echo lang('admin button users_add'); ?></a></li>
                        </ul>
                    </li>
									
										<li class="dropdown<?php echo (strstr(uri_string(), 'admin/transactions')) ? ' active' : ''; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('admin button transactions'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
														 <li class="<?php echo (uri_string() == 'admin/transactions') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/transactions'); ?>"><?php echo lang('admin button all_transactions'); ?></a></li>
														 <li class="<?php echo (uri_string() == 'admin/transactions/deposits') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/transactions/deposits'); ?>"><?php echo lang('admin button deposits'); ?></a></li>
														 <li class="<?php echo (uri_string() == 'admin/transactions/withdrawal_funds') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/transactions/withdrawal_funds'); ?>"><?php echo lang('admin button withdrawal_funds'); ?></a></li>
														<li class="<?php echo (uri_string() == 'admin/transactions/transfers') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/transactions/transfers'); ?>"><?php echo lang('admin button transfers'); ?></a></li>
														<li class="<?php echo (uri_string() == 'admin/transactions/disputes') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/transactions/disputes'); ?>"><?php echo lang('admin button disputes'); ?></a></li>
                        </ul>
                    </li>
									 <li class="<?php echo (uri_string() == 'admin/disputes') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/disputes'); ?>"><?php echo lang('admin button disputes'); ?></a></li>
									
                    <li class="<?php echo (uri_string() == 'admin/contact') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/contact'); ?>"><?php echo lang('admin button messages'); ?></a></li>
										<li class="<?php echo (uri_string() == 'admin/currency') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/currency'); ?>"><?php echo lang('admin button currency'); ?></a></li>
										<li class="<?php echo (uri_string() == 'admin/logs') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/logs'); ?>"><?php echo lang('admin button logs'); ?></a></li>
                    <li class="<?php echo (uri_string() == 'admin/settings') ? 'active' : ''; ?>"><a href="<?php echo base_url('/admin/settings'); ?>"><?php echo lang('admin button settings'); ?></a></li>
                </ul>
                <?php // Nav bar right ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url('logout'); ?>"><?php echo lang('core button logout'); ?></a></li>
                    <li>
                        <span class="dropdown">
                            <button id="session-language" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default">
                                <i class="fa fa-language"></i>
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
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php // Main body ?>
    <div class="container theme-showcase" role="main">

        <?php // Page title ?>
        <div class="page-header">
            <h1><?php echo $page_header; ?></h1>
        </div>

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

    <?php // Footer ?>
    <footer class="sticky-footer">
        <div class="container">
            <p class="text-muted">
                <?php echo lang('core text page_rendered'); ?>
                | PHP v<?php echo phpversion(); ?>
                | CodeIgniter v<?php echo CI_VERSION; ?>
                | <?php echo $this->settings->site_name; ?> v<?php echo $this->settings->site_version; ?>
                | <a href="http://jasonbaier.github.io/ci3-fire-starter/" target="_blank">Github.com</a>
            </p>
        </div>
    </footer>

    <?php // Javascript files ?>
    <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js; ?>?v=<?php echo $this->settings->site_version; ?>"></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
        <?php foreach ($js_files_i18n as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
