<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
	            <form class="form-horizontal" role="form" method="post">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="form-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],16);?></label>
                    <div class="col-sm-4">
                        <input type="text"disabled="disabled" class="form-control" value="<?php echo $edit_data->name;?>">
                    </div>
                </div>
                <div class="form-group">                                          
                    <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],255);?></label>
                    <div class="col-sm-4">
                        <input type="text" name="subject" value="<?php echo $edit_data->subject;?>" class="form-control" placeholder="Subject">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-styles"><?=show_static_text($adminLangSession['lang_id'],55);?></label>
                    <div class="col-sm-10">
                            <textarea class="form-control cleditor2" name="message"  rows="5" style="height:300px" ><?php echo $edit_data->message;?></textarea>
                    </div>
                </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn btn-primary btn-label-left"><?=show_static_text($adminLangSession['lang_id'],235);?></button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>




<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
$(document).ready(function(){
    $('.cleditor2').ckeditor();
});
</script>
-->

<link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script>
	$('.cleditor2').summernote({height: 300});
</script>
