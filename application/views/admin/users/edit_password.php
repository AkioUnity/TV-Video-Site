<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div data-sortable-id="form-stuff-1" class="panel panel-inverse">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
                <?php //echo validation_errors();?>
<?php //echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
	<input type="hidden" name="crop_image" id="input-crop-image" value="" />
<div class="form-body">                    
    <div class="form-group" >
	<label class="col-lg-2 control-label">New Password</label>
    <div class="col-md-10">
	    <?=form_input('password', set_value('password', $form_data->{'password'}), 'class="form-control " required')?>
    	<span class="error-span"><?php echo form_error('password'); ?></span>
    </div>
</div>

          
</div>
         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
	        <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text(1,235)?>"><?=show_static_text(1,235)?></button>
                        <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text(1,22);?></a>
                    </div>
                </div>
            </div>
     <?=form_close()?>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
</div>


<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}
</script>

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



<div class="modal fade" id="cropModal" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                ×</button>
            <h4 class="modal-title" id="myModalLabel">Crop Image</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div id="upload-demo"></div>
                <div class="col-md-12" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;min-height:45px;">
                            <input type="file" id="upload">
                            <br/>
                            <button class="btn btn-success upload-result" disabled="disabled">Crop</button>
                </div>                    
            </div>
        </div>
    </div>
</div>
</div>
