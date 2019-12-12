<?php
$string = 'select users_parent_remove.*,users.username,users.email from users_parent_remove 
join users on users_parent_remove.user_id = users.id
where users_parent_remove.parent_id='.$user_details->id;
$checkRemoveList = $this->comman_model->get_query($string,false);
?>
<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<div class="row">
  <div class="col-md-12">
    <!-- START card -->
    <div class="card card-transparent">
      <div class="card-header ">
        <div class="card-title">Your Coicio Account</div>
      </div>
      <div class="card-body">
        
        <div class="row m-b-10">
		<form method="get" id="search-form" class="form-inline" ></form>        
            <div>
                <h3>Additional Users</h3>
                <span class="small">These are users that have access to your account.</span>
                <p class="small"><a href="<?=$_cancel.'/create'?>">Add new user?</a></p>
            </div>
        </div>
        <div class="row" id="result-data">Loading..</div>

<div class="row m-b-10">
    <div>
        <h3>Removed</h3>
        <span class="small">These are users had prior access to your account and have left.</span>
    </div>
</div>        
<div class="row">
<?php
if($checkRemoveList){
	foreach($checkRemoveList as $set_data){
		$image = 'assets/uploads/profile.jpg';
		if(!empty($set_data->image)){
			$image = 'assets/uploads/users/thambails/'.$set_data->image;
		}
?>
<div class="col-md-5">
    <div class="profile-img-wrapper m-t-5 inline">
      <img width="35" height="35" src="<?=$image?>" alt="" data-src="<?=$image?>" data-src-retina="<?=$image?>">
      <div class="chat-status available">
      </div>
    </div>
    <div class="inline m-l-10">
       <p class="small hint-text">
           <strong><?=$set_data->username?></strong>
           <br><?=$set_data->email?>
       </p>
    </div>
    <p class="small"><a href="<?=$_cancel.'/add_back/'.$set_data->id?>" onclick="return confirm_box();">Add back?</a></p>
</div>
<?php
	}
}
?>
</div>

                              </div>
    </div>
    <!-- END card -->
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

