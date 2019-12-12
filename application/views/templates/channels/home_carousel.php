<?php
//printR($complex_list);
if($complex_list){
?>
<style>
.ms-thumb-frame .ms-thumb .image{
	background-size:100% 60px;
}
</style>
<div class="col-md-9">
    <h3 class="block-title3 mv5 mvt0" data-title="<?=$channel_data->name?>"><?=$channel_data->complex_name?></h3>
</div>
<div class="col-md-3">
    
</div>
<div class="row">     
<div class="col-md-12">
<!-- Photo slider -->
    <!-- template -->
    
    <div class="gallery-slider mv2" data-speed="100">
        <!-- masterslider -->
        <div class="master-slider gallery-style ms-skin-default" id="masterslider">
<?php
if($complex_list){
foreach($complex_list as $set_data){
	$image = 'assets/frontends/images/news/news-03.jpg';
	$full_image = 'assets/frontends/images/news/news-03.jpg';
	if(!empty($set_data->image)){
		$full_image = 'assets/uploads/channels/full/'.$set_data->image;
		$image = 'assets/uploads/channels/thumbnails/'.$set_data->image;
	}
?>
<div class="ms-slide">
<div class="slide-pattern tint"></div>
<img src="assets/frontends/vendors/masterslider/style/blank.gif" data-src="<?=$image?>" alt="Image"/>
<div class="ms-thumb">
<div class="image" data-src="<?=$image?>"></div>
</div>
<div class="post first text-bigger hover-dark entry-media">
<div class="image video-frame">
<img src="<?=$full_image?>" alt="Post image"/>
<a class="video-player video-player-center video-player-large" href="<?=$set_data->video_link?>"></a>
</div>
</div>
<div class="ms-layer" data-effect="fade" data-duration="300" data-ease="easeInOut"><?=$set_data->name?></div>
</div>
<?php		
}
}
?>                        


        </div>
        <!-- end of masterslider -->

    </div>
    <!-- end of template -->
</div>
<!-- end col-md-12 -->        
</div>
<!-- end .row -->
<div class="mv16"></div>
<?php
}
?>

