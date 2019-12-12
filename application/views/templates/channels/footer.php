<?php
$string ="select * from news where section in('Finances','Blazers','Leader','On The Beat','Property News') order by id desc limit 6";
$recent_news_list = $this->comman_model->get_query($string,false);

$string = "SELECT * FROM shows_category where user_id=".$channel_data->user_id." order by set_order asc limit 6";
$footer_category_list = $this->comman_model->get_query($string,false);

$string = "SELECT * FROM shows where channel_id=".$channel_data->id." order by id desc limit 6";
$footer_show = $this->comman_model->get_query($string,false);

?>
    <footer id="footer" class="footer-entertainment">
        
        <div class="container">


            <div class="row footer-row mvt0 mv6">
                <div class="col-sm-6">
                    <img src="<?='assets/uploads/sites/'.$settings['logo']?>" alt="Tana"/>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="widget subscribe">
                        <label for="newletter">NEWSLETTER</label>
                        <div class="subscribe-form">
                            <form onsubmit="save_newsletter();return false;">
                                <input id="newletter" type="email" placeholder="ENTER YOUR EMAIL" required="required">
                                <button type="submit"><i class="fa fa-envelope-o"></i></button>
                            </form>
                            
                        </div>
                    </div>
                    <div id="show_msges" style="color:#C00"></div>

                </div>
            </div>


            <div class="row footer-row">
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title">Categories</h5>
                        <ul>
<?php
if($footer_category_list){
	foreach($footer_category_list as $set_menu){
?>   
<li><a href="<?=site_url('channel/'.$channel_data->channel_url.'/all?category='.url_title(strtolower($set_menu->name)))?>"><?=$set_menu->name?></a></li>
<?php
	}
}
?>                        
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget">
                        <h5 class="widget-title">Shows</h5>
                        <ul>
<?php
if($footer_show){
	foreach($footer_show as $set_category){
?>
    <li><a href="<?=site_url('channel/'.$channel_data->channel_url.'/'.$set_category->slug.'/s'.$set_category->series_number.'/ep'.$set_category->episode_number)?>"><?=$set_category->name?></a></li>
<?php		
	}
}
?>                        
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="widget widget_recent_posts">
                        <h5 class="widget-title">Recent News</h5>
                        <ul>
<?php
if($recent_news_list){
	foreach($recent_news_list as $set_blazers){
?>
    <li><a href="<?='news/v/'.$set_blazers->id?>"><?=$set_blazers->name?></a></li>
<?php		
	}
}
?>                        
                        
                        </ul>
                    </div>
                </div>
                <!--<div class="col-sm-3">
                    <div class="widget widget_recent_posts">
                        <h5 class="widget-title">Recent comments</h5>
                        <ul>
                            <li><a href="#">How can the housing marke sustain such high property...</a></li>
                            <li><a href="#">Fortunately, I'm open optimistic at the recent interest...</a></li>
                            <li><a href="#">Love Kevin Turner's view on property...</a></li>
                            <li><a href="#">This house is crazy, where is it? I need it...</a></li>
                        </ul>
                    </div>
                </div>-->
                <div class="col-sm-2 pull-right">
                    <div class="widget text-right">
                        <h5 class="widget-title">Sponsored By</h5>
                        <div class="">
<?php
$footer_banner = $this->comman_model->get_by('banners',array('template'=>'footer_channel'),array('order'=>'asc'));
if($footer_banner){
	foreach($footer_banner as $set_banner){
?>
<a href="<?=$set_banner->link?>" target="_blank">
	<img src="<?='assets/uploads/banners/'.$set_banner->image?>" alt="Ads"/>
</a>
<?php		
	}
}
else{
?>
                        
<a href="<?=site_url('channel/'.$channel_data->channel_url)?>" >
    <img src="<?=!empty($channel_data->logo)?'assets/uploads/channels/full/'.$channel_data->logo:'assets/frontends/channels/images/coronis-C.png'?>" alt="Ads"/>
</a>
<?php
}
?>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>

            <div class="sub-footer">
                <div class="container">

                    <div class="row footer-row mv1">
                        <div class="col-sm-6">
                            <div class="widget">
                                <div class="social-links">
<?php
$user_social = json_decode($channel_data->social_media);
if(isset($user_social->facebook)){
?>                                
<a href="<?=$user_social->facebook?>" target="_blank"><i class="fa fa-facebook"></i></a>
<?php
}
if(isset($user_social->twitter)){
?>                                
<a href="<?=$user_social->twitter?>"><i class="fa fa-twitter"></i></a>
<?php
}
if(isset($user_social->linkedin)){
?>                                
<a href="<?=$user_social->linkedin?>"><i class="fa fa-linkedin"></i></a>
<?php
}
if(isset($user_social->instagram)){
?>                                
<a href="<?=$user_social->instagram?>"><i class="fa fa-instagram"></i></a>
<?php
}
?>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <!--<div class="tt-el-info inline-style">
                                <h4 class="top-weather">22˚C</h4>
                                <p class="current-location">Current location</p>
                            </div>-->
                            <div class="tt-el-info inline-style">
                                <h4><?=date('d')?></h4>
                                <p><?=date('F')?>, <?=date('l')?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border-line"></div>
                            <ul class="list-inline pull-left">
                                <li><a href="#">Home</a></li>
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
                            </ul>
                            <div class="copyright-text pull-right"><i class="fa fa-chevron-up scroll-to-top"></i> <?=show_static_text(1,62);?></div>
                        </div>
                    </div>
                    
                </div>
            </div>
    </footer> 


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


    <!-- Include jQuery and Scripts -->
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
function open_news_rate(id){
	$('#rate-modal').modal() ;
	$('#rate-modal .modal-body').html('loading..');
	$.ajax({
		type: 'GET',
		url : "<?='news_rate/ajax_modal'?>",
		data:{id:id},
		dataType:'json',
		success: function(data){
			$('#rate-modal .modal-body').html(data.html);
		}
	});

}
</script>
<div class="modal fade bd-example-modal-lg" id="rate-modal" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Rating</h3>
        </div>
        <div class="modal-body">
		</div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

