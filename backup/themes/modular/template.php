<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Template
 */
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> <?php echo $page_title; ?> - <?php echo $this->settings->site_name; ?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php // CSS files ?>
        
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="<?php echo base_url();?>themes/modular/css/vendor.css">
        <link rel="stylesheet" href="<?php echo base_url();?>themes/modular/css/app-green.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
        <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
    			<i class="fa fa-bars"></i>
    		</button> </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                          <li class="notifications new">
                                <a href="<?php echo base_url('logout'); ?>" aria-expanded="false"> <i class="fa fa-sign-out"></i> <sup>
    			    </sup> </a>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                     <span class="name">
    			      Language
    			    </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="session-language" id="session-language-dropdown" >
                                 <?php foreach ($this->languages as $key=>$name) : ?>  
                                    <a class="dropdown-item" href="#" rel="<?php echo $key; ?>">  <?php if ($key == $this->session->language) : ?>
                                                <i class="fa fa-check selected-session-language"></i>
                                            <?php endif; ?> <?php echo $name; ?> </a>
                                <?php endforeach; ?>
                                  
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo"> 
                                  <img width="180px" src="<?php echo base_url();?>themes/modular/img/admin-logo.png" alt="<?php echo $this->settings->site_name; ?>">
                                </div>
                        </div>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li class="<?php echo (uri_string() == 'admin' OR uri_string() == 'admin/dashboard') ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('/admin'); ?>"> <i class="icon-home icons"></i> <?php echo lang('admin button dashboard'); ?> </a>
                                </li>
                                <li class="<?php echo (strstr(uri_string(), 'admin/users')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-people icons"></i> <?php echo lang('admin button users'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="<?php echo (uri_string() == 'admin/users') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/users'); ?>">
                                    <?php echo lang('admin button users_list'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/users/add') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/users/add'); ?>">
                                  <?php echo lang('admin button users_add'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                                <li class="<?php echo (strstr(uri_string(), 'admin/transactions')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-directions icons"></i> <?php echo lang('admin button transactions'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="<?php echo (uri_string() == 'admin/transactions') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/transactions'); ?>">
                                    <?php echo lang('admin button all_transactions'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/transactions/pending') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/transactions/pending'); ?>">
                                  <?php echo lang('admin button pending'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/transactions/confirmed') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/transactions/confirmed'); ?>">
                                  <?php echo lang('admin button confirmed'); ?>
                                </a> </li>
                                      <li class="<?php echo (uri_string() == 'admin/transactions/disputed') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/transactions/disputed'); ?>">
                                  <?php echo lang('admin button disputed'); ?>
                                </a> </li>
                                      <li class="<?php echo (uri_string() == 'admin/transactions/blocked') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/transactions/blocked'); ?>">
                                  <?php echo lang('admin button blocked'); ?>
                                </a> </li>
                                       <li class="<?php echo (uri_string() == 'admin/transactions/refunded') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/transactions/refunded'); ?>">
                                  <?php echo lang('admin button refunded'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                                <li class="<?php echo (strstr(uri_string(), 'admin/disputes')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-shield icons"></i> <?php echo lang('admin button disputes'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="<?php echo (uri_string() == 'admin/disputes') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/disputes'); ?>">
                                    <?php echo lang('admin button all_dispute'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/disputes/open_disputes') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/disputes/open_disputes'); ?>">
                                  <?php echo lang('admin button open_disputes'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/disputes/open_claims') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/disputes/open_claims'); ?>">
                                  <?php echo lang('admin button open_claims'); ?>
                                </a> </li>
                                      <li class="<?php echo (uri_string() == 'admin/disputes/rejected_disputes') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/disputes/rejected_disputes'); ?>">
                                  <?php echo lang('admin button rejected_disputes'); ?>
                                </a> </li>
                                      <li class="<?php echo (uri_string() == 'admin/disputes/satisfied_disputes') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/disputes/satisfied_disputes'); ?>">
                                  <?php echo lang('admin button satisfied_disputes'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                                <li class="<?php echo (strstr(uri_string(), 'admin/tickets')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-support icons"></i> <?php echo lang('admin button tickets'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="<?php echo (uri_string() == 'admin/tickets/add') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/tickets/add'); ?>">
                                    <?php echo lang('admin button add_tickets'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/tickets') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/tickets'); ?>">
                                    <?php echo lang('admin tickets all'); ?>
                                </a> </li>
                                       <li class="<?php echo (uri_string() == 'admin/tickets/untreated') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/tickets/untreated'); ?>">
                                    <?php echo lang('admin button untreated_tickets'); ?>
                                </a> </li>
                                      <li class="<?php echo (uri_string() == 'admin/tickets/processed') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/tickets/processed'); ?>">
                                    <?php echo lang('admin button processed_tickets'); ?>
                                </a> </li>
                                      <li class="<?php echo (uri_string() == 'admin/tickets/closed') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/tickets/closed'); ?>">
                                    <?php echo lang('admin button closed_tickets'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                              
                                <li class="<?php echo (strstr(uri_string(), 'admin/verification')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-check icons"></i> <?php echo lang('admin title verification'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="<?php echo (uri_string() == 'admin/verification') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/verification'); ?>">
                                    <?php echo lang('admin verification all'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/verification/pending') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/verification/pending'); ?>">
                                    <?php echo lang('admin verification pending'); ?>
                                </a> </li>
                                       <li class="<?php echo (uri_string() == 'admin/verification/confirmed') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/verification/confirmed'); ?>">
                                    <?php echo lang('admin verification confirmed'); ?>
                                </a> </li>
                                     <li class="<?php echo (uri_string() == 'admin/verification/disapproved') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/verification/disapproved'); ?>">
                                    <?php echo lang('admin verification disapproved'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                              
                                <li class="<?php echo (strstr(uri_string(), 'admin/merchants')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-handbag icons"></i> <?php echo lang('admin merchant title'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                      <li class="<?php echo (uri_string() == 'admin/merchants/index') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/merchants/'); ?>">
                                    <?php echo lang('admin merchant all_merch'); ?>
                                </a> </li>
                                     <li class="<?php echo (uri_string() == 'admin/merchants/active') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/merchants/active'); ?>">
                                    <?php echo lang('admin merchant active'); ?>
                                </a> </li>
                                     <li class="<?php echo (uri_string() == 'admin/merchants/moderation') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/merchants/moderation'); ?>">
                                    <?php echo lang('admin merchant moderation'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/merchants/disapproved') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/merchants/disapproved'); ?>">
                                  <?php echo lang('admin merchant disapproved'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                              
                                <li class="<?php echo (strstr(uri_string(), 'admin/vouchers')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-diamond icons"></i> <?php echo lang('admin vouchers menu'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                      <li class="<?php echo (uri_string() == 'admin/vouchers/index') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/vouchers'); ?>">
                                    <?php echo lang('admin vouchers all'); ?>
                                </a> </li>
                                     <li class="<?php echo (uri_string() == 'admin/vouchers/pending') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/vouchers/pending'); ?>">
                                    <?php echo lang('admin vouchers pending'); ?>
                                </a> </li>
                                     <li class="<?php echo (uri_string() == 'admin/vouchers/activated') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/vouchers/activated'); ?>">
                                    <?php echo lang('admin vouchers activated'); ?>
                                </a> </li>
   
                                    </ul>
                                </li>

                                <li class="<?php echo (uri_string() == 'admin/contact') ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('/admin/contact'); ?>"> <i class="icon-drawer icons"></i> <?php echo lang('admin button messages'); ?> </a>
                                </li>
                                <li class="<?php echo (uri_string() == 'admin/currency') ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('/admin/currency'); ?>"> <i class="icon-wallet icons"></i> <?php echo lang('admin button currency'); ?> </a>
                                </li>
                              
                                <li class="<?php echo (strstr(uri_string(), 'admin/template')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-layers icons"></i> <?php echo lang('admin button template'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="<?php echo (uri_string() == 'admin/template') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/template'); ?>">
                                    <?php echo lang('admin template email'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/template/sms') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/template/sms'); ?>">
                                  <?php echo lang('admin template sms'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                              
                                <li class="<?php echo (strstr(uri_string(), 'admin/fees')) ? 'active open' : ''; ?>">
                                    <a href=""> <i class="icon-calculator icons"></i> <?php echo lang('admin pay title'); ?> <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li class="<?php echo (uri_string() == 'admin/fees') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/fees/'); ?>">
                                    <?php echo lang('admin trans withdrawal'); ?>
                                </a> </li>
                                        <li class="<?php echo (uri_string() == 'admin/fees/deposit') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/fees/deposit'); ?>">
                                  <?php echo lang('admin trans deposit'); ?>
                                </a> </li>
                                      <li class="<?php echo (uri_string() == 'admin/fees/sci') ? 'active' : ''; ?>"> <a href="<?php echo base_url('/admin/fees/sci'); ?>">
                                  <?php echo lang('admin pay sci'); ?>
                                </a> </li>
                                    </ul>
                                </li>
                                
                                <li class="<?php echo (uri_string() == 'admin/logs') ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('/admin/logs'); ?>"> <i class="icon-eye icons"></i> <?php echo lang('admin button logs'); ?> </a>
                                </li>
                                <li class="<?php echo (uri_string() == 'admin/settings') ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('/admin/settings'); ?>"> <i class="icon-equalizer icons"></i> <?php echo lang('admin button settings'); ?> </a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content responsive-tables-page">
                    <div class="title-block">
                        <h1 class="title">
                            <?php echo $page_header; ?>
                        </h1>
                    </div>
                    <section class="section">
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
                    </section>
                </article>
                <footer class="footer">
                    <div class="footer-block buttons">  </div>
                    <div class="footer-block author">
                        <ul>
                            <li>Just Wallet <?php echo $this->settings->site_version; ?></li>
                        </ul>
                    </div>
                </footer>
                
            </div>
        </div>
          
        <script src="<?php echo base_url();?>themes/modular/js/vendor.js"></script>
        <script src="<?php echo base_url();?>themes/modular/js/app.js"></script>
        <script src="<?php echo base_url();?>themes/modular/js/form.js"></script>
          
         
        <!-- Reference block for JS -->
       <?php // Javascript files ?>
        <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
            <?php foreach ($js_files_i18n as $js) : ?>
                <?php if ( ! is_null($js)) : ?>
                    <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        
    </body>

</html>