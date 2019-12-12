<div class="row">
    <div class="col-md-12">
<?php $this->load->view('admin/news/tab',$this->data);?>
    
        <div class="portlet box green">
            <div class="portlet-body">
<div class="row" style="margin-bottom:10px">
    <div class="col-md-6">
        <div class="btn-group">
            <a href="<?=$_edit?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
<?php
if(isset($is_set_order)){
?>
            <a href="<?=$_cancel.'/orders/'?>" class="btn btn-primary m-r-5 m-b-5">Set Order <i class="fa fa-list"></i></a>
<?php
}
?>
        </div>
    </div>
    
    </div>
<div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Package</th>
                    <th>Title</th>
                    <th>Series</th>
                    <th>Episodes</th>
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
    <td><?=print_value('packages',array('id'=>$set_data->package_id),'name'); ?></td>
    <td><?=$set_data->name; ?></td>
    <td><?=print_value('series',array('id'=>$set_data->series_id),'name'); ?></td>
    <td><?=$set_data->episode?></td>
    <td><?=date('d-m-Y',$set_data->created); ?></td>
    <td>
<?php
$btnshow = false;
if($this->data['admin_details']->default==0){
	if($set_data->admin_id==$this->data['admin_details']->id){
		$btnshow = true;
	}
}
else{
		$btnshow = true;
}
if($btnshow){
?>
    <a class="btn btn-icon-only btn-info" href="<?=$_edit.'/'.$set_data->id;?>"><i class="fa fa-edit"></i></a>
	<a class="btn btn-icon-only btn-danger" href="<?=$_delete.'/'.$set_data->id;?>"  onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>
<?php
}
?>
        
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