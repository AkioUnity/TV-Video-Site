<?php
/*$tagArr = array();
if(!empty($form_data->tags)){
	$tagArr = explode(',',$form_data->tags);
}*/
?>

<style>
.files-list 
{ 
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 100%; 
}
.files-list li 
{
    margin: 3px 3px 3px 0; 
    padding: 1px; 
    display:block;
    float: left; 
    width: 164px; 
    height: auto;
    border:1px solid #E5E5E5;
    position:relative;
}


.files-list li .btn-default
{
    text-align:center;
}

.files-list li:hover{
    background: #F5F5F5;
}

</style>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
                <?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?> 
                <div id="more_pic" style="display:none"></div>
                                                             
<div class="form-body">

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
        <?php echo (isset($form_data->article_image)&&!empty($form_data->article_image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->article_image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
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
      
      
<div class="form-group">
<label class="col-lg-2 control-label">Sponsor Link</label>
<div class="col-lg-10">
<?=form_input('sponsor_link', set_value('sponsor_link', $form_data->{'sponsor_link'}), 'class="form-control "')?>
</div>
</div>
      
<div class="form-group">
<label class="col-lg-2 control-label">Sponsor Image</label>
<div class="col-md-10">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
    <?php echo (isset($form_data->sponsor)&&!empty($form_data->sponsor)) ? '<img src="'.base_url('assets/uploads/news').'/'.$form_data->sponsor.'" >':'<img src="assets/uploads/no-image.gif">'; ?>
</div>
<div>
<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
<input type="file" name="sponsor_image" id="logo"></span>
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

    <div class="col-md-12">
    <div class="portlet box green">
        <div class="portlet-body">
            <div class="panel-body">
<div class="col-md-12" style="">

          <div class="widget wlightblue">
            <div class="widget-content">
<form role="form" action="" id="comment_form">
<input type="hidden" name="comment_form" value="set">                    	
<div class="form-group">
<label class="col-sm-2 control-label"><?=show_static_text($lang_id,277);?>:</label>  
<div class="col-sm-4">
<div id="fileuploader" class="fileuploader" style="background-color:#52B6EC"><?=show_static_text($lang_id,278);?></div>
<span id="filesUpload" class="filesUpload"></span>
<div id="status"></div>        		            
</div>
</div>
<div style="clear:both"></div>                    
</form>

<div id="product_files_content">
  <ul ui-sortable="sortableOptions" ng-model="leftArray" class="files files-list ui-sortable">
<?php
if(isset($products_file)&&!empty($products_file)){
foreach($products_file as $set_products_file){
?>
<li class="item" id="product_image_<?=$set_products_file->id?>" data-id="<?=$set_products_file->id?>" >
<div class="pi-img-wrapper">
<img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/news/<?=$set_products_file->filename?>"></a>
</div>
<div class="file-option" style="text-align:center">
<button  class="btn btn-default" onclick="delete_image('<?=$set_products_file->id?>')" href="javascript:void(0)" style="margin-top:10px">Delete</button>
</div>
</il>
<?php
}
}
?>    
</ul>
</div>
              
            </div>
              
          </div>  
          
        </div>

        </div>
        </div>
</div>
</div>
<link href="assets/plugins/uploader/css/uploadfile.css" rel="stylesheet">
<script src="assets/plugins/uploader/js/jquery.uploadfile.min.js"></script>
<script>
var moreCount = 0;

$(document).ready(function(){
	$(".fileuploader").uploadFile({
		url:"<?=$_cancel.'/ajax_upload'?>",
		fileName:"myfile",
		formData: {<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>',page_id:'<?=isset($page->id)?$page->id:0?>'},
		showStatusAfterSuccess:false,
		uploadButtonClass:"ajax-file-upload-blue",
		allowedTypes:"*",
		multiple: true,
		onSuccess:function(files,data,xhr){
			var obj = jQuery.parseJSON(data);
			if(obj.result=='error'){
				$('.ajax-file-upload-statusbar').hide();
				$("#status").html("<font color='red'>"+obj.msg+"</font>");
			}
			else if(obj.result=='success'){
				var pic_id = '<input type="hidden" name="more_pic[]" value="'+obj.msg+'" class="more-img-'+moreCount+'" />';
				$('#more_pic').append(pic_id);
				refresh_image(obj.msg,1);
				moreCount++;
			}
			
		},
		onError: function(files,status,errMsg){		
			$("#status").html("<font color='red'>Upload is Failed</font>");
		}

	});
});

function refresh_image(d_img,page_id){
	html = $('#uploaded_img').html();
	//console.log(html);
	html = html.replace(/%%ID%%/g, page_id);
	html = html.replace(/%%IMAGE%%/g,d_img);
	//console.log(html);
	$('.files-list').append(html);

}

function delete_image(id){
	$.ajax({
		type:"GET",
		url:"<?=$_cancel.'/delete_image'?>",
		data:{id:id},
		success:function(data){
			$('#product_image_'+id).remove();
		}
	});
}
</script>
<script id="uploaded_img" type="text/html">
<li class="item" id="product_image_%%ID%%" data-id="%%ID%%" >
	<div class="pi-img-wrapper">
		<img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/news/%%IMAGE%%"></a>
	</div>
</il>
</script>

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

<script>
function get_sub_category(id){	
	$('#sub-category').html('<option value="0">Select</option>');
	$.ajax({
		type:"POST",
		url:"ajax_category/ajaxGetSubcategory",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		dataType: 'json',
		success: function(json) {	
			if(json.status=='ok'){
				$('#sub-category').html(json.msge);
			}
			if(json.status=='error'){
				$('#sub-category').html('<option value="0">Select</option>');
			}
		}
		
	});
}


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
