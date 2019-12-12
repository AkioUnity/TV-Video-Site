<?php $this->load->view('templates/account/login_header'); ?>  
  
  <body class="fixed-header menu-pin">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="<?=site_url('assets/users')?>/assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src="<?=site_url('assets/users')?>/assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="<?=site_url('assets/users')?>/assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h2 class="semi-bold text-white">
					Gain visibility into your online performance with coicio™.</h2>
          <p class="small">
            coicio™ is a registered Trademark of Coicio Inc. All rights reserved © 2019.
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="<?=site_url('assets/users')?>/assets/img/logo.png" alt="logo" data-src="<?=site_url('assets/users')?>/assets/img/logo.png" data-src-retina="<?=site_url('assets/users')?>/assets/img/logo_2x.png" width="78" height="22">
          <p class="p-t-35">Sign into your coicio™ account</p>
<?php

if($this->session->flashdata('success')) {

$msg = $this->session->flashdata('success');

?>

<div class="alert alert-success"><?php echo $msg;?></div>

<?php	

}

if($this->session->flashdata('error')) {

$msg = $this->session->flashdata('error');

?>

<div class="alert alert-danger"><?php echo $msg;?></div>

<?php

}   

?>          
          <!-- START Login Form -->
<form id="form-login" class="p-t-15" role="form" action="" method="post">
<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
<input type="hidden" name="operation" value="set"  /> 
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Email Id</label>
              <div class="controls">
                <input type="text" name="email" placeholder="Email ID" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
<div class="row">
              <div class="col-md-6 no-padding sm-p-l-10">
                <a href="<?=site_url('secure/register')?>" class="text-info small">Create a coicio™ account</a>
              </div>
              <div class="col-md-6 d-flex align-items-center justify-content-end">
                <a href="<?=site_url('secure/login')?>" class="text-info small">Login</a>
              </div>
              
            </div>
        <button class="btn btn-primary btn-cons m-t-10" type="submit">Submit</button>
          </form>
          <!--END Login Form-->
          
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>
    <!-- START OVERLAY -->
    
    <!-- END OVERLAY -->
    <!-- BEGIN VENDOR JS -->
    <script src="<?=site_url('assets/users')?>/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="<?=site_url('assets/users')?>/assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?=site_url('assets/users')?>/assets/plugins/classie/classie.js"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="<?=site_url('assets/users')?>/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <script src="<?=site_url('assets/users')?>/pages/js/pages.min.js"></script>
    <script>
    $(function()
    {
      $('#form-login').validate()
    })
    </script>
  </body>
</html>