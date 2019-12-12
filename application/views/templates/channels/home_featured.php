<?php
if($featured_list){
?>
<div class="row">
    <div class="col-md-9">
        <h3 class="block-title3 mv5 mvt0" data-title="<?=$channel_data->name?>">Featured</h3>
        
    </div>
    <div class="col-md-3">
        <a href="<?=site_url($_cancel.'/'.$channel_data->channel_url.'/all');?>" class="category-more text-left">View All <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
    </div>
</div>
        <!-- pTV Featured carousel -->
<div class="m-dimension-carousel news-block" data-col="3" data-row="1">
<div class="swiper-container carousel-container swiper-container-horizontal" style="width: 100%;">
        <div class="swiper-wrapper">
<?php
if($featured_list){
	foreach($featured_list as $set_deta){
		$image = 'assets/frontends/channels/images/1.jpg';
		if(!empty($set_deta->image)){
			$image = 'assets/uploads/channels/thumbnails/'.$set_deta->image;
		}
?>
<div class="swiper-slide swiper-slide-active" style="width: 360px; margin-right: 30px;">
<div class="category-block articles">
<div class="post hover-dark">
<div class="image video-frame" data-src="" style="background-image: url('<?=$image?>');">
<img src="assets/frontends/images/5x3.png" alt="Proportion">
<a class="video-player video-player-center" href="<?=$set_deta->video_link?>"></a>
</div>
</div>
</div>
</div>
<?php
}
}
?>

        </div>
<!-- end swiper-wrapper -->
        <div class="pagination-next-prev mt3">
            <a href="javascript:;" class="swiper-button-prev arrow-link swiper-button-disabled" title="Prev"><img src="assets/frontends/images/arrow-left-white.gif" alt="Arrow"></a>
            <a href="javascript:;" class="swiper-button-next arrow-link" title="Next"><img src="assets/frontends/images/arrow-right-white.gif" alt="Arrow"></a>
        </div>
</div>
<!-- end swiper-container -->
</div>
<div class="mv10"></div>
<?php
}
?>
