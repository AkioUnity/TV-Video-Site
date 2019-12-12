<?php
$get_filter = $this->input->get('filter');
$get_category = $this->input->get('category');
?>
<link class="main-stylesheet" href="<?=site_url()?>assets/users/pages/css/themes/light.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=site_url()?>assets/plugins/ajax-pagination/pagination.min.js"></script>
<style>
.img-high-height{
	height:492px;
    object-fit: cover;
}
.img-thumbnails{
	height:241px;
    object-fit: cover;
}

.item-details .dialog__content .dialog__overview .item-slideshow .slide{
	background-size:100% 100% !important;
}
.img-small{
	height:56px;
}
</style>
<div class="card-transparent p-l-20 p-t-20">
<h4>My Subscriptions</h4>
</div>
<div class="gallery">

<div class="gallery-filters p-t-10 p-b-10">
  
<ul class="list-inline text-right">
  <li class="hint-text">Sort by: </li>
  <li><a href="javasscript:;" class="<?=$get_filter=='name'?'active':''?> text-master p-r-5 p-l-5 a-sort-name">Name</a></li>
  <li><a href="javasscript:;" class="<?=$get_filter=='new'?'active':''?> text-master hint-text p-r-5 p-l-5 a-sort-new">Newest</a></li>
  <li><a href="javasscript:;" class="<?=$get_filter=='trending'?'active':''?> text-master hint-text p-r-5 p-l-5 a-sort-trending">Trending</a></li>
  <li>
    <button class="btn btn-primary m-l-10" data-toggle="filters">More filters</button>
  </li>
</ul>
</div>
<?php
if($all_data){
	$i=0;
	foreach($all_data as $set_data){
		$i++;
		if($i==2){
?>
<div class="gallery-item " data-width="2" data-height="2" onclick="select_user(<?=$set_data->subscribe_id?>)">
<!-- START PREVIEW -->
<div class="live-tile slide" data-speed="750" data-delay="4000" data-mode="carousel">
  <div class="slide-front">
    <img src="<?=!empty($set_data->image_2)?'assets/uploads/channels/thumbnails/'.$set_data->image_2:'assets/uploads/no-image.gif'?>" alt="" class="image-responsive-height img-high-height">
  </div>
</div>
<!-- END PREVIEW -->
<!-- START ITEM OVERLAY DESCRIPTION -->
<div class="overlayer bottom-left full-width">
  <div class="overlayer-wrapper item-info more-content">
    <div class="gradient-grey p-l-20 p-r-20 p-t-20 p-b-5">
      <div class="">
        <h3 class="pull-left bold text-white no-margin"><?=$set_data->name?></h3>
        <h3 class="pull-right text-white no-margin">
            
            <a href="javascript:;" class="text-white">
            <i class="fa fa-play-circle large" ></i>
            </a>
            
        </h3>
        <div class="clearfix"></div>
        <span class="hint-text pull-left text-white"><?=$set_data->short_description?></span>
        <div class="clearfix"></div>
      </div>
      <div class="">
        <h5 class="text-white light"><?=$set_data->payoff_desc?></h5>
      </div>
      <div class="m-t-0">
        <div class="thumbnail-wrapper">
          <img height="40" src="<?=!empty($set_data->logo)?'assets/uploads/channels/thumbnails/'.$set_data->logo:'assets/users/assets/img/coronis-C-50px.png'?>" data-src="<?=!empty($set_data->logo)?'assets/uploads/channels/thumbnails/'.$set_data->logo:'assets/users/assets/img/coronis-C-50px.png'?>" data-src-retina="<?=!empty($set_data->logo)?'assets/uploads/channels/thumbnails/'.$set_data->logo:'assets/users/assets/img/coronis-C-50px.png'?>" alt="" style="width:65px;height:35px;">
        </div>
        <div class="inline m-l-10">
          <p class="no-margin text-white fs-12">Stone Real Estate</p>
        </div>
        <div class="pull-right m-t-10">
          <button class="btn btn-white btn-xs btn-mini bold fs-14" type="button">+</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!-- END PRODUCT OVERLAY DESCRIPTION -->
</div>
<?php
		}
		else{
?>
<div class="gallery-item <?=$i==1?'first':''?>" data-width="<?=$i==2?'2':'1'?>" data-height="<?=$i==2?'2':'1'?>" onclick="select_user(<?=$set_data->subscribe_id?>)">
<img src="<?=!empty($set_data->image_2)?'assets/uploads/channels/thumbnails/'.$set_data->image_2:'assets/uploads/no-image.gif'?>" alt="" class="image-responsive-height img-thumbnails">
<div class="overlayer bottom-left full-width">
  <div class="overlayer-wrapper item-info ">
    <div class="gradient-grey p-l-20 p-r-20 p-t-20 p-b-5">
      <div class="">
        <p class="pull-left bold text-white fs-14 p-t-10"><?=$set_data->name?></p>
        <h5 class="pull-right semi-bold text-white font-montserrat bold">
        <i class="fa fa-play-circle large "></i>
        </h5>
        <div class="clearfix"></div>
      </div>
      <div class="m-t-10">
        <div class="thumbnail-wrapper d32 circular m-t-5">
          <img width="40" height="40" src="<?=!empty($set_data->logo)?'assets/uploads/channels/thumbnails/'.$set_data->logo:'assets/users/assets/img/coronis-C-50px.png'?>" data-src="<?=!empty($set_data->logo)?'assets/uploads/channels/thumbnails/'.$set_data->logo:'assets/users/assets/img/coronis-C-50px.png'?>" data-src-retina="<?=!empty($set_data->logo)?'assets/uploads/channels/thumbnails/'.$set_data->logo:'assets/users/assets/img/coronis-C-50px.png'?>" alt="">
        </div>
        <div class="inline m-l-10">
          <p class="no-margin text-white fs-12">Coronis Channel</p>
        </div>
        <div class="pull-right m-t-10">
          <button class="btn btn-white btn-xs btn-mini bold fs-14" type="button">+</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<!-- END PRODUCT OVERLAY DESCRIPTION -->
</div>
<?php
		}
	}
}
else{
?>
You have not yet subscribed to a Channel
<?php	
}
?>
</div>
<!-- END CATEGORY -->
  <div id="itemDetails" class="dialog item-details">
<div class="dialog__overlay"></div>
<div class="dialog__content">
<div class="container-fluid channel-m-body"></div>
<button class="close action top-right" data-dialog-close><i class="pg-close fs-14"></i>
</button>
</div>
</div>          <!-- END DIALOG -->
<div class="quickview-wrapper" id="filters">
<div class="padding-40 "> 
<a class="builder-close quickview-toggle pg-close" data-toggle="quickview" data-toggle-element="#filters" href="javascript:;"></a>
<form class="" role="form" id="search-filter-form" method="get">
<h5 class="all-caps font-montserrat fs-12 m-b-20">Advance filters</h5>
<div class="form-group form-group-default ">
  <label>Channel</label>
  <input type="text" name="q" value="<?=$this->input->get('q')?>" class="form-control" placeholder="Channel name">
</div>
<h5 class="all-caps font-montserrat fs-12 m-b-20 m-t-25">Advance filters</h5>
<div class="radio radio-danger">
  <input type="radio"  value="name" name="filter" id="asc" <?=$get_filter=='name'?'checked="checked"':''?> >
  <label for="asc">Ascending order</label>
  <br>
  <input type="radio" value="viewed" name="filter" id="views" <?=$get_filter=='viewed'?'checked="checked"':''?> >
  <label for="views">Most viewed</label>
  <br>
  <input type="radio" value="trending" name="filter" id="trending" <?=$get_filter=='trending'?'checked="checked"':''?> >
  <label for="trending">Trending</label>
  <br>
  <input type="radio" value="new" name="filter" id="latest" <?=$get_filter=='new'?'checked="checked"':''?> >
  <label for="latest">Newest</label>
</div>
<h5 class="all-caps font-montserrat fs-12 m-b-20 m-t-25">Categories</h5>
<div class="check-circle check-danger">
<?php
if($channel_category_list){
	foreach($channel_category_list as $set_data){
?>
  <input type="radio" name="category" value="<?=$set_data->id?>"  id="c-f-<?=$set_data->id?>" <?=$get_category==$set_data->id?'checked="checked"':''?> >
  <label for="c-f-<?=$set_data->id?>"><?=$set_data->name?></label>
  <br>
<?php
	}
}
?>
</div>
<button class="pull-right btn btn-danger btn-cons m-t-40">Apply</button>
</form>
</div>
</div>          <!-- END CONTAINER FLUID -->
<script>
function select_user(id){
	$.ajax({
		type: 'GET',
		url : "<?php echo $_cancel.'/ajax_channel'?>",
		data:{id:id},
		dataType:'json',
		success: function(response){
			if(response.status=='ok'){
				$('#itemDetails .channel-m-body').html(response.html);
				var dlg = new DialogFx($('#itemDetails').get(0));
				dlg.toggle();
			}
			else{
				alert(response.message);
			}
		}
	});
}
/*    $('body').on('click', '.gallery-item', function() {
});*/

$(".a-sort-name").click(function(e){
	e.preventDefault();
	$("#asc").prop("checked", true);
	$('#search-filter-form').submit();
});
$(".a-sort-new").click(function(e){
	e.preventDefault();
	$("#latest").prop("checked", true);
	$('#search-filter-form').submit();
});
$(".a-sort-trending").click(function(e){
	e.preventDefault();
	$("#trending").prop("checked", true);
	$('#search-filter-form').submit();
});
</script>
<?php
if(!$all_data){
?>
<style>
.gallery{
	width:100% !important;
}
</style>
<?php	
}

?>