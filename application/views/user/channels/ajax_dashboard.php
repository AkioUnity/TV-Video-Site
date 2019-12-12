<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$last_video = print_value('shows',array('channel_id'=>$set_data->id),'created','no video');
?>
<tr>
  <td class="">
	  <a href="<?=$_user_link.'/channel/edit/'.$set_data->rand_id?>"><p class="text-black"><?=$set_data->name?></p></a>
  </td>
 <td class="text-right hidden-lg">
    <span class="hint-text small"> </span>
  </td>
<td class="text-right b-r b-dashed b-grey w-25">
<?=$last_video!='no video'?date('d-m-Y',$last_video):''?></td>
  <td class="w-25">
    <span class="font-montserrat fs-18 <?=$set_data->enabled=='1'?'text-success':'text-warning'?>"><?=$set_data->enabled=='1'?'Yes':'No'?></span>
  </td>
</tr>
<?php
	}
}
?>        