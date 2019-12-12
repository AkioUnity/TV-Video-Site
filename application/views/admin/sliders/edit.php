<div class="row">

    <div class="col-md-12">

        <div class="portlet box green">

            <div class="portlet-title"><div class="caption"><?=$name?></div></div>

            <div class="portlet-body">

    	        <?php echo validation_errors();?>

			<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                              

                    <input type="hidden" name="file_name" id="file-name" value="<?=$page->video_file?>" />

                <div class="form-body">                                        

                    

                    <div class="form-group" >

                      <label class="col-lg-2 control-label">Name of presenter</label>

                      <div class="col-lg-10">

                        <?=form_input('user_name', set_value('user_name', $page->{'user_name'}), 'class="form-control " id=""')?>

                      </div>

                </div>



                    <div class="form-group" >

                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>

                      <div class="col-lg-10">

                        <?=form_input('name', set_value('name', $page->{'name'}), 'class="form-control " id="" ')?>

                      </div>

                </div>



                    <div class="form-group">

                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>

                      <div class="col-lg-10">

				      	<div class="fileinput fileinput-new" data-provides="fileinput">

							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">

                                <?php echo !isset($page->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sliders/thumbnails').'/'.$page->image.'" >'; ?>

                            </div>

							<div>

						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>

    	    	            <input type="file" name="logo" id="logo"></span>

						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>

                            

<?php

if(isset($page->image)&&!empty($page->image)){

echo '<a class="btn " href="'.$_cancel.'/remove_image/'.$page->id.'" onclick="" >'.show_static_text($adminLangSession['lang_id'],109).'</a>';

}

?>

                            

                     	</div>

                   		</div>

                            <!--<input type="file" name="logo" id="logo" />-->

                      </div>

                    </div>

           



<div class="form-group">

        <label class="col-md-2 control-label">Video</label>

        <div class="col-md-10">

<?php

if(!empty($page->video_file)){

?>

<table class="" style="margin-left:10px">

<tbody class="files" id="product_files_content">    

    <tr class="template-download fade in" id="delete-file">

        <td width="60%" class="name"><?=$page->video_file?></td>

        <td width="10%" align="right" class="delete" >

        <a href="javascript:void(0);"  class="btn" onclick="delete_video(<?=$page->id?>)" >

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

<div class="form-group" >

                      <label class="col-lg-2 control-label">Video Link</label>

                      <div class="col-lg-10">

                        <?=form_input('link', set_value('link', $page->{'link'}), 'class="form-control " id="" ')?>

                      </div>

                </div>    

                    

                    

					<div class="form-group">

                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2716);?>Description</label>

                      <div class="col-lg-10">

                        <?=form_textarea('description', set_value('description', $page->{'description'}), 'placeholder="" rows="3" class="cleditor2 form-control"')?>

                      </div>

                    </div>                                        

    

<div class="form-group" >

      <label class="col-lg-2 control-label">Link to article</label>

      <div class="col-lg-10">

        <?=form_input('article_link', set_value('article_link', $page->{'article_link'}), 'class="form-control " id="" ')?>

      </div>

</div>

<div class="form-group" >

      <label class="col-lg-2 control-label">Link to watch now</label>

      <div class="col-lg-10">

        <?=form_input('watch_link', set_value('watch_link', $page->{'watch_link'}), 'class="form-control " id="" ')?>

      </div>

</div>    

                </div>

                <div class="form-actions">

                    <div class="row">

                        <div class="col-md-offset-2 col-md-9">

                            <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>

                            <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>

                        </div>

                    </div>

                </div>

            <?=form_close()?>

            </div>

        </div>

        <!-- end panel -->

    </div>

</div>













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
	//		$("#status").html("<font color='red'>There is some problem</font>");

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

