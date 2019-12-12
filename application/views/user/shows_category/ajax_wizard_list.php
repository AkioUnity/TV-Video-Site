<?php
if($all_data){
	foreach($all_data as $set_data){
?>
<tr>
<td class="col-lg-8 col-md-6 col-sm-7">
    <span class="m-l-10 "><?=$set_data->name?></span>
</td>
<td class="col-lg-2 col-md-3 col-sm-3 text-right">
  <span><?=date('d-m-Y',$set_data->created)?></span>
</td>
<td class=" col-lg-2 col-md-3 col-sm-2 text-right"><?=$set_data->set_order?></td>
</tr>
<?php
	}
}
?>
