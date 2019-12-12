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
$sliders = $this->comman_model->get_by('sliders',false,array('order'=>'asc'),false);
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
	        <img src="assets/frontends/vendors/masterslider/style/blank.gif" data-src="<?=!empty($set_slider->image)?'assets/uploads/sliders/full/'.$set_slider->image:'assets/frontends/images/Hero2.jpg'?>" alt="Image"/>
<?php
if(!empty($set_slider->link)){
	$video_class = 'video-text-bg';
	$videoLink = $set_slider->link;
	if(h_videoType($set_slider->link)=='youtube'){
		$link = $set_slider->link;
		$video_id = explode("?v=", $link);
		$video_id = $video_id[1];	
		$videoLink = 'https://www.youtube.com/embed/'.$video_id.'?hd=1&controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1&autohide=1';
	}
	else{
		$video_id = h_get_vimeo_id($set_slider->link);
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
    <source id="mp4-<?=$set_slider->id?>" src="assets/uploads/sliders/<?=$set_slider->video_file?>" type="video/mp4"/>
</video>
<?php
}
?>            
	        <div class="ms-thumb post">
	        	<div class="thumb-meta">
		        	<!--<div class="meta">
						<span class="author">Kevin Turner</span>
						<span class="date">1h</span>
					</div>-->
					<h4><?=$set_slider->name?></h4>
					<p><?=$set_slider->user_name?></p>
				</div>
	        </div>

	        <div class="ms-layer <?=$video_class_hover?>" data-effect="bottom(45)" data-duration="300" data-ease="easeInOut" data-origin="bl">

		        <!--<div class="meta animate-element" data-anim="fadeInUp">
		        	<span class="author">Latest</span>
					<span class="author">Kevin Turner</span>
					<span class="date">1h</span>
				</div>-->
                <div class=""> <?php //$video_class?>
					<a href="#"><h2 class="animate-element" data-anim="fadeInUp"><?=$set_slider->name?></h2></a>
			        <p class="animate-element" data-anim="fadeInUp"><?=$set_slider->description?></p>
                </div>
				<div class="animate-element" data-anim="fadeInUp">
<?php
if(!empty($set_slider->watch_link)){
?>        
<!--<a href="<?=$set_slider->watch_link?>" class="button beauty-hover"><i class="fa fa-play"></i> Watch Now</a>-->
<a class="video-player video-player-center video-player-large button beauty-hover" href="<?=$set_slider->watch_link?>">Watch Now</a>
<?php
}
if(!empty($set_slider->article_link)){
?>        
<a href="<?=$set_slider->article_link?>" class="button beauty-hover"><i class="fa fa-ellipsis-h"></i> Read More</a>
<?php
}
?>        

<!--					<div class="circle-chart" data-circle-width="7" data-percent="84" data-text="8.4 <small>stars</small>"></div>-->
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