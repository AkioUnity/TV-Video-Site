<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
<div class="row" style="margin-bottom:10px;">
    <div class="col-md-6">
        <div class="btn-group">	        
            <a href="<?=$_cancel.'/create'?>" class="btn btn-primary m-r-5 m-b-5">
            Add New  <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            
                <thead>
                <tr>
			        <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
			        <th><?=show_static_text($adminLangSession['lang_id'],16);?></th>
			        <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
			        <th><?=show_static_text($adminLangSession['lang_id'],18);?></th>
			        <th><?=show_static_text($adminLangSession['lang_id'],258);?></th>
                </tr>
                </thead>
                <tbody>

<?php
if(count($all_data)){
	foreach($all_data as $set_data){
?>
                        <tr>
                            <td><?=$set_data->id;?></td>
                            <td><?=$set_data->name;?></td>
                            <td><?=$set_data->username;?></td>
                            <td><?=$set_data->email;?></td>
                            <td>

<a class="btn btn-icon-only btn-success " href="<?=$_edit?>/<?=$set_data->id;?>" ><i class="fa fa-edit"></i></a>

<a class="btn btn-icon-only btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>"  onclick="return confirm_box();" title=""><i class="fa fa-trash-o"></i></a>

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
        <!-- end panel -->
    </div>
</div>


<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}


</script>