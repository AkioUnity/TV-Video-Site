<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
                <?php //echo validation_errors();?>
				<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
	<input type="hidden" name="crop_image" id="input-crop-image" value="" />
					<div class="form-body">                    
	
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,16);?></label>
        <div class="col-lg-10">
			<?=form_input('first_name', set_value('first_name'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('first_name'); ?></span>
        </div>
    </div>
    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,17);?></label>
        <div class="col-lg-10">
			<?=form_input('last_name', set_value('last_name'), 'class="form-control " id="" placeholder=""')?>
    	    <span class="error-span"><?php echo form_error('last_name'); ?></span>
        </div>
    </div>
    
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,18);?></label>
        <div class="col-lg-10">
			<input type="email" name="email" value="<?=set_value('email')?>" class="form-control " id="" placeholder="" />
    	    <span class="error-span"><?php echo form_error('email'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(11,20);?></label>
        <div class="col-lg-10">
	        <input type="text" name="password" class="form-control " value="<?=set_value('password');?>">
    	    <span class="error-span"><?php echo form_error('password'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,2000);?>Phone</label>
        <div class="col-lg-10">
	        <input type="text" name="phone" class="form-control " value="<?=set_value('phone');?>">
    	    <span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,2000);?>Address</label>
        <div class="col-lg-10">
	        <input type="text" name="address" class="form-control " value="<?=set_value('address');?>">
    	    <span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,2000);?>City</label>
        <div class="col-lg-10">
	        <input type="text" name="city" class="form-control " value="<?=set_value('city');?>">
    	    <span class="error-span"><?php echo form_error('city'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,2000);?>Country</label>
        <div class="col-lg-10">
	        <input type="text" name="country" class="form-control " value="<?=set_value('country');?>">
    	    <span class="error-span"><?php echo form_error('country'); ?></span>
        </div>
    </div>

<div class="form-group" >
    <label class="col-lg-2 control-label">Channel Create</label>
    <div class="col-lg-10">
<input type="number" name="channels_create" value="<?=set_value('channels_create');?>" min="0" class="form-control" >
    </div>
</div>    
    

<div class="form-group" >
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-10">
				<div class="pull-left">
<div class="checkbox check-success  ">
  <input type="checkbox" name="options[information_above]" value="1" id="checkbox-agree" >
  <label for="checkbox-agree">I hereby certify that the information above is true and accurate
  </label>
</div>
  <div class="checkbox check-success">
  <input type="checkbox" name="options[channel_ownership]" value="1" id="apply-channel-owner" >
      <label for="apply-channel-owner">Apply for Channel Ownership
  </label>
</div>
  <!-- Show this only if user is approved to be channel owner -->
  <div class="checkbox check-success  ">
  <input type="checkbox" name="options[channel_owner]" value="1" id="checkbox-channel-owner" >
      <label for="checkbox-channel-owner">Approved channel owner
  </label>
</div>
</div>
        </div>
    </div>
    
<div class="form-group" >
			<label class="col-md-2 control-label">Permissions</label>
<div class="col-md-10">
<?php
foreach($permissions as $key=>$val){
?>
<div class="checkbox">
    <label><input type="checkbox" name="permissions[]" value="<?=$key?>" ><?=$val?></label>
</div>                                        
<?php	
}
?>      
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
	<div style="clear:both"></div>
                 
			</div>
        </div>
        <!-- end panel -->
    </div>
</div>


<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 


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



