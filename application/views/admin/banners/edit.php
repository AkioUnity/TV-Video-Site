<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
				<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                          
	                <div class="form-body">
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Page Name</label>
                      <div class="col-lg-10">
                        <?php echo form_dropdown('template', $templates_page, $this->input->post('template') ? $this->input->post('template') : $page->template, 'class="form-control"'); ?>
                      </div>
                    </div>
                    
                    <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=lang('Name')?></label>
                  <div class="col-lg-10">
                    <?=form_input('name', set_value('name', $page->{'name'}), 'class="form-control " id="" placeholder="'.lang('Name').'"')?>
                  </div>
                </div>
                <div class="form-group" >
                  <label class="col-lg-2 control-label">Link</label>
                  <div class="col-lg-10">
                    <?=form_input('link', set_value('link', $page->{'link'}), 'class="form-control " id="" placeholder="link"')?>
                  </div>
                </div>
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=lang('image')?></label>
                      <div class="col-lg-10">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($page->image) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/banners').'/'.$page->image.'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
    	    	            <input type="file" name="logo" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            
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
                    <!--<div class="form-group">
                              <label class="col-lg-2 control-label">Code</label>
                              <div class="col-lg-10">
                                <?=form_textarea('desc', html_entity_decode(set_value('desc', $page->desc)), 'placeholder="Code" rows="3" class="cleditor2 form-control"')?>
                              </div>
                            </div>-->
					

    
                </div>
    	            <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <?=form_submit('submit', 'Save', 'class="btn btn-primary"')?>
                            <a href="<?=$_cancel?>" class="btn btn-default" type="button">Cancel</a>
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



<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 


<link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script>
	$('.cleditor2').summernote({height: 300});
</script>

