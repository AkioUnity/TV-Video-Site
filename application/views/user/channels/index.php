<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<style>
.table tbody tr td .checkbox label:after {
    left: 3.1px;
}
</style>
<div class="card card-default m-t-20">
    <form method="get" id="search-form" class="form-inline" ></form>
      <div class="card-body">
        <div class="invoice padding-50 sm-padding-10">                
          <div class="table-responsive table-invoice">
              <table class="table m-t-0">
              <thead>
                <tr>
                  <th>Channel Name</th>
                  <th class="text-center">Type</th>
                  <th class="text-center">On</th>
                  <th class="text-center">Shows</th>
                  <th class="text-center">Create Date</th>
                  <th class="text-right" style="width:205px">Artwork</th>
                </tr>
              </thead>
              <tbody id="result-data" ><tr><td colspan="6">Loading..</td></tbody>
            </table>
<ul class="float-right" id="list-paginations"></ul>
            
          </div>
          <div class="p-l-15 p-r-15">
          </div>
          <br />
          <br />
          <p class="small hint-text">
          The amount of shows per channel are unlimited, however at this stage, one TV Channel allocated per account. 
          </p>
          <br>
          <hr>
        </div>
      </div>
    </div>
            <!-- END card -->

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
function set_active(id){
	$.ajax({
		type: "GET",
		url: "<?=$_cancel.'/set_active'?>", /* The country id will be sent to this file */
		data: {id:id},
		dataType:'json',
		success: function(msg){
			location.reload();
		}
	});
} 

</script>
