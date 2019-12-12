<?php
$string = "select * from banners where template = 'Video Page Bottom' and enabled =1 order by 'order' asc ";
$bottom_banner = $this->comman_model->get_query($string,false);
$string = "select * from series_episode where enabled =1 order by id desc limit 15";
$text_video = $this->comman_model->get_query($string,false);
?>
<?php $this->load->view('templates/includes/header'); ?>
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
<span><?=$new_html?></span>
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
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="block-title2 mv5" data-title="On pTV">Featured<a name="featured"></a>
			</h2>
                        <div class="m-dimension-carousel news-block" data-col="3" data-row="2">
                            <div class="swiper-container carousel-container">
                               <div class="swiper-wrapper">
<?php
if($featured_show_list){
	foreach($featured_show_list as $set_data){
		$html = strip_tags($set_data->summary);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 15);
?>
<div class="swiper-slide">
    <div class="category-block articles">
        <div class="post hover-dark">
            <div class="image video-frame" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/thumbnails/'.$set_data->article_image:'assets/uploads/no-image.gif'?>">
                <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                <a class="video-player" href="<?=$set_data->video_link?>"></a>
            </div>
            <div class="meta">
    	        <span class="author2"><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></a></span>
	            <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
            </div>
            <h4><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$set_data->name?></a></h4>
            <p><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$new_html?></a></p>
            <div class="meta">
                <a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" style="float: right;">
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
            <!-- end article-carousel -->
	 		</div>
    <!-- end .col-md-12 -->	
                    <div class="col-md-12">
                        <div class="border-line mv3"></div>
                    </div>
		</div>
    <!-- end .row -->
		<div class="row">
                    <div class="col-md-12">
			<h2 class="block-title2 mv5" data-title="On pTV">
			NEW <a name="new"></a>
			</h2>
                        <div class="m-dimension-carousel news-block" data-col="3" data-row="2">
                            <div class="swiper-container carousel-container">
                               <div class="swiper-wrapper">
<?php
if($new_video_list){
	foreach($new_video_list as $set_data){
		$html = strip_tags($set_data->summary);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 15);
?>
<div class="swiper-slide">
    <div class="category-block articles">
        <div class="post hover-dark">
            <div class="image video-frame" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/thumbnails/'.$set_data->article_image:'assets/uploads/no-image.gif'?>">
                <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                <a class="video-player" href="<?=$set_data->video_link?>"></a>
            </div>
            <div class="meta">
    	        <span class="author2"><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></a></span>
	            <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
            </div>
            <h4><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$set_data->name?></a></h4>
            <p><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$new_html?></a></p>
            <div class="meta">
                <a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" style="float: right;">
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
            <!-- end article-carousel -->
	 		</div>
    <!-- end .col-md-12 -->	
                    <div class="col-md-12">
                        <div class="border-line mv3"></div>
                    </div>
		</div>
		<!-- end .row -->
            <div class="row">
                
                    <div class="col-md-12">
			<h2 class="block-title2 mv5" data-title="On pTV">
                            Top Picks<a name="popular"></a>
			</h2>
                        <div class="m-dimension-carousel news-block" data-col="3" data-row="2">
                            <div class="swiper-container carousel-container">
                               <div class="swiper-wrapper">
<?php
if($top_pick_list){
	foreach($top_pick_list as $set_data){
		$html = strip_tags($set_data->summary);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 15);
?>
<div class="swiper-slide">
    <div class="category-block articles">
        <div class="post hover-dark">
            <div class="image video-frame" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/thumbnails/'.$set_data->article_image:'assets/uploads/no-image.gif'?>">
                <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                <a class="video-player" href="<?=$set_data->video_link?>"></a>
            </div>
            <div class="meta">
    	        <span class="author2"><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></a></span>
	            <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
            </div>
            <h4><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$set_data->name?></a></h4>
            <p><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$new_html?></a></p>
            <div class="meta">
                <a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" style="float: right;">
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
            <!-- end article-carousel -->
	 		</div>
    <!-- end .col-md-12 -->	
                    <div class="col-md-12">
                        <div class="border-line mv3"></div>
                    </div>
		</div>
<!-- end .row -->
                <div class="row">
                    <div class="col-md-12">
			<h2 class="block-title2 mv5" data-title="On pTV">
			Trending<a name="trending"></a>
			</h2>
                        <div class="m-dimension-carousel news-block" data-col="4" data-row="1">
                            <div class="swiper-container carousel-container">
                               <div class="swiper-wrapper">
<?php
if($trending_list ){
	foreach($trending_list as $set_data){
		$html = strip_tags($set_data->summary);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 15);
?>
<div class="swiper-slide">
    <div class="category-block articles">
        <div class="post hover-dark">
            <div class="image video-frame" data-src="<?=!empty($set_data->article_image)?'assets/uploads/news/thumbnails/'.$set_data->article_image:'assets/uploads/no-image.gif'?>">
                <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                <a class="video-player" href="<?=$set_data->video_link?>"></a>
            </div>
            <div class="meta">
    	        <span class="author2"><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=print_value('series',array('id'=>$set_data->series_id),'name')?>, Episode <?=$set_data->episode?></a></span>
	            <span class="date"><?=$set_data->length.' '.$set_data->length_type?></span>
            </div>
            <h4><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$set_data->name?></a></h4>
            <p><a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" ><?=$new_html?></a></p>
            <div class="meta">
                <a href="javascript:;" onClick="window.location='<?=base_url('v/'.$set_data->p_url.'/series/'.$set_data->series_id.'/episode/'.$set_data->id)?>'" style="float: right;">
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
            <!-- end article-carousel -->
	 		</div>
    <!-- end .col-md-12 -->	
                    <div class="col-md-12">
                        <div class="border-line mv3"></div>
                    </div>
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

</body>
</html>
