<?php
if($properties){
	foreach($properties as $set_properties){
?>
<div class="col-xs-6 col-sm-4 col-md-15">
<div class="post boxoffice-style color-2">
<div class="image" data-src="<?=!empty($set_properties->image)?$set_properties->image:'assets/uploads/no-image.gif'?>">
    <a href="<?=$set_properties->prop_social_url?>">
        <img src="assets/frontends/images/2x3.png" alt="Image"/>
    </a>

</div>
<ul class="list-inline d-flex">
                <li class="list-inline-item">
                  <a class="text-secondary" href="<?=$set_properties->prop_social_url?>"><?=$set_properties->prop_bed?> <span class="fa fa-bed ml-1"></span>
                  </a>
                </li>
                <li class="list-inline-item ml-3">
                  <a class="text-secondary" href="<?=$set_properties->prop_social_url?>">
                    <?=$set_properties->prop_bath?>
                    <span class="fa fa-bath ml-1"></span>
                  </a>
                </li>
                <li class="list-inline-item ml-3">
                  <a class="text-secondary" href="<?=$set_properties->prop_social_url?>">
                    <?=$set_properties->prop_car?>
                    <span class="fa fa-car ml-1"></span>
                  </a>
                </li>
                <!--<li class="list-inline-item ml-auto">
                  <a class="text-secondary" href="javascript:;">
                    <span class="far fa-envelope mr-1"></span>
                    Message
                  </a>
                </li>-->
              </ul>
<h4><a href="<?=$set_properties->prop_social_url?>"><?=$set_properties->prop_title?></a></h4>

</div>
<!-- /.post -->
</div>
<?php
	}
}
?>
