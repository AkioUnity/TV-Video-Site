<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
?>
<tr>
    <td class="">
      <a href="<?=$_cancel.'/edit/'.$set_data->rand_id?>">
      <p class="text-black"><img src="<?=!empty($set_data->image_2)?'assets/uploads/channels/thumbnails/'.$set_data->image_2:'assets/uploads/no-image.gif'?>" style="padding: 2px; border: lightgrey solid thin;width:100px;height:auto" /> <?=$set_data->name?></p></a>
    <p class="small hint-text"><?=$set_data->short_description?></p>
    </td>
    <td class="text-center"><?=$set_data->type?></td>
<td class="">
<input type="checkbox" value="1" data-init-plugin="switchery" class=" js-switch js-switch-<?=$set_data->rand_id?>" id="checkbox-<?=$set_data->rand_id?>" onclick="set_active('<?=$set_data->rand_id?>');" <?=$set_data->enabled==1?'checked':''?> data-id="<?=$set_data->rand_id?>"; />
</td>    
    <td class="text-center"><a href="<?=$_user_link.'/shows/l/'.$set_data->rand_id?>"><?=print_count('shows',array('channel_id'=>$set_data->id))?></a></td>
    <td class="text-center"><?=date('d-m-Y',$set_data->created)?></td>
    <td class="text-right">
      <a href="<?=$_cancel.'/edit/'.$set_data->rand_id?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
      <a href="<?=$_cancel.'/edit_clone/'.$set_data->rand_id?>" class="btn btn-xs btn-warning"><i class="fa fa-copy"></i> Clone</a>
    
    <a class="btn btn-xs btn-danger" href="<?=$_cancel.'/delete/'.$set_data->rand_id;?>" onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>
      
    </td>
</tr>

<script>
var elem_<?=$set_data->id?> = document.querySelector('.js-switch-<?=$set_data->rand_id?>');
var init = new Switchery(elem_<?=$set_data->id?>, { size: 'small' });
var changeCheckbox = document.querySelector('.js-check-change');

elem_<?=$set_data->id?>.onchange = function() {
	set_active(<?=$set_data->rand_id?>);
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
