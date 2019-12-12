<?php
$string = "select * from banners where template = 'Author Bottom' and enabled =1 order by 'order' asc ";
$author_bottom_banner = $this->comman_model->get_query($string,false);
$string = "select * from news where section in ('Blazers','Featured Video') and enabled =1 and s_date <= '".date('Y-m-d')."' AND e_date>= '".date('Y-m-d')."'  order by id desc limit 15";
$latest_news = $this->comman_model->get_query($string,false);
?>
<?php $this->load->view('templates/includes/header'); ?>
<style>
.category-block.articles .first h4 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    height: 38px;
    overflow: hidden;
}
.category-block .post.first p{
    display: -webkit-box;
    -webkit-line-clamp: 2;
    height: 38px;
    overflow: hidden;

}
</style>
<body class="">
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
if($latest_news){
	foreach($latest_news as $set_news){
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
    <div class="fullwidth-section image height-middle mb5" data-src="<?=!empty($author_data->cover_image)?'assets/uploads/news/full/'.$author_data->cover_image:'assets/frontends/images/author-hero.jpg'?>" data-section-type="parallax"></div>

    <section class="section-content single">

        <div class="container">
            <div class="row">
                <div class="col-md-2 col-md-push-1 entry-details">
                    <div class="author-info">
                        <img src="<?=!empty($author_data->image)?'assets/uploads/news/thumbnails/'.$author_data->image:'assets/uploads/profile.jpg'?>" style="border-radius: 50%; width: 100px; height: 100px;" />
                    </div>
                                
                    <div class="entry-author">
                        <h5>
                            <a href="javascript:;"><?=$author_data->name?></a><br>
                        </h5>
                    </div>
                    <div class="entry-views"><?=print_count('authors_view',array('author_id'=>$author_data->id))?> views</div>
                    <div class="entry-social">
        <a class="btn btn-social-icon btn-facebook" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo site_url(uri_string())?>&amp;t=<?php echo urlencode($author_data->name)?>', 'facebookShare', 'width=626,height=436'); return false;"><i class="fa fa-facebook"></i></a>
        <a class="btn btn-social-icon btn-google-plus" onClick="window.open('https://plus.google.com/share?url=<?php echo site_url(uri_string())?>', 'twitterShare', 'width=626,height=436'); return false;" ><i class="fa fa-google-plus"></i></a>
        <a class="btn btn-social-icon btn-twitter" onClick="window.open('http://twitter.com/share?text=<?php echo urlencode($author_data->name)?>&amp;url=<?php echo site_url(uri_string())?>', 'twitterShare', 'width=626,height=436'); return false;"><i class="fa fa-twitter"></i></a>
                    </div>

                </div>
                <!-- end .entry-details -->

                <div class="col-sm-7 col-md-push-1 entry-content">

                    <article class="blog-item blog-single">

                        <h2 class="post-title"><?=$author_data->name?></h2>

<?=$author_data->description?>
                    </article>


                </div>
                <!-- end .col-md-7.entry-content -->


            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->



                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="related-news">

                                        <div class="border-line mv5"></div>
                                        <h2 class="block-title mv8" data-title="Related">
                                            From <?=$author_data->name?>
                                        </h2>

                                        <div class="row">
<?php
if($related_news){
	$i=0;
	foreach($related_news as $set_news){
		$i++;
		if($i>6){
			break;
		}
		$html = strip_tags($set_news->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html,10);
		$open_link = 'news/v/'.$set_news->id;
		if($set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'){
			$open_link = $set_news->link;
		}
?>                                            
<div class="col-md-4">

<div class="category-block articles">
<div class="post first">
<div class="meta">
<span class="author"><?=$author_data->name?></span>
</div>
<h4><a href="<?=$open_link?>"><?=$set_news->name?></a></h4>
<p><?=$new_html?></p>
</div>
</div>
</div>
<?php
	}
}
?>                                            
                                        </div><!-- end row -->

                                    </div>
                                    <!-- end .related-news -->


                                    <div class="border-line mv3"></div>
                                    		<div class="row">
<?php
if($author_bottom_banner){
	foreach($author_bottom_banner as $set_banner){
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
                <div class="col-md-12">
                    <div class="border-line mv3"></div>
                </div>
            </div>
        <!-- end .column -->
        </div>
    <!-- end .row -->
    </div>
<!-- end .container -->


    </section>
    <!-- end .section-content -->


    <div class="clearfix"></div>

<?php $this->load->view('templates/includes/footer'); ?>
</div><!-- end .wrapper -->
</body>