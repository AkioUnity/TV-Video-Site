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
        <td class=" col-lg-2 col-md-3 col-sm-2 text-right">
<input type="checkbox" value="1" data-init-plugin="switchery" class=" js-switch js-switch-<?=$set_data->rand_id?>" id="checkbox-<?=$set_data->rand_id?>" onclick="set_active('<?=$set_data->rand_id?>');" <?=$set_data->enabled==1?'checked':''?> data-id="<?=$set_data->rand_id?>"; />
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
?>
