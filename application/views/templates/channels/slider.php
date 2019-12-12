<link href="<?=site_url()?>assets/plugins/jquery_cofirm/dist/jquery-confirm.min.css" rel="stylesheet">
<script src="<?=site_url()?>assets/plugins/jquery_cofirm/dist/jquery-confirm.min.js"></script>
<?php
$subscribeBtn =true;
if(isset($user_details)){
	$subSubcr = print_count('users_channels_subscribe',array('user_id'=>$user_details->id,'channel_id'=>$channel_data->id));
	if($subSubcr>0){
		$subscribeBtn  =false;
	}
}
?>                    
<style>
.ms-sl-selected .video-text-hover{
    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
.ms-sl-selected .video-text-hover:hover{
    display: block;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}
@-webkit-keyframes fadeIn {
    from { opacity: 0; }
      to { opacity: 1; }
}

@keyframes fadeIn {
    from { opacity: 0; }
      to { opacity: 1; }
}
@keyframes cssAnimation {
    to {
		opacity:0;
    }
}
@-webkit-keyframes cssAnimation {
    to {
		opacity:0;
    }
}
</style>
<style>
.video-text-bg{
	background-color:rgba(0,0,0,0.3);
	/*padding-left:5px;*/
	position:absolute;
	width:100%;
	height:100%;
}
.entertainment-slider.news-slider-hover .ms-thumb-list.ms-dir-v{
	display:none;
}

/*.ms-sl-selected .video-text-hover{
  opacity: 0;
  transition: all ease 10s;
}

.video-text-hover:hover{
	opacity:1
}*/
</style>
<div class="entertainment-slider news-slider-hover">

    <!-- masterslider -->
    <div class="master-slider ms-skin-default" id="masterslider3">
<?php

if($sliders){
	foreach($sliders as $set_slider){
	$video_class = 'video-text-bg';//set blank
	$video_class_hover = '';//set blank
	if(!empty($set_slider->link)){
		$video_class = 'video-text-bg';
		$video_class_hover = 'video-text-hover';//set blank
	}
	elseif(!empty($set_slider->video_file)){
		$video_class_hover = 'video-text-hover';//set blank
		$video_class = 'video-text-bg';
	}
?>	
	<div class="ms-slide">
            <div class="slide-pattern tint <?=$video_class?>"></div>
            <img src="assets/frontends/vendors/masterslider/style/blank.gif" data-src="<?=!empty($set_slider->image)?'assets/uploads/channels/full/'.$set_slider->image:'assets/frontends/images/Hero2.jpg'?>"  />
<?php
if(!empty($set_slider->video_link)){
	$video_class = 'video-text-bg';
	$videoLink = $set_slider->video_link;
	if(h_videoType($set_slider->video_link)=='youtube'){
		$link = $set_slider->video_link;
		$video_id = explode("?v=", $link);
		$video_id = $video_id[1];	
		$videoLink = 'https://www.youtube.com/embed/'.$video_id.'?hd=1&controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1&autohide=1';
	}
	else{
		$video_id = h_get_vimeo_id($set_slider->video_link);
		$videoLink = '//player.vimeo.com/video/'.$video_id.'?background=1';
	}
?>
<iframe src="<?=$videoLink?>" webkitallowfullscreen mozallowfullscreen frameborder="0" allowfullscreen style="width:100%;height:100%"  data-mute="true" data-loop="true" ></iframe>
<?php
}
elseif(!empty($set_slider->video_file)){
	$video_class = 'video-text-bg';
?>
<video data-autopause="false" data-mute="true" data-loop="true" data-fill-mode="fill">
    <source id="mp4-<?=$set_slider->id?>" src="assets/uploads/channels/<?=$set_slider->video_file?>" type="video/mp4"/>
</video>
<?php
}
?>                   
            <div class="ms-layer" data-effect="bottom(45)" data-duration="300" data-ease="easeInOut" data-origin="bl">
                <div class="meta animate-element" data-anim="fadeInUp">
                    <span class="author"><img src="<?=!empty($channel_data->logo)?'assets/uploads/channels/full/'.$channel_data->logo:'assets/frontends/channels/images/coronis-C.png'?>" width="100px"/></span>
                </div>
                    <a href="javascript:;"><h2 class="animate-element" data-anim="fadeInUp"><?=$set_slider->name?></h2></a>
                    <p class="animate-element" data-anim="fadeInUp"><?=$channel_data->short_description?></p>
                <div class="animate-element" data-anim="fadeInUp">
<?php
if(!empty($set_slider->video_link)){
?>        
<a class="video-player video-player-center video-player-large button beauty-hover" href="<?=$set_slider->video_link?>">Watch Now</a>
<?php
}
?>        
<!--                    <a href="javascript:;" class="button beauty-hover"><i class="fa fa-play"></i> Watch Now</a>-->
                    <a href="javascript:;" class="button beauty-hover s-btn-more" ><i class="fa fa-ellipsis-h"></i> View More</a>
<?php
if($subscribeBtn){
?>    
<a href="javascript:;" class="button beauty-hover btn-subscribeBtn" onclick="set_subscribe()" >Subscribe </a>
<?php
}
?>    
                </div>
            </div>
	</div>
<?php
	}
}
?>	
    
    </div>
    <!-- end of masterslider -->
</div>
<script>
$(".s-btn-more").click(function() {
    $('html, body').animate({
        scrollTop: $(".content-area").offset().top
    }, 2000);
});
function set_subscribe(id){
    $.ajax({
		type: 'GET',
        url:'<?=$_cancel.'/set_subscribe'?>',
		data:{id:'<?=$channel_data->rand_id?>'},
		dataType:'json',
		success: function(response){
			if(response.status=='ok'){
				//alert('Channel has successfully subscribed!!');
				$('.btn-subscribeBtn').remove();
			}
			else{
				$.alert({
					title: 'Alert!',
					content:response.message,
				});
			}
		}
    });
}
</script>

