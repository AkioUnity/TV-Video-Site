<script src="assets/plugins/jquery.validate.js"></script>   
<!-- START card -->
<div class="card card-default m-t-20">
<div class="card-body">
<div class="invoice padding-50 sm-padding-10">
    <!-- START card -->
    <div class="card card-default">
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => ' edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
<div class="card-header ">
<div class="card-title">
    <h5>Create</h5>
</div>
   <!--@Differentiate NEWS or Video or Audio -->    
  </div>  
<div class="card-body">
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="<?=$edit_form->name?>" class="form-control" required>
      </div>
      
<div class="form-group">
	<label>Set the Order of appearance, 0 = auto</label>
	<input type="number" name="set_order" value="<?=$edit_form->set_order?>" class="form-control" required>
</div>
       
      
    </div>
    

    
  </div>
  
  
    <button type="submit" class="btn btn-primary btn-cons btn-animated from-top fa fa-cloud-upload submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">
      <span>Save</span>
    </button> 

<!--    <button type="button" class="btn btn-warning btn-cons btn-animated from-top fa fa-save">
      <span>Save Draft</span>
    </button>-->
  </div>
<?=form_close()?>
      </div>
    </div>
    <!-- END card -->
        
  
</div>
</div>
<!-- END card -->
<script>
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

$( ".edit-form" ).validate({
	submitHandler: function (form) {
		$(".submitBtn").button('loading');
/*		$('.submitBtn').prop('disabled', true)
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('.submitBtn').html(loadingText);*/
		return true;
	}
});
</script>
