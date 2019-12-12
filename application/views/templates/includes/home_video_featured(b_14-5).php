<?php
$this->db->limit(15);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Featured Video','tab_section'=>'Featured Shows','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));
?>
<div class="movie-section">
        <div class="container">

<!-- pTV Featured carousel -->
            <div class="col-md-12">
                    <h3 class="block-title mt0">
                    FEATURED SHOWS
                    </h3>
		</div>
            <div class="m-dimension-carousel news-block" data-col="3" data-row="1">
		<div class="swiper-container carousel-container swiper-container-horizontal" style="width: 100%;">
                    <div class="swiper-wrapper">
<?php
if($home_featured){
	foreach($home_featured as $set_news){
?>
<div class="swiper-slide swiper-slide-active" style="width: 360px; margin-right: 30px;">
<div class="category-block articles">
<div class="post hover-dark">
<div class="image video-frame" data-src="<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>" style="background-image: url('<?=!empty($set_news->image)?'assets/uploads/news/full/'.$set_news->image:'assets/uploads/no-image.gif'?>');">
<img src="assets/frontends/images/5x3.png" alt="Proportion">
<a class="video-player video-player-center" href="<?=$set_news->v_link?>"></a>
</div>
</div>
</div>
</div>
<?php
	}
}
?>
                    </div>
    <!-- end swiper-wrapper -->
                    <div class="pagination-next-prev mt3">
                        <a href="javascript:;" class="swiper-button-prev arrow-link swiper-button-disabled" title="Prev"><img src="assets/frontends/images/arrow-left-white.gif" alt="Arrow"></a>
                        <a href="javascript:;" class="swiper-button-next arrow-link" title="Next"><img src="assets/frontends/images/arrow-right-white.gif" alt="Arrow"></a>
                    </div>
		</div>
<!-- end swiper-container -->
            </div>

<!-- end FEATURED -->

<!-- Future Popular on pTV carousel -->

<!-- Future New to pTV carousel -->


            <div class="mv6"></div>
        </div>
    </div>