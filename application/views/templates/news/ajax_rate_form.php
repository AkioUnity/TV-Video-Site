<script src="<?php echo base_url();?>assets/frontends/vendors/jquery.validate.js"></script> 
<link href="assets/frontends/vendors/star_rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="assets/frontends/vendors/star_rating/js/star-rating.js" type="text/javascript"></script>
<div class="row">
    <div class="col-md-12">
<div id="review_msge"></div>
<form method="post" action="" id="review_form" accept-charset="UTF-8" style="padding-top:10px;" class="edit-form  form-horizontal" >
<input type="hidden" name="news_id" value="<?php echo $products->id?>"  />
<div class="form-group">
	<label class="col-md-2 control-label">Rating</label>
    <div class="col-md-9">
        <input id="rating-input" name="rate" type="number" value="3" class="rating rating-input" min=0 max=5 step=1 data-size="xs" data-show-clear="false" data-show-caption="false" data-stars="5" />			  
    </div>
</div>

<div class="form-group" style="margin-top:10px;">
	<label class="col-md-2 control-label">&nbsp;</label>
    <div class="col-md-9 ">
            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..">Submit</button>

    </div>
</div>
  </form>
 
    </div>
</div>




<div style="clear:both"></div>
</div>


<style>
.customer-login .col-md-4{
	margin-bottom:10px;
}

.error-span{
	color:#F00;
	margin:0px;
}
.error-span p{
	margin:0px;
}

.form-group{
	clear:both;
}

.form-group label{
  padding: 5px 0px 0px;
  font-size: 13px;
  font-weight: normal;
}


</style>
<script>
$(document).ready(function(){
	$('#review_form').validate({
		ignore: [],
        rules: {
           comment: {
                required: true,
            },
           rate: {
                required: true,
            },
        },
		submitHandler: function (form) {
			var data = jQuery('#review_form').serialize();
			$(".submitBtn").button('loading');
			$.ajax({
				type: 'GET',
				url : "<?php echo 'news_rate/ajax_update_review'?>",
				data:data,
				dataType:'json',
				success: function(response){
					$(".submitBtn").button('reset');
					$('#review_msge').empty();
					if (response.status == 200) {
						var message = response.message;
						$('#review_msge').html("<div class='alert alert-success fade in'><strong>" + response.message + "</strong></div>");
						$("#review_msge").fadeTo(2000, 500).slideUp(500, function(){
							$('#review_msge').empty();
							$('#rate-modal').modal('hide');
						});
						$totalRatingHtml = '<i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i>';
						if(response.rating>=5){
							$totalRatingHtml = '<i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i>';
						}
						else if(response.rating>=4){
							$totalRatingHtml = '<i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star "></i>';
						}
						else if(response.rating>=3){
							$totalRatingHtml = '<i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star "></i><i class="fa fa-star "></i>';
						}
						else if(response.rating>=2){
							$totalRatingHtml = '<i class="fa fa-star color-1"></i><i class="fa fa-star color-1"></i><i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i>';
						}
						else if(response.rating>=1){
							$totalRatingHtml = '<i class="fa fa-star color-1"></i><i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i>';
						}
						$('.rate-'+response.news_id).html($totalRatingHtml);
					}
					else if (response.status == 201) {
						$('#review_msge').html("<div class='alert alert-danger fade in'><strong>" + response.message + "</strong></div>");
					}
					
				}
			});

			return false;
		},
	});
});
</script>