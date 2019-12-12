<?php
$user_service = $user_options = array();
if($form_data){
	$user_service = json_decode($form_data->services);
	$user_options = json_decode($form_data->options);
}
//printR($user_options);
?>
<style>
@media (min-width: 990px){
	.mt-1 label{
		margin-top:-10px
	}
}
</style>

<script src="assets/plugins/jquery.validate.js"></script>   
<div class="row">
  <div class="col-md-5">
    <!-- START card -->
    <div class="card card-transparent">
      <div class="card-header ">
        <div class="card-title">Your Own TV Channel
        </div>
      </div>
      <div class="card-body">
          <h3>
              Get subscribers and control your own content, on your own channel. 
          </h3>
        <p>With your own TV Channel, you are in control. Publish your own TV Shows, your own property videos and your own message. 
            <br /><strong>It's your channel, they're your followers</strong>.
        </p>
        <br>
        <div class="card" >
            <img src="assets/users/images/channel-480.jpg" alt="" class="image-responsive-height">
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
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
          <h5>Channel Request</h5>
          <p>This process is a manual approval process and takes no more than 24hrs to be approved, mostly much quicker.</p>
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>First name</label>
                  <input type="text" class="form-control" name="first_name" value="<?=$form_data?$form_data->first_name:''?>" id="input-first_name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default required">
                  <label>Last name</label>
                  <input type="text" class="form-control" name="last_name" value="<?=$form_data?$form_data->last_name:''?>" id="input-last_name" required>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-6">
                <div class="form-group form-group-default ">
                  <label>Company name</label>
                  <input type="text" class="form-control" name="company_name" value="<?=$form_data?$form_data->company_name:''?>" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default ">
                  <label>Company website</label>
                  <input type="text" class="form-control" name="website" value="<?=$form_data?$form_data->website:''?>" >
                </div>
              </div>
            </div>
          </div>
          <div class="checkbox check-success col-md-12  ">
            <input type="checkbox" name="same_profile" value="1" id="checkbox0" onclick="set_copy_profile()">
            <label for="checkbox0">Copy from my profile</label>
          </div>
          <div class="row">
                <div class="col-md-12">
                    <br />
                    <div class="form-group row">
                      <label class="col-md-12 control-label">What describes you best</label>
                      <div class="checkbox check-success col-md-4  ">
                        <input type="checkbox" name="options[]" value="Corporate" id="checkbox1" <?=$user_options&&in_array('Corporate',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox1">Corporate</label>
                      </div>
                      <br>
                      <div class="checkbox check-success col-md-4 mt-1 ">
                        <input type="checkbox" name="options[]" value="Real Estate Agent or agency" id="checkbox2" <?=$user_options&&in_array('Real Estate Agent or agency',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox2">Real Estate Agent/Agency</label>
                      </div>
                      <br>
                      <div class="checkbox check-success col-md-4  ">
                        <input type="checkbox" name="options[]" value="Auctioneer"  id="checkbox8" <?=$user_options&&in_array('Auctioneer',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox8">Auctioneer</label>
                      </div>
                      <br>
                      <div class="checkbox check-success col-md-4  ">
                        <input type="checkbox"  name="options[]" value="Trainer or Coach"  id="checkbox3" <?=$user_options&&in_array('Trainer or Coach',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox3">Trainer/Coach</label>
                      </div>
                      <br>
                      <div class="checkbox check-success col-md-4 mt-1 ">
                        <input type="checkbox"  name="options[]" value="Property Developer"  id="checkbox4" <?=$user_options&&in_array('Property Developer',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox4">Property Developer</label>
                      </div>
                      <br>
                      <div class="checkbox check-success col-md-4  ">
                        <input type="checkbox"  name="options[]" value="Service Provider"  id="checkbox5" <?=$user_options&&in_array('Service Provider',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox5">Service Provider</label>
                      </div>
                      <br>
                      <div class="checkbox check-success col-md-4  ">
                        <input type="checkbox" name="options[]" value="Home Improvement" id="checkbox6" <?=$user_options&&in_array('Home Improvement',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox6">Home Improvement</label>
                      </div>
                      <br>
                      <div class="checkbox check-success col-md-4  ">
                        <input type="checkbox" name="options[]" value="Other Content Creator"  id="checkbox7" <?=$user_options&&in_array('Other Content Creator',$user_options)?'checked="checked"':''?>>
                        <label for="checkbox7">Other Content Creator</label>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <label class="col-md-12 control-label">WHAT TYPE OF CHANNEL WOULD YOU LIKE?</label>
                      <div class="checkbox check-danger col-md-6  ">
                        <input type="checkbox" name="services[]" value="On-Demand Only" id="checkbox10" <?=$user_service&&in_array('On-Demand Only',$user_service)?'checked="checked"':''?> >
                        <label for="checkbox10">On-Demand Only</label>
                      </div>
                      <br>
                      <div class="checkbox check-danger col-md-6  ">
                        <input type="checkbox" name="services[]" value="On-Demand + Broadcast LIVE" id="checkbox11" <?=$user_service&&in_array('On-Demand + Broadcast LIVE',$user_service)?'checked="checked"':''?>>
                        <label for="checkbox11">On-Demand + Broadcast LIVE</label>
                      </div>
                      <br>
                    </div>
                    <br/>
                    <div class="form-group row">
                      <label for="name" class="col-md-12 control-label">Supporting Detail</label>
                      <span class="help">Please feel free to add further supporting detail to your application.</span>
                      <div class="col-md-12">
                        <textarea class="form-control" id="name" name="details" placeholder="Describe your Business, Skills &amp; Successes " ><?=$form_data?$form_data->details:''?></textarea>
                      </div>
                      <div class="form-group row m-t-10">
                      <label for="position" class="col-md-12 control-label">Add a friend?</label>
                      <span class="help">There's strength in numbers. Add an email address of a friend you think would benefit from a Property TV Chanel.</span>
                      <div class="col-md-12">
                        <input type="email" class="form-control" name="friends" value="<?=$form_data?$form_data->friends:''?>" id="position" placeholder="someone@google.com" >
                      </div>
                    </div>
                    </div>
                </div>
              </div>
          <br>
          <div class="pull-left">
              <div class="checkbox check-success">
                  <input type="checkbox" checked="checked" value="1" id="apply-channel-owner">
                  <label for="apply-channel-owner">I would like to apply for Channel Ownership and I agree to the terms and conditions.
              </label>
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

function set_copy_profile() {
	if($("input[name='same_profile']:checked").length>0){
		$('#input-first_name').val('<?=$user_details->first_name?>');
		$('#input-last_name').val('<?=$user_details->last_name?>');
	}
}
</script>

