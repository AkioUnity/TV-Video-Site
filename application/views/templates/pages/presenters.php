<?php
$leaders = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Leader','is_presenter'=>1,'s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('order'=>'asc'));
?>
<?php $this->load->view("templates/includes/header"); ?>
<style>
.travel-item-boxed a.entry-link {
	cursor:pointer !important;
}
.img-spacer{
	width:100%;
	height:315px;
	object-fit: cover;
}
.no-padding{
	padding:0;
}
.carousel-travel .s-slide:nth-child(2n) .travel-item-boxed .entry-info::before{
  background-image: url(assets/frontends/images/pin-red.png);
}
@media (max-width: 768px) {
	.img-spacer{
		height:250px;
	}
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
    <div class="s-slide col-md-3 col-sm-6 col-xs-6 no-padding">
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
                <div class="desc"><?=$set_news->head_title?></div>
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