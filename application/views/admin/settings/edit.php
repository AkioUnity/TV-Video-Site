<div class="row">

    <div class="col-md-12">

        <div class="portlet box green">

            <div class="portlet-title"><div class="caption"><?=$name?></div></div>

            <div class="portlet-body">

            <?php echo validation_errors();?>

			<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                              

				<input type="hidden" name="name"  value="setting" />

                <input type="hidden" value="<?=set_value('gps', $settings_form->gps)?>" id="inputGps" name="gps">

                <div class="form-body">

     

                    

                    

               

                    <hr>

                    <div class="form-group">

                      <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],253);?></label>

                      <div class="col-lg-3">

				      	<div class="fileinput fileinput-new" data-provides="fileinput">

							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">

                                <?php echo !isset($settings_form->logo) ? '<img src="assets/uploads/no-image.gif">' :'<img src="'.base_url('assets/uploads/sites').'/'.$settings_form->logo.'" >'; ?>

                            </div>

							<div>

						    <span class="btn btn-default btn-file"><span class="fileinput-new"><?=show_static_text($adminLangSession['lang_id'],159);?></span><span class="fileinput-exists"><?=show_static_text($adminLangSession['lang_id'],160);?></span>

    	    	            <input type="file" name="logo" id="logo"></span>

						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?=show_static_text($adminLangSession['lang_id'],109);?></a>

<?php
if(!empty($settings_form->logo)){
echo '<a class="btn " href="'.$_cancel.'/remove_image?img='.$settings_form->logo.'" onclick="" >'.show_static_text($adminLangSession['lang_id'],109).'</a>';
}
?>

                     	</div>

                   		</div>

                            <!--<input type="file" name="logo" id="logo" />-->

                      </div>

                      <div class="col-lg-7">

                            <?=form_input('map_address', set_value('map_address'), 'class="form-control " placeholder="'.show_static_text($adminLangSession['lang_id'],3).'" id="autocomplete"')?>

                      <div class="gmap" id="mapsAddress" style="width:100%;height:300px"></div></div>

                      

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

                    

                    <hr>

                    

                    

                    

                    

                    <h5><?=show_static_text($adminLangSession['lang_id'],268);?></h5>

                   <div style="margin-bottom: 0px;" class="tabbable">

                      <ul class="nav nav-tabs">

                        <?php $i=0;

                        foreach($this->setting_model->languages_icon as $key_lang=>$val_lang):

    

                          $i++;?>

                        <li class="<?=$i==1?'active':''?>">

                          <a data-toggle="tab" href="#<?=$key_lang?>" title="<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" title="<?=$key_lang?>" height="15" width="20" ></a></li>

                        <?php endforeach;?>

                      </ul>

                      <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">

                        <?php $i=0;foreach($this->setting_model->languages as $key_lang=>$val_lang):$i++;?>

                        <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">

                            <div class="form-group">

                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],245);?></label>

                        <div class="col-lg-4">

                           <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $settings_form->{'title_'.$key_lang}), 'class="form-control"  placeholder=""')?>

                        </div>

<!--                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],246);?></label>

                        <div class="col-sm-4">

                            <input type="email" name="<?='email_'.$key_lang?>" class="form-control" placeholder="" value="<?php echo set_value('email_'.$key_lang, $settings_form->{'email_'.$key_lang});?>" >

                        </div>-->

                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],247);?></label>

                        <div class="col-sm-4">

                            <input type="text" name="<?='meta_title_'.$key_lang?>" class="form-control" placeholder="" value="<?php echo set_value('meta_title_'.$key_lang, $settings_form->{'meta_title_'.$key_lang});?>" >

                        </div>

                    </div>





                    <div class="form-group">

                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],27);?></label>

                        <div class="col-sm-10">

                            <input type="text" name="<?='meta_keyword_'.$key_lang?>" value="<?php echo set_value('meta_keyword_'.$key_lang, $settings_form->{'meta_keyword_'.$key_lang});?>" data-role="tagsinput" class="form-control input-large"  >

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],248);?></label>

                        <div class="col-sm-10">

                            <textarea name="<?='meta_desc_'.$key_lang?>" class="form-control"><?php echo set_value('meta_desc_'.$key_lang, $settings_form->{'meta_desc_'.$key_lang});?></textarea>

                        </div>

                    </div>

                    

                    <div class="form-group">

                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],249);?></label>

                        <div class="col-lg-4">

                            <input type="text" name="<?='home_title_'.$key_lang?>" class="form-control" placeholder="" value="<?php echo set_value('home_title_'.$key_lang, $settings_form->{'home_title_'.$key_lang});?>" >

                        </div>

                        <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],46);?></label>

                        <div class="col-sm-4">

                            <input type="text" name="<?='address_'.$key_lang?>" class="form-control" placeholder="" value="<?php echo set_value('address_'.$key_lang, $settings_form->{'address_'.$key_lang});?>" >

                        </div>

                    </div>

					<div class="form-group">

                        <label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],252);?></label>

                        <div class="col-lg-10">

                            <textarea name="<?='offline_data_'.$key_lang?>" class="form-control cleditor2"><?php echo set_value('offline_data_'.$key_lang, $settings_form->{'offline_data_'.$key_lang});?></textarea>

                        </div>

                                                

                    </div>

                              

                        </div>

                        <?php endforeach;?>

                      </div>

                    </div>

                </div>

                <div class="form-actions">

                    <div class="row">

                        <div class="col-md-offset-2 col-md-9">

                            <?=form_submit('submit', show_static_text($adminLangSession['lang_id'],235), 'class="btn btn-primary"')?>

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



<!--<script src="assets/plugins/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script> 

<script src="assets/plugins/ckeditor/adapters/jquery.js" type="text/javascript" language="javascript"></script> 



<script>

/* CL Editor */

$(document).ready(function(){

    $('.cleditor2').ckeditor({

	    filebrowserUploadUrl : '<?site_url("ajax_upload/upload_editor_image")?>'	

	});

});

</script>-->



<link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />

<script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>

<script>

	$('.cleditor2').summernote({height: 300});

</script>







<style>

.gmap{

    margin:0 auto;

    border:1px dashed #C0C0C0;

    width:68%;

    height:250px;

}

</style>



<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 





<script src="//maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go" type="text/javascript"></script>

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

			center: [<?php echo isset($settings_form->gps)?$settings_form->gps:'45.81, 15.98'?>],

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



<link href="assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />

<link href="assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet" type="text/css" />

<script src="assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>

