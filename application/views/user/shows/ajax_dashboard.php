<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$rand_id = print_value('channels',array('id'=>$set_data->channel_id),'rand_id');
?>
        <tr>
<td class="">
<a href="<?=$_user_link.'/shows/edit/'.$rand_id.'/'.$set_data->rand_id?>"><p class="text-black"><?=$set_data->name?></p></a>
</td>
<td class="text-center">series <?=$set_data->series_number?></td>
 <td class="text-right">
<input type="checkbox" value="1" data-init-plugin="switchery" class=" js-switch js-switch-<?=$set_data->rand_id?>" id="checkbox-<?=$set_data->rand_id?>" onclick="set_slider('<?=$set_data->rand_id?>');" <?=$set_data->is_slider==1?'checked':''?> data-id="<?=$set_data->rand_id?>"; />
</td>
  <!--<td class="w-25"><span class="font-montserrat fs-18">0</span></td>-->
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
?>
