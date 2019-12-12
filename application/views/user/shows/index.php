<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<style>
.table tbody tr td .checkbox label:after {
    left: 3.1px;
}
</style>
<div class="card card-default m-t-20">
  <div class="card-body">
    <div class="invoice sm-padding-10">
        <!-- Quick Search -->
<form method="get" id="search-form" class="form-inline" >
<input type="hidden" name="show_type" value="<?=isset($tabName)?$tabName:''?>" >
<input type="hidden" name="channel_id" value="<?=isset($channels)?$channels->id:''?>" />
</form>     
     
<div class="table-responsive table-invoice">
<table class="table m-t-0">
<thead>
<tr>
  <th>&nbsp;</th>
  <th>Show</th>
  <th>Channel</th>
  <th class="text-center">Hero?</th>
  <th class="text-center">Series</th>
  <th class="text-center">Episode</th>
  <th class="text-center">Date</th>
  <th class="text-right" style="width:130px">Artwork</th>
</tr>
</thead>
  <tbody id="result-data" ><tr><td colspan="6">Loading..</td></tbody>
</table>
<ul class=" float-right" id="list-paginations"></ul>
      </div>
      
    </div>
  </div>
</div>
<script>
function get_data(){
    var data = $('#search-form').serialize();
	$.ajax({
		type: 'GET',
		url : "<?php echo $_cancel.'/ajax_list'?>",
		data:data,
		dataType:'json',
		success: function(response){
			$('#result-data').html(response.html);
			$('.search-total').html(response.total);
			if(response.total>20){
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
get_data();

function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}

function set_slider(id){
	$.ajax({
		type: "GET",
		url: "<?=$_cancel.'/set_hero'?>", /* The country id will be sent to this file */
		data: {id:id},
		dataType:'json',
		success: function(msg){
			location.reload();
		}
	});
} 
</script>
