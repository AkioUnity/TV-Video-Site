<?php $this->load->view("templates/includes/header"); ?>
<style>
.img-spacer{
	width:100%;
	height:300px;
}
.no-padding{
	padding:0;
}
</style>
<body class="">
    <div class="wrapper">
        
<?php $this->load->view("templates/includes/menu_news"); ?>


					<div class="carousel-travel">
                        <div class="">
                            <div class="row">
<?php
$b_c = 0;
if($leaders){
	foreach($leaders as $set_news){
		if($b_c>5){
			$b_c=0;
		}
		$b_c++;
	
		$articleLinkTarget = "";
		$open_link = "news/v/".$set_news->id;
		if(!empty($set_news->link)){
			$articleLinkTarget = 'target="_blank"';
			$open_link = $set_news->link;
		}
		else if($set_news->article_id!=0){
			$open_link = "news/v/".$set_news->article_id;
		}
?>
    <div class=" col-md-3 no-padding">
        <div class="travel-item-boxed color-<?=$b_c?>">
            <div class="entry-img">
<a href="<?=$open_link?>" <?=$articleLinkTarget?> class="image entry-link" data-src="assets/frontends/images/travel/block-1.jpg">
                    <img src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" class="img-spacer" alt="travel item">
                </a>
            </div>
<?php
if(!empty($set_news->label)){
?>            
<span class="price label"><?=$set_news->label?></span>
<?php
}
?>            
            <div class="entry-info">
                <h3><a href="<?=$open_link?>" <?=$articleLinkTarget?>><?=$set_news->name?></a></h3>
                <div class="desc">Anchor</div>
            </div>
        </div>
    </div>
<?php
		
	}
}
?>                            	
                                    </div>
                        </div>


                    </div>
                    <!-- end .carousel-travel -->

<!-- .content-area -->


<div class="content-area pvt0">
	<div class="container">

	</div>
	<!-- end .container -->

</div>
    <div class="clearfix"></div>

<?php $this->load->view("templates/includes/footer"); ?>
    
    </div>
    <!-- end .wrapper -->

</body>
</html>