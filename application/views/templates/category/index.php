<?php
$home_tags= $this->comman_model->get_by('news_tag',array('enabled'=>1),array('order'=>'asc'));
$home_category_menu= $this->comman_model->get_by('news_category',array('enabled'=>1),array('order'=>'asc'));
$right_banner = $this->comman_model->get_by('banners',array('template'=>'category_right'),array('order'=>'asc'));
?>                            
<?php $this->load->view('templates/includes/header'); ?>
<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<style>
.fs-post-filter .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
	border:none;
}
.fs-post-filter .nav-tabs>li a{
	padding:0;
	line-height:49px;
}
.fs-post-filter .nav-tabs{
	border-bottom:none;
}
.fs-grid-item {
    margin-bottom: 50px;
}
.fs-grid-item .fs-entry-meta {
    font-family: 'SF-UI-Display';
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 0px;
    margin-top: 15px;
}
.fs-grid-item span a {
    color: rgba(0, 0, 0, 0.9);
}
.fs-grid-item h3 {
    font-family: 'Montserrat';
    font-size: 18px;
    font-weight: 400;
    letter-spacing: 0px;
    margin: 0px;
    margin-top: 12px;
    line-height: 1.3em;
}

.fs-grid-item .read-more {
    font-size: 14px;
    font-family: 'Montserrat';
    font-weight: normal;
    margin: 0px;
    margin-top: 12px;
}

.fs-grid-item .read-more a {
    color: #000000;
    text-decoration: underline;
}
#header .header-wrapper .site-branding img{
/*	height:60px;
	width:100px;*/
	height:auto;
	width:100px;
}
.swiper-containers img{
	height:150px;
	width:100%
}
header .header-wrapper .site-branding img {
    width: 150px;
    height: auto;
}
.slide-wp-2 .img-a,
.slide-wp-1 .img-a{
	width:100%;
	
}
.slide-wp-2 img,
.slide-wp-1 img{
	height:250px;
	width:100%;
	object-fit: cover;
}
.similar-list img{
	height:250px;
	width:100%
}
</style>
<body class="blog-content">
    <div class="wrapper">
        
        <header id="header" class="header-blog">
            <div class="panel-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <div class="header-wrapper">

                                <div class="site-branding">
                                    
                                    <!-- image logo -->
                                    <a href="" rel="home" class="custom-logo-link">
                                        <img src="<?='assets/uploads/sites/'.$settings['dark_logo']?>" alt="logo image" ><!--assets/frontends/images/ptv-Black_transparent_200x156.png-->
                                    </a>
                                    
                                    <!-- text logo -->
                                    <!-- <a href="index.html" rel="home" class="logo-text-link">Development Fruit</a>
                                    <p class="site-description">The Awesome WordPress Theme</p> -->
                                    

                                </div>

                                <nav class="main-nav">
                                    <ul>
<?php
if($home_category_menu){
	foreach($home_category_menu as $set_menu){
		$open_link = $set_menu->link;
/*		if($set_menu->article_id!=0){
			$open_link = 'news/v/'.$set_menu->article_id;
		}*/
			
?>
<li>
<a href="<?=$open_link?>"><?=$set_menu->name?></a>
</li>
<?php
	}
}
?>                                    
                                    </ul>
                                </nav>
                                <div class="right-content">
                                    
                                    <div class="search-panel">
                                        <form method="get">
                                            <input type="text" name="s" placeholder="Type your keyword">
                                            <button type="submit">Search</button>
                                        </form>
                                    </div>

                                    <a href="javascript:;" id="search_handler" class="search-handler">
                                        <img src="assets/frontends/images/search.png" alt="search icon">
                                    </a>
                                    <a href="javascript:;" class="burger-menu pm-right">
                                        <img src="assets/frontends/images/burger.png" alt="menu icon">
                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

<!--            <a href="javascript:;" id="burger_menu" class="burger-menu">
                <img src="assets/frontends/images/burger-white.png" alt="menu icon">
            </a>-->

            <div class="push-menu">
                <div class="pm-overlay"></div>
                <div class="pm-container">
                    <div class="pm-wrap">
                        
                        <a href="javascript:;" class="close-menu"></a>

                        <nav class="big-menu">
                            <ul>
                                <li><a href="category/Leaders">Leaders</a></li>
                                <li><a href="category/Blazers">Blazers</a></li>
                                <li><a href="category/PropertyNews">Property News</a></li>
                                <li><a href="category/OnTheBeat">On the Beat</a></li>
                                <li><a href="category/Finance">Finance</a></li>
                                <li><a href="category/Editorial">Editorial</a></li>
                            </ul>
                        </nav>
                        <!--<nav class="small-menu">
                            <ul>
                                <li><a href="javascript:;">Facebook</a></li>
                                <li><a href="javascript:;">Twitter</a></li>
                                <li><a href="javascript:;">Linkedin</a></li>
                                <li><a href="javascript:;">Instagram</a></li>
                            </ul>
                        </nav>-->

                    </div>

                    <!--<div class="bottom-content hidden-xs hidden-sm">
                        <div class="widget">
                            <h5 class="widget-title">Address</h5>
                            <p>555 Madison Avenue. New York City, New York. United States.</p>
                        </div>
                        <div class="widget">
                            <h5 class="widget-title">Information</h5>
                            <p>Up to the minute propety industry news from around the world.</p>
                        </div>
                    </div>-->

                </div>
            </div>
        </header>

<div class="content-area pvt0">

	<div class="section-full fs-slide">

		<div class="swiper-container">
	    	<div class="swiper-wrapper">
<?php
if($news_list){
	$i=0;
	foreach($news_list as $set_news){
		$i++;
		if($i==10){
			break;
		}
		$open_link = 'news/v/'.$set_news->id;
		if($set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'){
			$open_link = $set_news->link;
		}
?>
<div class="swiper-slide">
    <div class="fs-item" data-bg-color="#f1f1f1">
        <div class="fs-entry-bg" data-bg-image="<?=!empty($set_news->article_image) ? base_url('assets/uploads/news/full').'/'.$set_news->article_image:'assets/frontends/images/down.png'?>"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <div class="fs-entry-item">
                        <h4 class="fs-title fs-animate-text" data-label="<?=$page_title?>">Latest</h4>
                        <h3 class="fs-animate-text"><?=$set_news->name?></h3>
<!--                        <p class="fs-animate-text">Lorem Ipsum proin gravida nibh vel velit. Lorem Ipsum proin gravida nibh vel velit.</p>-->
                        <a href="<?=$open_link?>" class="read-more fs-animate-text">read the article</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php		
	}
}
?>                            
				

			</div>
		</div>
		
		<div class="fs-arrows">
			<a href="javascript:;" class="fs-arrow-prev"><i class="fa fa-angle-left"></i> Prev</a>
			<a href="javascript:;" class="fs-arrow-next">Next <i class="fa fa-angle-right"></i></a>
		</div>
		<div class="fs-arrows arrows-bottom">
			<a href="javascript:;" class="fs-arrow-prev"><i class="fa fa-angle-left"></i></a>
			<a href="javascript:;" class="fs-arrow-next"><i class="fa fa-angle-right"></i></a>
		</div>
	</div>


<?php
if($most_news_list){
?>
<div class="section-full pv9 pvb0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="fs-blog-carousel" data-col="3" data-row="1" data-responsive="3,2,1">
                    <h3 class="fs-title text-center">Latest</h3>
                    <div class="fs-pager">
                        <span>
                            <a href="javascript:;" class="fs-arrow-prev swiper-prev"><img src="assets/frontends/images/arrow-prev.png" alt="preview"></a>
                            <i class="fs-current-index">1</i> of <i class="fs-current-total">1</i>
                            <a href="javascript:;" class="fs-arrow-next swiper-next"><img src="assets/frontends/images/arrow-next.png" alt="preview"></a>
                        </span>
                    </div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper slide-wp-1">
<?php
foreach($most_news_list as $set_news){
		$open_link = 'news/v/'.$set_news->id;
		if($set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'){
			$open_link = $set_news->link;
		}
		$article_img = 'assets/uploads/no-image.gif';
		if(!empty($set_news->article_image)){
			$article_img = 'assets/uploads/news/full/'.$set_news->article_image;
		}
		elseif($set_news->image){
			$article_img = 'assets/uploads/news/full/'.$set_news->image;
		}
		
?>
<div class="swiper-slide">
<div class="fs-blog-item">
<a href="<?=$open_link?>" class="img-a">
<img src="<?=$article_img?>" alt="portfolio image" >
</a>
<h4><a href="<?=$open_link?>"><?=$set_news->name?></a></h4>
</div>
</div>

<?php		
}
?>                            
</div>
                    </div>
                    <div class="swiper-button-prev swiper-prev">
                        <i class="fa fa-angle-left"></i> <span>Prev</span>
                    </div>
                    <div class="swiper-button-next swiper-next">
                        <span>Next</span> <i class="fa fa-angle-right"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
}
?>

<div class="section-full pv9 pvb0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="fs-blog-carousel" data-col="3" data-row="2" data-responsive="3,2,1">
                    <h3 class="fs-title text-center">Similar</h3>
                    <div class="fs-pager">
                        <span>
                            <a href="javascript:;" class="fs-arrow-prev swiper-prev"><img src="assets/frontends/images/arrow-prev.png" alt="preview"></a>
                            <i class="fs-current-index">1</i> of <i class="fs-current-total">1</i>
                            <a href="javascript:;" class="fs-arrow-next swiper-next"><img src="assets/frontends/images/arrow-next.png" alt="preview"></a>
                        </span>
                    </div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper similar-list slide-wp-2">
<?php
if($news_list){
foreach($news_list as $set_news){
    $open_link = 'news/v/'.$set_news->id;
    if($set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'){
        $open_link = $set_news->link;
    }
?>
<div class="swiper-slide">
<div class="fs-blog-item boxed-title">
    <a href="javascript:;" class="img-a">
        <img src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" alt="portfolio image">
    </a>
<!--<span class='fs-label'>Hottest</span>-->
    <div class="entry-title">
        <h4><a href="<?=$open_link?>"><?=$set_news->name?></a></h4>
        <p class="read-more">
            <a href="<?=$open_link?>">read the article</a>
        </p>
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

            </div>
        </div>
    </div>
	</div>


	<div class="section-full pv9 pvb0">
		<div class="container">
			<div class="row sticky-parent fs-with-sidebar">
				<div class="col-sm-9 sticky-column fs-content">

					<div class="">
						<div class=" row" data-col-width=".col-sm-6">
						<div class=""><!--fs-grid-posts-->
							<div class="fs-post-filter bordered1">
								<div class="col-sm-12">
									<h4>Archives</h4>
									<ul class="nav nav-tabs">
<!--										<li class="active"><a href="javascript:;" data-filter="*">All</a></li>
										<li><a href="javascript:;" data-filter=".Leader">Leaders</a></li>
										<li><a href="javascript:;" data-filter=".Blazers">Blazers</a></li>
										<li><a href="javascript:;" data-filter=".PropertyNews">Property News</a></li>
										<li><a href="javascript:;" data-filter=".OnTheBeat">On The Beat</a></li>
										<li><a href="javascript:;" data-filter=".style">Finance</a></li>-->
                                        <li class="active"><a data-toggle="tab" href="#tab-all">All</a></li>
                                        <li><a data-toggle="tab" href="#tab-leaders">Leaders</a></li>
                                        <li><a data-toggle="tab" href="#tab-blazers">Blazers</a></li>
                                        <li><a data-toggle="tab" href="#tab-property">Property News</a></li>
                                        <li><a data-toggle="tab" href="#tab-onthebeat">On The Beat</a></li>
                                        <li><a data-toggle="tab" href="#tab-finance">Finance</a></li>
                                        
									</ul>
								</div>
								<!-- end .col-12 -->
							</div>
							<!-- end .fs-post-filter -->
<div class="tab-content">
  <div id="tab-all" class="tab-pane fade in active">
    <div class="fs-grid-viewport" style="position:relative;" id="result-all"></div>
    <div style="clear:both"></div>
    <ul class="pagination" id="all-paginations"></ul>
  </div>

  <div id="tab-leaders" class="tab-pane fade">
		<div class="fs-grid-viewport" style="position:relative;" id="result-leaders"></div>
		<div style="clear:both"></div>
		<ul class="pagination" id="leaders-paginations"></ul>

  </div>

  <div id="tab-blazers" class="tab-pane fade">
		<div class="fs-grid-viewport" style="position:relative;" id="result-blazers"></div>
		<div style="clear:both"></div>
		<ul class="pagination" id="blazers-paginations"></ul>
  </div>

  <div id="tab-property" class="tab-pane fade">
		<div class="fs-grid-viewport" style="position:relative;" id="result-property"></div>
		<div style="clear:both"></div>
		<ul class="pagination" id="property-paginations"></ul>
  </div>

  <div id="tab-onthebeat" class="tab-pane fade">
		<div class="fs-grid-viewport" style="position:relative;" id="result-onthebeat"></div>
		<div style="clear:both"></div>
		<ul class="pagination" id="onthebeat-paginations"></ul>
  </div>

  <div id="tab-finance" class="tab-pane fade">
		<div class="fs-grid-viewport" style="position:relative;" id="result-finance"></div>
		<div style="clear:both"></div>
		<ul class="pagination" id="finance-paginations"></ul>
  </div>

</div>							
							
							<!-- /.fs-grid-viewport -->
						</div>
						</div>
						<!-- /.masonry-layout -->

					</div>
					<!-- //theiaStickySidebar -->

				</div>
				<div class="col-sm-3 sticky-column fs-sidebar">

					<div class="theiaStickySidebar">

						<div class="widget widget_search">
							<h5 class="widget-title">Search</h5>
							<form action="./" class="search_form" method="get">
								<input type="text" placeholder="Type your keyword" required name="s">
								<input type="submit" value="Search">
							</form>
						</div>

						<div class="widget">
							<h5 class="widget-title">Latest</h5>
							<div class="fs-recent-post">
																		
<?php
if($all_news_list){
	$i=0;
	foreach($all_news_list as $set_news){
		$i++;
		if($i==5){
			break;
		}
		$article_type = $set_news->section;
		$open_link = 'news/v/'.$set_news->id;
		if($set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'||$set_news->section=='Leader'){
			$open_link = $set_news->link;
		}

?>
<div class="fs-rp-item">
<div class="entry-image">
<!-- <a href="javascript:;"><img src="assets/frontends/images/blog/fs-thumb.jpg" alt="recent post"></a> -->
<a href="javascript:;"><img src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" alt="recent post"></a>
</div>
<div class="entry-rp">
<div class="entry-meta">
<span>
<a href="javascript:;"><?=date('M d, Y')?></a>
</span>

</div>
<h4>
<a href="javascript:;"><?=$set_news->name?></a>
</h4>
<p class="read-more">
<a href="<?=$open_link?>">read the article</a>
</p>
</div>
</div>

<?php		
	}
}
?>                            
<!--<div class="fs-rp-item no-thumb">
<div class="entry-rp">
<div class="entry-meta">
<span>
<a href="javascript:;">1:16 PM</a>
</span>

</div>
<h4>
<a href="javascript:;">What does Drake’s whiskey say about him?</a>
</h4>
<p class="read-more">
<a href="javascript:;">read the article</a>
</p>
</div>
</div>-->
															</div>
						</div>

						<div class="widget">
							<h5 class="widget-title">Category</h5>
							<ul>
<li><a href="category/Leaders">Leaders <span><?=print_count('news',array('section'=>'Leader'))?></span></a></li>
<li><a href="category/Blazers">Blazers <span><?=print_count('news',array('section'=>'Blazers'))?></span></a></li>
<li><a href="category/PropertyNews">Property News <span><?=print_count('news',array('section'=>'Property News'))?></span></a></li>
<li><a href="category/OnTheBeat">On The Beat <span><?=print_count('news',array('section'=>'On The Beat'))?></span></a></li>
<li><a href="category/Finance">Finance <span><?=print_count('news',array('section'=>'Finances'))?></span></a></li>
<li><a href="category/Editorial">Editorial <span><?=print_count('news',array('section'=>'Editorial'))?></span></a></li></a></li>

							</ul>
						</div>

						<div class="widget">
							    Sponsored Message
<?php
if($right_banner){
	foreach($right_banner as $set_banner){
?>
<a href="<?=$set_banner->link?>">
<img src="assets/uploads/banners/<?=$set_banner->image?>" alt="banner" class="full-size">
</a>
<?php
	}
}
?>                        
						</div>

						<div class="widget">
							<h5 class="widget-title">Popular Tags</h5>
							<div class="fs-tags">
<?php
if($home_tags){
	foreach($home_tags as $set_cat){
?>                    
<a href="#"><?=$set_cat->name?></a>
<?php
	}
}
?>
							</div>
						</div>

					</div>
					<!-- //theiaStickySidebar -->

				</div>
			</div>
		</div>
	</div>

</div>
<!-- .content-area -->


        <footer id="footer" class="light footer-blog">
                
            <!--<div class="footer-instagram">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h4 class="mv5 mvt0">Follow us on Social</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">

                        <div class="swiper-containers">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="insta-image">
                                        <a href="javascript:;">
                                            <img src="assets/frontends/images/category_page/facebook.png" alt="instagram">
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="insta-image">
                                        <a href="javascript:;">
                                            <img src="assets/frontends/images/category_page/twitter.jpeg" alt="instagram">
                                        </a>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="insta-image">
                                        <a href="javascript:;">
                                            <img src="assets/frontends/images/category_page/google-plus.png" alt="instagram">
                                        </a>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="insta-image">
                                        <a href="javascript:;">
                                            <img src="assets/frontends/images/category_page/youtube.png" alt="instagram">
                                        </a>
                                    </div>
                                </div>
                                                                
                                                                
                                                            </div>
                        </div>

                    </div>
                </div>
            </div>-->
            <!-- end .footer-instagram -->

            <div class="container footer-container mv8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="widget">
                            <img src="assets/frontends/images/ptv-Black_transparent_200x156.png" alt="footer logo" width="139px">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="widget mh3">
                            <h5 class="widget-title">Subscribe</h5>
                            <div class="subscribe-form">
	                            <form onSubmit="save_newsletter();return false;">
                                    <input type="text" id="newletter" placeholder="E-mail address" required>
                                    <button type="submit">SIGN UP</button>
                                </form>
			                    <div id="show_msges" style="color:#C00"></div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <div class="widget">
                            <h5 class="widget-title">Social</h5>
                            <div class="social-links">
<?php
if(!empty($settings['facebook_url'])){
?>                                
<a href="<?=$settings['facebook_url']?>"><i class="fa fa-facebook"></i></a>
<?php
}
if(!empty($settings['twitter_url'])){
?>                                
<a href="<?=$settings['twitter_url']?>"><i class="fa fa-twitter"></i></a>
<?php
}
if(!empty($settings['youtube_url'])){
?>                                
<a href="<?=$settings['youtube_url']?>"><i class="fa fa-youtube"></i></a>
<?php
}
if(!empty($settings['google_plus'])){
?>                                
<a href="<?=$settings['google_plus']?>"><i class="fa fa-google-plus"></i></a>
<?php
}
?>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end .footer-container -->


            <div class="sub-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-inline pull-left">
                                <li><a href="">Home</a></li>
<?php
$bottom_menu = $this->comman_model->get_by('page',array('bottom_menu'=>1,'parent_id'=>0),array('order'=>'asc'));
if($bottom_menu){
	foreach($bottom_menu as $set_bottom_menu){
?>
<li><a href="pages/<?=$set_bottom_menu->slug?>"><?=$set_bottom_menu->name;?></a></li>
<?php
	}
}
?>        
<!--                                
                                <li><a href="javascript:;">Advertise</a></li>
                                <li><a href="javascript:;">Contact us</a></li>
                                <li><a href="javascript:;">Your Ad Choices</a></li>
                                <li><a href="javascript:;">Privacy</a></li>
                                <li><a href="javascript:;">Terms of Service</a></li>-->
                            </ul>
                            <div class="copyright-text pull-right"><?=show_static_text(1,62);?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end .sub-footer -->


        </footer>    </div>
    <!-- end .wrapper -->
    <script type="text/javascript" src="assets/frontends/vendors/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/typed.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/theia-sticky-sidebar.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/circles.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/jquery.parallax.columns.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/svg-morpheus.js"></script>

    <!-- Swiper -->
    <script type="text/javascript" src="assets/frontends/vendors/swiper/js/swiper.min.js"></script>

    <!-- Magnific-popup -->
    <script type="text/javascript" src="assets/frontends/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    
    <!-- Master Slider -->
    <script src="assets/frontends/vendors/masterslider/jquery.easing.min.js"></script>
    <script src="assets/frontends/vendors/masterslider/masterslider.min.js"></script>
    
        
    <script type="text/javascript" src="assets/frontends/js/scripts.js"></script>
<script>
var swiper = new Swiper('.swiper-containers', {
  slidesPerView: 4,
  pagination: {
	el: '.swiper-pagination',
	clickable: true,
  },
});
</script>    
<script>
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function save_newsletter(){
	submitSubscribe =false;
	var newsEmail=$('#newletter').val();
	submitSubscribe  = isEmail(newsEmail);
//	alert(ech);
	
	if(submitSubscribe){
		$('#show_msges').html('sending...');
		$.ajax({
			type:"POST",
			url:"ajax_contact/save_newsletter",
			data:{newsEmail:newsEmail,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
			success:function(data){
				if(data==1)
				{
					$('#show_msges').html('Thank you for subscribing');
				}
				else
				{
					$('#show_msges').html('You already subscribe');
				}
				setTimeout(function(){
				  $('#show_msges').html('');
				}, 3000);
			}
		
		});
	}
	else{
		$('#show_msges').html('Please enter a valid email-id');
	}
}
</script>  
<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

function get_all_data(){
	$.ajax({
		type: 'GET',
		url : "<?php echo 'category/ajax_list'?>",
		data:{type:'all'},
		dataType:'json',
		success: function(response){
			$('#result-all').html(response.html);
			if(response.total>10){
				$('#all-paginations').pagination({
					total: response.total,
					current: 1,
					length: 10,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						set_d = 'page='+options.current;
						urls = response.url;
						
						$.get(urls,set_d,
							function(result){          
								$('#result-all').html(result.html);
							},
							'json'
						);
					
					}
				});
			}
		}
	});
}
get_all_data();

function get_leaders_data(){
	$.ajax({
		type: 'GET',
		url : "<?php echo 'category/ajax_list'?>",
		data:{type:'Leader'},
		dataType:'json',
		success: function(response){
			$('#result-leaders').html(response.html);
			if(response.total>10){
				$('#leaders-paginations').pagination({
					total: response.total,
					current: 1,
					length: 10,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						set_d = 'page='+options.current;
						urls = response.url;
						
						$.get(urls,set_d,
							function(result){          
								$('#result-leaders').html(result.html);
							},
							'json'
						);
					
					}
				});
			}
		}
	});
}
get_leaders_data();

function get_blazers_data(){
	$.ajax({
		type: 'GET',
		url : "<?php echo 'category/ajax_list'?>",
		data:{type:'Blazers'},
		dataType:'json',
		success: function(response){
			$('#result-blazers').html(response.html);
			if(response.total>10){
				$('#blazers-paginations').pagination({
					total: response.total,
					current: 1,
					length: 10,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						set_d = 'page='+options.current;
						urls = response.url;
						
						$.get(urls,set_d,
							function(result){          
								$('#result-blazers').html(result.html);
							},
							'json'
						);
					
					}
				});
			}
		}
	});
}
get_blazers_data();

function get_property_data(){
	$.ajax({
		type: 'GET',
		url : "<?php echo 'category/ajax_list'?>",
		data:{type:'Property News'},
		dataType:'json',
		success: function(response){
			$('#result-property').html(response.html);
			if(response.total>10){
				$('#property-paginations').pagination({
					total: response.total,
					current: 1,
					length: 10,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						set_d = 'page='+options.current;
						urls = response.url;
						
						$.get(urls,set_d,
							function(result){          
								$('#result-property').html(result.html);
							},
							'json'
						);
					
					}
				});
			}
		}
	});
}
get_property_data();

function get_onthebeat_data(){
	$.ajax({
		type: 'GET',
		url : "<?php echo 'category/ajax_list'?>",
		data:{type:'On The Beat'},
		dataType:'json',
		success: function(response){
			$('#result-onthebeat').html(response.html);
			if(response.total>10){
				$('#onthebeat-paginations').pagination({
					total: response.total,
					current: 1,
					length: 10,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						set_d = 'page='+options.current;
						urls = response.url;
						
						$.get(urls,set_d,
							function(result){          
								$('#result-onthebeat').html(result.html);
							},
							'json'
						);
					
					}
				});
			}
		}
	});
}
get_onthebeat_data();

function get_finance_data(){
	$.ajax({
		type: 'GET',
		url : "<?php echo 'category/ajax_list'?>",
		data:{type:'Finances'},
		dataType:'json',
		success: function(response){
			$('#result-finance').html(response.html);
			if(response.total>10){
				$('#finance-paginations').pagination({
					total: response.total,
					current: 1,
					length: 10,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						set_d = 'page='+options.current;
						urls = response.url;
						
						$.get(urls,set_d,
							function(result){          
								$('#result-finance').html(result.html);
							},
							'json'
						);
					
					}
				});
			}
		}
	});
}
get_finance_data();

</script>
</body>
</html>