<style>
.course-content img{
	width:100%;
	height:auto;
}

@media (max-width: 768px) {
	.course-content img{
		width:100% !important;
		height:auto  !important;
	}
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class=" py-3">
			<h4 class=" font-weight-bold text-primary"><?=$view_data->name?></h4>
		</div>
	</div>        
	<div class="col-md-4">
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Course Sections</h6>
            </div>
            <div class="card-body">
<?php
if($section_list){
	foreach($section_list as $set_data){
?>
<button class="btn btn-block text-left btn-section btn-secondary" data-cid="<?=$view_data->rand_id?>" data-id="<?=$set_data->rand_id?>" data-temp="<strong><?=$set_data->name?></strong>"><strong><?=$set_data->name?></strong></button>            
<?php
	}
}
?>            
              
            </div>
          </div>    
    </div>
    <div class="col-md-8">
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Course Content</h6>
            </div>
            <div class="card-body course-content" ><p>Please select section from left sidebar to load content</p></div>
          </div>    
    </div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
		$('.panel-intro').find('.panel-body').hide(0);
		$('.panel-intro').find('.panel-heading').click(function(){
			$(this).parent('.panel-intro').find('.panel-body').slideToggle('fast');
		});
		$(".btn-section").click(function(){
			var all_buttons = $('.btn-section');
			var btn = $(this);
			var id = btn.attr('data-id');
			var cid = btn.attr('data-cid');
			var token = btn.attr('data-token');
			btn.attr('data-temp',btn.html()).attr('disabled','disabled').html('<span class="fa fa-spinner fa-spin"></span> Loading...');
			all_buttons.attr('disabled','disabled');
			btn.button('loading');
			$.ajax({
			  url: '<?=$_cancel.'/ajax_section'?>',
				method: 'GET',
				data:{
					id: id,
					c_id: cid,
				},
				dataType:'json',
				error: function(){
					all_buttons.removeAttr('disabled');
					btn.html(btn.attr('data-temp')).removeAttr('disabled');
					$(".course-content").html('<div class="alert alert-danger">Communication Error</div>');
				},
				success: function(response){
					all_buttons.removeAttr('disabled').removeClass('btn-primary').addClass('btn-secondary');
					btn.html(btn.attr('data-temp')).removeAttr('disabled').removeClass('btn-secondary').addClass('btn-primary');
					if(response.status=='ok'){
						$(".course-content").html(response.content);
					}
					else{
						$(".course-content").html(response.message);
					}
				}
			});
		});
	});
</script>