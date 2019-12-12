<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$i++;
		$service = json_decode($set_data->services);
		$options = json_decode($set_data->options);
?>
<tr>
<td><?=$set_data->first_name.' '.$set_data->last_name?></td>
<td><?=$set_data->company_name?></td>
<td><?=$set_data->website?></td>
<td><?=$set_data->details;?></td>
<td><?=$options?implode(', ',$options):'';?></td>
<td><?=$service?implode(', ',$service):'';?></td>
<td><?=$set_data->friends;?></td>
<td>
<?php
if($set_data->status==0){
?>
<a class="btn btn-xs btn-primary" href="<?=$_cancel.'/set_confirm/'.$set_data->id;?>" onclick="return confirm_box();">Get Confirm</a>
<?php
}
?>

</td>
</tr>
<?php             
	}
}
?>                        
