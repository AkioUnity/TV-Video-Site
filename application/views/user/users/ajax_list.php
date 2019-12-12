<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$image = 'assets/uploads/profile.jpg';
		if(!empty($set_data->image)){
			$image = 'assets/uploads/users/thambails/'.$set_data->image;
		}
?>
<div class="col-md-5">
<div class="profile-img-wrapper m-t-5 inline">
  <img width="35" height="35" src="<?=$image?>" alt="" data-src="<?=$image?>" data-src-retina="<?=$image?>">
  <div class="chat-status available">
  </div>
</div>
<div class="inline m-l-10">
   <p class="small hint-text">
       <strong><?=$set_data->username?></strong>
       <br><?=$set_data->email?>
   </p>
</div>
<p class="small"><a href="<?=$_cancel.'/edit/'.$set_data->id?>">edit</a> | <a href="<?=$_cancel.'/delete/'.$set_data->id?>" onclick="return confirm_box();">delete</a></p>

</div>
<?php
	}
}
else{
?>
<div class="col-md-12">No additional users found.</div>
<?php
}
?>
