<script src="assets/plugins/jquery.validate.js"></script>   

<?php
$user_checkbox = json_decode($user_details->user_checkbox);
?>
<!-- START card -->
<div class="row">
	<div class="col-md-8">
	    <!-- START card -->
	    <div class="card card-transparent">
    		<div class="card-body">
<?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data",'autocomplete'=>'off'))?>
                          <p>Your Information</p>
                          <div class="form-group-attached">
                            <div class="row clearfix">
                              <div class="col-md-6">
                                <div class="form-group form-group-default required">
                                  <label>First name</label>
                                  <input type="text" class="form-control" name="first_name" value="<?=$user_details->first_name?>"  required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default required">
                                  <label>Last name</label>
                                  <input type="text" class="form-control" name="last_name" value="<?=$user_details->last_name?>" required >
                                </div>
                              </div>
                            </div>
                          </div>
                          <p class="m-t-10">Contact Detail</p>
                          <div class="form-group-attached">
                            <div class="row clearfix">
                              <div class="col-md-6">
                                <div class="form-group form-group-default required">
                                  <label>Email</label>
                                  <input type="email" class="form-control" name="email" value="<?=$user_details->email?>" disabled="disabled">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Phone</label>
                                  <input type="text" class="form-control" name="phone" value="<?=$user_details->phone?>">
                                </div>
                              </div>
                            </div>
                            <div class="form-group form-group-default">
                              <label>Street Address <i class="fa fa-info text-complete m-l-5"></i>
                              </label>
                              <input type="text" class="form-control" name="address"  value="<?=$user_details->address?>" >
                            </div>
                            <div class="row clearfix">
                              <div class="col-md-6">
                                <div class="form-group form-group-default required">
                                  <label>City</label>
                                  <input type="text" class="form-control" name="city" value="<?=$user_details->city?>" required>
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
                          </div>
                          


<div class="form-group-attached">
<div class="row clearfix">
<div class="col-md-6">
	<div class="form-group">
<label class="col-md-12 control-label">Image</label>
<div class="col-md-10">

<div class="fileinput fileinput-new" data-provides="fileinput">

<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">

<img src="<?=!empty($user_details->image) ? base_url('assets/uploads/users/thumbnails').'/'.$user_details->image:'assets/uploads/no-image.gif'; ?>" />

</div>

<div>

<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

<input type="file" name="image" <?=!empty($user_details->image) ? '':'';?>></span>

<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

</div>

</div>

<!--<input type="file" name="logo" id="logo" />-->

</div>
<?php /*?><div id="cropContainerProduct">
<?php echo !isset($products->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/products').'/'.$products->image.'" style="width:360px; height:250px;" >'; ?>
                        </div><?php */?>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-md-12 control-label">Logo Of Company</label>
<div class="col-md-9">

<div class="fileinput fileinput-new" data-provides="fileinput">

<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">

<img src="<?=!empty($user_details->logo) ? base_url('assets/uploads/users/').'/'.$user_details->logo:'assets/uploads/no-image.gif'; ?>" />

</div>

<div>

<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

<input type="file" name="logo" <?=!empty($user_details->logo) ? '':'';?>></span>

<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

</div>

</div>

<!--<input type="file" name="logo" id="logo" />-->

</div>

</div>
</div>
</div>
</div>                          
<br>
<div class="pull-left">
<div class="checkbox check-success  ">
  <input type="checkbox" name="options[information_above]" value="1" id="checkbox-agree" <?=isset($user_checkbox->information_above)&&$user_checkbox->information_above==1?'checked="checked"':''?>>
  <label for="checkbox-agree">I hereby certify that the information above is true and accurate
  </label>
</div>
<?php
if($user_details->apply_channel==0){
?>
<div class="checkbox check-success">
  <input type="checkbox" name="apply_channel" value="1" id="apply-channel-owner" >
      <label for="apply-channel-owner">Apply for Channel Ownership
  </label>
</div>
<?php	
}
else if($user_details->apply_channel==1&&$user_details->approved_channel==1){
?>
  <div class="checkbox check-success  ">
  <input type="checkbox" name="approved_channel" value="1" id="checkbox-channel-owner" <?=$user_details->approved_channel==1?'checked="checked"':''?> disabled="disabled">
      <label for="checkbox-channel-owner">Approved channel owner
  </label>
</div>
<?php
}
?>
  
  <!-- Show this only if user is approved to be channel owner -->
</div>
<br>
<?php
if($this->data['userPermission']&&in_array('users',$this->data['userPermission'])){
	if($user_details->admin_id!=0){}
	else{
		if($user_details->parent_id!=0){
?>
<button class="btn btn-tag  btn-tag-light m-r-20" type="button" onclick="return confirm_box();">Unlink from owner</button>
<?php
		}
	}
}
?>
<button type="submit" class="btn btn-success submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">Update</button> 
                        </form>
                      </div>
                    </div>
                    <!-- END card -->
                  </div>
                </div>

<div class="modal fade" id="cropModal" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×</button>
            <h4 class="modal-title" id="myModalLabel">Crop Image</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div id="upload-demo"></div>
                <div class="col-md-12" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;min-height:45px;">
                            <input type="file" id="upload">
                            <br/>
                            <button class="btn btn-success upload-result" disabled="disabled">Crop</button>
                </div>                    
            </div>
        </div>
    </div>
</div>
</div>                
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
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
		first_name:{
			maxlength:20,
		},
		last_name:{
			maxlength:20,
		},
	},	
	submitHandler: function (form) {
//		$(".submitBtn").button('loading');
		//$('.submitBtn').prop('disabled', true)
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('.submitBtn').html(loadingText);
		return true;
	}
});

function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (answer){
		window.location='<?=$_user_link.'/account/set_remove_owner'?>';
	}
}
</script>

 