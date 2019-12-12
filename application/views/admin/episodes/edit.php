<?php
/*$tagArr = array();
if(!empty($form_data->tags)){
	$tagArr = explode(',',$form_data->tags);
}*/
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
                <?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             
                    <input type="hidden" name="video_file" id="file-name" value="<?=$form_data->video_file?>" />
<div class="form-body">

<div class="form-group">
<label class="col-md-2 control-label">Package</label>
<div class="col-md-10">
<select class="form-control" name="package_id" required>
<option value="" >Select</option>
<?php
$post_package_id = $this->input->post('package_id');
if($packages_list){
	foreach($packages_list as $set_author){
	$selected = '';
	if($post_series_id){
		if($set_author->id==$post_package_id){
			$selected = 'selected="selected"';
		}
	}
	else if($set_author->id==$form_data->package_id){
		$selected = 'selected="selected"';
	}

?>
<option value="<?=$set_author->id;?>"  <?=$selected;?> ><?=$set_author->name;?></option>
<?php
}
}
?>

</select>
</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Episode Name</label>
	<div class="col-md-10">
		<?=form_input('name', set_value('name', $form_data->{'name'}), 'class="form-control " required')?>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label">Series</label>
	<div class="col-md-5">
<select class="form-control" name="series_id" required>
<option value="" >Select</option>
<?php
$post_series_id = $this->input->post('series_id');
if($series_list){
	foreach($series_list as $set_author){
	$selected = '';
	if($post_series_id){
		if($set_author->id==$post_series_id){
			$selected = 'selected="selected"';
		}
	}
	else if($set_author->id==$form_data->series_id){
		$selected = 'selected="selected"';
	}

?>
<option value="<?=$set_author->id;?>"  <?=$selected;?> ><?=$set_author->name;?></option>
<?php
}
}
?>

</select>
</div>    
	<div class="col-md-5">
		<input type="number" name="episode" value="<?=set_value('episode', $form_data->{'episode'})?>" class="form-control" placeholder="Episode Number" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Show Length</label>
	<div class="col-md-5">
			<input type="number" name="length" value="<?=set_value('length', $form_data->{'length'})?>" min="0" class="form-control " required>
	</div>
	<div class="col-md-5">
<select class="form-control" name="length_type" >
<?php
foreach($length_type as $val){
		$selected = '';
?>
<option value="<?=$val;?>"  <?=$val==$form_data->length_type?'selected="selected"':'';?> ><?=$val;?></option>
<?php
}
?>

</select>    
	</div>
</div>


<div class="form-group">
<label class="col-md-2 control-label">Show Summary</label>
<div class="col-md-10">
<?=form_textarea('summary', html_entity_decode(set_value('summary', $form_data->{'summary'})), ' class=" form-control"')?>
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">&nbsp;</label>
	<div class="col-md-10">
		<div class="row">
<div class="col-md-4">
	<div class="checkbox-inline">
		<label><?=form_checkbox('is_featured_video', '1', set_value('is_featured_video', $form_data->is_featured_video), 'class=""')?> Featured Video</label>
	</div>                                        
</div>
<div class="col-md-4">
	<div class="checkbox-inline">
		<label><?=form_checkbox('is_featured_show', '1', set_value('is_featured_show', $form_data->is_featured_show), 'class=""')?>Featured Show</label>
	</div>                                        
</div>
<div class="col-md-4">
	<div class="checkbox">
<select class="form-control" name="category" >
<option value="" >Add To Category</option>
<?php
$post_category = $this->input->post('category');
foreach($section_type as $set_author){
	$selected = '';
	if($post_category){
		if($set_author==$post_category){
			$selected = 'selected="selected"';
		}
	}
	else if($set_author==$form_data->category){
		$selected = 'selected="selected"';
	}
?>
<option value="<?=$set_author;?>"  <?=$selected;?> ><?=$set_author;?></option>
<?php
}
?>

</select>
	</div>                                        
</div>
		</div><!--roww-->
	</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">Author</label>
<div class="col-md-5">

<select class="form-control" name="author_id" required>
<option value="" >Select</option>
<?php
$post_category = $this->input->post('author_id');
if($authors_list){
	foreach($authors_list as $set_author){
	$selected = '';
	if($post_category){
		if($set_author->id==$post_category){
			$selected = 'selected="selected"';
		}
	}
	else if($set_author->id==$form_data->author_id){
		$selected = 'selected="selected"';
	}

?>
<option value="<?=$set_author->id;?>"  <?=$selected;?> ><?=$set_author->name;?></option>
<?php
}
}
?>

</select>
</div>
<div class="col-md-5">
	<?=form_input('label', set_value('label', $form_data->{'label'}), 'class="form-control "  placeholder="Label" required')?>
</div>
</div>

<div class="form-group" >
	<label class="col-md-2 control-label">Publish</label>
	<div class="col-md-10">
		<div class="row">
        <div class="col-md-3">
            <input class="form-control input-date" type="text" id="i-s-date" name="s_date" value="<?=h_dateFormat(set_value('s_date', $form_data->{'s_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy" required   />
            <span class="error-span"><?php echo form_error('s_date'); ?></span>
        </div>

		<div class="col-md-3">
<select name="s_time"  class="form-control" required>
<option value="">Time</option>
<?php
foreach($time_data as $key=>$val){
?>
	<option value="<?=$key?>" <?=$form_data->e_time==$key?'selected':''?> ><?=$val?></option>
<?php	
}
?>      
      </select>
</div>

	    <div class="col-md-3">
    		<input class="form-control input-date" type="text" id="i-e-date" name="e_date" value="<?=h_dateFormat(set_value('e_date', $form_data->{'e_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy"   />
		    <span class="error-span"><?php echo form_error('e_date'); ?></span>
		</div>
        <div class="col-md-3">
<select name="e_time"  class="form-control" required>
<option value="">Time</option>
<?php
foreach($time_data as $key=>$val){
?>
<option value="<?=$key?>" <?=$form_data->e_time==$key?'selected':''?> ><?=$val?></option>
<?php	
}
?>      
  </select>
</div>
	</div>
	</div>
</div>


<div class="form-group">
    <label class="col-md-2 control-label">Tags</label>
    <div class="col-md-10">
        <?=form_input('tags', set_value('tags', $form_data->{'tags'}), 'class="form-control " data-role="tagsinput"')?>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Link</label>
        <div class="col-md-10">
            <?=form_input('link', set_value('link', $form_data->{'link'}), 'class="form-control "')?>
    </div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">&nbsp;</label>
<div class="col-lg-10">Password Protect Page?
<input type="checkbox" name="is_password" value="1" <?=$form_data->is_password==1?'checked="checked"':''?> onclick="set_secure();" id="input-is_secure" />

<div class="shipping-box">
        <input type="text" name="password" value="<?=set_value('password',$form_data->password)?>"  placeholder="Set Password" class="form-control " required>
</div>
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">Description</label>
<div class="col-md-10">
<?=form_textarea('description', html_entity_decode(set_value('description', $form_data->{'description'})), ' class="cleditor2 form-control"')?>
</div>
</div>


<div class="form-group">
      <label class="col-md-2 control-label">Square Image</label>
        <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo (isset($form_data->square_image)&&!empty($form_data->square_image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->square_image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
            <input type="file" name="square_image" ></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
        </div>
            
      </div>
      </div>
      
<div class="form-group">
      <label class="col-md-2 control-label">Featured Show Tile</label>
        <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo (isset($form_data->featured_image)&&!empty($form_data->featured_image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->featured_image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
            <input type="file" name="featured_image" ></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
        </div>
            
      </div>
      </div>      
      
<div class="form-group">
      <label class="col-md-2 control-label">Featured Video Tile</label>
        <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo (isset($form_data->featured_video_image)&&!empty($form_data->featured_video_image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->featured_video_image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
            <input type="file" name="featured_video_image" ></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
        </div>
            
      </div>
      </div>
      
<div class="form-group">
<label class="col-md-2 control-label">Article Image</label>
<div class="col-md-10">
<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
        <?php echo (isset($form_data->article_image)&&!empty($form_data->article_image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->article_image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
    </div>
    <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
    <input type="file" name="article_image" ></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
</div>
</div>
    
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Video Link</label>
<div class="col-lg-10">
<?=form_input('video_link', set_value('video_link', $form_data->{'video_link'}), 'class="form-control "')?>
</div>
</div>
<div class="form-group">
<label class="col-md-2 control-label">Or Video</label>
<div class="col-md-10">
<?php
if(!empty($form_data->video_file)){
?>
<table class="" style="margin-left:10px">
<tbody class="files" id="product_files_content">    
<tr class="template-download fade in" id="delete-file">
<td width="60%" class="name"><?=$form_data->video_file?></td>
<td width="10%" align="right" class="delete" >
<a href="javascript:void(0);"  class="btn" onclick="delete_video(<?=$form_data->id?>)" >
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
<div class="" style="margin-left:-10px;margin-top:10px;">
<div id="fileuploader" class="fileuploader" style="background-color:#268abe"><i class="fa fa-plus"></i> Upload</div>
<span id="filesUpload" class="filesUpload"></span>
<div id="status"></div>        		            
<div style="clear:both"></div>                    
<br>
<span>Please upload mp4 file.</span>
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
      
<div class="form-group">
<label class="col-lg-2 control-label">Date</label>
<div class="col-lg-10">
<input type="text" name="dates" value="<?=set_value('dates', h_dateFormat($form_data->{'dates'},'d-m-Y'))?>" id=""  class="form-control input-date" required="required" data-date-format="dd-mm-yyyy" />
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">&nbsp;</label>
	<div class="col-md-10">
	<div class="checkbox-inline">
		<label><?=form_checkbox('is_top_pick', '1', set_value('is_top_pick', $form_data->is_top_pick), 'class=""')?> Top Pick</label>
	</div>                                        
</div>
</div>

<div class="form-group">
<label class="col-md-2 control-label">&nbsp;</label>
	<div class="col-md-10">
	<div class="checkbox-inline">
		<label><?=form_checkbox('is_draft', '1', set_value('is_draft', $form_data->is_draft), 'class=""')?> Draft</label>
	</div>                                        
</div>
</div>
      

</div>


                        
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Save">Save</button>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button">Back</a>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                </div>
                            </div>
                        </div>
                    <?=form_close()?>

            </div>
        </div>
        <!-- end panel -->
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
$(document).ready(function () {
    $(".edit-form").submit(function () {
//        $(".submitBtn").attr("disabled", true);
		$(".submitBtn").button('loading');
        return true;
    });
});
</script>


<link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script>
	var IMAGE_PATH = '<?=site_url('assets/uploads/news/')?>';
	$('.cleditor2').summernote({
	height: 300,
	callbacks : {
		onImageUpload: function(files, editor, welEditable) {
			$.blockUI({ message: '<img src="assets/uploads/loading1.gif" style="width:100px;height:100px;" />' ,
			css: { width: '30%', border:'0px solid #FFFFFF', background:'none',cursor:'wait'},
			  overlayCSS:  { cursor:'wait'} 
			});
			data = new FormData();
			data.append("file", files[0]);
			data.append('<?=$this->security->get_csrf_token_name();?>','<?=$this->security->get_csrf_hash();?>');
			data.append("folder", 'news');
			$.ajax ({
				data:data,
				type: "POST",
				url: "ajax_editor/ajax_upload",
				cache: false,
				contentType: false,
				processData: false,
				success: function(url) {
					$.unblockUI();
					var image = IMAGE_PATH + url;
					$('.cleditor2').summernote('insertImage', image);
					//console.log(image);
					},
					error: function(data) {
						console.log(data);
					}
			});
		}
	}
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
			$("#status").html("<font color='red'>There is some problem</font>");
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
		type:"POST",
		url:"<?=$_cancel.'/delete_video'?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success:function(data){
			$('#delete-file').remove();
			$('#file-name').val('');
			location.reload();
		}
	});
}
</script>
<script id="uploaded_img" type="text/html">
<tr class="template-download fade in" id="delete-file-1">
            <td width="60%" class="name">%%IMAGE%%</td>
        <td width="10%" align="right" class="delete" >
            <a href="javascript:void(0);"  class="btn" onclick="delete_files()" >
                <i class="fa fa-times"></i>
            </a>
        </td>
    </tr>
</script>


<link href="assets/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
$(document).ready(function(){
	$('.input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

});

var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

var checkin = $('#i-s-date').datepicker({
    beforeShowDay: function(date) {
       // return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.viewDate.valueOf()){
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout.setDate(newDate);		
    }
    else {
        checkout.setDate(ev.date + 1);
    }
    
    checkin.hide();
    $('#i-e-date')[0].focus();
}).data('datepicker');

var checkout = $('#i-e-date').datepicker({
    beforeShowDay: function(date) {
        return date.valueOf() <= checkin.viewDate.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    checkout.hide();
}).data('datepicker');

</script>

<link href="assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet" type="text/css" />
<script src="assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<style>
.bootstrap-tagsinput{
	width:100%;
}
</style>

<script>
function set_secure(){
	val = $('#input-is_secure'). prop("checked") ;
	if(val==true){
		$('.shipping-box input').attr("required", true);
		$('.shipping-box').show();
	}
	else{
		$('.shipping-box input').attr("required", false);
		$('.shipping-box').hide();
	}
}
set_secure();

</script>