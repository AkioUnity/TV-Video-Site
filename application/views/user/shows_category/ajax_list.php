<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
?>
<tr>
<td class="">
<a href="<?=$_cancel.'/edit/'.$set_data->id?>"><p class="text-black"><?=$set_data->name?></p></a>
</td>
<td class="text-center"><?=date('d-m-Y',$set_data->created)?></td>
<td class="text-right">
<a class="btn btn-xs btn-primary" href="<?=$_cancel.'/edit/'.$set_data->id?>"><i class="fa fa-edit"></i></a>

<a class="btn btn-xs btn-danger" href="<?=$_cancel.'/delete/'.$set_data->id;?>" onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>
  </td>
</tr>
<?php
	}
}
else{
?>
<tr><td colspan="6">There is no data.</td></tr>
<?php
}
?>
