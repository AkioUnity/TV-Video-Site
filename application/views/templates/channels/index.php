<?php $this->load->view('templates/channels/channel_header'); ?>
<style>
#header.header-entertainment .header-wrapper .site-branding img {
    height: 60px;
    width: 155px;
}
</style>
<body class="entertainment-content">

    <!--<div class="tana-loader">
        <div class="loader-content">
            <div class="loader-circle"></div>
            <div class="loader-line-mask">
                <div class="loader-line"></div>
            </div>
        </div>
    </div>-->
    <div class="wrapper">
        
<?php $this->load->view('templates/includes/home_menu'); ?>
        

<!-- Section 1 # Slideshow -->
<?php $this->load->view('templates/channels/slider'); ?>

<div class="content-area pvt0 entertainment-layout pb0 mb40">
    <div class="movie-section">
        <div class="container">
<?php $this->load->view('templates/channels/home_featured'); ?>
<?php $this->load->view('templates/channels/home_carousel'); ?>
<?php $this->load->view('templates/channels/home_category'); ?>
        </div>
    </div>
</div>

<!-- .content-area -->
    <div class="clearfix"></div>
<?php $this->load->view('templates/channels/footer'); ?>
    
        </div>
    <!-- end .wrapper -->
<script>
jQuery(document).ready(function() {
	ajax_visitor();
});

function ajax_visitor(){
	$.ajax({
		type: 'GET',
		url : "<?=site_url('Ajax_channel/ajax_c_p')?>",
		data : {v:'<?=time()?>'},
		dataType:'json',
		success: function(data){}
	});
}

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