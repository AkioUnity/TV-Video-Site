<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$i++;
		$service = json_decode($set_data->services);
		$options = json_decode($set_data->production);
?>
<tr>
<td><?=$set_data->first_name.' '.$set_data->last_name?><br><?=$set_data->email?></td>
<td><?=$set_data->phone?></td>
<td><?=$set_data->description;?></td>
<td><?=$options?implode(', ',$options):'';?></td>
<td><?=$service?implode(', ',$service):'';?></td>
<td><?=date('d-m-Y',$set_data->created)?></td>
</tr>
<?php             
	}
}
?>                        
