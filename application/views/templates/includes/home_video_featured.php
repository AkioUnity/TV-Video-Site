<?php
/*$this->db->limit(15);
$home_featured = $this->comman_model->get_by('series_episode',array('enabled'=>1,'is_featured_show'=>1,'s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));
*/
$string = "SELECT series_episode.*,packages.slug AS p_url FROM series_episode
JOIN packages ON series_episode.package_id = packages.id
WHERE series_episode.id IN (
    SELECT MAX(series_episode.id)
    FROM series_episode
	where `enabled` = 1 AND `is_featured_show` = 1 AND `s_date` <= '".date('Y-m-d')."' AND `e_date` >= '".date('Y-m-d')."' and is_draft =0
    GROUP BY package_id
)  
ORDER BY series_episode.id DESC LIMIT 15";
$home_featured = $this->comman_model->get_query($string,false);

$string = "SELECT series_episode.*,packages.slug AS p_url, COUNT(episode_id) AS t_episode FROM series_episode
JOIN packages ON series_episode.package_id = packages.id
JOIN series_view ON series_view.episode_id = series_episode.id
where series_episode.enabled = 1 AND `s_date` <= '".date('Y-m-d')."' AND `e_date` >= '".date('Y-m-d')."' and is_draft =0
GROUP BY series_view.episode_id 
ORDER BY t_episode DESC LIMIT 4";
$popular_servies = $this->comman_model->get_query($string,false);

$string = "SELECT series_episode.*,packages.slug AS p_url FROM series_episode
JOIN packages ON series_episode.package_id = packages.id
where series_episode.enabled = 1 AND `s_date` <= '".date('Y-m-d')."' AND `e_date` >= '".date('Y-m-d')."' and is_draft =0
ORDER BY series_episode.id DESC LIMIT 4";
$new_videos= $this->comman_model->get_query($string,false);
?>
<style>
.movie-section .swiper-slide:hover{
	cursor:pointer;
}
	
</style>
<div class="movie-section">
        <div class="container">

<!-- pTV Featured carousel -->
            <div class="col-md-12">
                    <h3 class="block-title mt0">
                    FEATURED SHOWS
<a href="<?=base_url('series/videos')?>" class="category-more text-right">View All <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
                    </h3>

                    
		</div>
            <div class="m-dimension-carousel news-block" data-col="3" data-row="1">
		<div class="swiper-container carousel-container swiper-container-horizontal" style="width: 100%;">
                    <div class="swiper-wrapper">
<?php
if($home_featured){
	foreach($home_featured as $set_news){
?>
<div class="swiper-slide swiper-slide-active" style="width: 360px; margin-right: 30px;" onclick="window.location='<?=base_url('v/'.$set_news->p_url.'/series/'.$set_news->series_id.'/episode/'.$set_news->id)?>'" >
<div class="category-block articles">
<div class="post hover-dark">
<div class="image " data-src="<?=!empty($set_news->featured_image)?'assets/uploads/news/full/'.$set_news->featured_image:'assets/uploads/no-image.gif'?>" style="background-image: url('<?=!empty($set_news->featured_image)?'assets/uploads/news/full/'.$set_news->featured_image:'assets/uploads/no-image.gif'?>');">
<img src="assets/frontends/images/5x3.png" alt="Proportion">
<a class="video-player video-player-center" ></a>
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

<!-- end FEATURED -->
<div class="mv6"></div>
<!-- Popular on pTV carousel -->
            <div class="row">
		<div class="col-md-12">
                    <h3 class="block-title mt0">
                    Popular on pTV
                    <a href="<?=base_url('series/videos')?>" class="category-more text-right">View All <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
                    </h3>
		</div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
				<div class="category-block articles">
<?php
if($popular_servies){
	foreach($popular_servies as $set_news){
?>                
<div class="col-xs-6 col-sm-6 col-md-3" onclick="window.location='<?=base_url('v/'.$set_news->p_url.'/series/'.$set_news->series_id.'/episode/'.$set_news->id)?>'">
<div class="post hover-light">
<div class="image video-frame" data-src="<?=!empty($set_news->square_image)?'assets/uploads/news/full/'.$set_news->square_image:'assets/uploads/no-image.gif'?>" style="background-image: url('<?=!empty($set_news->square_image)?'assets/uploads/news/full/'.$set_news->square_image:'assets/uploads/no-image.gif'?>');">
<img src="assets/frontends/images/1x1.png" alt="Proportion">
<a class="video-player video-player-small video-player-inside" ></a>
</div>
</div>
</div>
<?php
	}
}
?>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
<!-- END Popular on pTV carousel -->
<div class="mv6"></div>
<!-- Popular on pTV carousel -->
            <div class="row">
		<div class="col-md-12">
                    <h3 class="block-title mt0">
                    New to pTV
                    <a href="<?=base_url('series/videos')?>" class="category-more text-right">View All <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
                    </h3>
		</div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
				<div class="category-block articles">
<?php
if($new_videos){
	foreach($new_videos as $set_news){
?>                
<div class="col-xs-6 col-sm-6 col-md-3" onclick="window.location='<?=base_url('v/'.$set_news->p_url.'/series/'.$set_news->series_id.'/episode/'.$set_news->id)?>'">
<div class="post hover-light">
<div class="image video-frame" data-src="<?=!empty($set_news->square_image)?'assets/uploads/news/full/'.$set_news->square_image:'assets/uploads/no-image.gif'?>" style="background-image: url('<?=!empty($set_news->square_image)?'assets/uploads/news/full/'.$set_news->square_image:'assets/uploads/no-image.gif'?>');">
<img src="assets/frontends/images/1x1.png" alt="Proportion">
<a class="video-player video-player-small video-player-inside" ></a>
</div>
</div>
</div>
<?php
	}
}
?>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
<!-- END Popular on pTV carousel -->
        </div>
    </div>