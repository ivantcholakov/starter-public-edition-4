<?php $this->load->view("header"); ?>
<?php $this->load->view("sidebar"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        500 Error
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">error</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="error-page">
        <h2 class="headline text-red">500</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>

          <p>
            You don't have permission for this request.
            Meanwhile, you may <a href="<?php echo site_url('admin'); ?>">return to dashboard.</a>
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
  </div>
  
<?php $this->load->view("footer"); ?>
