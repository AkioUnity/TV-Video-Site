<?php
$this->db->limit(5);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Featured Video','tab_section'=>'Live','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));

$this->db->limit(5);
$home_featured_2 = $this->comman_model->get_by('series_episode',array('enabled'=>1,'is_featured_video'=>'1','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d'),'is_draft'=>0),array('id'=>'desc'));

//$this->db->limit(5);
/*$home_featured_3 = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Featured Video','tab_section'=>'Archived','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));*/
if($home_featured||$home_featured_2){

?>
<style>
#home-featured-wp .post.boxoffice-style .label{
	bottom:0;
	top:inherit;
}
</style>
<div class="simple-tab-space" id="home-featured-wp">

        <div class="tab-title clearfix">
            <a href="#" class="active">Live</a>
            <a href="#">Featured</a>
<!--            <a href="#">Archived</a>-->
        </div>
        
        <div class="tab-panel">
            <div class="tab-content active">
                <div class="row row-has-5-columns">
<?php
if($home_featured){
$i=0;
$b_c = 0;
foreach($home_featured as $set_news){
    $i++;
	if($b_c>5){
		$b_c=0;
	}
	$b_c++;
    $stringQuery = "SELECT AVG(rate)AS rate FROM news_rate where news_id  =".$set_news->id;
    $rating = $this->comman_model->get_query($stringQuery,true);
    if($rating&&!empty($rating->rate)){			
        $totalRating = round($rating->rate,1);
    }
    else{
        $totalRating = 0;
    }
                                                
?>
<div class="col-xs-6 col-sm-4 col-md-15">
<div class="post boxoffice-style color-2">
<div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" style="background:url('<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>')">
    <a href="news/v/<?=$set_news->id?>">
        <img src="assets/frontends/images/2x3.png" alt="Image"/>
    </a>
<?php
if(!empty($set_news->label)){
?>    
    <a href="news/v/<?=$set_news->id?>" class="label bg-color-<?=$b_c?>"><?=$set_news->label?></a>
<?php
}
?>
    <!--<div class="entry-hover bigger-meta">
        <div class="meta-holder">
            <div class="circle-chart" data-circle-width="10" data-percent="69" data-text="6.9"></div>
            <span class="earnings">Free</span>
            <span class="views">11k views</span>
        </div>
    </div>-->
    <!-- /.entry-hover -->

</div>

<h4><a href="news/v/<?=$set_news->id?>"><?=h_dateFormat($set_news->publish_date,'d F, Y')?></a></h4>

</div>
<!-- /.post -->
</div>
<?php
}
}
?>
<!-- /.col -->
                
                </div>
                <!-- /.row -->

            </div>
            <!-- /.tab-panel -->
                    
            <div class="tab-content">
<div class="row row-has-5-columns">
                                                
<?php
if($home_featured_2){
$i=0;
foreach($home_featured_2 as $set_news){
    $i++;
?>
<div class="col-xs-6 col-sm-4 col-md-15">
<div class="post boxoffice-style color-2">
<div class="image" data-src="<?=!empty($set_news->featured_video_image)?'assets/uploads/news/full/'.$set_news->featured_video_image:'assets/uploads/no-image.gif'?>">
    <a href="<?=$set_news->link?>">
        <img src="assets/frontends/images/2x3.png" alt="Image"/>
    </a>
<?php
if(!empty($set_news->label)){
?>    
    <a href="<?=$set_news->link?>" class="label"><?=$set_news->label?></a>
<?php
}
?>

    <!--<div class="entry-hover bigger-meta">
        <div class="meta-holder">
            <div class="circle-chart" data-circle-width="10" data-percent="69" data-text="6.9"></div>
            <span class="earnings">Free</span>
            <span class="views">11k views</span>
        </div>
    </div>-->
    <!-- /.entry-hover -->

</div>
<h4><a href="<?=base_url('series/episode/'.$set_news->id)?>"><?=h_dateFormat($set_news->dates,'d F, Y')?></a></h4>

</div>
<!-- /.post -->
</div>
<?php
}
}
?>						
                
                </div>
                <!-- /.row -->
            </div>
            <!-- /.tab-panel -->
                    
            <!-- /.tab-panel -->
                    
                    </div>
        <!-- /.tab-panel -->
    </div>
<?php
}
?>        
