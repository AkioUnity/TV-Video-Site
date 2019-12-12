<?php
$home_one_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'On The Beat','is_feature'=>1,'s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),false,true);

$this->db->limit(4);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'On The Beat','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));

$this->db->limit(4,4);
$home_featured_2 = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'On The Beat','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));

$this->db->limit(3);
$home_quote = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Quote'),array('id'=>'desc'));
?>
		
<a href="category/OnTheBeat"><h2 class="block-title mt8" data-title="Beat">
On the Beat
<!--			<a href="#" class="category-more text-right">Continue to the category <img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>-->
</h2></a>


		<div class="boxed wide-space">
			
			<div class="row">
				
				<div class="col-sm-4 category-block en-block">
<?php
if($home_featured){
	foreach($home_featured as $set_news){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			$html = strip_tags($set_news->description);
			$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
			$new_html = word_limiter($html, 30);

			$articleLink = base_url('news/v/'.$set_news->id);
			$articleLinkTarget = '';
			if(!empty($set_news->link)){
				$articleLinkTarget = 'target="_blank"';
				$articleLink = $set_news->link;
			}
?>
<div class="post">

<div class="meta inline-meta">
<div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>"></div>
<span class="author"><?=$user_data->name?></span>
<span class="date"><?=date('d F, Y',$set_news->created)?></span>
</div>
<div class="border-bottom2 mb2"></div>
<h4 class="font28"><a href="<?=$articleLink?>" <?=$articleLinkTarget?> ><?=$set_news->name?></a></h4>
<p><?=$new_html?></p>

<a href="<?=$articleLink?>" <?=$articleLinkTarget?> class="category-more">Read More <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
</div>
<?php		
		}
	}
}
?>                
				</div>
				<!-- end .col-md-4 -->

				<div class="col-sm-8">
<?php 
if($home_one_featured){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$home_one_featured->author_id),false,true);
		if($user_data){
			$html = strip_tags($home_one_featured->description);
			$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    

			$new_html = word_limiter($html, 50);
			$articleLink = base_url('news/v/'.$home_one_featured->id);
			$articleLinkTarget = '';
			if(!empty($home_one_featured->link)){
				$articleLinkTarget = 'target="_blank"';
				$articleLink = $home_one_featured->link;
			}
?>
<div class="category-block en-block">
    <div class="post color-2">
            <div class="image" data-src="<?=!empty($home_one_featured->image)?'assets/uploads/news/full/'.$home_one_featured->image:'assets/uploads/no-image.gif'?>">								
                <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                <a href="<?=$articleLink?>" <?=$articleLinkTarget?> class="label">LATEST</a>
            </div>
        <div class="meta font18 inline-meta">
            <a href="<?=$articleLink?>" <?=$articleLinkTarget?>>
                <div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>">
                    <img src="assets/frontends/images/1x1.png" alt="Proportion"/>
                </div>
            </a>
            <span class="author"><?=$user_data->name?></span>
            <span class="date"><?=date('d F, Y',$home_one_featured->created)?></span>

            <div class="social-links pull-right">
                <span>Share: </span>
        <a class="" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $articleLink?>&amp;t=<?php echo urlencode($home_one_featured->name)?>', 'facebookShare', 'width=626,height=436'); return false;"><i class="fa fa-facebook"></i></a>
        <a class="" onClick="window.open('https://plus.google.com/share?url=<?php echo $articleLink?>', 'twitterShare', 'width=626,height=436'); return false;" ><i class="fa fa-google-plus"></i></a>
        <a class="" onClick="window.open('http://twitter.com/share?text=<?php echo urlencode($home_one_featured->name)?>&amp;url=<?php echo $articleLink?>', 'twitterShare', 'width=626,height=436'); return false;"><i class="fa fa-twitter"></i></a>
                
<!--                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>-->
            </div>
        </div>
        <div class="clearfix"></div>
        <h4 class="font28"><a href="<?=$articleLink?>" <?=$articleLinkTarget?>><?=$home_one_featured->name?></a></h4>
        <div class="border-line"></div>
        <p><?=$new_html?></p>
        <a href="<?=$articleLink?>" <?=$articleLinkTarget?> class="category-more">Read More <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
    </div>
</div>
<!-- end .category-block -->
<?php
if(!empty($home_one_featured->sponsor)){
?>
<div class="pv2">
    <a href="<?=$home_one_featured->sponsor_link?>">
        <img src="<?='assets/uploads/news/'.$home_one_featured->sponsor?>" alt="Ads" class="full-size">
    </a>
</div>

<?php
		}
		}
}
?>
					<div class="border-line mb5"></div>

					<div class="row category-block en-block" >
<?php
if($home_featured_2){
	$c_i=0;
	$n_c = 0;
	foreach($home_featured_2 as $set_news){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			$n_c++;
			$html = strip_tags($set_news->description);
			$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
			$new_html = word_limiter($html, 30);

			$articleLink = base_url('news/v/'.$set_news->id);
			$articleLinkTarget = '';
			if(!empty($set_news->link)){
				$articleLinkTarget = 'target="_blank"';
				$articleLink = $set_news->link;
			}
			$c_i++;
			if($c_i>=4){
				$c_i=1;
			}
?>		
<div class="col-md-6" style="">
    <div class="post hover-light color-<?=$c_i?>">
        <div class="meta inline-meta small-meta">
<?php
if(!empty($set_news->label)){
?>
<a href="javascript:;" class="label"><?=$set_news->label?></a>
<?php
}
?>        
            <span class="author"><?=$user_data->name?></span>
            <span class="date"><?=date("d F' Y",$set_news->created)?></span>
        </div>
        <h4 class="font18"><a href="<?=$articleLink?>" <?=$articleLinkTarget?>><?=$set_news->name?></a></h4>
        <p><?=$new_html?></p>
        <a href="<?=$articleLink?>" <?=$articleLinkTarget?> class="category-more">Continue to the news <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
    </div>
    
</div>
<?php
		}
	}
}
?>					
						
						<!-- /.col -->
						
						
						<!-- /.col -->
						
					</div>



				</div>
				<!-- end .col-md-8 -->

			</div>
			<!-- /.row -->

		</div>
		<!-- /.boxed -->
<?php
if($home_quote){
?>
		<div class="boxed wide-space en-block">

			<div class="row">
<?php 
if($home_quote){
	$i=0;
	foreach($home_quote as $set_news){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			$i++;
			$html = strip_tags($set_news->description);
			$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
			$new_html = word_limiter($html, 50);
?>
<div class="col-sm-4">
	<div class="post quote color-<?=$i?>">
		<div class="meta bullet-style">
			<span class="author"><?=$set_news->head_title?></span>
			<span class="date"><?=date("d M 'y",$set_news->created)?></span>
		</div>
		<blockquote><?=$set_news->name?></blockquote>
        <div class="author clearfix">
            <a href="<?=$set_news->link?>">
                <img class="image image-thumb border-radius" src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>" alt="Image">
            </a>
            <a href="<?=$set_news->link?>" class="label"><?=$user_data->name?></a>
        </div>
	    <a href="<?=$set_news->link?>" class="category-more">Read More <img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>
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
		<!-- /.boxed -->
<?php
}
?>


