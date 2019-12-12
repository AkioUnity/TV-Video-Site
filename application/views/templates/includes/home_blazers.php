<?php
$this->db->limit(6);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Blazers','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d'),'order !='=>''),array('order'=>'asc'));
if($home_featured){
?>

<div class="row">
	
	<div class="col-md-12">
		
<a href="category/Blazers"><h2 class="block-title mt8" data-title="Blazers">
Blazers
<!--			<a href="#" class="category-more text-right">Continue to the category <img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>-->
</h2></a>


		<div class="masonry-layout1 masonry-no-col little-space row animated-blocks">
<?php
if($home_featured){
$i= 0;
foreach($home_featured as $set_news){
	$i++;
	$user_img = 'assets/uploads/profile.jpg';
	
	if($set_news->order==1){
?>
<div class="col-xs-12 col-sm-3 col-md-3 masonry-item ab-item">
<div class="post color-2">
    <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
        <img src="assets/frontends/images/8x5.png" alt="Image" class="grid-size">
    </div>
    <div class="entry-hover">
        <a href="news/v/<?=$set_news->id?>" class="label"><?=$set_news->label?></a>
        <h4><a href="news/v/<?=$set_news->id?>"><span style="color:#333;"><?=$set_news->name?></span></a></h4>
        <div class="meta">
            <span class="author"><?=print_value('authors',array('id'=>$set_news->author_id),'name')?></span>
<!--            <span class="date">30</span>-->
        </div>
    </div>
    <!-- /.entry-hover -->
</div>
<!-- /.post -->
</div>
<?php
	}
	else if($set_news->order==2){
?>
<div class="col-xs-12 col-sm-3 col-md-3 masonry-item ab-item">
    <div class="post color-3 bgwhite">
        <img src="assets/frontends/images/8x5.png" alt="Image" class="grid-size">
        <div class="entry-hover">

            <a href="news/v/<?=$set_news->id?>" class="label"><?=$set_news->label?></a>
            <h4><a href="news/v/<?=$set_news->id?>"><?=$set_news->name?></a></h4>
            <div class="meta">
                <span class="author"><?=print_value('authors',array('id'=>$set_news->author_id),'name')?></span>
<!--                <span class="date">30 mins</span>-->
            </div>
        </div>
        <!-- /.entry-hover -->
    </div>
    <!-- /.post -->
</div>
<?php
	}
	else if($set_news->order==3){
?>
<div class="col-xs-12 col-sm-3 col-md-2 masonry-item ab-item">
    <div class="post color-4">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <img src="assets/frontends/images/1x2.png" alt="Image" class="grid-size sv">
        </div>
        <div class="entry-hover">
            <a href="news/v/<?=$set_news->id?>" class="label"><?=$set_news->label?></a>

            <h4><a href="news/v/<?=$set_news->id?>"><?=$set_news->name?></a></h4>
            <div class="meta">
                <span class="author"><?=print_value('authors',array('id'=>$set_news->author_id),'name')?></span>
<!--                <span class="date">1h</span>-->
            </div>
        </div>
        <!-- /.entry-hover -->
    </div>
    <!-- /.post -->
</div>
<?php
	}
	else if($set_news->order==4){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			if(!empty($user_data->image))
			$user_img = 'assets/uploads/news/thumbnails/'.$user_data->image;
		}
?>
<div class="col-xs-12 col-sm-3 col-md-4 masonry-item ab-item">
    <div class="post color-2">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">

            <a href="news/v/<?=$set_news->id?>" class="label"><?=$set_news->label?></a>
            <img src="assets/frontends/images/2x3.png" alt="Image" class="grid-size svb">
        </div>
        <div class="entry-hover bigger-meta">
            <div class="meta-holder">
                <a href="news/v/<?=$set_news->id?>" class="author-image">
                    <img class="image image-thumb border-radius" src="<?=$user_img?>" alt="Image">
                </a>
                <div class="meta">
                    <span class="author"><?=print_value('authors',array('id'=>$set_news->author_id),'name')?></span>
<!--                    <span class="date">1h</span>-->
                </div>
                <h4><a href="news/v/<?=$set_news->id?>"><?=$set_news->name?></a></h4>

<!--                <div class="circle-chart" data-circle-width="10" data-percent="79" data-text="7.9"></div>-->

            </div>
            <!-- /.meta-holder -->
        </div>
        <!-- /.entry-hover -->
    </div>
    <!-- /.post -->
</div>
<?php
	}
	else if($set_news->order==5){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			if(!empty($user_data->image))
			$user_img = 'assets/uploads/news/thumbnails/'.$user_data->image;
		}
?>
<div class="col-xs-12 col-sm-6 col-md-6 masonry-item ab-item">
    <div class="post color-2">
        <div class="image" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>">
            <a href="news/v/<?=$set_news->id?>" class="label"><?=$set_news->label?></a>
            <img src="assets/frontends/images/8x5.png" alt="Image" class="grid-size">
        </div>

        <div class="entry-hover bigger-meta">
            <div class="meta-holder">
                <a href="news/v/<?=$set_news->id?>" class="author-image">
                    <img class="image-thumb border-radius" src="<?=$user_img?>" alt="Image">
                </a>
                <div class="meta">
                    <span class="author"><?=print_value('authors',array('id'=>$set_news->author_id),'name')?></span>
<!--                    <span class="date">30 mins</span>-->
                </div>
                <h4><a href="news/v/<?=$set_news->id?>"><?=$set_news->name?></a></h4>
            </div>
            <!-- /.meta-holder -->
        </div>
        <!-- /.entry-hover -->
    </div>
    <!-- /.post -->
</div>
<?php
	}
	else if($set_news->order==6){
?>
<div class="col-xs-12 col-sm-3 col-md-2 masonry-item ab-item">
    <div class="post color-4 bgyellow">
        <img src="assets/frontends/images/8x7.png" alt="Image" class="grid-size">
        <div class="entry-hover">
            <a href="news/v/<?=$set_news->id?>" class="label"><?=$set_news->label?></a>
            <h4><a href="news/v/<?=$set_news->id?>"><?=$set_news->name?></a></h4>
        </div>
        <!-- /.entry-hover -->
    </div>
    <!-- /.post -->
</div>
<?php
	}
	}
}
?>				
		</div><!-- /.masonry-layout -->
	</div><!-- end .col-md-12 -->
</div>
<?php
}
?>
