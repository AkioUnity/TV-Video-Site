

<div class="row">

    <div class="col-md-12">

        <div class="portlet box green">

            <div class="portlet-title"><div class="caption"><?=$name?></div></div>

            <div class="portlet-body">

    	        <?php echo validation_errors();?>

                <?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             

<div class="form-body">





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
      
      
<div class="form-group">
      <label class="col-lg-2 control-label">Cover Image</label>
        <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">

            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">

                <?php echo (isset($form_data->cover_image)&&!empty($form_data->cover_image)) ? '<img src="'.base_url('assets/uploads/news/thumbnails').'/'.$form_data->cover_image.'" >':'<img src="assets/uploads/no-image.gif">'; ?>

            </div>

            <div>

            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>

            <input type="file" name="cover_image" ></span>

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

	$('.cleditor2').summernote({height: 300});

</script>

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

