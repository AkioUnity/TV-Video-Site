<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
<div class="row" style="margin-bottom:10px;">
	    <div class="col-md-6">
    		<div class="btn-group">
			    <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
            </div>
	    </div>
    	
	    </div>
			    <div class="table-responsive">

<table id="data-table" class="table table-striped table-hover">
    <thead>
    <tr>
        <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
        <th><?=show_static_text($adminLangSession['lang_id'],1920);?>Name</th>
        <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Date</th>
        <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
    </tr>
    </thead>
    <tbody>

<?php
if(count($all_data)){
foreach($all_data as $set_data){
	$username = 'Admin';
?>
<tr>
    <td><?=$set_data->id;?></td>
    <td><?=$set_data->name?></td>
    <td><?=date('d-m-Y',$set_data->created);?></td>
    <td>
<div class=" t-html-<?=$set_data->id?>" style="display:none;">
<?=$set_data->html?>
</div>
    
        <a class="btn btn-icon-only btn-info" href="javascript:;"  onclick="html_preview(<?=$set_data->id?>)" >
            <i class="fa fa-eye"></i></a>
        <a class="btn btn-icon-only btn-info" href="<?=$_cancel.'/edit/'.$set_data->id;?>" >
            <i class="fa fa-edit"></i></a>
        <a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();">
            <i class="fa fa-trash-o"></i></a>
    </td>                            
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


<script>
function confirm_box(){
    var answer = confirm ("<?=show_static_text($adminLangSession['lang_id'],265);?>");
    if (!answer)
     return false;
}


</script>


<style>
.product-list__content{
	padding:10px;
}
</style>

<div class="modal fade" id="html-editor-modals" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">Preview</h4>
            </div>
            <div class="modal-body">
<div class="col-md-12">
<div id="contentarea" class="" style="">
</div>
</div>
<div style="clear:both"></div>
			</div>
    </div>

	</div><!--//modal-dialog//-->
</div>
<script>
function html_preview(id){
	checkhtml = $('.t-html-'+id).html();
	if(checkhtml!== ''){
		$('#contentarea').html(checkhtml);
	}
	$('#html-editor-modals').modal() ;
}

</script>