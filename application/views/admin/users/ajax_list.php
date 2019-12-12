<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$i++;
?>
<tr>
<td><?=$i?></td>

<td><?=$set_data->username?></td>
<td><?=$set_data->email;?></td>

<td>
<?php
if($set_data->confirm=='confirm'){
echo 'Confirm';
}
else{
echo 'Not Confirm<br>';
?>
<a href="<?=$_cancel?>/set_user/<?=$set_data->id?>">Set As User</a>
<?php
}
?>
</td>
<td>
<select onchange="get_status('users',<?=$set_data->id;?>,this.value)" name="martial_id">
<option value="1" <?=$set_data->status==1?'selected':''?>>Active</option>
<option value="0" <?=$set_data->status==0?'selected':''?>>Inactive</option>
</select>
</td>
<td>
<?php
if($set_data->parent_id!=0){
	echo print_value('users',array('id'=>$set_data->parent_id),'username');
}
else if($set_data->admin_id!=0){
	echo print_value('admin',array('id'=>$set_data->admin_id),'name');
}
else{
	echo '-';
}
?>
</td>

<td>
<a class="btn btn-xs btn-primary " style="min-width:120px; min-height:25px;"  href="<?=$_cancel.'/change_password/'.$set_data->id;?>" ><i class="fa fa-key"></i> Reset Password</a>
<a class="btn btn-xs btn-success" style="min-width:120px; min-height:25px;" href="<?=$_cancel.'/access/'.$set_data->id;?>"  target="_blank"><i class="fa fa-sign-in"></i> Login Access</a>
<a class="btn btn-xs btn-info " style="min-width:120px; min-height:25px;"  href="<?=$_cancel.'/send_mail/'.$set_data->id;?>" ><i class="fa fa-share"></i> Send Mail</a>
<a class="btn btn-xs btn-success " style="min-width:120px; min-height:25px;" href="<?=$_cancel.'/edit/'.$set_data->id;?>" title="" ><i class="fa fa-edit"></i> Edit User</a>
<hr>
<a class="btn btn-xs btn-danger" style="min-width:120px; min-height:25px;" href="<?=$_delete?>/<?=$set_data->id;?>" onclick="return confirm_box();"><i class="fa fa-trash-o"></i> DELETE USER</a>

                        </td>
                    </tr>
<?php             
	}
}
?>                        
