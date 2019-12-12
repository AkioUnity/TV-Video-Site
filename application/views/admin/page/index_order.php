<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
<div class="row" style="margin-bottom:10px">
    <div class="col-md-6">
        <div class="btn-group">	        
            <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5">
            <?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i>
            </a>
            <input type="button" id="save" value="<?=show_static_text($adminLangSession['lang_id'],235);?>" class="btn btn-success" />

        </div>
    </div>
</div>

    <p class="alert alert-info"><?=show_static_text($adminLangSession['lang_id'],264);?></p>
    <!--<div class="form-body alert alert-warning">
        <div class="col-md-5" style="padding:0px">
              	<input type="text" name="title" value="" placeholder="Search Title" class="form-control"  id="search_title" onkeypress="ajax_search()" onkeyup="ajax_search()" onkeydown="ajax_search()" style="height:30px;margin:0px"/>
        </div>
        <div style="clear:both"></div>
    </div>-->
    <div id="orderResult" style=""></div>
    
</div>

        </div>
        <!-- end panel -->
    </div>
</div>







<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}
function ajax_search(title){
	$('#orderResult').html('<div style="text-align:center; margin-top:20px" ><img src="assets/uploads/loading.gif"></div>');
	var edValue = document.getElementById("search_title");
    var id = edValue.value;
	$.ajax({
		type:"POST",
		url:"<?=$_cancel?>/search_ajax",
		data:{title:id,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
		success:function(data){
			$('#orderResult').html(data);
		}
	});
	return false;		
}


</script>



<!--<link href="assets/plugins/nestedsortable/css/bootstrap.min.css" rel="stylesheet">-->
<script src="assets/admin_temps/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<link href="assets/plugins/nestedsortable/css/admin.css" rel="stylesheet">
<script src="assets/plugins/nestedsortable/jquery.mjs.nestedSortable.js"></script>

<script>
$(function(){
    $.post('<?=site_url($_cancel.'/order_ajax')?>', {'<?=$this->security->get_csrf_token_name();?>':'<?=$this->security->get_csrf_hash();?>'}, function(data){
        $('#orderResult').html(data); 
    });    

	$('#save').click(function(){
		oSortable = $('.sortable').nestedSortable('toArray');

		$('#orderResult').slideUp(function(){
			$.post('<?php echo site_url($_cancel.'/order_ajax'); ?>', { sortable: oSortable,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>' }, function(data){
				$('#orderResult').html(data);
				$('#orderResult').slideDown();
			});
		});
		
	});
})
</script>

<style>
.options {
  background: none !important;
  border: none !important;
  padding: 0px !important;
}

.sortable li div{
	height:38px;
}
</style>
