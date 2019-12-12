<link rel="stylesheet" href="assets/frontends/vendors/owl-carousel/dist/assets/owl.carousel.min.css" />
<script src="assets/frontends/vendors/owl-carousel/dist/owl.carousel.min.js"></script>
<style>
.properties-wp-result h4 a,
.text-secondary {
    color: #77838f !important;
}
#properties-wp .post.boxoffice-style .bigger-meta {
  visibility: visible;
  opacity: 1;
  -webkit-transform: translateY(0px);
  -moz-transform: translateY(0px);
  transform: translateY(0px);
}
.property-state span{
	display:block;
}
#properties-wp .post .bigger-meta .author-image {
    top: -9px;
}
#properties-wp .post.boxoffice-style .bigger-meta span {
    line-height: 24px;
	text-align:right;
}


.rounded-circle {
    border-radius: 50% !important;
}

.u-badge {
    z-index: 3;
    display: inline-block;
    vertical-align: middle;
    text-align: center;
    width: 1.125rem;
    height: 1.125rem;
    line-height: 1.7 ;
    font-size: 0.625rem;
}
.u-badge-border-success {
	border: solid 1px;
    color: #fff;
    background: #00c9a7;
    border-color: #fff;
}
.u-badge-pos--bottom-right {
    position: absolute;
    right: 17px;
    bottom: 19px;
}

.u-badge--md {
    width: 1.375rem;
    height: 1.375rem;
    line-height: 1.7 !important;
    font-size: 0.6875rem;
}
.u-badge .fa{
	padding:3px
}

</style>

    
<div class="simple-tab-space" id="properties-wp">

<h3><a href="http://www.getcoicio.com/">Featured Properties - From Coicio</a></h3>
        

<div class="fs-blog-carousel" data-col="3" data-row="1" data-responsive="3,2,1">
        <div class="swiper-container">
            <div class="swiper-wrapper slide-wp-1 properties-wp-result owl-carousel owl-theme">  
</div>
	</div>

            <div class="fs-pager">
<span id="customNav">
<a href="javascript:;" class="fs-arrow-prev swiper-prev"><img src="assets/frontends/images/arrow-prev.png" alt="preview"></a>
<a href="javascript:;" class="fs-arrow-next swiper-next"><img src="assets/frontends/images/arrow-next.png" alt="preview"></a>
</span>
</div>
        </div>        
</div>
<script>
function get_properties(){
	$.ajax({
		type: 'GET',
		url : "<?='properties/ajax'?>",
		data:{id:<?php echo time();?>},
		dataType:'json',
		success: function(response){
			$('.properties-wp-result').html(response.html);
			$('#properties-wp .image').each(function(){
				if ( typeof $(this).data('src') !== 'undefined' && $(this).data('src') != '' ) {
					$(this).css('background-image', 'url('+$(this).data('src')+')');
				}
			});
			//$('#properties-wp .swiper-container').swiper();
			setTimeout(function() {
				$(document).ready(function(){
					var carouselCustom  = $('#properties-wp .swiper-wrapper');
					carouselCustom.owlCarousel({
						loop:true,
						margin:10,
						responsiveClass:true,
						nav: false,
						navigation : false,
						dots: false,
/*						nav: true,
						navContainer: '#customNav',*/
						/*navText: ['<a href="javascript:;" class="fs-arrow-prev swiper-prev"><img src="assets/frontends/images/arrow-prev.png" alt="preview"></a>','<a href="javascript:;" class="fs-arrow-next swiper-next"><img src="assets/frontends/images/arrow-next.png" alt="preview"></a>'],*/
						responsive:{
							0:{
								items:1,
								nav:true
							},
							600:{
								items:3,
								nav:false
							},
							1000:{
								items:5,
								nav:true,
								loop:false
							}
						}
					});
					
					$('#properties-wp .swiper-next').click(function() {
						 carouselCustom.trigger('next.owl.carousel');
					});
					
					// Or to go to a previous slide
					$('#properties-wp .swiper-prev').click(function() {
						  carouselCustom.trigger('prev.owl.carousel');
					});					
				});
/*				$('#properties-wp .swiper-container').swiper({
					slidesPerView: 5,
					spaceBetween: 30,					
					nextButton: $('#properties-wp .swiper-next'),
					prevButton: $('#properties-wp .swiper-prev'),
				});*/
			}, 2000);
			
		}
	});	
}
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		get_properties();
	});
});

</script>
<style>
#properties-wp .owl-nav{
	display:none;
}
</style>