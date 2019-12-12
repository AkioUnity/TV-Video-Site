<?php $this->load->view('templates/account/login_header'); ?>  
  <body class="fixed-header menu-pin">
    <div class="register-container full-height sm-p-t-30">
      <div class="d-flex justify-content-center flex-column full-height ">
        <img src="<?=site_url('assets/users')?>/assets/img/logo.png" alt="logo" data-src="<?=site_url('assets/users')?>/assets/img/logo.png" data-src-retina="<?=site_url('assets/users')?>/assets/img/logo_2x.png" width="78" height="22">
        <h3>Make online management easy</h3>
        <p>
          Create a coicio™ account below.
        </p>

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
        
<?=form_open(NULL, array('class' => 'p-t-15', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'form-register'))?>
        <input type="hidden" name="operation" value="set"  /> 
          <div class="row">
            <div class="col-md-6">
              <div class="form-group form-group-default">
                <label>First Name</label>
                <input type="text" name="first_name" placeholder="John" value="<?=set_value('first_name')?>" class="form-control" required>
                <span class="error-span"><?php echo form_error('first_name'); ?></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-default">
                <label>Last Names</label>
                <input type="text" name="last_name" placeholder="Smith"  value="<?=set_value('last_name')?>" class="form-control" required>
                <span class="error-span"><?php echo form_error('last_name'); ?></span>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>Password</label>
                <input type="password" name="password" placeholder="Must be complex" value="<?=set_value('password')?>" id="input-password"  class="form-control" required>
                <span class="error-span"><?php echo form_error('password'); ?></span>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>Password</label>
                <input type="password" name="confirm" placeholder="Confirm" value="<?=set_value('confirm')?>"  class="form-control" required>
                <span class="error-span"><?php echo form_error('confirm'); ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>Email</label>
                <input type="email" name="email" placeholder="We will send login details to you" value="<?=set_value('email')?>" id="input-email" class="form-control" required>
                <span class="error-span"><?php echo form_error('email'); ?></span>
              </div>
            </div>
          </div>
          <div class="row m-t-10">
            <div class="col-lg-6">
              <p><small>I agree to the <a href="<?=site_url('pages/terms-of-service')?>" class="text-info">Terms</a> and <a href="<?=site_url('pages/privacy')?>" class="text-info">Privacy</a>.</small></p>
            </div>
            <div class="col-lg-6 text-right">
              <a href="mailto:help@propertytv.io" class="text-info small">Help? Contact Support</a>
            </div>
          </div>
          

<div class="form-group  " style="position:relative">
    <div class="" style="margin:auto 18%">
    <?php echo $widget;?>
        <span class="error-span"><?php echo form_error('code'); ?></span>
    <?php echo $script;?>
</div>
</div>          
          <button class="btn btn-primary btn-cons m-t-10" type="submit">Create a new account</button>
        </form>
      </div>
    </div>
    <div class=" full-width">
      <div class="register-container m-b-10 clearfix">
        <div class="m-b-30 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix d-flex-md-up">
          <div class="col-md-2 no-padding d-flex align-items-center">
            <img src="<?=site_url('assets/users')?>/assets/img/demo/pages_icon.png" alt="" class="" data-src="<?=site_url('assets/users')?>/assets/img/demo/pages_icon.png" data-src-retina="<?=site_url('assets/users')?>/assets/img/demo/pages_icon_2x.png" width="60" height="60">
          </div>
          <div class="col-md-9 no-padding d-flex align-items-center">
            <p class="hinted-text small inline sm-p-t-10">No part of this website or any of its contents may be reproduced, copied, modified or adapted, without the prior written consent of the author, unless otherwise indicated for stand-alone materials.</p>
          </div>
        </div>
      </div>
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
$(function(){
	$('#form-register').validate({
	rules: {
		first_name:{
			maxlength:20,
		},
		last_name:{
			maxlength:20,
		},
		email: {
			required: true,
			email: true,
			remote: {
				url: "<?php echo site_url('secure/register_email_exists')?>",
				type: "GET",
				data: {
					email: function(){ return $("#input-email").val(); }
				}
			}				
		},	
		'confirm': {
		  equalTo: "#input-password"
		},
		
	},
	messages: {
		email: {
				required: "Email is required",
				remote: 'Email already in use, did you forget <a href="<?=site_url('secure/forgot')?>">your password</a>?'
			},
		}, 
			
	});
});
</script>

<style>
.error-span p{
	margin-bottom:0px;
	color:#C00;
	font-size:13px;
}
</style>    
  </body>
</html>