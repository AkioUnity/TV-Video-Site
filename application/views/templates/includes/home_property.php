<?php
$this->db->limit(8);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Property News'),array('id'=>'desc'));

?>
<div class="movie-section">
	<div class="container">
		<div class="row">

			<div class="col-md-12">
<a href="category/PropertyNews"><h3 class="block-title mt0">
PROPERTY NEWS
<!--<a href="#" class="category-more text-right">Continue to the category <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>-->				</h3>
</a>
			</div>

			<div class="col-md-12">
				
				
				<div class="row">

					<div class="col-md-12">

						<!-- Movie slider -->
						<div class="gallery-slider movie-slider">

							<!-- masterslider -->
							<div class="master-slider ms-skin-default" id="masterslider4">
<?php 
if($home_featured){
	foreach($home_featured as $set_news){
		$html = strip_tags($set_news->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 30);
?>
<div class="ms-slide color-1">
<div class="slide-pattern tint"></div>
<img src="assets/frontends/vendors/masterslider/style/blank.gif" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" alt="Image"/>

<div class="ms-layer" data-effect="fade(400)" data-origin="tl" data-delay="0" data-offset-y="70"><a href="news/v/<?=$set_news->id?>" class="label"><?=$set_news->label?></a></div>							    								    	
<div class="ms-layer right-side" data-duration="300" data-ease="easeInOut">

<div class="one-half animate-element movie-slider-meta" data-anim="fadeInUp">
<h3><a href="news/v/<?=$set_news->id?>"><?=$set_news->name?></a></h3>
<div class="meta">
<span class="author"><?=$set_news->author_id!=0?print_value('authors',array('id'=>$set_news->author_id),'name'):'-'?></span>
<span class="date"><?=h_dateFormat($set_news->publish_date,'d F, Y')?></span>
</div>
</div>

<!--<div class="one-half animate-element movie-slider-circle" data-anim="fadeInUp">
<div class="bottom">
                        <div class="circle-chart" data-circle-width="7" data-percent="89" data-text="8.9 <small>IMDB</small>"></div>
</div>
</div>-->
<div class="clearfix"></div>
<a href="news/v/<?=$set_news->id?>"><div class="excerpt border-top animate-element" data-anim="fadeInUp"><?=$new_html?></div></a>
</div>

<div class="ms-thumb">
<div class="image color-1" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>"></div>
</div>

</div>
<?php
	}
}
?>
														    
							
							</div><!-- end of masterslider -->

						</div><!-- /.movie-slider -->

					</div><!-- end col-md-12 -->

				</div><!-- end .row -->

			</div><!-- end .col-md-12 -->

		</div><!-- end .row -->

	</div><!-- /.movie-slider -->
</div>