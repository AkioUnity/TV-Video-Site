<script type="text/javascript" src="assets/global/plugins/jquery.blockui.min.js"></script>
<link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
			<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>                              
                      <div id="more_pic" style="display:none"></div>
                                
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],288);?></label>
                      <div class="col-lg-10">
                        <?php echo form_dropdown('template', $templates_page, $this->input->post('template') ? $this->input->post('template') : $page->template, 'class="form-control"'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],289);?></label>
                        <div class="col-md-10">
                            <div class="checkbox">
                                <label>
                        <?=form_checkbox('top_menu', '1', set_value('top_menu', $page->top_menu), 'id="inputDefault" class=""')?>
                                </label>
                            </div>                                        
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?=show_static_text($adminLangSession['lang_id'],290);?></label>
                        <div class="col-md-10">
                            <div class="checkbox">
                                <label>
                            <?=form_checkbox('bottom_menu', '1', set_value('bottom_menu', $page->bottom_menu), 'id="inputDefault" class=""')?>
                                </label>
                            </div>                                        
                        </div>
                    </div>
    
                     <hr />
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],263);?></label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($page->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/pages').'/'.$page->image.'" >'; ?>
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
                    
                            <div class="form-group" >
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>
                              <div class="col-lg-10">
                                <?=form_input('name', set_value('name', $page->{'name'}), 'class="form-control " ')?>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],276);?></label>
                              <div class="col-lg-10 ">
                                <?=form_textarea('description', html_entity_decode(set_value('description', $page->{'description'})), 'placeholder="Body" rows="3" class="cleditor2 form-control "')?>
                              </div>
                            </div>
                            
                   
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
                            <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
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
<script>
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
var IMAGE_PATH = '<?=site_url('assets/uploads/pages/')?>';
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
			data.append("folder", 'pages');
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
