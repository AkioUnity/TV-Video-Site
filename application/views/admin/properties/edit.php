<style>
.files-list 
{ 
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 100%; 
}
.files-list li 
{
    margin: 3px 3px 3px 0; 
    padding: 1px; 
    display:block;
    float: left; 
    width: 164px; 
    height: auto;
    border:1px solid #E5E5E5;
    cursor: move;
    position:relative;
}


.files-list li .btn-default
{
    text-align:center;
}

.files-list li:hover{
    background: #F5F5F5;
}

</style>

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
        <label class=" control-label">Realtor</label>
<select name="user_id" class="form-control " id=""  requried>
<option value="">Select</option>
<?php
if($realtor_list){
	foreach($realtor_list as $set_realtor){
?>
<option value="<?=$set_realtor->id?>"  <?=$form_data->user_id==$set_realtor->id?'selected="selected"':''?> ><?=$set_realtor->realtorName?></option>
<?php
	}
}
?>
</select>
        
    </div>
    
    <div class="col-md-4">
        <label class=" control-label">Show Realtor Details</label>
<select name="user_display" class="form-control " id=""  >
<option value="1"  <?=$form_data->user_display==1?'selected="selected"':''?> >Yes</option>
<option value="0"  <?=$form_data->user_display==0?'selected="selected"':''?> >No</option>
</select>
    </div>
</div>
<div class="form-group" >
    <div class="col-md-4">
        <label class=" control-label">Name</label>
       <?=form_input('name', set_value('name', $form_data->name), 'class="form-control " id="" placeholder=""')?>
    </div>
    <div class="col-md-4">
    <label class=" control-label">Sale</label>
<select name="sale_type" class="form-control " id="" >
<?php
foreach($sale_type as $set_t){
?>
<option value="<?=$set_t?>"  <?=$form_data->sale_type==$set_t?'selected="selected"':''?> ><?=$set_t?></option>
<?php
}
?>
</select>
    </div>

<div class="col-md-4">
    <label class=" control-label">Type</label>
<select name="type" class="form-control " id="" >
<?php
foreach($type_list as $set_t){
?>
<option value="<?=$set_t?>"><?=$set_t?></option>
<?php
}
?>
</select>
    </div>
</div>

<div class="form-group" >
    <div class="col-md-4">
        <label class=" control-label">Price Display (price Label)</label>
       <input type="text" name="priceView"  value="<?=set_value('priceView', $form_data->priceView)?>" class="form-control " id="" required="required" />
    </div>

    <div class="col-md-4">
        <label class=" control-label">Search Price</label>
       <input type="text" name="priceSearch"  value="<?=set_value('priceSearch', $form_data->priceSearch)?>" class="form-control " id="" required="required"/>
    </div>

    <div class="col-md-4">
        <label class=" control-label">Price Currency</label>
       <input type="text" name="priceCurrency"  value="<?=set_value('priceCurrency', $form_data->priceCurrency)?>" class="form-control " id="" required="required"/>
    </div>

    
</div>

<div class="form-group" >
<div class="col-md-3">
    <label class=" control-label">Category</label>
<select name="category" class="form-control " id="" >
<?php
foreach($category as $set_t){
?>
<option value="<?=$set_t?>"><?=$set_t?></option>
<?php
}
?>
</select>
    </div>

    <div class="col-md-3">
        <label class=" control-label">Bed</label>
       <input type="number" name="bedroom"  value="<?=set_value('bedroom', $form_data->bedroom)?>" min="0" class="form-control " id="" required="required" />
    </div>

    <div class="col-md-3">
        <label class=" control-label">Bath</label>
       <input type="number" name="bathroom"  value="<?=set_value('bathroom', $form_data->bathroom)?>" min="0" class="form-control " id="" required="required" />
    </div>

    <div class="col-md-3">
        <label class=" control-label">Car</label>
       <input type="number" name="carports"  value="<?=set_value('carports', $form_data->carports)?>" min="0" class="form-control " id="" required="required" />
    </div>
    


    
</div>

<div class="form-group" >
<div class="col-md-2">
    <label class="checkbox-inline">
        <input type="checkbox" name="airconditioning" value="1" <?=$form_data->airconditioning==1?'checked="checked"':''?>> air conditioning
    </label>
</div>

<div class="col-md-2">
    <label class="checkbox-inline">
        <input type="checkbox" name="pool" value="1" <?=$form_data->pool==1?'checked="checked"':''?>> pool
    </label>
</div>

<div class="col-md-3">
    <label class="checkbox-inline">
        <input type="checkbox" name="alarmSystem" value="1" <?=$form_data->alarmSystem==1?'checked="checked"':''?>> alarm system
    </label>
</div>

    <div class="col-md-4">
        <label class=" control-label">other features -- seperate multiples by commas </label>
   <input type="text" name="other_features"  value="<?=set_value('other_features', $form_data->other_features)?>" class="form-control " id="" placeholder="eg: fireplace, guest suite" />
    </div>
</div>
<hr>

<div class="form-group" >
<div class="col-md-3">
	<label class=" control-label">Land Area</label>
<div class="row">
<div class="col-md-6">
<input type="text" name="landArea"  value="<?=set_value('landArea', $form_data->landArea)?>" class="form-control " id="" placeholder="Land" />
</div>

<div class="col-md-6">
<input type="text" name="landAreaUnit"  value="<?=set_value('landAreaUnit', $form_data->landAreaUnit)?>" class="form-control " id="" placeholder="m2" />
</div>
</div><!--//row//-->    
</div>

<div class="col-md-3">
	<label class=" control-label">Floor Area</label>
<div class="row">
<div class="col-md-6">
<input type="text" name="floorArea"  value="<?=set_value('floorArea', $form_data->floorArea)?>" class="form-control " id="" placeholder="Floor" />
</div>

<div class="col-md-6">
<input type="text" name="floorAreaUnit"  value="<?=set_value('floorAreaUnit', $form_data->floorAreaUnit)?>" class="form-control " id="" placeholder="m2" />
</div>
</div><!--//row//-->    
</div>

<div class="col-md-3">
	<label class=" control-label">Land Size</label>
<div class="row">
<div class="col-md-6">
<input type="text" name="landSize"  value="<?=set_value('landSize', $form_data->landSize)?>" class="form-control " id="" placeholder="Area" />
</div>

<div class="col-md-6">
<input type="text" name="landSizeUnit"  value="<?=set_value('landSizeUnit', $form_data->landSizeUnit)?>" class="form-control " id="" placeholder="m2" />
</div>
</div><!--//row//-->    
</div>

<div class="col-md-3">
	<label class=" control-label">Building Area</label>
<div class="row">
<div class="col-md-6">
<input type="text" name="buildingArea"  value="<?=set_value('buildingArea', $form_data->buildingArea)?>" class="form-control " id="" placeholder="Area" />
</div>

<div class="col-md-6">
<input type="text" name="buildingAreaUnit"  value="<?=set_value('buildingAreaUnit', $form_data->buildingAreaUnit)?>" class="form-control " id="" placeholder="m2" />
</div>
</div><!--//row//-->    
</div>

</div>
<div class="form-group" >
<div class="col-md-3">
	<label class=" control-label">Property Availability</label>
<select name="availability" class="form-control " id="" >
<?php
foreach($availability_list as $set_t){
?>
<option value="<?=$set_t?>"><?=$set_t?></option>
<?php
}
?>
</select>
</div>

<div class="col-md-4">
        <label class=" control-label">Show Map</label>
<select name="address_display" class="form-control " id=""  >
<option value="1"  <?=$form_data->address_display==1?'selected="selected"':''?> >Yes</option>
<option value="0"  <?=$form_data->address_display==0?'selected="selected"':''?> >No</option>
</select>
    </div>



</div>

<hr />
<div class="form-group" >
<div class="col-md-3">
	<label class=" control-label">Unit Number</label>
	<input type="text" name="unitNumber"  value="<?=set_value('unitNumber', $form_data->unitNumber)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-3">
	<label class=" control-label">Street Number</label>
	<input type="text" name="streetNumber"  value="<?=set_value('streetNumber', $form_data->streetNumber)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-3">
	<label class=" control-label">Street Name</label>
	<input type="text" name="street"  value="<?=set_value('street', $form_data->street)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-3">
	<label class=" control-label">Secondary Address Line</label>
	<input type="text" name="address"  value="<?=set_value('address', $form_data->address)?>" class="form-control " id="" placeholder="" />
</div>
</div>

<div class="form-group" >
<div class="col-md-3">
	<label class=" control-label">City</label>
	<input type="text" name="city"  value="<?=set_value('city', $form_data->city)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-3">
	<label class=" control-label">State</label>
	<input type="text" name="state"  value="<?=set_value('state', $form_data->state)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-3">
	<label class=" control-label">Zip/Post Code</label>
	<input type="text" name="postcode"  value="<?=set_value('postcode', $form_data->postcode)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-3">
	<label class=" control-label">Country</label>
	<input type="text" name="country"  value="<?=set_value('country', $form_data->country)?>" class="form-control " id="" placeholder="" />
</div>

<!--<div class="col-md-3">
	<label class=" control-label">Property Inspection Date</label>
<?=form_input('dates', set_value('dates',h_dateFormat($form_data->{'dates'},'d-m-Y')), 'class="form-control " id="input-date" placeholder="" data-date-format="dd-mm-yyyy" ')?>
</div>-->

<!--<div class="col-md-3">
	<label class=" control-label">Land Size</label>
<select id="inputState" name="times"  class="form-control">
<?php
foreach($time_data as $key=>$val){
?>
	<option value="<?=$key?>" ><?=$val?></option>
<?php	
}
?>      
      </select>
</div>-->



</div>
<hr />

<div class="form-group" >
<div class="col-md-12 ">
<label class=" control-label">Description</label>
<textarea name="description" class="form-control " id="" placeholder="" ><?=set_value('description', $form_data->description)?></textarea>
</div>
</div>
                       
<hr />
<div class="form-group" >
<h3 style="margin-left:15px">Additional Property Specs</h3>
<div class="col-md-6">
	<label class=" control-label">Property Video Url (If Exists)</label>
	<input type="text" name="propertyVideo"  value="<?=set_value('propertyVideo', $form_data->propertyVideo)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-6">
	<label class=" control-label">Property Latitude</label>
	<input type="text" name="propertyLatitude"  value="<?=set_value('propertyLatitude', $form_data->propertyLatitude)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-6">
	<label class=" control-label">Virtual Tour Url (If Exists)</label>
	<input type="text" name="propertyTour"  value="<?=set_value('propertyTour', $form_data->propertyTour)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-6">
	<label class=" control-label">Property Longitude</label>
	<input type="text" name="propertyLongitude"  value="<?=set_value('propertyLongitude', $form_data->propertyLongitude)?>" class="form-control " id="" placeholder="" />
</div>

<div class="col-md-6">
	<label class=" control-label">Social Url (If Exists)</label>
	<input type="text" name="socialURL"  value="<?=set_value('socialURL', $form_data->socialURL)?>" class="form-control " id="" placeholder="" />
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
    
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption">Image</div></div>
            <div class="portlet-body">
                    <div class="row">
<div class="col-md-12" style="">

              <div class="widget wlightblue">
                <div class="widget-content">

			<form role="form" action="ajax/set_video_comment" id="comment_form">
<input type="hidden" name="comment_form" value="set">                    	
<div class="form-group">
<label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],277);?>:</label>  
<span>Please upload more then  200 * 300</span>
<div class="col-sm-4">
<div id="fileuploader" class="fileuploader" style="background-color:#52B6EC"><?=show_static_text($adminLangSession['lang_id'],278);?></div>
<span id="filesUpload" class="filesUpload"></span>
<div id="status"></div>        		            
</div>
</div>
<div style="clear:both"></div>                    
</form>


			<div id="product_files_content">
      <ul ui-sortable="sortableOptions" ng-model="leftArray" class="files files-list ui-sortable">
<?php
if(isset($products_file)&&!empty($products_file)){
foreach($products_file as $set_products_file){
?>
<li class="item" id="product_image_<?=$set_products_file->img_id?>" data-id="<?=$set_products_file->img_id?>" >
    <div class="pi-img-wrapper">
<img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/properties/<?=$set_products_file->filename?>"></a>
</div>
<div class="file-option" style="text-align:center">
<button  class="btn btn-default" onclick="delete_image('<?=$set_products_file->img_id?>')" href="javascript:void(0)" style="margin-top:10px">Delete</button>
</div>
</il>
<?php
}
}
?>    
	</ul>
</div>
                  
                </div>
                  
              </div>  
              
            </div>
</div>
            </div>
        </div>


        
    </div>
</div>
    
<link href="assets/plugins/uploader/css/uploadfile.css" rel="stylesheet">
<script src="assets/plugins/uploader/js/jquery.uploadfile.min.js"></script>
<script>
var moreCount = 0;

$(document).ready(function(){
	$(".fileuploader").uploadFile({
		url:"<?=$_cancel.'/ajax_upload'?>",
		fileName:"myfile",
		formData: {<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>',user_id:'<?=isset($user_data->id)?$user_data->id:0?>'},
		showStatusAfterSuccess:false,
		uploadButtonClass:"ajax-file-upload-blue",
		allowedTypes:"*",
		multiple: true,
		onSuccess:function(files,data,xhr){
			var obj = jQuery.parseJSON(data);
			if(obj.result=='error'){
				$('.ajax-file-upload-statusbar').hide();
				$("#status").html("<font color='red'>"+obj.msg+"</font>");
			}
			else if(obj.result=='success'){
				var pic_id = '<input type="hidden" name="more_pic[]" value="'+obj.msg+'" class="more-img-'+moreCount+'" />';
				$('#more_pic').append(pic_id);
				refresh_image(obj.msg,obj.id);
				moreCount++;
			}
			
		},
		onError: function(files,status,errMsg){		
			$("#status").html("<font color='red'>Upload is Failed</font>");
		}

	});
});

function refresh_image(d_img,page_id){
	html = $('#uploaded_img').html();
	//console.log(html);
	html = html.replace(/%%ID%%/g, page_id);
	html = html.replace(/%%IMAGE%%/g,d_img);
	//console.log(html);
	$('.files-list').append(html);

}

function delete_image(id){
	$.ajax({
		type:"POST",
		url:"<?=$_cancel.'/delete_image'?>",
		data:{id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			$('#product_image_'+id).hide();
		}
	});
}
</script>
<script id="uploaded_img" type="text/html">
<li class="item" id="product_image_%%ID%%" data-id="%%ID%%" >
	<div class="pi-img-wrapper">
		<img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/properties/%%IMAGE%%"></a>
	</div>
</il>
</script>
    
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

<link href="assets/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
	$('#input-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

});
</script>
