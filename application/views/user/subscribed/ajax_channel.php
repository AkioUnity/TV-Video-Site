<?php
$string = "SELECT id,name FROM shows_category where user_id=".$channel_list->user_id.' limit 4';
$channel_category = $this->comman_model->get_query($string,false);
$html = strip_tags($channel_list->description);
$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
$new_html = word_limiter($html, 50);

$html_2 = strip_tags($channel_list->short_description);
$html_2 = html_entity_decode($html_2, ENT_QUOTES, 'UTF-8');    
$new_html_2 = word_limiter($html_2, 10);
?>
<div class="row dialog__overview">
  <div class="col-md-7 no-padding item-slideshow-wrapper full-height">
    <div class="item-slideshow full-height owl-carousel">
      <div class="slide" data-image="<?=!empty($channel_list->subscribe_image)?'assets/uploads/channels/thumbnails/'.$channel_list->subscribe_image:'assets/uploads/no-image.gif'?>">
      </div>
      <div class="slide" data-image="<?=!empty($channel_list->subscribe_image)?'assets/uploads/channels/thumbnails/'.$channel_list->subscribe_image:'assets/uploads/no-image.gif'?>">
      </div>
    </div>
  </div>
  <div class="col-md-12 d-md-none d-lg-none d-xl-none bg-info-dark">
    <div class="container-xs-height">
      <div class="row row-xs-height">
        <div class="col-8 col-xs-height col-middle no-padding">
          <div class="thumbnail-wrapper d32 inline">
            <img width="32" height="32" src="<?=!empty($channel_list->subscribe_image)?'assets/uploads/channels/thumbnails/'.$channel_list->subscribe_image:'assets/uploads/no-image.gif'?>" data-src="<?=!empty($channel_list->subscribe_image)?'assets/uploads/channels/thumbnails/'.$channel_list->subscribe_image:'assets/uploads/no-image.gif'?>" data-src-retina="<?=!empty($channel_list->subscribe_image)?'assets/uploads/channels/thumbnails/'.$channel_list->subscribe_image:'assets/uploads/no-image.gif'?>" alt="">
          </div>
          <div class="inline m-l-15">
            <p class="text-white no-margin"><?=$channel_list->name?></p>
            <p class="hint-text text-white no-margin fs-12"><?=$channel_list->short_description?></p>
          </div>
        </div>
        <div class="col-4 col-xs-height col-middle text-right  no-padding">
          <!-- <h2 class="bold text-white price font-montserrat">$20.00</h2> -->
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-5 p-r-35 p-t-35 p-l-35 full-height item-description">
    <h2 class="semi-bold no-margin font-montserrat"><?=$channel_list->name?></h2>
    <p class="rating fs-12 m-t-5">
      Editor's Pick
        <i class="fa fa-star text-warning "></i>
      
    </p>
    <div class="fs-13"><?=$new_html?></div>
<?php
if($channel_category){
?>
    <div class="row m-t-20 m-b-10">
      <div class="col-6"><span class="font-montserrat all-caps fs-11">Top Categories</span>
      </div>
    </div>
<?php
	foreach($channel_category as $set_category){
?>    
    <button class="btn btn-white" style="margin-bottom:2px;"><?=$set_category->name?></button>
<?php
	}
?>
    <br>
<?php
}
?>    
    <span class="text-success pull-left pull-bottom m-b-25">
        <a href="<?=$_cancel.'/delete/'.$channel_list->subscribe_id;?>" onclick="return confirm_box();" class="text-success" >Unsubscribe</a>
    </span>
    <button class="btn btn-danger buy-now" onclick="window.location='<?=site_url('/channel/'.$channel_list->channel_url)?>'">Watch Now</button>
  </div>
</div>
<div class="row dialog__footer bg-info-dark d-sm-none d-none d-sm-flex d-lg-flex d-xl-flex">
  <div class="col-md-7 full-height separator m-t-15">
    <div class="container-xs-height">
      <div class="row row-xs-height">
        <div class="col-12 col-xs-height col-middle no-padding">
          <div class="thumbnail-wrapper d48 circular inline">
            <img width="48" height="48" src="<?=!empty($channel_list->logo)?'assets/uploads/channels/thumbnails/'.$channel_list->logo:'assets/users/assets/img/coronis-C-50px.png'?>" data-src="<?=!empty($channel_list->logo)?'assets/uploads/channels/thumbnails/'.$channel_list->logo:'assets/users/assets/img/coronis-C-50px.png'?>" data-src-retina="<?=!empty($channel_list->logo)?'assets/uploads/channels/thumbnails/'.$channel_list->logo:'assets/users/assets/img/coronis-C-50px.png'?>" alt="">
          </div>
          <div class="inline m-l-15">
            <p class="text-white no-margin"><?=$channel_list->name?></p>
            <p class="hint-text text-white no-margin fs-12"><?=$new_html_2?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Show Thumbnails -->
  <div class="col-md-5 full-height">
    <ul class="recommended list-inline pull-right m-t-10 m-b-0">
<?php
if(!empty($channel_list->image)){
?>
<li><a href="javascript:;"><img src="assets/uploads/channels/thumbnails/<?=$channel_list->image?>" class="img-small"></a></li>
<?php
}
if(!empty($channel_list->image_2)){
?>
<li><a href="javascript:;"><img src="assets/uploads/channels/thumbnails/<?=$channel_list->image_2?>" class="img-small"></a></li>
<?php
}
if(!empty($channel_list->logo)){
?>
<li><a href="javascript:;"><img src="assets/uploads/channels/thumbnails/<?=$channel_list->logo?>" class="img-small"></a></li>
<?php
}
?>
    </ul>
  </div>
    <!-- //END Show Thumbnails -->
</div>
<script>
    $('.item-slideshow > div').each(function() {
        var img = $(this).data('image');
        $(this).css({
            'background-image': 'url(' + img + ')',
            'background-size': 'cover'
        })
    });

    $(".item-slideshow").owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        dots: true
    });

</script>