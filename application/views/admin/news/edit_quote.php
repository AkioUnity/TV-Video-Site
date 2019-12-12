

<div class="row">

    <div class="col-md-12">

        <div class="portlet box green">

            <div class="portlet-title"><div class="caption"><?=$name?></div></div>

            <div class="portlet-body">

    	        <?php echo validation_errors();?>

                <?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             

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

<label class="col-lg-2 control-label">Heading</label>

<div class="col-lg-10">

<?=form_input('head_title', set_value('head_title', $form_data->{'head_title'}), 'class="form-control "')?>

</div>

</div>









<div class="form-group">

<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>

<div class="col-lg-10">

<?=form_input('name', set_value('name', $form_data->{'name'}), 'class="form-control "')?>

</div>

</div>



<div class="form-group">

<label class="col-lg-2 control-label">Link</label>

<div class="col-lg-10">

<?=form_input('link', set_value('link', $form_data->{'link'}), 'class="form-control "')?>

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

