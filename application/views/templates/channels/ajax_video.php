<?php
$i = ($page_number-1)*20;
if($all_data){
	foreach($all_data as $set_data){
		$images = 'assets/uploads/no-image.gif';
		if(!empty($set_data->image)){
			$images = 'assets/uploads/channels/thumbnails/'.$set_data->image;
		}
?>
<div class="col-xs-6 col-sm-6 col-md-3">
<div class="post hover-light">
<div class="image video-frame" data-src="<?=$images?>" style="background-image: url('<?=$images?>');">
<img src="assets/frontends/images/1x1.png" alt="Proportion">
<a class="video-player video-player-small video-player-inside" href="<?=$set_data->video_link?>"></a>
</div>
</div>
</div>
<?php
	}
}
else{
?>
<h3 style="color:#FFF">There is no video.</h3>
<?php
}
?>
