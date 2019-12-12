<?php
if($products){
	foreach($products as $set_news){
if($set_news->type_search=='news'){
		$article_type = $set_news->section;
		$open_link = 'news/v/'.$set_news->id;
		if($set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'){
			$open_link = $set_news->link;
		}
		if($set_news->section=='On The Beat'){
			$article_type = 'OnTheBeat';
		}
		else if($set_news->section=='Property News'){
			$article_type = 'PropertyNews';
		}
?>
	<div class="col-sm-3 masonry-item <?=$article_type?>">
	<div class="fs-grid-item">
	<a href="javascript:;" class="fs-entry-image">
	<img src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" alt="portfolio image">
	</a>
	<div class="fs-entry-meta">
	<!--<span><a href="javascript:;">Author 1</a></span>-->
	<span><a href="javascript:;"><?=date('M d, Y')?></a></span>
	
	</div>
	<h3>
	<a href="javascript:;"><?=$set_news->name?></a>
	</h3>
	<p class="read-more">
	<a href="<?=$open_link?>">read the article</a>
	</p>
	</div>
	</div>
<?php
}
else{
?>
<div class="col-sm-3 masonry-item ">
	<div class="fs-grid-item">
	<a href="javascript:;" class="fs-entry-image">
	<img src="<?=!empty($set_news->image)?'assets/uploads/channels/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" alt="portfolio image">
	</a>
	<div class="fs-entry-meta">
	<!--<span><a href="javascript:;">Author 1</a></span>-->
	<span><a href="javascript:;"><?=date('M d, Y',$set_news->created)?></a></span>
	
	</div>
	<h3>
	<a href="javascript:;"><?=$set_news->name?></a>
	</h3>
	<p class="read-more">
	<a href="<?=site_url('channel/'.$set_news->channel_url)?>">view more</a>
	</p>
	</div>
	</div>
<?php
}
	}
}
else{
?>
<div class="col-sm-12"><h4>No Results Found. Try simplifying your search</h4></div>
<?php	
}
?>                            
