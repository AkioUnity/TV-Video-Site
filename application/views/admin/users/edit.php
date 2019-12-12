<?php
$social_arr = json_decode($users_form->user_checkbox);
?>
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
	<label class="col-lg-2 control-label" style="padding-top:0"><?=show_static_text(1,4001);?>Email</label>
    <div class="col-md-10">
	    <?=$users_form->{'email'}?>
    </div>
</div>


    <div class="form-group" >
	<label class="col-lg-2 control-label"><?=show_static_text(1,4001);?>Name</label>
    <div class="col-md-10">
	    <?=form_input('first_name', set_value('first_name', $users_form->{'first_name'}), 'class="form-control " id="" placeholder=""')?>
    	<span class="error-span"><?php echo form_error('first_name'); ?></span>
    </div>
</div>
	
    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,401);?>Surname</label>
        <div class="col-md-10">
        <?=form_input('last_name', set_value('last_name', $users_form->{'last_name'}), 'class="form-control " id="" placeholder=""')?>
        <span class="error-span"><?php echo form_error('last_name'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,4010);?>Phone</label>
	    <div class="col-lg-10">
    	    <?=form_input('phone', set_value('phone', $users_form->{'phone'}), 'class="form-control " id="" placeholder=""')?>
        	<span class="error-span"><?php echo form_error('phone'); ?></span>
        </div>
    </div>
    

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,2000);?>Address</label>
        <div class="col-lg-10">
	        <input type="text" name="address" class="form-control " value="<?=set_value('address',$users_form->{'address'});?>">
    	    <span class="error-span"><?php echo form_error('address'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,2000);?>City</label>
        <div class="col-lg-10">
	        <input type="text" name="city" class="form-control " value="<?=set_value('city',$users_form->{'city'});?>">
    	    <span class="error-span"><?php echo form_error('city'); ?></span>
        </div>
    </div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"><?=show_static_text(1,2000);?>Country</label>
        <div class="col-lg-10">
	        <input type="text" name="country" class="form-control " value="<?=set_value('country',$users_form->{'country'});?>">
    	    <span class="error-span"><?php echo form_error('country'); ?></span>
        </div>
    </div>
<div class="form-group" >
    <label class="col-lg-2 control-label">Channel Create</label>
    <div class="col-lg-10">
<input type="number" name="channels_create" value="<?=set_value('channels_create',$users_form->{'channels_create'});?>" min="0" class="form-control" >
    </div>
</div>

    <div class="form-group" >
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-10">
				<div class="pull-left">
<div class="checkbox check-success  ">
  <input type="checkbox" name="options[information_above]" value="1" id="checkbox-agree" <?=isset($social_arr->information_above)&&$social_arr->information_above==1?'checked="checked"':''?>>
  <label for="checkbox-agree">I hereby certify that the information above is true and accurate
  </label>
</div>
<?php
if($users_form->apply_channel==1){
?>
<div class="checkbox check-success  ">
  <input type="checkbox" name="approved_channel" value="1" id="checkbox-channel-owner" <?=$users_form->approved_channel==1?'checked="checked"':''?>>
      <label for="checkbox-channel-owner">Approved channel owner
  </label>
</div>
<?php
}
?>
  
  <!-- Show this only if user is approved to be channel owner -->
  
</div>
        </div>
    </div>
    
    
    
                        
<div class="form-group" >
			<label class="col-lg-2 col-md-2 control-label">Permissions</label>
<div class="col-md-10">
<?php
$userPermission =array();
if(!empty($users_form->permissions)){
	$userPermission = explode(',',$users_form->permissions);
}
foreach($permissions as $key=>$val){
?>
<div class="checkbox">
    <label><input type="checkbox" name="permissions[]" value="<?=$key?>" <?=$userPermission&&in_array($key,$userPermission)?'checked':''?> ><?=$val?></label>
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



