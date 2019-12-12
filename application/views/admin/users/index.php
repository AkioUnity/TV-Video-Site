<?php
$get_q = $this->input->get('q');
$get_s_date= $this->input->get('s_date');
$get_e_date= $this->input->get('e_date');
?>
<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
<div class="row" style="margin-bottom:10px">
    <div class="col-md-12">
<form method="get" id="search-form" class="form-inline" >
<div class="form-group">
	<input type="text" name="q" placeholder="Search" value="<?=$this->input->get('q');?>" class="form-control search-q" >
</div>
<button type="submit" class="btn btn-default">Search</button>
<a href="<?=$_add?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
</form>
    </div>        
</div>

<div class="row" style="margin-bottom:10px;">
	    <div class="col-md-6">
    		<div class="btn-group">
            </div>
	    </div>
    	
	    </div>            
    			<div class="table-responsive">
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
            <tr>
                
                <th><?=show_static_text($adminLangSession['lang_id'],1000);?>S. No.</th>
                <th><?=show_static_text($adminLangSession['lang_id'],242);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],1101);?>Email</th>
                <th><?=show_static_text($adminLangSession['lang_id'],1530);?>Confirm</th>
                <th><?=show_static_text($adminLangSession['lang_id'],158);?></th>
                <th><?=show_static_text($adminLangSession['lang_id'],1242);?>Organization</th>
                <th style="width:160px;"><?=show_static_text($adminLangSession['lang_id'],258);?></th>
            </tr>
            </thead>
<tbody id="result-data"><tr><td colspan="8">Loading..</td></tr></tbody>
        </table>
<div class="pull-left">Total: <span class="search-total">0</span></div>
<ul class="pagination pull-right" id="list-paginations"></ul>
    </div>
    
		    </div>
		</div>
    </div>
</div>



<script>
function confirm_box(){
    var answer = confirm ("Are you sure?");
    if (!answer)
     return false;
}


function get_status(name,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "<?=$_cancel?>/get_status", /* The country id will be sent to this file */
       data: {id:id,status:value,<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
       beforeSend: function () {
	      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 //alert(msg);
		//location.reload();
    	$("#show_class").html(msg);
       }
       });
} 
</script>


<script>
function submit_search(){
	list_per = 20;
    var data = $('#search-form').serialize();
	$.ajax({
		type: 'GET',
		url : "<?php echo $_cancel.'/ajax_get_list'?>",
		data:data,
		dataType:'json',
		success: function(response){
			$('#result-data').html(response.html);
			$('.search-total').html(response.total);
			if(response.total>list_per){
				$('#list-paginations').pagination('destroy');
				$('#list-paginations').pagination({
					total: response.total,
					current: 1,
					length: list_per,
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
submit_search();
function select_data_list(){
	$('#search-form').submit();
}
function export_data(){
    var data = $('#search-form').serialize();
	window.location = '<?=$_cancel.'/export_data?'?>'+data;
}

</script>
