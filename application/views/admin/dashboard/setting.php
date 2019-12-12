<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
			<?php echo validation_errors(); ?>
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" value="<?=set_value('gps', $settings['gps'])?>" id="inputGps" name="gps">
                <div class="form-body">
                    <hr>
                    <div class="form-group">
                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],253);?></label>
                      <div class="col-lg-3">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['logo']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['logo'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="logo" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                                <?php
                                if(!empty($settings['logo'])){
                                	echo '<a class="btn " href="'.$admin_link.'/account/remove_image/'.$settings['logo'].'" onclick="" >'.show_static_text($adminLangSession['lang_id'],109).'</a>';
                                }
                                ?>
                     	</div>
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      <label class="col-lg-2 control-label">Dark <?=show_static_text($adminLangSession['lang_id'],253);?></label>
                      <div class="col-lg-3">
				      	<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                <?php echo !isset($settings['dark_logo']) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings['dark_logo'].'" >'; ?>
                            </div>
							<div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>
    	    	            <input type="file" name="dark_logo" id="logo"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>
                     	</div>
                   		</div>
                            <!--<input type="file" name="logo" id="logo" />-->
                      </div>
                      
                      
                    </div>
                    <hr>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],251);?></label>
                        <div class="col-lg-4">
							<?php echo form_dropdown('website_active', array('1'=>"Online",'0'=>"Offline"),$settings['website_active'], 'class="form-control" '); ?>
                        </div>
                        
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],82);?></label>
                        <div class="col-lg-4">
                           <?=form_input('phone', set_value('phone', isset($settings['phone'])?$settings['phone']:''), 'class="form-control" id="Phone" placeholder="Phone"')?>
                        </div>
                        
                        
                        
                    </div>
                    
                    
                    <div class="form-group">
                        
                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],246);?></label>
                        <div class="col-sm-4">
                            <input type="email" name="site_email" class="form-control" placeholder="Site Email" value="<?php echo set_value('site_email', isset($settings['site_email'])?$settings['site_email']:'');?>" >
                        </div>
                        
                        
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],250);?></label>
                        <div class="col-lg-4">
							<textarea name="analytic_code" class="form-control"  style="height:100px" > <?=isset($settings['analytic_code'])?$settings['analytic_code']:'';?></textarea>
                        </div>
                                                
                    </div>
                    
                    <div class="form-group">
                    <div class="col-lg-12">
                            <?=form_input('map_address', set_value('map_address'), 'class="form-control " placeholder="'.show_static_text($adminLangSession['lang_id'],3).'" id="autocomplete"')?>
                      <div class="gmap" id="mapsAddress" style="width:100%;height:300px"></div></div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],245);?></label>
                        <div class="col-lg-4">
                           <?=form_input('site_name', set_value('site_name', isset($settings['site_name'])?$settings['site_name']:''), 'class="form-control"  placeholder="Site Name"')?>
                        </div>
                        
                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],247);?></label>
                        <div class="col-sm-4">
                            <input type="text" name="meta_title" class="form-control" placeholder="Mate Title Name" value="<?php echo set_value('meta_title', isset($settings['meta_title'])?$settings['meta_title']:'');?>" >
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        
                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],27);?></label>
                        <div class="col-sm-10">
                            <input type="text" name="keywords" class="form-control bootstrap-tagsinput" placeholder="Keywords" value="<?php echo set_value('keywords', isset($settings['keywords'])?$settings['keywords']:'');?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],248);?></label>
                        <div class="col-sm-10">
                            <textarea name="meta_description" class="form-control"><?php echo set_value('meta_description', isset($settings['meta_description'])?$settings['meta_description']:'');?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],249);?></label>
                        <div class="col-lg-4">
                           <?=form_input('home_title', set_value('home_title', isset($settings['home_title'])?$settings['home_title']:''), 'class="form-control" id="facebook_url" placeholder="Home Title"')?>
                        </div>
                    
                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],46);?></label>
                        <div class="col-sm-4">
                            <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo set_value('address', isset($settings['address'])?$settings['address']:'');?>" >
                        </div>
                                                
                    </div>
                    
                    
					<div class="form-group">
                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],252);?></label>
                        <div class="col-lg-10">
							<textarea name="website_desc" class="form-control cleditor2"  style="height:100px" > <?=isset($settings['website_desc'])?$settings['website_desc']:'';?></textarea>
                        </div>
                    </div>
                </div>
                    
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary btn-label-left"><?=show_static_text($adminLangSession['lang_id'],56);?></button>
                        </div>
                    </div>
				</div>                    
            </form>
            </div>
        </div>
    </div>
</div>
<style>
.gmap{
    margin:0 auto;
    border:1px dashed #C0C0C0;
    width:68%;
    height:250px;
}
</style>
<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 
<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 
<script>
/* CL Editor */
$(document).ready(function(){
    $('.cleditor2').ckeditor({
	    filebrowserUploadUrl : '<?=site_url("ajax/upload_editor_image")?>'	
	});
});
</script>
<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDPLi6vvwFFT3WbS1DJoU1PV6sTAFUOv2w"></script>
<script src="assets/plugins/gmap/gmap3.min.js"></script>
<script type="text/javascript">
var timerMap;
var firstSet = false;
var savedGpsData;
$(function () {
$('.zoom-button').click(function()
{
	var myLinks = new Array();
	var current = $(this).attr('href');
	var curIndex = 0;
	
	$('.files-list .zoom-button').each(function (i) {
		var img_href = $(this).attr('href');
		myLinks[i] = img_href;
		if(current == img_href)
			curIndex = i;
	});
	options = {index: curIndex}
	blueimp.Gallery(myLinks, options);
	
	return false;
});
// If alredy selected
if($('#inputGps').length && $('#inputGps').val() != '')
{
	savedGpsData = $('#inputGps').val().split(", ");
	
	$("#mapsAddress").gmap3({
		map:{
		  options:{
			center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
			zoom: 14
		  }
		},
		marker:{
		values:[
		  {latLng:[parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])]},
		],
		options:{
		  draggable: true
		},
		events:{
			dragend: function(marker){
			  $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
			}
	  }}});
	
	firstSet = true;
}
else
{
	$("#mapsAddress").gmap3({
		map:{
		  options:{
			center: [<?php echo isset($settings['gps'])?$settings['gps']:'45.81, 15.98'?>],
			zoom: 12
		  },
		}
	  });
}
$('#autocomplete').keyup(function (e) {
	clearTimeout(timerMap);
	timerMap = setTimeout(function () {
		
		$("#mapsAddress").gmap3({
		  getlatlng:{
			address:  $('#autocomplete').val(),
			callback: function(results){
			  if ( !results ){
				alert('Bad address!');
				return;
			  } 
			  
				if(firstSet){
					$(this).gmap3({
						clear: {
						  name:["marker"],
						  last: true
						}
					});
				}
			  
			  // Add marker
			  $(this).gmap3({
				marker:{
				  latLng:results[0].geometry.location,
				   options: {
					  id:'searchMarker',
					  draggable: true
				  },
				  events: {
					dragend: function(marker){
						  $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
					}
				  }
				}
			  });
			  
			  // Center map
			  $(this).gmap3('get').setCenter( results[0].geometry.location );
			  
			  $('#inputGps').val(results[0].geometry.location.lat()+', '+results[0].geometry.location.lng());
			  
			  firstSet = true;
			}
		  }
		});
	}, 2000);
	
});
});
function delete_file(id){
	var id = id;
	if(id){
		$.ajax({
			type: "POST",
			url: "<?=$admin_link?>/account/remove_image", /* The country id will be sent to this file */
			dataType: "json",
		   	data: {id:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
			success: function(msg){
				if(msg['result']=='success'){
				   $('.remove_'+id).remove();
				}
			}
	   });
		
	}
}
</script>
