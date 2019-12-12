<?php $this->load->view('templates/includes/header'); ?>
<style>
.fs-entry-image img{
	width: 100%;
	height:210px;
}

</style>

<body class="">

    
    <div class="wrapper">
        
        <header id="header" class="header-news">
<?php $this->load->view('templates/includes/menu_news'); ?>
            


    <section class="section-content single">

        <div class="container">
            <div class="row">
            
                
<div class="col-sm-12">
<div class="theiaStickySidebar">
        <div class=" row" style="margin-top:20px;">
        <div class="fs-grid-posts">
            
            <div class="fs-grid-viewport" style="position:relative;" id="result-data"></div>
<div class="" style="text-align: center;display:none" id="more-btn-cont">
<button class="btn sys-btn" id="ajax-more" onClick="ajax_more()" value="loadmore">
Load more..<img style="display: none" id="loader2" src="assets/uploads/loading.gif"> 
</button>
<input type="hidden" name="limit" id="limit" value="12"/>
<input type="hidden" name="offset" id="offset" value="12"/>
    </div>            
            <!-- /.fs-grid-viewport -->
        </div>
        </div>
        <!-- /.masonry-layout -->

    </div>


</div>

            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->

<div style="clear:both"></div>
    </section>
    <!-- end .section-content -->
    


    <div class="clearfix"></div>

<?php $this->load->view('templates/includes/footer'); ?>
</div>
    <!-- end .wrapper -->

</body>
<script type="text/javascript">
$(document).ready(function(){
  $('#advance-search-form').submit(function(e){
    e.preventDefault();
    var data = jQuery('#advance-search-form').serialize();
    $('.recent-loading').show(); 
    $.get(
        'search/ajax',
        data,
        function(result){          
           jQuery('#more-btn-cont').show();
           if(result.url!=window.location){
             window.history.pushState({path:result.url},'',result.url);
           }
           
            jQuery('#offset').val(result.offset);
            jQuery('#limit').val(result.limit);
		    jQuery('.recent-loading').hide(); 
           jQuery('#result-data').html(result.content);          
			if(result.more_d){
				jQuery('#ajax-more').show();
			}
			else{
				jQuery('#ajax-more').hide();
			}
        },
        'json'
    );
  });
  var initialURL = location.href;
});
</script>
<script>
function ajax_more(){
    var data = jQuery('#advance-search-form').serialize();
	$("#loader2").show();
    $('.recent-loading').show(); 
    $.ajax({
        url:'search/ajax',
		data:data+'&offset='+$('#offset').val()+'&limit='+$('#limit').val(),
        type:'get', 
		dataType: 'json',
        success:function(data){
	        $("#loader2").hide();
		    $('.recent-loading').hide(); 
	         $('#result-data').append(data.content);          
/*			if(data.more_data==0){
				$('#ajax-more').hide();
			}*/
			if(data.more_d){
			}
			else{
				$('#ajax-more').hide();
			}
			
            $('#offset').val(data.offset);
            $('#limit').val(data.limit);
        }
    })
}
</script>

<?php
if($_GET){
?>
<script>
$(document).ready(function(){
	$('#advance-search-form').submit();  
});
</script>
<?php
}
?>

</html>