<?php
$home_leader = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Leader','is_home'=>1,'s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('order'=>'asc'));
if($home_leader){
?>
<a href="category/Leaders"><h2 class="block-title mt8" data-title="Leaders" style="margin-bottom: -40px;">
Leaders
</h2></a>
		<div class="testimonial-slider fs-blog-carousel" data-col="1" data-row="1" data-responsive="1,1,1">
			<div class="swiper-container">
				<div class="swiper-wrapper">
<?php
	foreach($home_leader as $set_news){
		$html = strip_tags($set_news->description_2);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 20);

		$articleLinkTarget = '';
		$open_link = 'news/v/'.$set_news->id;
		if(!empty($set_news->link)){
			$articleLinkTarget = 'target="_blank"';
			$open_link = $set_news->link;
		}
		else if($set_news->article_id!=0){
			$open_link = 'news/v/'.$set_news->article_id;
		}
?>
<div class="swiper-slide">
<a href="<?=$open_link?>" <?=$articleLinkTarget?>>
<div class="swiper-holder">
	<img src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" alt="Quote author">
<blockquote>
	<cite><?=$set_news->name?></cite>
	<p><?=$new_html?></p>
</blockquote>
</div>
</a>
<!-- /.swiper-holder -->
</div>
<?php
	}
?>
								</div>
				<div class="fs-pager">
					<span>
						<i class="fs-current-index">1</i> / <i class="fs-current-total">1</i>
					</span>
				</div>
			</div>
			<!-- /.swiper-container -->
			<div class="swiper-button-prev swiper-prev">
		    	<i class="fa fa-angle-left"></i> <span>Prev</span>
		    </div>
		    <div class="swiper-button-next swiper-next">
		    	<span>Next</span> <i class="fa fa-angle-right"></i>
		    </div>
		</div>
<?php
}
?>        
