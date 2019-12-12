<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
<div class="row" style="margin-bottom:10px">
    <div class="col-md-6">
        <div class="btn-group">
            <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
        </div>
    </div>
    
    </div>
<div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No.</th>								
                    <th>Title</th>
                    <th>Date</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>

<?php
$i=0;
if(count($all_data)){
	foreach($all_data as $set_data){
		$i++;
?>
<tr>
    <td><?=$i; ?></td>
    <td><?=$set_data->name; ?></td>
    <td><?=date('d-m-Y',$set_data->created); ?></td>

    <td>
    <a class="btn btn-icon-only btn-info" href="<?='api/property/v/'.$set_data->p_rand_id;?>"><i class="fa fa-code"></i></a>
    <a class="btn btn-icon-only btn-info" href="<?=$_edit.'/'.$set_data->id;?>"><i class="fa fa-edit"></i></a>
	<a class="btn btn-icon-only btn-danger" href="<?=$_delete.'/'.$set_data->id;?>"  onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>

        
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
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}
</script>