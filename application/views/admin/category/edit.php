<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
                <?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>                                                             
                        <div class="form-body">
                            <!--<div class="form-group">
                                <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],266);?></label>
                                <div class="col-lg-10">
                				<?=form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $form_data->parent_id, 'class="form-control"')?>
		                    	</div>
							</div>-->	


<div class="form-group">
<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],236);?></label>
<div class="col-lg-10">
<?=form_input('name', set_value('name', $form_data->{'name'}), 'class="form-control "')?>
</div>
</div>                        
<div class="form-group">
<label class="col-lg-2 control-label">Link</label>
<div class="col-lg-10">
<?=form_input('link', set_value('link', $form_data->{'link'}), 'class="form-control " required')?>
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
