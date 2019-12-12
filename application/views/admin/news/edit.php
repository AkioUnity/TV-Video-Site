

<div class="row">

    <div class="col-md-12">

        <div class="portlet box green">

            <div class="portlet-title"><div class="caption"><?=$name?></div></div>

            <div class="portlet-body">

    	        <?php echo validation_errors();?>

                <?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             

<div class="form-body">



<div class="form-group">

<label class="col-lg-2 control-label">Section Category</label>

<div class="col-lg-10">



<select class="form-control" name="section" id="" >

<option value="" >Select</option>

<?php

$post_category = $this->input->post('section');

foreach($section_type as $setCategory){

$selected = '';

if($post_category){

if($setCategory==$post_category){

$selected = 'selected="selected"';

}

}

else if($setCategory==$form_data->section){

$selected = 'selected="selected"';

}



?>

<option value="<?=$setCategory;?>"  <?=$selected;?> ><?=$setCategory;?></option>

<?php

}

?>



</select>

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





<div class="form-group">

<label class="col-lg-2 control-label"><?=show_static_text($lang_id,167);?></label>

<div class="col-lg-10">



<select class="form-control" name="category_id" id="select_category" onChange="get_sub_category(this.value);"  required>

<option value="" >Select</option>

<?php

$post_category = $this->input->post('category_id');

if(isset($categories_data)&&!empty($categories_data)){

foreach($categories_data as $setCategory){

$selected = '';

if($post_category){

if($setCategory->id==$post_category){

$selected = 'selected="selected"';

}

}

else if($setCategory->id==$form_data->category_id){

$selected = 'selected="selected"';

}



?>

<option value="<?=$setCategory->id;?>"  <?=$selected;?> ><?=$setCategory->name;?></option>

<?php

}

}

?>



</select>

</div>

</div>



<div class="form-group">

<label class="col-lg-2 control-label"><?=show_static_text($lang_id,269);?></label>

<div class="col-lg-10">

<select class="form-control" name="sub_category_id" id="sub-category" style=""  >

<option value="0">Select</option>

<?php

$post_s_c1 = $this->input->post('sub_category_id');



$s_c_data1 =array();

if($post_category){

$s_c_data1 = $this->comman_model->get_by('news_category',array('parent_id'=>$post_category),false);

}

else{

if($form_data->category_id)

$s_c_data1 = $this->comman_model->get_by('news_category',array('parent_id'=>$form_data->category_id),false);

}

if($s_c_data1){

$selected_s_c1 = $this->input->post('sub_category_id');

if($selected_s_c1){

}

else{

$selected_s_c1 = $form_data->sub_category_id;

}

foreach($s_c_data1 as $set_c_data1){

?>

<option value="<?=$set_c_data1->id;?>" <?=$selected_s_c1==$set_c_data1->id?'selected="selected"':''?> ><?=$set_c_data1->name;?></option>

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

<label class="col-lg-2 control-label">Description</label>

<div class="col-lg-10">

<?=form_textarea('description', html_entity_decode(set_value('description', $form_data->{'description'})), ' class="cleditor2 form-control"')?>

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

