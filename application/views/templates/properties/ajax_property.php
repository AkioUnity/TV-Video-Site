<?php
if($properties){
	foreach($properties as $set_properties){
?>
<div class="swiper-slide">
<div class="fs-blog-item">
<div class="post boxoffice-style color-2">
<div class="image" data-src="<?=!empty($set_properties->image)?$set_properties->image:'assets/uploads/no-image.gif'?>">
    <a href="<?=$set_properties->prop_social_url?>" target="_blank">
        <img src="assets/frontends/images/2x3.png" alt="Image"/>
    </a>
<?php
if(!empty($set_properties->prop_country)){
?>    
    <a href="<?=$set_properties->prop_social_url?>" class="label" target="_blank"><?=$set_properties->prop_country?></a>
<?php
}
?>
    <div class="entry-hover bigger-meta">
        <div class="meta-holder">
<a href="<?=$set_properties->prop_social_url?>" class="author-image" target="_blank">
    <img class="image image-thumb border-radius" src="<?=$set_properties->user_data->image?>" alt="Image" style="width:50px;height:50px">
<?php
if($set_properties->user_data->verified==1){
?>
<span class="u-badge u-badge-border-success u-badge--md u-badge-pos--bottom-right rounded-circle"><i class="fa fa-check"></i></span>
<?php
}
?>    
</a>        
<div class="pull-right property-state">
            <span class="earnings"><?=$set_properties->prop_city?></span>
            <span class="views"><?=$set_properties->prop_price_display?></span>
</div>            
        </div>
    </div>

</div>
<ul class="list-inline d-flex">
                <li class="list-inline-item">
                  <a class="text-secondary" href="<?=$set_properties->prop_social_url?>" target="_blank"><?=$set_properties->prop_bed?> <span class="fa fa-bed ml-1"></span>
                  </a>
                </li>
                <li class="list-inline-item ml-3">
                  <a class="text-secondary" href="<?=$set_properties->prop_social_url?>" target="_blank">
                    <?=$set_properties->prop_bath?>
                    <span class="fa fa-bath ml-1"></span>
                  </a>
                </li>
                <li class="list-inline-item ml-3">
                  <a class="text-secondary" href="<?=$set_properties->prop_social_url?>" target="_blank">
                    <?=$set_properties->prop_car?>
                    <span class="fa fa-car ml-1"></span>
                  </a>
                </li>
              </ul>
<h4><a href="<?=$set_properties->prop_social_url?>" target="_blank"><?=$set_properties->prop_title?></a></h4>

</div>
</div>
</div>
<?php
	}
}
?>
