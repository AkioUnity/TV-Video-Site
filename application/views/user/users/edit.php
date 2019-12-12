<?php
$userPermission =array();
if(!empty($edit_form->permissions)){
	$userPermission = explode(',',$edit_form->permissions);
}
?>
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
                  <input type="text" class="form-control" name="first_name" value="<?=$edit_form->first_name?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>Last name</label>
                  <input type="text" class="form-control" name="last_name" value="<?=$edit_form->last_name?>" required="required">
                </div>
              </div>
            </div>
          </div>
          <p class="m-t-10">Contact Detail</p>
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-md-6">
                <div class="form-group form-group-default">
                  <label>Phone</label>
                  <input type="text" class="form-control" name="phone" value="<?=$edit_form->phone?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default">
                  <label>Street Address </label>
                  <input type="text" class="form-control" name="address" value="<?=$edit_form->address?>">
                </div>
              </div>
            </div>
            
            <div class="row clearfix">
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>City</label>
                  <input id="start-date" type="text" class="form-control" name="city" value="<?=$edit_form->city?>" required>
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
<option value="<?=$val?>" <?=$edit_form->country==$val?'selected':''?>><?=$val?></option>
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
                                  <input type="text" class="form-control" name="social_media[facebook]" value="<?=isset($social_arr->facebook)?$social_arr->facebook:''?>" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Twitter</label>
                                  <input type="text" class="form-control" name="social_media[twitter]" value="<?=isset($social_arr->twitter)?$social_arr->twitter:''?>">
                                </div>
                              </div>
                            </div>
                            <div class="row clearfix">
                              <div class="col-md-6">
                                <div class="form-group form-group-default ">
                                  <label>LinkedIN</label>
                                  <input type="text" class="form-control" name="social_media[linkedin]" value="<?=isset($social_arr->linkedin)?$social_arr->linkedin:''?>">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Instagram</label>
                                  <input type="text" class="form-control" name="social_media[instagram]" value="<?=isset($social_arr->instagram)?$social_arr->instagram:''?>">
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
<input type="checkbox" name="permissions[]" value="create_channel" data-init-plugin="switchery" <?=$userPermission&&in_array('create_channel',$userPermission)?'checked':''?>/>
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Delete Channels</label>
<input type="checkbox" name="permissions[]" value="delete_channel" data-init-plugin="switchery" <?=$userPermission&&in_array('delete_channel',$userPermission)?'checked':''?> />
</div>
</div>
</div>
<div class="row clearfix">

<div class="col-md-6">
<div class="form-group form-group-default">
<label>Create Shows</label>
<input type="checkbox" name="permissions[]" value="create_shows"  data-init-plugin="switchery" <?=$userPermission&&in_array('create_shows',$userPermission)?'checked':''?> />
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default ">
<label>Delete Shows</label>
<input type="checkbox" name="permissions[]" value="delete_shows" data-init-plugin="switchery" <?=$userPermission&&in_array('delete_shows',$userPermission)?'checked':''?> />
</div>
</div>

</div>

<div class="row clearfix">
<div class="col-md-6">
<div class="form-group form-group-default ">
<label>Add Users</label>
<input type="checkbox" name="permissions[]" value="users"  data-init-plugin="switchery" <?=$userPermission&&in_array('users',$userPermission)?'checked':''?>/>
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
<button type="submit" class="btn btn-success submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">Update</button>
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
		password:{
			minlength:4,
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

