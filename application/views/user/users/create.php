<script src="assets/plugins/jquery.validate.js"></script>   

<div class="col-md-7">
                    <!-- START card -->
                    <div class="card card-transparent">
                      <div class="card-body">
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data","autocomplete"=>"off"))?>
<p><strong>
      New User Details</strong></p>
<div class="form-group-attached">
<div class="row clearfix">
  <div class="col-md-6">
    <div class="form-group form-group-default required">
      <label>First name</label>
      <input type="text" class="form-control" name="first_name" required>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group form-group-default required">
      <label>Last name</label>
      <input type="text" class="form-control" name="last_name" required="required">
    </div>
  </div>
</div>
<!--<div class="row clearfix">
  <div class="col-md-6">
    <div class="form-group form-group-default required">
      <label>Company name</label>
      <input type="text" class="form-control" name="companyName" required>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group form-group-default required">
      <label>Company website</label>
      <input type="text" class="form-control" name="companyWeb">
    </div>
  </div>
</div>-->
</div>
<p class="m-t-10">Contact Detail</p>
<div class="form-group-attached">
<div class="row clearfix">
  <div class="col-md-6">
    <div class="form-group form-group-default required">
      <label>Email</label>
      <input type="email" class="form-control" name="email" id="input-email" required>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group form-group-default">
      <label>Phone</label>
      <input type="text" class="form-control" name="phone" required>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-12">
    <div class="form-group form-group-default required">
      <label>Password</label>
      <input type="text" class="form-control" name="password" required>
    </div>
  </div>
</div>

<div class="form-group form-group-default">
  <label>Street Address <i class="fa fa-info text-complete m-l-5"></i>
  </label>
  <input type="text" class="form-control" name="address">
</div>
<div class="row clearfix">
  <div class="col-md-6">
    <div class="form-group form-group-default required">
      <label>City</label>
      <input id="start-date" type="text" class="form-control" name="city" required>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group form-group-default required">
      <label>Country</label>
<select class="cs-select cs-skin-slide cs-transparent form-control" data-init-plugin="cs-select" name="country" required="required" a>
<option value="">Select</option>
<?php
foreach($country_list as $val){
?>
<option value="<?=$val?>" <?=$user_details->country==$val?'selected':''?>><?=$val?></option>
<?php	
}
?>
</select>                                  
    </div>
  </div>
</div>
</div>
<p class="m-t-10">Social Media</p>
<div class="form-group-attached">
<div class="row clearfix">
<div class="col-md-6">
<div class="form-group form-group-default ">
<label>Facebook</label>
<input type="text" class="form-control" name="social_media[facebook]" value="" >
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Twitter</label>
<input type="text" class="form-control" name="social_media[twitter]" value="">
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-md-6">
<div class="form-group form-group-default ">
<label>LinkedIN</label>
<input type="text" class="form-control" name="social_media[linkedin]" value="">
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Instagram</label>
<input type="text" class="form-control" name="social_media[instagram]" value="">
</div>
</div>
</div>
</div>                          

<p class="m-t-10">User Credentials<br />
<span class="small">The above user has access to my account with the following credentials:</span></p>

<div class="form-group-attached">
<div class="row clearfix">
<div class="col-md-6">
<div class="form-group form-group-default ">
<label>Create Channels</label>

<input type="checkbox" name="permissions[]" value="create_channel" data-init-plugin="switchery" checked="checked"  />
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Delete Channels</label>
<input type="checkbox" name="permissions[]" value="delete_channel" data-init-plugin="switchery" />
</div>
</div>
</div>
<div class="row clearfix">
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Create Shows</label>
<input type="checkbox" name="permissions[]" value="create_shows"  data-init-plugin="switchery" checked="checked" />
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default ">
<label>Delete Shows</label>
<input type="checkbox" name="permissions[]" value="delete_shows" data-init-plugin="switchery" />
</div>
</div>
</div>

<div class="row clearfix">
<div class="col-md-6">
<div class="form-group form-group-default ">
<label>Add Users</label>
<input type="checkbox" name="permissions[]" value="users"  data-init-plugin="switchery" checked="checked" />
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">

</div>
</div>
</div>
</div>
<br>
<div class="pull-left">
<div class="checkbox check-success  ">
<input type="checkbox" checked="checked" value="1" id="checkbox-agree">
<label for="checkbox-agree">I agree to grant access to this user.
</label>
</div>
</div>
<br>
<button type="submit" class="btn btn-success submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">Submit</button>
     <?=form_close()?>
                      </div>
                    </div>
                    <!-- END card -->
                  </div>
                  

<script>
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

$( ".edit-form" ).validate({
	rules: {
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
		password:{
			minlength:4,
		},
	},
	messages: {
		email: {
			required: "Email is required",
			remote: 'Email already in use'
		},
	}, 
			
	submitHandler: function (form) {
//		$(".submitBtn").button('loading');
		$('.submitBtn').prop('disabled', true)
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('.submitBtn').html(loadingText);
		return true;
	}
});


</script>

