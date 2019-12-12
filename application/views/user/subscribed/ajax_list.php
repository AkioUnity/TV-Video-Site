<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
?>
<tr>
    <td class="">
      <a href="<?=site_url('/channel/'.$set_data->channel_url)?>">
      <p class="text-black"><img src="<?=!empty($set_data->image_2)?'assets/uploads/channels/thumbnails/'.$set_data->image_2:'assets/uploads/no-image.gif'?>" style="padding: 2px; border: lightgrey solid thin;width:100px;height:auto" /> <?=$set_data->name?></p></a>
    <p class="small hint-text"><?=$set_data->short_description?></p>
    </td>
    <td class="text-center"><?=date('d-m-Y',$set_data->subscribe_date)?></td>
    <td class="text-right">
    <a class="btn btn-xs btn-danger" href="<?=$_cancel.'/delete/'.$set_data->subscribe_id;?>" onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>
      
    </td>
</tr>
<?php
	}
}
else{
?>
<tr><td colspan="3">There is no data.</td></tr>
<?php
}
?>
