<?php $this->load->view('templates/includes/header'); ?>
<style>
.fs-entry-image img{
	width: 100%;
	height:210px;
	object-fit:cover;
}
.fs-grid-item h3{
	height: 46px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

</style>

<body class="">

    
    <div class="wrapper">
        
        <header id="header" class="header-news">
<?php $this->load->view('templates/includes/menu_news'); ?>
            


    <section class="section-content single">

        <div class="container">
            <div class="row">
            
                
<div class="col-sm-12">
<div class="theiaStickySidebar">
        <div class=" row" style="margin-top:20px;">
        <div class="fs-grid-posts">
            
            <div class="fs-grid-viewport" style="position:relative;" id="result-data">
<?php
if($news_list){
	foreach($news_list as $set_news){
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
	<span><a href="javascript:;"><?=h_dateFormat($set_news->s_date,'M d, Y')?></a></span>
	
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
}
?>                            
            
            </div>
            <!-- /.fs-grid-viewport -->
        </div>
        </div>
        <!-- /.masonry-layout -->

    </div>


</div>

            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->

<div style="clear:both"></div>
    </section>
    <!-- end .section-content -->
    


    <div class="clearfix"></div>

<?php $this->load->view('templates/includes/footer'); ?>
</div>
    <!-- end .wrapper -->

</body>

</html>