<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
                <div class="row" style="margin-bottom:10px;">
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
			    <div id="orderResult" style=""></div>
			</div>
            <!--end panel-body-->
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
	height:45px;
}
</style>
