<?php
$home_right_banner = $this->comman_model->get_by('banners',array('template'=>'home_right'),array('order'=>'asc'));

$this->db->limit(8);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Finances','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));

$home_category = $this->comman_model->get_by('news_category',array('enabled'=>1),array('order'=>'asc'));
//$home_tags= $this->comman_model->get_by('news_tag',array('enabled'=>1),array('order'=>'asc'));
$strting  = "SELECT COUNT(slug) AS total, slug, name FROM news_tags GROUP BY slug ORDER BY total desc limit 5";
$home_tags= $this->comman_model->get_query($strting,false);

?>
<a href="category/Finance"><h2 class="block-title mt8" data-title="Finance">
Articles
<!--<a href="#" class="category-more text-right">Continue to the category <img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>-->
</h2>
</a>

<div class="section-blog en-block category-block sticky-parent">
    
<div class="row">

    <div class="col-sm-8 col-md-9 sticky-column">
        <div class="row none-masonry animated-blocks">

<?php
if($home_featured){
	foreach($home_featured as $set_news){
		$author = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($author){
			$html = strip_tags($set_news->description);
			$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
			$new_html = word_limiter($html, 20);
			$this->db->limit(2);
			$more_image = $this->comman_model->get_by('news_image',array('news_id'=>$set_news->id),false,false);
?>
<div class="col-xs-12 col-sm-6 col-md-4 ab-item">
	<div class="post boxed mb3 color-2 cart-style">
    
    <div class="clearfix">
        <img class="image-thumb" src="<?=!empty($author->image)?'assets/uploads/news/full/'.$author->image:'assets/uploads/no-image.gif'?>" alt="Image">
        <a href="#" class="label">LATEST</a>
        <div class="meta">
            <span class="author"><?=$author->name?> </span>
            <span class="date"><?=date('d M',$set_news->created)?></span>
        </div>
    </div>
    <h4 class="font18"><a href="news/v/<?=$set_news->id?>"><?=$set_news->name?></a></h4>
                                    <p><?=$new_html?>...</p>
<?php
if($more_image){
?>    
<div class="image-grid col-2">
<?php
foreach($more_image as $set_img){
?>    
    <div class="image" data-src="<?='assets/uploads/news/'.$set_img->filename?>" style="background-image: url('<?='assets/uploads/news/'.$set_img->filename?>');">
        <img src="assets/frontends/images/4x3.png" alt="Placeholder">
    </div>
<?php
}
?>    
</div>    
<?php
}
?>    
    <a href="<?='news/v/'.$set_news->id?>" class="category-more">Read More <img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>
    
</div>
</div>
<?php			
		}
	}
}
?>                            
            
    
        </div>
        <!-- /.row -->
        
    </div>
    <!-- /.col -->
    

    <div class="col-sm-4 col-md-3 sticky-column">

        <div class="theiaStickySidebar">
            <div class="sidebar boxed p4">

                <div class="widget categories">
                    <h5 class="widget-title color-2"><span>Categories</span></h5>
                    <ul>
<?php
/*if($home_category){
	foreach($home_category as $set_cat){
?>                    
<li>
<a href="<?=$set_cat->link?>"><?=$set_cat->name?></a><!--<span>(74)</span>-->
</li>
<?php
	}
}*/
?>
<li><a href="category/Leaders">Leaders</a> <span><?=print_count('news',array('section'=>'Leader'))?></span></li>
<li><a href="category/Blazers">Blazers</a> <span><?=print_count('news',array('section'=>'Blazers'))?></span></li>
<li><a href="category/PropertyNews">Property News</a> <span><?=print_count('news',array('section'=>'Property News'))?></span></li>
<li><a href="category/OnTheBeat">On The Beat</a> <span><?=print_count('news',array('section'=>'On The Beat'))?></span></li>
<li><a href="category/Finance">Finance</a> <span><?=print_count('news',array('section'=>'Finances'))?></span></li>
<li><a href="category/Editorial">Editorial</a> <span><?=print_count('news',array('section'=>'Editorial'))?></span></li>

                    </ul>
                </div>
                <!-- end .widget -->



<?php
//$monthData =get_month_news();
?>
<?php /*?><div class="widget categories">
<h5 class="widget-title color-2"><span>Archive</span></h5>
<ul>
<li>
    <a href="#">January</a>
    <span><?=$monthData['January']?></span>
</li>
<li>
    <a href="#">Febrary</a>
    <span><?=$monthData['Febrary']?></span>
</li>
<li>
    <a href="#">March</a>
    <span><?=$monthData['March']?></span>
</li>
<li>
    <a href="#">April</a>
    <span><?=$monthData['April']?></span>
</li>
<li>
    <a href="#">May</a>
    <span><?=$monthData['May']?></span>
</li>
<li>
    <a href="#">May</a>
    <span><?=$monthData['May']?></span>
</li>

<li>
    <a href="#">June</a>
    <span><?=$monthData['June']?></span>
</li>

<li>
    <a href="#">July</a>
    <span><?=$monthData['July']?></span>
</li>
<li>
    <a href="#">August</a>
    <span><?=$monthData['August']?></span>
</li>
<li>
    <a href="#">September</a>
    <span><?=$monthData['September']?></span>
</li>

<li>
    <a href="#">October</a>
    <span><?=$monthData['October']?></span>
</li>
<li>
    <a href="#">November</a>
    <span><?=$monthData['November']?></span>
</li>

<li>
    <a href="#">December</a>
    <span><?=$monthData['December']?></span>
</li>
</ul>
</div><?php */?>
                <!-- end .widget -->


                <div class="widget">
                    <h5 class="widget-title color-2"><span>Tag Cloud</span></h5>
                    <div class="widget-tags">
<?php
if($home_tags){
	foreach($home_tags as $set_cat){
?>                    
<a href="<?='news/tags/'.$set_cat->slug?>"><?=$set_cat->name?></a>
<?php
	}
}
?>
                    </div>
                </div>
                <!-- end .widget -->


                <div class="widget">
<?php
if($home_right_banner){
	foreach($home_right_banner as $set_banner){
?>
<a href="<?=$set_banner->link?>">
<img src="assets/uploads/banners/<?=$set_banner->image?>" alt="banner" class="full-size">
</a>
<?php
	}
}
?>                        
                </div>
                <!-- end .widget -->

            </div>
            <!-- end .sidebar -->
        </div>
    </div>
    <!-- /.col -->
    
</div>
<!-- /.row -->

</div>
