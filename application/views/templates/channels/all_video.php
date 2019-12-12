<?php $this->load->view('templates/channels/channel_header'); ?>
<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<style>
#header.header-entertainment .header-wrapper .site-branding img {
    height: 60px;
    width: 155px;
}
</style>
<body class="entertainment-content">
    <div class="wrapper">
        
<?php $this->load->view('templates/includes/home_menu'); ?>
<!-- Section 1 # Slideshow -->
<?php $this->load->view('templates/channels/slider'); ?>

<div class="content-area pvt0 entertainment-layout pb0 mb40">
<!-- Section 2 # News -->   
    <div class="movie-section">
        <div class="container">
        <!-- New to pTV carousel -->
            <div class="row">
		<div class="col-md-9">
<h3 class="block-title3 mv5 mvt0" data-title="<?=$channel_data->name?>"><?=isset($selected_category)&&!empty($selected_category)?$selected_category->name:'All Shows'?></h3>
                </div>
                <div class="col-md-3 text-right">
		        <a href="<?=site_url($_cancel.'/'.$channel_data->channel_url);?>" class="category-more text-left">Home</a>
                </div> 
                <div class="col-md-12">
<form method="get" id="search-form" class="form-inline" >
<input type="hidden" name="category" value="<?=$this->input->get('category');?>" >
<input type="hidden" name="channel_id" value="<?=$channel_data->rand_id?>" />
</form>                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
				<div class="category-block articles" id="result-data"><h3 style="color:#FFF">Loading..</h3></div>
                            </div>                    
                        </div>
                    </div>
					<ul class="pagination float-right" id="list-paginations"></ul>
                </div>
                
            </div>
        <!--<div class="pagination-next-prev mt3">
            <p class="text-light" >Load More</p>
                    </div>-->
    <!-- END New to Channel -->
        </div>
    </div>
</div>
<!-- .content-area -->
    <div class="clearfix"></div>
<?php $this->load->view('templates/channels/footer'); ?>
    
        </div>
    <!-- end .wrapper -->
<script type="text/javascript">
var page =0;
function ajax_more(){
    var data = $('#search-form').serialize();
    $.ajax({
		type: 'GET',
        url:'<?=$_cancel.'/ajax_video'?>',
		data:data,
		dataType:'json',
		success: function(response){
			$('#result-data').html(response.html);
			if(response.total>20){
				elem = document.querySelector('.js-switch');
				$('#list-paginations').pagination({
					total: response.total,
					current: 1,
					length: 20,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						urls = response.url;
						set_d = 'page='+options.current;
						$.get(urls,set_d,
							function(result){          
								$('#result-data').html(result.html);
							},
							'json'
						);
	
					}
				});
			}
		}
    });
}
ajax_more();
</script>

<script>
 $('.custom-logo-link').attr("href",'<?=site_url('channel/'.$channel_data->channel_url)?>');
</script>
<?php
/*if(!empty($channel_data->logo)){
?>
<script>
//$('.custom-logo-link img').attr("src",'assets/uploads/channels/full/<?=$channel_data->logo?>');
</script>
<?php	
}
*/?>

</body>
</html>