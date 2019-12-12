<?php $this->load->view('templates/account/login_header'); ?>  
  
  <body class="fixed-header menu-pin">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="<?=site_url('assets/uploads/sites/'.$settings['login_background'])?>" data-src="<?=site_url('assets/uploads/sites/'.$settings['login_background'])?>" data-src-retina="<?=site_url('assets/uploads/sites/'.$settings['login_background'])?>" alt="" class="lazy">
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
<?=form_open(NULL, array('class' => 'p-t-15', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'form-login'))?>
<input type="hidden" name="operation" value="set"  /> 
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Login</label>
              <div class="controls">
                <input type="text" name="email" placeholder="Email ID" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Password</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
            </div>
            <!-- START Form Control-->
            <div class="row">
              <div class="col-md-6 no-padding sm-p-l-10">
                <!--<div class="checkbox ">
                  <input type="checkbox" value="1" id="checkbox1">
                  <label for="checkbox1">Keep Me Signed in</label>
                </div>-->
                <a href="<?=site_url('secure/forgot')?>" class="text-info small">Forgot Your Password?</a>
              </div>
              <div class="col-md-6 d-flex align-items-center justify-content-end">
                <a href="mailto:help@propertytv.io" class="text-info small">Help? Contact Support</a>
              </div>
            </div>
            <!-- END Form Control-->

<div class="form-group  " style="position:relative;margin-top:20px">
    <div class="" style="">
    <?php echo $widget;?>
        <span class="error-span"><?php echo form_error('code'); ?></span>
    <?php echo $script;?>
</div>
</div>            
            <button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
          </form>
          <!--END Login Form-->
          <div class="pull-bottom sm-pull-bottom">
            <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
              <div class="col-sm-3 col-md-2 no-padding">
                <img alt="" class="m-t-5" data-src="<?=site_url('assets/users')?>/assets/img/demo/pages_icon.png" data-src-retina="<?=site_url('assets/users')?>/assets/img/demo/pages_icon_2x.png" height="60" src="<?=site_url('assets/users')?>/assets/img/demo/pages_icon.png" width="60">
              </div>
              <div class="col-sm-9 no-padding m-t-10">
                <p>
                  <small>
                      <a href="<?=site_url('secure/register')?>">Create a coicio™ account</a>
		  </small>
                </p>
              </div>
            </div>
          </div>
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