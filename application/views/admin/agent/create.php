<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
				<?php echo validation_errors();?>
				<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
                      <div id="more_pic" style="display:none"></div>
                    <div class="form-body">
<div class="form-group" >
<div class="col-md-4">
	<label class=" control-label">Realtor Name</label>
	<?=form_input('realtorName', set_value('realtorName', $form_data->realtorName), 'class="form-control " id="" placeholder=""')?>
</div>

<div class="col-md-4">
	<label class=" control-label">Realtor Email</label>
    <input type="email" name="realtorEmail" value="<?=set_value('realtorEmail', $form_data->realtorEmail)?>" class="form-control "/>
</div>
    
    <div class="col-md-4">
        <label class=" control-label">Realty Name</label>
       <input type="text" name="realtyName"  value="<?=set_value('realtyName', $form_data->realtyName)?>" class="form-control " id="" required="required" />
    </div>
</div>

<div class="form-group" >
<div class="col-md-4">
	<label class=" control-label">Realtor Cell</label>
    <input type="text" name="realtorCell" value="<?=set_value('realtorCell', $form_data->realtorCell)?>" class="form-control "/>
</div>
<div class="col-md-4">
	<label class=" control-label">Fixed Phone</label>
    <input type="text" name="realtyFixedPhone" value="<?=set_value('realtyFixedPhone', $form_data->realtyFixedPhone)?>" class="form-control "/>
</div>

</div>
<div class="form-group" >
    <div class="col-md-4">
        <label class=" control-label">Street 1</label>
       <input type="text" name="realtyStreet1"  value="<?=set_value('realtyStreet1', $form_data->realtyStreet1)?>" class="form-control " id="" required="required"/>
    </div>

    <div class="col-md-4">
        <label class=" control-label">Street 2</label>
       <input type="text" name="realtyStreet2"  value="<?=set_value('realtyStreet2', $form_data->realtyStreet2)?>" class="form-control " id="" required="required"/>
    </div>

    <div class="col-md-4">
        <label class=" control-label">City</label>
       <input type="text" name="realtyCity"  value="<?=set_value('realtyCity', $form_data->realtyCity)?>" class="form-control " id="" required="required" />
    </div>
</div>

<div class="form-group" >
    

    <div class="col-md-4">
        <label class=" control-label">State</label>
       <input type="text" name="realtyState"  value="<?=set_value('realtyState', $form_data->realtyState)?>" class="form-control " id="" required="required"/>
    </div>

    <div class="col-md-4">
        <label class=" control-label">Zip</label>
       <input type="text" name="realtyZip"  value="<?=set_value('realtyZip', $form_data->realtyZip)?>" class="form-control " id="" required="required"/>
    </div>


    <div class="col-md-4">
        <label class=" control-label">Country</label>
       <input type="text" name="realtyCountry"  value="<?=set_value('realtyCountry', $form_data->realtyCountry)?>" class="form-control " id="" required="required"/>
    </div>
    
</div>

<div class="form-group">
    <div class="col-md-3">
        <label class=" " style="display:block">Image</label>
<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
<img src="assets/uploads/no-image.gif">
    </div>
    <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select</span>
    <span class="fileinput-exists">Change</span>
    <input type="file" name="image" id="logo"></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
</div>
</div>
    </div>
    


</div>


                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-9">
                            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving">Save</button>
                                <a href="<?=$_cancel?>" class="btn btn-default" type="button">Cancel</a>
                            </div>
                        </div>
                    </div>
                <?=form_close()?>
	        </div>
        </div>
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
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 

