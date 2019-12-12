<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">

<div class="row" style="margin-bottom:10px;">
<div class="col-md-6 pull-right">
<input type="text" class="form-control search_static_text" autocomplete="off" name="search" placeholder="Search Title" >

</div>
<div style="clear:both"></div>
</div>
<div class="table-responsive">
	<table id="data-table" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
            <th><?=show_static_text($adminLangSession['lang_id'],236);?></th>
        <?php 
        $i=0;
        foreach($this->static_text_model->languages_icon as $key_lang=>$val_lang){
        $i++;
        ?>
        <th><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></th>
        <?php
        }
        ?>
                </tr>
                </thead>
        <tbody class="tbody-list">
<?php
if(count($all_data)){
foreach($all_data as $set_data){
$get_lang_value = $this->static_text_model->get_lang($set_data->id, FALSE, $content_language_id);		
?>
<tr class="s-item" data-name="<?php echo $set_data->name; ?>">
<td><?php echo $set_data->id; ?></td>
<td><?php echo $set_data->name; ?></td>
<?php $i=0;
foreach($this->static_text_model->languages as $key_lang=>$val_lang){
$i++;
?> 
<td><span class="xedit" id="<?=$get_lang_value->{'id_static_text_lang_'.$key_lang}; ?>" ><?=$get_lang_value->{'title_'.$key_lang}?></span></td>
<?php 
}
?>
<td><a class="btn btn-icon-only btn-danger" href="<?=$_cancel.'/delete/'.$set_data->id;?>"  onclick="return confirm_box();">
<i class="fa fa-trash-o"></i></a></td>
</tr>
<?php             
}
}
?>                        
        </tbody>
        </table>
</div>
            </div>
        </div>
    </div>
</div>



<link href="assets/plugins/edittable/css/custom.css" rel="stylesheet" type="text/css">
<script src="assets/plugins/edittable/js/bootstrap-editable.js" type="text/javascript"></script> 
<script type="text/javascript">
jQuery(document).ready(function() {  
	$.fn.editable.defaults.mode = 'popup';
	$('.xedit').editable();		
	$(document).on('click','.editable-submit',function(){
		var x = $(this).closest('td').children('span').attr('id');
		var y = $('.input-sm').val();
		var z = $(this).closest('td').children('span');
		$.ajax({
			url: "<?=$_cancel?>/ajax_edit",
			type: 'post',
			data:{id:x,data:y,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
			success: function(s){
				if(s == 'status'){
				$(z).html(y);}
				if(s == 'error') {
					alert('Please insert value!');
				}
			},
			error: function(e){
				alert('Error Processing your Request!!');
			}
		});
	});
});
</script>

<script>
$(document).ready(function(){
    $(".search_static_text").keyup(function(){
        var str = $(".search_static_text").val();
		var count = 0;
        $(".tbody-list .s-item").each(function(index){
            if($(this).attr("data-name")){
				//case insenstive search
                if(!$(this).attr("data-name").match(new RegExp(str, "i"))){
                    $(this).fadeOut("fast");
                }else{
                    $(this).fadeIn("slow");
					count++;
                }
            }
        }); 
    });
});
</script><!--search-->


<script>
function confirm_box(){
    var answer = confirm ("Are you want to delete?");
    if (!answer)
     return false;
}
</script>