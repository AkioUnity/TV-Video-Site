<?php
$this->db->limit(7);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Masonry Collage','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'asc'));
$this->db->limit(7,7);
$home_featured_2 = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Masonry Collage','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'asc'));
//echo $this->db->last_query();
$this->db->limit(7,14);
$home_featured_3 = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Masonry Collage','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'asc'));
if($home_featured||$home_featured_2||$home_featured_3){
?>
<style>
.article-carousel .video-player{
	color:#FFF;
}
</style>
<div class="article-carousel en-block en-carousel-block">

<div class="swiper-container carousel-container">
<div class="swiper-wrapper animated-blocks">

<?php
if($home_featured){
?>
    <div class="swiper-slide">
        <div class="masonry-layout row" data-col-width=".col-md-3">

<?php
$i= 0;
foreach($home_featured as $set_news){

	$articleLinkTarget = '';
	$open_link = $set_news->link;
	if($set_news->article_id!=0){
		$articleLinkTarget = 'target="_blank"';
		$open_link = 'news/v/'.$set_news->article_id;
	}
	$i++;
	if($i==1){
?>
<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
<div class="post">
	<div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
		<img src="assets/frontends/images/1x1.png" alt="Placeholder">
	</div>
	<div class="post-content">
		<div class="meta mb0">
			<span class="author"><?=$set_news->head_title?></span>
		</div>
		<h4><a href="<?=$open_link?>"  <?=$articleLinkTarget?>><?=$set_news->name?></a></h4>
	</div>
</div>

</div>
<?php
	}
	else if($i==2){
?>

<div class="col-xs-12 col-sm-4 col-md-6 masonry-item ab-item">
    <div class="post text-light color-1">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <a href="<?=$open_link?>" <?=$articleLinkTarget?> class="label"><?=$set_news->label?></a>
            <h4 class="font36"><a href="<?=$open_link?>" <?=$articleLinkTarget?>><span style="color:#333;"><?=$set_news->head_title?></span></a></h4>
            <div class="meta mb0">
                <span class="author" style="color:#333;"><?=$set_news->name?></span>
            </div>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==3){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content post-content-bottom">
            <div class="meta mb0">
                <span class="author"><?=$set_news->head_title?></span>
            </div>
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?>><?=$set_news->name?></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==4){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post text-light">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content meta-bottom">
            <h4 class="font36"><a href="<?=$open_link?>" <?=$articleLinkTarget?>><?=$set_news->head_title?></a></h4>
            <div class="meta mb0 white">
                <span class="author"><?=$set_news->name?></span>
            </div>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==5){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post text-light half-height">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <div class="meta mb0 white">
                <span class="author"><?=$set_news->head_title?></span>
            </div>
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?>><?=$set_news->name?></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==6){
?>

<div class="col-xs-12 col-sm-4 col-md-6 masonry-item ab-item">
    <div class="post">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" style="background:url('<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>')">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?>><?=$set_news->head_title?></a></h4>
<?php
if(!empty($set_news->v_link)){
?>
<a class="video-player video-player-center video-player-large button beauty-hover" href="<?=$set_news->v_link?>">Watch Now</a>

<?php
}
?>            
<!--<a class="video-player video-player-center video-player-large button beauty-hover" href="<?=$open_link?>">Watch Now</a>-->
            
        </div>
    </div>

</div>
<?php
	}
	else if($i==7){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post half-height">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?>><span style="color:#fff;"><?=$set_news->head_title?></span></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	}
?>
	</div>
</div>
<?php
}
if($home_featured_2){
?>
    <div class="swiper-slide">
        <div class="masonry-layout row" data-col-width=".col-md-3">

<?php
$i= 0;
foreach($home_featured_2 as $set_news){
	$articleLinkTarget = '';
	$open_link = $set_news->link;
	if($set_news->article_id!=0){
		$articleLinkTarget = 'target="_blank"';
		$open_link = 'news/v/'.$set_news->article_id;
	}
	$i++;
	if($i==1){
?>
<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
<div class="post">
	<div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
		<img src="assets/frontends/images/1x1.png" alt="Placeholder">
	</div>
	<div class="post-content">
		<div class="meta mb0">
			<span class="author"><?=$set_news->head_title?></span>
		</div>
		<h4><a href="<?=$open_link?>" <?=$articleLinkTarget?> ><?=$set_news->name?></a></h4>
	</div>
</div>

</div>
<?php
	}
	else if($i==2){
?>

<div class="col-xs-12 col-sm-4 col-md-6 masonry-item ab-item">
    <div class="post text-light color-1">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
<!--            <a href="#" class="label">What's Hot</a>-->
            <h4 class="font36"><a href="<?=$open_link?>" <?=$articleLinkTarget?> ><span style="color:#333;"><?=$set_news->head_title?></span></a></h4>
            <div class="meta mb0">
                <span class="author" style="color:#333;"><?=$set_news->name?></span>
            </div>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==3){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content post-content-bottom">
            <div class="meta mb0">
                <span class="author"><?=$set_news->head_title?></span>
            </div>
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?> ><?=$set_news->name?></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==4){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post text-light">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content meta-bottom">
            <h4 class="font36"><a href="<?=$open_link?>" <?=$articleLinkTarget?> ><?=$set_news->head_title?></a></h4>
            <div class="meta mb0 white">
                <span class="author"><?=$set_news->name?></span>
            </div>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==5){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post text-light half-height">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <div class="meta mb0 white">
                <span class="author"><?=$set_news->head_title?></span>
            </div>
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?> ><?=$set_news->name?></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==6){
?>

<div class="col-xs-12 col-sm-4 col-md-6 masonry-item ab-item">
    <div class="post">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?> ><?=$set_news->head_title?></a></h4>
<a class="video-player video-player-center video-player-large button beauty-hover" href="">Watch Now</a>
        </div>
    </div>

</div>
<?php
	}
	else if($i==7){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post half-height">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <h4><a href="<?=$open_link?>" <?=$articleLinkTarget?> ><span style="color:#fff;"><?=$set_news->head_title?></span></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	}
?>
	</div>
</div>
<?php
}
if($home_featured_3){
?>
    <div class="swiper-slide">
        <div class="masonry-layout row" data-col-width=".col-md-3">

<?php
$i= 0;
foreach($home_featured_3 as $set_news){
	$open_link = $set_news->link;
	if($set_news->article_id!=0){
		$open_link = 'news/v/'.$set_news->article_id;
	}
	$i++;
	if($i==1){
?>
<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
<div class="post">
	<div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
		<img src="assets/frontends/images/1x1.png" alt="Placeholder">
	</div>
	<div class="post-content">
		<div class="meta mb0">
			<span class="author"><?=$set_news->head_title?></span>
		</div>
		<h4><a href="<?=$open_link?>"><?=$set_news->name?></a></h4>
	</div>
</div>

</div>
<?php
	}
	else if($i==2){
?>

<div class="col-xs-12 col-sm-4 col-md-6 masonry-item ab-item">
    <div class="post text-light color-1">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
<!--            <a href="#" class="label">What's Hot</a>-->
            <h4 class="font36"><a href="<?=$open_link?>"><span style="color:#333;"><?=$set_news->head_title?></span></a></h4>
            <div class="meta mb0">
                <span class="author" style="color:#333;"><?=$set_news->name?></span>
            </div>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==3){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content post-content-bottom">
            <div class="meta mb0">
                <span class="author"><?=$set_news->head_title?></span>
            </div>
            <h4><a href="<?=$open_link?>"><?=$set_news->name?></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==4){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post text-light">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content meta-bottom">
            <h4 class="font36"><a href="<?=$open_link?>"><?=$set_news->head_title?></a></h4>
            <div class="meta mb0 white">
                <span class="author"><?=$set_news->name?></span>
            </div>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==5){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post text-light half-height">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <div class="meta mb0 white">
                <span class="author"><?=$set_news->head_title?></span>
            </div>
            <h4><a href="<?=$open_link?>"><?=$set_news->name?></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	else if($i==6){
?>

<div class="col-xs-12 col-sm-4 col-md-6 masonry-item ab-item">
    <div class="post">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <h4><a href="<?=$open_link?>"><?=$set_news->head_title?></a></h4>
<a class="video-player video-player-center video-player-large button beauty-hover" href="">Watch Now</a>
        </div>
    </div>

</div>
<?php
	}
	else if($i==7){
?>

<div class="col-xs-12 col-sm-4 col-md-3 masonry-item ab-item">
    <div class="post half-height">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x1.png" alt="Placeholder">
        </div>
        <div class="post-content">
            <h4><a href="<?=$open_link?>"><span style="color:#fff;"><?=$set_news->head_title?></span></a></h4>
        </div>
    </div>
    
</div>
<?php
	}
	}
?>
	</div>
</div>
<?php
}
?>        
    
</div>
<!-- /.swiper-wrapper -->
<?php
if($home_featured_2||$home_featured_3){
?>
<div class="pagination-next-prev bordered">
    <a href="#" class="swiper-button-prev arrow-link" title="Prev"><img src="assets/frontends/images/arrow-left.png" alt="Arrow"></a>
    <a href="#" class="swiper-button-next arrow-link" title="Next"><img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>
</div>
<?php
}
?>

</div>
<!-- /.swiper-container -->

</div>
<?php
}
?>
<!-- /.section-carousel -->
