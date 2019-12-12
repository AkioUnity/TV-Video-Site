<script src="assets/plugins/jquery.validate.js"></script>   
<!-- START card -->
<div class="card card-default m-t-20">
<div class="card-body">
<div class="invoice padding-50 sm-padding-10">
    <!-- START card -->
    <div class="card card-default">
<?php echo validation_errors();?>
<div class="card-header ">
<div class="card-title">
    <h5>New Show</h5>
</div>
<!-- Differentiate NEWS or Video or Audio --> 
<div class="row">
        <div class="col-md-12 form-group m-b-0">
          <label>Show Type</label>
          <span class="help"> please select the type of post you are creating.</span>
        <ul class="nav nav-pills m-t-5 m-b-15" role="tablist">
            <li class="active">
              <a href="#tab1" data-toggle="tab" role="tab" class="b-a b-grey text-master">
                Video
              </a>
            </li>
            <li>
              <a href="#tab2" data-toggle="tab" role="tab" class="b-a b-grey text-master">
                Audio
              </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane in active" id="tab1">
				            
              <div class="row">
	              <div class="col-md-6 form-group">
                    <label>Upload your video</label>
                    <span class="help">e.g. "/user/video.mp4"</span>
                    <div >

<?php
if(!empty($edit_form->video_file)){
?>
<table class="" style="margin-left:10px">
<tbody class="files" id="product_files_content">    
    <tr class="template-download " id="delete-file">
        <td width="60%" class="name"><?=$edit_form->video_file?></td>
        <td width="10%" align="right" class="delete" >
        <a href="javascript:void(0);"  class="btn" onclick="delete_video(<?=$edit_form->rand_id?>)" >
	        <i class="fa fa-times"></i>
        </a>
        </td>
    </tr>
</tbody>
</table>
<?php
}
else{
?>        
<div class="" style="margin-left:-10px;margin-top:2px;">

<div id="fileuploader" class="fileuploader" style="background-color:#268abe"><i class="fa fa-plus"></i> Upload</div>

<span id="filesUpload" class="filesUpload"></span>

<div id="status"></div>        		            

<div style="clear:both"></div>                    
<table class="" style="margin-top:10px;margin-left:10px">
<tbody class="files" id="product_files_content">
</tbody>
</table>

</div>
<?php
}

?>
                            </div>
                      
                </div>
              </div> 
            </div>
          </div>
        </div>  
    </div>
   <!--@Differentiate NEWS or Video or Audio -->    
  </div>  
<?=form_open(NULL, array('class' => ' edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<input type="hidden" name="s_date" id="input-s_date" value="<?=$edit_form->s_date?>" />
<input type="hidden" name="e_date" id="input-e_date"  value="<?=$edit_form->e_date?>" />
<input type="hidden" name="file_name" id="file-name" value="<?=$edit_form->video_file?>" />
<div class="card-body" style="padding-top:0">
<div class="row">
    <div class="col-md-6 form-group">
        <label>OR Video Link</label>
        <input type="text" name="video_link" value="<?=$edit_form->video_link?>" class="form-control" >
    </div>

    <div class="col-md-6 form-group">
        <label>Set Order</label>
        <input type="number" name="set_order" value="<?=$edit_form->set_order?>" class="form-control" />
    </div>
</div>

  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Episode Name</label>
        <span class="help">e.g. "Buying Tips"</span>
        <input type="text" name="name" value="<?=$edit_form->name?>" id="ep-name" class="form-control" required>
      </div>
      <div class="row">
          <div class="col-md-6 form-group">
            <label>Series Number</label>
            <span class="help">e.g. "3"</span>
            <div class="required">
              <input type="number" name="series_number" value="<?=$edit_form->series_number?>" id="input-series-number" class="form-control" required>
<!--<select class="full-width" data-init-plugin="select2" required>
<option value="">Select</option>
<?php
for($i=1;$i<=100;$i++){
?>
<option value="<?=$i?>"><?=$i?></option>
<?php	
}
?>  
</select>-->            
            </div>
          </div>
          <div class="col-md-6 form-group">
            <label>Episode Number</label>
            <span class="help">e.g. "65"</span>
            <div class="form-group form-group-default required">
              <input type="number" name="episode_number" value="<?=$edit_form->episode_number?>" id="input-episode-number" class="form-control" required>
            </div>
          </div>
      </div> 
      <div class="row">
          <div class="col-md-6 form-group">
            <label>Show Length</label>
            <span class="help">e.g. "12"</span>
            <div class="form-group form-group-default required">
              <input type="text" name="show_length" value="<?=$edit_form->show_length?>" class="form-control" required>
            </div>
          </div>
          <div class="col-md-6 form-group">
            <label>Units</label>
            <span class="help">e.g. "Minutes"</span>
            <div class="required">
              <select class="full-width" name="units" data-init-plugin="select2">
                  <optgroup label="Time">
                    <option value="MIN" <?=$edit_form->units=='MIN'?'selected':''?> >Minutes</option>
                    <option value="HRS" <?=$edit_form->units=='HRS'?'selected':''?> >Hours</option>
                    <option value="SEC" <?=$edit_form->units=='SEC'?'selected':''?> >Seconds</option>
                  </optgroup>
              </select>
            </div>
          </div>
          <div class="col-md-12 form-group">
            <label>Channel</label>
            <div class="required">
              <select name="channel_id" class="full-width" data-init-plugin="select2" onchange="select_channel()" id="input-channel" required>
<option value="">Select</option>
<?php
if($channel_list){
	foreach($channel_list as $set_category){
?>            
<option value="<?=$set_category->id?>" <?=$set_category->enabled==1?'selected':''?>  data-url="<?=$set_category->channel_url?>" ><?=$set_category->name?></option>
<?php
	}
}
?>            
              </select>
            </div>
            <label id="category-error" class="error" for="channel_id"></label>
            
          </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label>Publish Date</label>
        <span class="help">You can elect to start &amp; stop publishing at a date &amp; time</span>
        <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
        <input type="text" name="publish_date" value="<?=$edit_form->publish_date?>"  id="daterangepicker1" class="form-control" required/>
        </div>
      </div>     
      <div class="form-group">
        <label>TAGS</label>
        <span class="help">e.g. "Corelogic, Auction, "</span>
        <input class="tagsinput custom-tag-input form-control"  type="text" name="tags" value="<?=$edit_form->tags?>" required/>
      </div>
      <div class="form-group p-t-5">
          <label>Who's in it?</label>
          <span class="help">e.g. "Bernice Ross, Sherrie Storor, "</span>
          <input class="tagsinput custom-tag-input form-control" name="users" type="text" value="<?=$edit_form->users?>"  />
      </div>
      <div class="col-md-12 form-group">
            <label>Category</label>
            <span class="help">Adding to a category adds this area to the home page.</span>
            <div class="required">
<select name="category" class="full-width" data-init-plugin="select2" required>
	<option value="" >Select</option>
<?php
if($category_list){
	foreach($category_list as $set_category){
?>            
<option value="<?=$set_category->id?>" <?=$set_category->id==$edit_form->category?'selected':''?>><?=$set_category->name?></option>
<?php
	}
}
?>            
              </select>
            </div>
            <label id="category-error" class="error" for="category"></label>
          </div>
    </div>

<div class="col-md-12">
      <div class="row">
          <div class="col-md-12 form-group">
            <label>Show Link</label>
            <span class="help">Shortcut to access the show directly</span>
              <div class="input-group transparent">
                <div class="input-group-prepend">
                  <span class="input-group-text transparent">www.propertytv.io
                    </span><span class="input-group-text transparent">channel
                    </span><span class="input-group-text transparent text-channel"></span>
                    </span><span class="input-group-text transparent text-danger url-eps-name"><?=$edit_form->slug?>
                    </span>
                    <span class="input-group-text transparent text-danger url-s-number">s<?=$edit_form->series_number?>
                    </span><span class="input-group-text transparent text-danger url-eps-number">ep<?=$edit_form->episode_number?>
                    </span>
                </div>
                  <input type="hidden" value="<?=$channels?site_url('channel/'.$channels->channel_url.'/'.$edit_form->slug.'/s'.$edit_form->series_number.'/ep'.$edit_form->episode_number):''?>" id="input-copy" class="form-control" >
                  <span class="p-l-15 p-t-5">
                      <a href="javascript:;" onclick="copyToClipboard()">
                      <i class="fa fa-copy"></i> copy url</a>
                  </span>
              </div>
            
          </div>  
      </div>
      
</div>

<div class="col-lg-12"> 
    <div class="card-title">
      <h5>Features <span title="Mouse over each help text below to view more detail" class="help small"> </span>
        </h5>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label>On-Demand</label>
          <span title="This is on by default, turning this off will hide the video from your channel page" class="help">Your Channel</span>
          <div>
            <input type="checkbox" name="on_demand" value="1" data-init-plugin="switchery" <?=$edit_form->on_demand==1?'checked="checked"':''?> />
          </div>
        </div>
        <div class="col-md-3 form-group">
          <label>Broadcast LIVE</label>
          <span title="Once released, you will be able to Broadcast LIVE to the world instantaneously" class="help">Coming Soon</span>
          <div >
              <input type="checkbox" data-init-plugin="switchery" disabled="" />
          </div>
        </div>
        <div class="col-md-3 form-group">
          <label>Featured</label>
          <span title="This area is the top selected shows below the main large video" class="help">Top feature area</span>
          <div>
            <input type="checkbox" name="is_featured" value="1" data-init-plugin="switchery" <?=$edit_form->is_featured==1?'checked="checked"':''?> />
          </div>
        </div>
        <div class="col-md-3 form-group">
          <label>Complex Area</label>
          <span title="This the collection of videos in the middle of your channel page"  class="help">Large multi-player</span>
          <div >
            <input type="checkbox" name="is_complex" value="1" data-init-plugin="switchery" <?=$edit_form->is_complex==1?'checked="checked"':''?> />
          </div>
        </div>
    </div>
  </div>
<div class="col-lg-12"> 
<div class="row">
    <div class="col-md-3 form-group">
      <label>Hero Area</label>
      <span title="This area is the large video at the very top of your channel page" class="help">Very top video</span>
      <div>
        <input type="checkbox" name="is_slider" value="1" data-init-plugin="switchery" <?=$edit_form->is_slider==1?'checked="checked"':''?> />
      </div>
    </div>
</div>
</div>

    
  </div>
  <div class="row">
    <div class="col-md-12">  
      <div class="form-group">
            <label>Short Summary</label>
            <span class="help">This appears at the top of the article and in is used Search Engines like Google.</span>
            <textarea class="form-control" name="short_description" id="name" placeholder="Some use this area as a secondry headline, reminder of when your show airs and how to watch."><?=$edit_form->short_description?></textarea>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">    
          <label>Main Article</label>
            <span class="help">Add text to form an article. Embed code is permitted.</span>
            <div class="summernote-wrapper required">
                <textarea id="summernote" name="description" class="required"><?=$edit_form->description?></textarea>
          </div>
          <div class="checkbox check-warning">
                  <input type="checkbox" name="is_article" value="1" id="checkbox6" <?=$edit_form->is_article==1?'checked':''?> >
                  <label for="checkbox6">Check this box to create as an article?</label>
                  <span class="help">You can create this show as an article, it will appear in your channel and referenced from the Property TV article pages.</span>
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
    <div class="col-md-6">
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

<input type="file" name="image" <?=!empty($edit_form->image)?'':'required'?>></span>

<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

</div>

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
    
    <!--    <button type="button" class="btn btn-warning btn-cons btn-animated from-top fa fa-save">
      <span>Save Draft</span>
    </button>-->
  </div>
<?=form_close()?>
      </div>
    </div>
    <!-- END card -->
        
  
  <div class="p-l-15 p-r-15"></div>
  <hr>
</div>
</div>
<!-- END card -->

<script>
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

$( ".edit-form" ).validate({
	messages: {
		category: {
			required: "Please create a Category first",
		},
	}, 

	submitHandler: function (form) {
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('.submitBtn').html(loadingText);
/*		$('.submitBtn').prop('disabled', true)
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('.submitBtn').html(loadingText);*/
		return true;
	}
});
</script>
<script>

$('#ep-name').keyup(function() {
	str = $(this).val();
	str = str.replace(/\s+/g, '-').toLowerCase();
    $('.url-eps-name').html(str);
});

$('#input-series-number').keyup(function() {
	str = $(this).val();
	str = str.replace(/\s+/g, '-').toLowerCase();
    $('.url-s-number').html('s'+str);
});

$('#input-episode-number').keyup(function() {
	str = $(this).val();
	str = str.replace(/\s+/g, '-').toLowerCase();
    $('.url-eps-number').html('eps'+str);
});
</script>
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

<link href="assets/plugins/uploader/css/uploadfile.css" rel="stylesheet">
<script src="assets/plugins/uploader/js/jquery.uploadfile.min.js"></script>
<script>

$(document).ready(function(){
	$(".fileuploader").uploadFile({
		url:"<?=$_cancel.'/ajax_upload'?>",
		fileName:"myfile",
		formData: {<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		showStatusAfterSuccess:false,
		uploadButtonClass:"ajax-file-upload-blue",
		allowedTypes:"mp4",
		multiple: false,
		onSuccess:function(files,data,xhr){
			var obj = jQuery.parseJSON(data);
			if(obj.result=='error'){
				$('.ajax-file-upload-statusbar').hide();
				$("#status").html("<font color='red'>"+obj.msg+"</font>");
			}
			else if(obj.result=='success'){
				//$("#status").html("<font color='red'>image is uploaded. </font>");
				//var pic_id = '<input type="hidden" name="more_pic[]" value="'+obj.msg+'" />';
				$('#file-name').val(obj.msg);
				refresh_image(obj.msg);
				//window.location.href = "front/videos/"+$("#video_id").val();
			}
		},
		onError: function(files,status,errMsg){		
			$("#status").html("<font color='red'>"+errMsg+"</font>");
		}

	});
});

function refresh_image(id){
	html = $('#uploaded_img').html();
	//console.log(html);
	html = html.replace(/%%IMAGE%%/g, id);
	//console.log(html);
	$('#product_files_content').html(html);

}

function delete_files(id){
	$('#delete-file-1').remove();
	$('#file-name').val('');
}

function delete_video(id){
	$.ajax({
		type:"GET",
		url:"<?=$_cancel.'/delete_video'?>",
		data:{id:id},
		dataType: 'json',
		success:function(data){
			$('#delete-file').remove();
			$('#file-name').val('');
			location.reload();
		}
	});
}

function copyToClipboard() {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val($("#input-copy").val()).select();
	document.execCommand("copy");
	$temp.remove();
}
function select_channel(){
	text_channel = $('#input-channel :selected').attr('data-url');
	$('.text-channel').html(text_channel);
}
select_channel();
</script>

<script id="uploaded_img" type="text/html">
<tr class="template-download " id="delete-file-1">
            <td width="60%" class="name">%%IMAGE%%</td>
        <td width="10%" align="right" class="delete" >
            <a href="javascript:void(0);"  class="btn" onclick="delete_files()" >
                <i class="fa fa-times"></i>
            </a>
        </td>
    </tr>
</script>
<script>
$(function() {
	$('#daterangepicker1').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'DD/MM/YYYY H:mm'
        }, function(start, end, label) {
//            console.log(start.toISOString(), end.toISOString(), label);
			$('#input-s_date').val(start.format('YYYY-MM-DD H:mm'));
			$('#input-e_date').val(end.format('YYYY-MM-DD H:mm'));
	});
});
</script>