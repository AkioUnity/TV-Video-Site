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
    <label class="col-lg-2 control-label">Placement</label>
    <div class="col-lg-10">
<select name="order" class="form-control">
<option value="">Select</option>
<?php
for($i=1;$i<=6;$i++){
?>
	<option value="<?=$i?>" <?=$i==$form_data->order?'selected="selected"':''?>><?=$i?></option>
<?php	
}
?>
</select>    
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">Label</label>
    <div class="col-lg-10">
        <?=form_input('label', set_value('label', $form_data->{'label'}), 'class="form-control "')?>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">External URL Or</label>
        <div class="col-lg-10">
            <?=form_input('external_url', set_value('external_url', $form_data->{'external_url'}), 'class="form-control "')?>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">Article Link</label>
        <div class="col-lg-10">
            <?=form_input('link', set_value('link', $form_data->{'link'}), 'class="form-control "')?>
    </div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Author</label>
<div class="col-lg-10">

<select class="form-control" name="author_id" required>
<option value="" >Select</option>
<?php
$post_category = $this->input->post('author_id');
if($author_data){
	foreach($author_data as $set_author){
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
</div>


<div class="form-group" >
	<label class="col-lg-2 control-label">Publish</label>

	<div class="col-lg-5">
    <input class="form-control input-date" type="text" id="i-s-date" name="s_date" value="<?=h_dateFormat(set_value('s_date', $form_data->{'s_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy" required   />
    <span class="error-span"><?php echo form_error('s_date'); ?></span>
	</div>

    <div class="col-lg-5">
    <input class="form-control input-date" type="text" id="i-e-date" name="e_date" value="<?=h_dateFormat(set_value('e_date', $form_data->{'e_date'}),'d-m-Y')?>" data-date-format="dd-mm-yyyy"   />
    <span class="error-span"><?php echo form_error('e_date'); ?></span>
	</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>
<div class="col-lg-10">
<?=form_input('name', set_value('name', $form_data->{'name'}), 'class="form-control "')?>
</div>
</div>


<div class="form-group">
    <label class="col-lg-2 control-label">Tags</label>
    <div class="col-lg-10">
        <?=form_input('tags', set_value('tags', $form_data->{'tags'}), 'class="form-control " data-role="tagsinput"')?>
    </div>
</div>

<?php /*?><div class="form-group">
<label class="col-lg-2 control-label">Tags</label>
<div class="col-lg-10">

<select multiple="multiple" class="tags-select" name="tags[]" style="width:100%">
<?php
if($news_tag_list){
	foreach($news_tag_list as $value){
?>
	<option value="<?=$value->id;?>" <?=in_array($value->id,$tagArr)?'selected':''?> ><?=$value->name; ?></option>
<?php
	}
}
?>
</select>

</div>
</div><?php */?>


<div class="form-group">
<label class="col-lg-2 control-label">Description</label>
<div class="col-lg-10">
<?=form_textarea('description', html_entity_decode(set_value('description', $form_data->{'description'})), ' class="cleditor2 form-control"')?>
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Code</label>
<div class="col-lg-10">
<?=form_textarea('code', html_entity_decode(set_value('code', $form_data->{'code'})), ' class=" form-control"')?>
</div>
</div>

<div class="form-group">
      <label class="col-lg-2 control-label">Image</label>
        <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                <?php echo (isset($form_data->image)&&!empty($form_data->image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
            </div>
            <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
            <input type="file" name="image" id="logo"></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
        </div>
            <!--<input type="file" name="logo" id="logo" />-->
      </div>
      </div>
      
<div class="form-group">
<label class="col-lg-2 control-label">Article Image</label>
<div class="col-md-10">
<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
        <?php echo (isset($form_data->article_image)&&!empty($form_data->image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->article_image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
    </div>
    <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
    <input type="file" name="article_image" id="logo"></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
</div>
</div>
    <!--<input type="file" name="logo" id="logo" />-->
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

<!--<link href="assets/plugins/select2/select2.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/plugins/select2/select2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.tags-select').select2({placeholder: "Select Tags"});
});

</script>-->
