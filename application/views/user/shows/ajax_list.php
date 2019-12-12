<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$rand_id = print_value('channels',array('id'=>$set_data->channel_id),'rand_id');
?>
<tr>
<td class="">
<a href="<?=$set_data->is_delete==0?
$_cancel.'/edit/'.$set_data->rand_id:'javascript:;'?>"><img src="<?=!empty($set_data->image)?'assets/uploads/channels/thumbnails/'.$set_data->image:'assets/uploads/no-image.gif'?>" style="padding: 2px; border: lightgrey solid thin;width:100px;height:90px" />
</a>

</td>
<td class="">
<a href="<?=$set_data->is_delete==0?
$_cancel.'/edit/'.$set_data->rand_id:'javascript:;'?>"><p class="text-black"><?=$set_data->name?></p>
</a>
<p class="small hint-text"><?=$set_data->short_description?></p>
</td>
<td class="text-center"><?=print_value('channels',array('id'=>$set_data->channel_id),'name')?></td>
<td class="">
<?php
if($set_data->is_delete==0){
?>
<input type="checkbox" value="1" data-init-plugin="switchery" class=" js-switch js-switch-<?=$set_data->rand_id?>" id="checkbox-<?=$set_data->rand_id?>" onclick="set_slider('<?=$set_data->rand_id?>');" <?=$set_data->is_slider==1?'checked':''?> data-id="<?=$set_data->rand_id?>"; />
<?php
}
?>
</td>
<td class="text-center">S.<?=$set_data->series_number?></td>
<td class="text-center">E.<?=$set_data->episode_number?></td>
  <td class="text-center"><?=date('d-m-Y',$set_data->created)?></td>
<td class="text-right " style="padding:10px 0">
<?php
if($set_data->is_delete==0){
?>
<a href="<?=$_cancel.'/edit_clone/'.$set_data->rand_id?>" class="btn btn-xs btn-warning"><i class="fa fa-copy"></i> Clone</a>
<a href="<?=$_cancel.'/edit/'.$set_data->rand_id?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
<a class="btn btn-xs btn-danger" href="<?=$_cancel.'/delete/'.$set_data->rand_id;?>" onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>
<?php
}
?>
  </td>
</tr>
<script>
var elem_<?=$set_data->id?> = document.querySelector('.js-switch-<?=$set_data->rand_id?>');
var init = new Switchery(elem_<?=$set_data->id?>, { size: 'small' });
var changeCheckbox = document.querySelector('.js-check-change');

elem_<?=$set_data->id?>.onchange = function() {
	set_slider(<?=$set_data->rand_id?>);
};
</script>        

<?php
	}
}
else{
?>
<tr><td colspan="6">There is no data.</td></tr>
<?php
}
?>
