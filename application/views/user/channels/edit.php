<?php
$left_menu_uri_3 = $this->uri->segment(3);
?>

<script src="assets/plugins/jquery.validate.js"></script>   
<!--<script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>-->
<div class="card card-default m-t-20">
  <div class="card-body">
    <div class="invoice padding-50 sm-padding-10">
        <!-- START card -->
        <div class="card card-default">
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<div class="card-header ">
<div class="card-title">
    <h5>My Channel</h5>
</div>
<!-- Differentiate NEWS or Video or Audio --> 
<div class="row">
    <div class="col-md-12 form-group m-b-0">
      <label>Channel Type</label>
      <span class="help">What type of Channel is this?</span>
      <div class="radio radio-success">
        <input type="radio" checked="checked" value="TV Channel" name="type" id="yes">
        <label for="yes">TV Channel</label>
        <input type="radio" value="no" name="type" disabled="" id="no">
        <label for="no">Podcast <span class="small">coming soon</span></label> 
      </div>
    </div>  
</div>
   <!--@Differentiate NEWS or Video or Audio -->    
</div>  
<div class="card-body">
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Channel Name</label>
        <span class="help">e.g. "John Smith Channel"</span>
        <input type="text" name="name" value="<?=$edit_form->name?>" id="ep-name" class="form-control" required>
      </div>
      <div class="row">
          <div class="col-md-12 form-group">
            <label>Channel URL</label>
            <span class="help">Shortcut to access your Channel directly</span>
              <div class="input-group transparent">
                <div class="input-group-prepend">
                  <span class="input-group-text transparent">www.propertytv.io</span>
                  <span class="input-group-text transparent">channel</span>
                </div>
                  <input type="text" name="channel_url" value="<?=$edit_form->channel_url?>" placeholder="john-smith" class="form-control" id="input-copy" required>
              </div>
              <label id="input-copy-error" class="error" for="input-copy"></label>
              <span class="p-l-15 p-t-5">
                  <a href="javascript:;" onclick="copyToClipboard()">
                  <i class="fa fa-copy"></i> copy url</a>
              </span>
          </div>  
      </div>
      
    </div>
    <div class="col-lg-6">  
      <div class="form-group">
        <label>Channel TAGS</label>
        <span class="help">e.g. "Corelogic, Auction, "</span>
        <input class="tagsinput custom-tag-input form-control" name="tags" type="text" value="<?=$edit_form->tags?>" />
      </div>

<div class="form-group">
	<label>Complex Name</label>
	<input type="text" name="complex_name" value="<?=$edit_form->complex_name?>" class="form-control" required/>
</div>

    </div>
  </div>
  <div class="row">
	  <div class="col-md-12">  
      <div class="form-group">
            <label>Channel Payoff</label>
            <input type="text" name="payoff_desc" value="<?=$edit_form->payoff_desc?>" class="form-control" />
        </div>
    </div>
    <div class="col-md-12">  
      <div class="form-group">
            <label>Channel Summary</label>
            <span class="help">This is used as overlay on the home screen.</span>
            <textarea class="form-control" name="short_description" id="" placeholder=""><?=$edit_form->short_description?></textarea>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">    
          <label>About Your Channel</label>
            <span class="help">This is used for more detail on your channel.</span>
            <div class="summernote-wrapper required">
                <textarea id="summernote" name="description" class="required"><?=$edit_form->description?></textarea>
          </div>
      </div>   
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
          <h5>Imagery</h5>
          <p>Please upload the artwork for the respective areas.</p>
      </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
          <label>Cover Hero</label>
          <span class="help">1920px x 1080px. This is the large image at the <b>top</b> of the page.</span>  
          <div class="card-body no-scroll no-padding">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
	<img src="<?=!empty($edit_form->image)?'assets/uploads/channels/thumbnails/'.$edit_form->image:'assets/uploads/no-image.gif'?>" />
</div>

<div>

<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

<input type="file" name="image" id="input-image" <?=!empty($edit_form->image)?'':'required'?>></span>

<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

</div>
<label id="input-image-error" class="error" for="input-image"></label>

</div>          
          </div>
      </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
          <label>Standard Image</label>
          <span class="help">550px x 260px. This is the Channel rectangle image on the home screen.</span>  
          <div class="card-body no-scroll no-padding">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
	<img src="<?=!empty($edit_form->image_2)?'assets/uploads/channels/thumbnails/'.$edit_form->image_2:'assets/uploads/no-image.gif'?>" />
</div>

<div>

<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

<input type="file" name="image_2" id="input-image_2" <?=!empty($edit_form->image_2)?'':'required'?> ></span>


<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

</div>
<label id="input-image_2-error" class="error" for="input-image_2"></label>

</div>                
          </div>
      </div>
      </div>
      
      <div class="col-md-4">
      <div class="form-group">
          <label>Logo</label>
          <span class="help">155px x 60px. This is the Channel logo image on the home screen.</span>  
          <div class="card-body no-scroll no-padding">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
	<img src="<?=!empty($edit_form->logo)?'assets/uploads/channels/thumbnails/'.$edit_form->logo:'assets/uploads/no-image.gif'?>" />
</div>

<div>

<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

<input type="file" name="logo" id="input-logo" <?=!empty($edit_form->logo)?'':'required'?> ></span>


<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

</div>
<label id="input-logo-error" class="error" for="input-logo"></label>
</div>                
          </div>
      </div>
      </div>
      
      <div class="col-md-4">
      <div class="form-group">
          <label>Subscription Image</label>
          <span class="help">1200px x 1200px. This is the Channel graphicshown on a user’s subscription page.</span>  
          <div class="card-body no-scroll no-padding">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
	<img src="<?=!empty($edit_form->subscribe_image)?'assets/uploads/channels/thumbnails/'.$edit_form->subscribe_image:'assets/uploads/no-image.gif'?>" />
</div>

<div>

<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

<input type="file" name="subscribe_image" id="input-subscribe_image" <?=!empty($edit_form->subscribe_image)?'':'required'?> ></span>


<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

</div>
<label id="input-subscribe_image-error" class="error" for="input-subscribe_image"></label>
</div>                
          </div>
      </div>
      </div>
      
  </div>
  
    <button type="submit" class="btn btn-primary btn-cons btn-animated from-top fa fa-cloud-upload submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">
      <span>Make LIVE</span>
    </button> 

    <button type="submit" name="draft" class="btn btn-warning btn-cons btn-animated from-top fa fa-save submitBtn" value="set" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">
      <span>Save Draft</span>
    </button>
  </div>
<?=form_close()?>

          </div>
        </div>
        <!-- END card -->
            
      <div class="p-l-15 p-r-15">
      </div>
      <div class="p-l-15 p-r-15">
      </div>
      <br />
      <br />
      
      <br>
      <hr>
    </div>
  </div>
            
<script>
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});


	/*$.validator.addMethod('filesize', function (value, element, arg) {
		var minsize=1000; // min 1kb
		if((value>minsize)&&(value<=arg)){
			return true;
		}else{
			return false;
		}
	});*/
			
	$( ".edit-form" ).validate({
	rules: {
		channel_url: {
			required: true,
			remote: {
				url: "<?php echo site_url($_cancel.'/check_channel_url?id='.$edit_form->id)?>",
				type: "GET",
				data: {
					channel_url: function(){ return $("#input-copy").val(); }
				}
			}				
		},	
	},
	messages: {
		channel_url: {
			remote: 'URL taken, please try another.'
		},
	},	
		submitHandler: function (form) {
	//		$(".submitBtn").button('loading');
			submitForms = true;
			console.log($('#input-image_2').get(0).files.length );
			if($('#input-image_2').get(0).files.length!=0){
				var file_size_2 = $('#input-image_2')[0].files[0].size;
				if(file_size_2>2097152) {//2097152
					$("#input-image_2-error").show();
					$("#input-image_2-error").html("File size must not exceed 2MB");
					submitForms = false;
				} 
			}
			if($('#input-image').get(0).files.length!=0){
				var file_size_1 = $('#input-image')[0].files[0].size;
				if(file_size_1>2097152) {//2097152
					$("#input-image-error").show();
					$("#input-image-error").html("File size must not exceed 2MB");
					submitForms = false;
				} 
			}
			if($('#input-logo').get(0).files.length!=0){
				var file_size = $('#input-logo')[0].files[0].size;
				if(file_size>2097152) {//2097152
					$("#input-logo-error").show();
					$("#input-logo-error").html("File size must not exceed 2MB");
					submitForms = false;
				}
			}
			if(submitForms){
				var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
				//$('.submitBtn').prop('disabled', true)
				$('.submitBtn').html(loadingText);
				return true;
			}
			return false;
		}
	});

function copyToClipboard() {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val('<?=site_url('channel')?>/'+$("#input-copy").val()).select();
	document.execCommand("copy");
	$temp.remove();
}
</script>


<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

