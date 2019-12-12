<?php
$videoLink = '';
if(!empty($episode_data->video_link)){
	$video_id = h_get_vimeo_id($episode_data->video_link);
	$videoLink = '//player.vimeo.com/video/'.$video_id;
}
else if(!empty($episode_data->video_file)){
	$videoLink = 'assets/uploads/sliders/'.$episode_data->video_file;
}

//$string = "select * from series_episode where enabled =1 order by id desc limit 15";
$string ="SELECT series_episode.*,packages.slug AS p_url  FROM series_episode
JOIN packages ON series_episode.package_id = packages.id
where is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."'
AND series_episode.id!=".$episode_data->id."
ORDER BY series_episode.id desc limit 15";
$text_video = $this->comman_model->get_query($string,false);

$string = "select * from banners where template = 'Episode Bottom' and enabled =1 order by 'order' asc ";
$bottom_banner = $this->comman_model->get_query($string,false);

$similar_news = array();
$article_img = '';
if(!empty($episode_data->article_image)){
	$article_img = 'assets/uploads/news/full/'.$episode_data->article_image;
}
else if(!empty($episode_data->image)){
	$article_img = 'assets/uploads/news/full/'.$episode_data->image;
}

$string ="SELECT series_episode.*, COUNT(episode_id) AS show_count FROM series_episode
JOIN series_view ON series_episode.id = series_view.episode_id
where is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."'
GROUP BY episode_id
ORDER BY show_count desc limit 20";
$trending_list = $this->comman_model->get_query($string,false);

?>
<?php $this->load->view('templates/includes/header'); ?>
<style>
.ms-sl-selected .ms-layer.box{
    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
.ms-sl-selected .ms-layer.box:hover{
    display: block;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}
@-webkit-keyframes fadeIn {
    from { opacity: 0; }
      to { opacity: 1; }
}

@keyframes fadeIn {
    from { opacity: 0; }
      to { opacity: 1; }
}
@keyframes cssAnimation {
    to {
		opacity:0;
    }
}
@-webkit-keyframes cssAnimation {
    to {
		opacity:0;
    }
}
</style>
<body class="news-content">
    <div class="wrapper">
        <header id="header" class="header-news">
<?php $this->load->view('templates/includes/menu_news'); ?>
<div class="panel-ticker">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="tt-el-ticker">
                    <strong>Latest: </strong>
                    <span class="entry-arrows">
                        <a href="javascript:;" class="ticker-arrow-prev"><img src="assets/frontends/images/arrow-lr-left.png" alt="arrow"></a>
                        <a href="javascript:;" class="ticker-arrow-next"><img src="assets/frontends/images/arrow-lr-right.png" alt="arrow"></a>
                    </span>
                    <span class="entry-ticker">
<?php
if($text_video){
	foreach($text_video as $set_news){
		$html = strip_tags($set_news->name);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 13);
?>
<span ><?=$new_html?></span>
<?php /*?><span ><?=$new_html?> <a href="<?=base_url('v/'.$set_news->p_url.'/series/'.$set_news->series_id.'/episode/'.$set_news->id)?>">Click Here</a></span><?php */?>
<?php		
	}
}
?>                    
                    </span>
                </div>
            </div>
            <div class="col-sm-3 text-right phl0">
                <div class="tt-el-info text-right">
                    <h4><?=date('d')?></h4>
                    <p><?=date('F')?>, <?=date('l')?></p>
                </div>                            
                <!--<div class="tt-el-info text-right">
                    <h4 class="top-weather">32˚C</h4>
                    <p class="current-location">Current location</p>
                </div>-->
            </div>
        </div>
    </div>
</div>
        </header>

    <div class="content-area pvt0">
	<div class="container">
	<!-- end .row -->
        <div class="row">
            <div class="col-md-12">
<h2 class="block-title2 mv5" data-title="On pTV"><?=print_value('packages',array('id'=>$episode_data->package_id),'name')?></h2>    
            </div>
        </div>    
        <div class="row">     
                <div class="col-md-12">
        <!-- Photo slider -->
                    <div class="news-slider photo-news-slider news-block">
        <!-- masterslider -->
                        <div class="master-slider ms-skin-default" id="masterslider">
                            <div class="ms-slide">
                                <iframe src="<?=$videoLink?>" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen style="background: #000000;"></iframe>
                                <div class="ms-thumb post">
                                    <div class="image" data-src="<?=!empty($episode_data->article_image)?'assets/uploads/news/full/'.$episode_data->article_image:'assets/uploads/no-image.gif'?>">
                                    </div>
                                        <div class="meta">
                                            <span class="author" style="padding-left:10px;"><?=print_value('series',array('id'=>$episode_data->series_id),'name')?>, Episode <?=$episode_data->episode?></span>
                                            <span class="date"><?=$episode_data->length.' '.$episode_data->length_type?></span>
                                        </div>
                                        <h4 style="padding-left:10px; padding-right: 10px; padding-bottom: -10px;"><?=$episode_data->name?></h4>
<!--                                        <h5 style="padding-left:10px; padding-right: 10px; margin: 0px; float: left;">Where to buy?</h5>-->
                                </div>
				<div class="ms-layer box" data-effect="bottom(45)" data-duration="10" data-ease="easeInOut" style="padding: 25px">
                                    <div class="meta animate-element" data-anim="fadeInUp">
                                        <span class="author"><?=print_value('series',array('id'=>$episode_data->series_id),'name')?>, Episode <?=$episode_data->episode?></span>
                                        <span class="date"><?=$episode_data->length.' '.$episode_data->length_type?></span>
                                    </div>
<div style="clear:both"></div>
<a href="<?=$episode_data->link?>"><h4 class="animate-element" data-anim="fadeInUp"><?=$episode_data->name?></h4></a>
<div style="clear:both"></div>
<a href="<?=$episode_data->link?>"><p class="animate-element" data-anim="fadeInUp">
<?php
$html = strip_tags($episode_data->summary);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
$new_html = word_limiter($html, 20);
echo $new_html
?></p></a>
                                </div>
                            </div>
<?php
if($episode_list){
	foreach($episode_list as $set_data){
		$setVideoLink = '';
		if(!empty($set_data->video_link)){
			$video_id = h_get_vimeo_id($set_data->video_link);
			$setVideoLink = '//player.vimeo.com/video/'.$video_id;
		}
		else if(!empty($episode_data->video_file)){
			$setVideoLink = base_url('series/video_frame/'.$set_data->id);
			//$setVideoLink = 'assets/uploads/news/'.$set_data->video_file;
		}
		$html = strip_tags($set_data->summary);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 20);
?>
<div class="ms-slide">
    <iframe src="<?=$setVideoLink?>" width="100%" height="100%" frameborder="0" allow="fullscreen" allowfullscreen style="background: #000000;"></iframe>
    <?php /*?><img src="assets/fronends/images/blank.gif" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/full/'.$set_data->article_image:'assets/uploads/no-image.gif'?>" alt="Image"/><?php */?>
    <div class="ms-thumb post">
        <div class="image" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/full/'.$set_data->article_image:'assets/uploads/no-image.gif'?>">
        </div>
            <div class="meta">
                <span class="author" style="padding-left:10px;"><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></span>
                <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
            </div>
            <h4 style="padding-left:10px; padding-right: 10px; padding-bottom: -10px;"><?=print_value('packages',array('id'=>$set_data->package_id),'name')?></h4>
<!--            <h5 style="padding-left:10px; padding-right: 10px; margin: 0px; float: left;">Where to buy?</h5>-->
    </div>
<div class="ms-layer box" data-effect="bottom(45)" data-duration="10" data-ease="easeInOut" style="padding: 25px">
        <div class="meta animate-element" data-anim="fadeInUp">
            <span class="author"><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></span>
            <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
        </div>
<div style="clear:both"></div>
<a href="<?=$set_data->link?>"><h4 class="animate-element" data-anim="fadeInUp"><?=$set_data->name?></h4></a>
<div style="clear:both"></div>
<a href="<?=$set_data->link?>"><p class="animate-element" data-anim="fadeInUp"><?=$new_html?></p></a>
    </div>
</div>
<?php		
	}
}

?>                            
                            		
			</div>
	<!-- end of masterslider -->
                    </div>
	<!-- end of Photo slider -->
                </div>
        <!-- end col-md-12 -->        
                <div class="col-md-12">
                    <div class="border-line mv3" style="border-color: #666;"></div>
                </div>
            </div>
        <!-- end .row -->
        
        <!-- Similar -->        
            <div class="row">
		<div class="col-md-12">
                    <h3 class="block-title mt0" >
                    SIMILAR
                    </h3>
		</div>
                <div class="col-md-12">
                    <div class="m-dimension-carousel news-block" data-col="3" data-row="1">
                            <div class="swiper-container carousel-container">
                               <div class="swiper-wrapper">
<?php
if($related_news){
	foreach($related_news as $set_data){
		$html = strip_tags($set_data->summary);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 15);
?>
<div class="swiper-slide">
    <div class="category-block articles">
        <div class="post hover-dark">
            <div class="image video-frame" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/full/'.$set_data->article_image:'assets/uploads/no-image.gif'?>">
                <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                <a class="video-player" href="<?=$set_data->video_link?>"></a>
            </div>
            <div class="meta">
    	        <span class="author2"><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></span>
	            <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
            </div>
            <h4><a href="<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>" ><?=$set_data->name?></a></h4>
            <p><?=$new_html?></p>
            <div class="meta">
                <a href="<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>" style="float: right;">
                <span class="author2">More Episodes</span></a>
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
					<a href="javascript:;" class="swiper-button-prev arrow-link" title="Prev"><img src="assets/frontends/images/arrow-left.png" alt="Arrow"></a>
					<a href="javascript:;" class="swiper-button-next arrow-link" title="Next"><img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>
                                    </div>
				</div>
                <!-- end swiper-container -->
                            </div>
                </div>
            </div>
        <!-- end similar -->
        <div class="col-md-12">
            <div class="border-line mv3"></div>
        </div>
        <!-- end .row -->
        <!-- Popular -->
        <div class="row">
		<div class="col-md-12">
                    <h3 class="block-title mt0" >
                    Trending
                    </h3>
		</div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="m-dimension-carousel news-block" data-col="4" data-row="1">
                            <div class="swiper-container carousel-container">
                               <div class="swiper-wrapper">
<?php
if($trending_list){
	foreach($trending_list as $set_data){
		$package_url = print_value('packages',array('id'=>$set_data->package_id),'slug','package');
		$html = strip_tags($set_data->summary);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 15);
?>
<div class="swiper-slide">
    <div class="category-block articles">
        <div class="post hover-dark">
            <div class="image video-frame" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/full/'.$set_data->article_image:'assets/uploads/no-image.gif'?>">
                <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                <a class="video-player" href="<?=$set_data->video_link?>"></a>
            </div>
            <div class="meta">
    	        <span class="author2"><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></span>
	            <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
            </div>
            <h4><a href="<?=base_url('v/'.$package_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>" ><?=$set_data->name?></a></h4>
            <p><?=$new_html?></p>
            <div class="meta">
                <a href="<?=base_url('v/'.$package_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>" style="float: right;">
                <span class="author2">More Episodes</span></a>
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
					<a href="javascript:;" class="swiper-button-prev arrow-link" title="Prev"><img src="assets/frontends/images/arrow-left.png" alt="Arrow"></a>
					<a href="javascript:;" class="swiper-button-next arrow-link" title="Next"><img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>
                                    </div>
				</div>
                <!-- end swiper-container -->
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        <!-- end Popular-->
        
        <!-- end similar -->
        <div class="col-md-12">
            <div class="border-line mv3"></div>
        </div>
        <!-- end .row -->
        
		<div class="row">
<?php
if($bottom_banner){
	foreach($bottom_banner as $set_banner){
?>
<div class="col-md-12 pv3 pvb0">
<a href="<?=$set_banner->link?>">
    <img src="<?='assets/uploads/banners/'.$set_banner->image?>" alt="banner">
</a>
</div>
<?php	
	}
}
?>            
                    
		</div>
	</div>
	<!-- end .container -->
</div>
<!-- .content-area -->

    <div class="clearfix"></div>
    <?php $this->load->view('templates/includes/footer'); ?>
    </div>
    <!-- end .wrapper -->
</body>
</html>