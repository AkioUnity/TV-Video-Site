<?php
$user_service = $user_options = array();
if($form_data){
	$user_service = json_decode($form_data->services);
	$user_options = json_decode($form_data->production);
}
?>

<script src="assets/plugins/jquery.validate.js"></script>   
<div class="row">
    <div class="col-md-5">
    <!-- START card -->
    <div class="card card-transparent">
      <div class="card-header ">
        <div class="card-title">Your Personal Producer
        </div>
      </div>
      <div class="card-body">
          <h3>
              Your personal <b>Concierge</b> to help you make the most out of Property TV. 
          </h3>
        <p>With your own private concierge, we take all the hard work out and let you do what you do best, <b>you</b>!
            <br />Elect to do some, all or none. The choice is yours.
        </p>
        <br>
        <div class="card" >
            <img src="assets/users/images/concierge.jpg" alt="" class="image-responsive-height">
        </div>
      </div>
    </div>
    <!-- END card -->
    </div>
    <div class="col-md-7">
    <!-- START card -->
    <div class="card card-transparent">
      <div class="card-body">
<?php echo validation_errors();?>
<form method="post" id="form-project" class="edit-form" role="form" autocomplete="off" novalidate>
<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
          <h5>Concierge Request</h5>
          <p>Complete this form to get your personal production assistant.</p>
          <!-- Auto Populate from Profile -->
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>First name</label>
                  <input type="text" class="form-control" name="first_name" value="<?=$form_data?$form_data->first_name:$user_details->first_name?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>Last name</label>
                  <input type="text" class="form-control" name="last_name" value="<?=$form_data?$form_data->last_name:$user_details->last_name?>" required="required">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" value="<?=$form_data?$form_data->email:$user_details->email?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>Phone</label>
                  <input type="text" class="form-control" name="phone" value="<?=$form_data?$form_data->phone:$user_details->phone?>" required="required">
                </div>
              </div>
            </div>
          </div>
          <!--//END Auto Populate from Profile -->
          
          <div class="row">
                <div class="col-md-12">
                    <br />
                    <h5>How Can We Help?</h5>
                    <p><b>What services are you seeking</b></p>
                    <div class="checkbox check-success p-b-5">
                       <input type="checkbox" name="services[]" value="Complete Management of my account" id="checkbox-1" <?=$user_service&&in_array('Complete Management of my account',$user_service)?'checked="checked"':''?>>
                       <label for="checkbox-1">Complete Management of my account</label>
                    </div>
                    <label class="col-md-12 control-label">Or selected items</label>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="services[]" value="Show or Video Uploading"  id="checkbox-2" <?=$user_service&&in_array('Show or Video Uploading',$user_service)?'checked="checked"':''?>>
                      <label for="checkbox-2">Show/Video Uploading</label>
                    </div>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="services[]" value="Sharing to Social Network" id="checkbox-4" <?=$user_service&&in_array('Sharing to Social Network',$user_service)?'checked="checked"':''?>>
                      <label for="checkbox-4">Sharing to Social Network</label>
                    </div>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="services[]" value="Broadcasting LIVE" id="checkbox-5" <?=$user_service&&in_array('Broadcasting LIVE',$user_service)?'checked="checked"':''?>>
                      <label for="checkbox-5">Broadcasting LIVE</label>
                    </div>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="services[]" value="Setup my account only, I can handle the rest" id="checkbox-6" <?=$user_service&&in_array('Setup my account only, I can handle the rest',$user_service)?'checked="checked"':''?>>
                      <label for="checkbox-6">Setup my account only, I can handle the rest</label>
                    </div>
                    <hr />
                    <p><b>Do you need production services?</b></p>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="production[]" value="Full production and crew" id="checkbox3" <?=$user_options&&in_array('Full production and crew',$user_options)?'checked="checked"':''?>>
                      <label for="checkbox3">Full production &amp; crew</label>
                    </div>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="production[]" value="Post-production (rendering video files etc)"  id="checkbox4" <?=$user_options&&in_array('Post-production (rendering video files etc)',$user_options)?'checked="checked"':''?>>
                      <label for="checkbox4">Post-production (rendering video files etc)</label>
                    </div>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="production[]" value="I want a TV Show like Million Dollar Listing" id="checkbox5" <?=$user_options&&in_array('I want a TV Show like Million Dollar Listing',$user_options)?'checked="checked"':''?>>
                      <label for="checkbox5">I want a TV Show like Million Dollar Listing</label>
                    </div>
                    <div class="checkbox check-success">
                      <input type="checkbox" name="production[]" value="Other" id="checkbox6" <?=$user_options&&in_array('Other',$user_options)?'checked="checked"':''?>>
                      <label for="checkbox6">Other</label>
                    </div>
                    <hr />
                    <p><b>Is there anything else we can help you with?</b></p>
                    <div class="form-group row">
                      <label for="name" class="col-md-12 control-label">Let us know</label>
                      <span class="help"></span>
                      <div class="col-md-12">
                        <textarea class="form-control" name="description" placeholder="  " required="required"><?=$form_data?$form_data->description:''?></textarea>
                      </div>
                    </div>
                </div>
              </div>
          <br>
<button type="submit" class="btn btn-success submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">
Submit</button> 
        </form>
      </div>
    </div>
    <!-- END card -->
    </div>
</div>
<script>

$( ".edit-form" ).validate({
	submitHandler: function (form) {
//		$(".submitBtn").button('loading');
		submitForms = true;
		if(submitForms){
			var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
			//$('.submitBtn').prop('disabled', true)
			$('.submitBtn').html(loadingText);
			return true;
		}
		return false;
	}
});
</script>

