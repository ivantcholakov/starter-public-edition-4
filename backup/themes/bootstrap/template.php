<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Bootstrap Public Template
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
	
		<link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="<?php echo base_url();?>themes/bootstrap/css/bootstrap-grid.css">
		<link rel="stylesheet" href="<?php echo base_url();?>themes/bootstrap/css/bootstrap-reboot.css">
		<link rel="stylesheet" href="<?php echo base_url();?>themes/bootstrap/css/bootstrap.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Navbar</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>


    <?php // Fixed navbar ?>
    <nav class="navbar navbar-default navbar-static-top">
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
                    <li class="<?php echo (uri_string() == '') ? 'active' : ''; ?>"><a href="<?php echo base_url('/'); ?>"><?php echo lang('core button home'); ?></a></li>
                    <li class="<?php echo (uri_string() == 'contact') ? 'active' : ''; ?>"><a href="<?php echo base_url('/contact'); ?>"><?php echo lang('core button contact'); ?></a></li>
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <li class="<?php echo (uri_string() == 'profile') ? 'active' : ''; ?>"><a href="<?php echo base_url('/profile'); ?>"><?php echo lang('core button profile'); ?></a></li>
                    <?php endif; ?>
                </ul>
                <?php // Nav bar right ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <?php if ($this->user['is_admin']) : ?>
                            <li>
                                <a href="<?php echo base_url('admin'); ?>"><?php echo lang('core button admin'); ?></a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo base_url('logout'); ?>"><?php echo lang('core button logout'); ?></a>
                        </li>
                    <?php else : ?>
                        <li class="<?php echo (uri_string() == 'login') ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('login'); ?>"><?php echo lang('core button login'); ?></a>
                        </li>
                    <?php endif; ?>
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
    <footer>
        <div class="container">
            <div class="clearfix"><hr /></div>
            <p class="text-muted">
                <?php echo lang('core text page_rendered'); ?>
                | PHP v<?php echo phpversion(); ?>
                | CodeIgniter v<?php echo CI_VERSION; ?>
                | <?php echo $this->settings->site_name; ?> v<?php echo $this->settings->site_version; ?>
                | <a href="http://jasonbaier.github.io/ci3-fire-starter/" target="_blank">Github.com</a>
            </p>
        </div>
    </footer>
	
		<script src="<?php echo base_url();?>themes/bootstrap/js/bootstrap.js"></script>
		<!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>


    <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
        <?php foreach ($js_files_i18n as $js) : ?>
            <?php if ( ! is_null($js)) : ?>
                <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
