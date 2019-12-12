<style>
.table tbody tr td .checkbox label:after {
    left: 3.1px;
}
</style>

<div class="row">
<?php
if($this->data['userPermission']&&in_array('shows',$this->data['userPermission'])){
?>          
<div class="col-lg-6 m-b-10 d-flex">
<!-- START WIDGET widget_pendingComments.tpl-->
<div class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle align-self-stretch d-flex flex-column">
  <div class="card-header top-right">
    <div class="card-controls">
      <ul>
        <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i
                        class="portlet-icon portlet-icon-refresh"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="padding-25">
    <div class="pull-left">
      <h2 class="text-success no-margin">My Shows</h2>
      <p class="no-margin">Most Recent First</p>
    </div>
    <!--<div class="pull-right">
      <p class="no-margin">Total Views</p>
      <h3 class="semi-bold no-margin">102,967</h3>
    </div>-->
    <div class="clearfix"></div>
  </div>
  <div class="auto-overflow widget-11-2-table">
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
          <th class="">Episode/Show Title</th>
          
          <th class="text-right">Series</th>
          <th class="text-right">Hero?</th>
<!--          <th class="text-left">Views</th>-->
        </tr>
      </thead>
      <tbody id="show-data"></tbody>
    </table>
  </div>
  <div class="padding-25 mt-auto">
    <p class="small no-margin">
      <a href="<?=$_user_link.'/shows'?>"><i class="fa fs-16 fa-arrow-circle-o-down text-success m-r-10"></i>
      <span class="hint-text ">Show more</span></a>
    </p>
  </div>
</div>
<!-- END WIDGET -->
</div>
<script>
function get_data(){
	$('#show-data').html('<tr><td colspan="6">Loading..</td></tr>');
	$.ajax({
		type: 'GET',
		url : "<?php echo $_user_link.'/ajax_dashboard/ajax_show'?>",
		dataType:'json',
		success: function(response){
			$('#show-data').html(response.html);
		}
	});
}
get_data();
function set_slider(id){
	$.ajax({
		type: "GET",
		url: "<?=$_user_link.'/shows/set_hero'?>", /* The country id will be sent to this file */
		data: {id:id},
		dataType:'json',
		success: function(msg){
			get_data();
		}
	});
} 
</script>
<?php
}
?>         
<?php
if($this->data['userPermission']&&in_array('channel',$this->data['userPermission'])){
?>          
 
<div class="col-lg-6 m-b-10 d-flex">
<!-- START WIDGET widget_pendingComments.tpl-->

<div class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle align-self-stretch d-flex flex-column">
  <div class="card-header top-right">
    <div class="card-controls">
      <ul>
        <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="padding-25">
    <div class="pull-left">
      <h2 class="text-success no-margin">My Channels</h2>
      <p class="no-margin">Channels Created</p>
    </div>
    <div class="pull-right">
      <p class="no-margin">Total Channels</p>
      <h3 class="semi-bold no-margin"><?=print_count('channels',array('user_id'=>$user_details->id))?> / 1 active</h3>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="auto-overflow widget-11-2-table">
    <table class="table table-condensed table-hover">
        <thead>
        <tr>
          <th class="">Chanel Name</th>
          <th class=""></th>
          <th class="text-right">Last Video</th>
          <th class="text-left">Active?</th>
        </tr>
      </thead>
      <tbody id="channel-data">
        <tr><td colspan="6">Loading..</td></tr>
      </tbody>

    </table>
  </div>
  <div class="padding-25 mt-auto">
    <p class="small no-margin">
      <a href="<?=$_user_link.'/channel'?>"><i class="fa fs-16 fa-arrow-circle-o-down text-success m-r-10"></i>
      <span class="hint-text ">Show more</span></a>
    </p>
  </div>
</div>
<!-- END WIDGET -->
</div>
<script>
function get_channel(){
	$.ajax({
		type: 'GET',
		url : "<?php echo $_user_link.'/ajax_dashboard/ajax_channel'?>",
		dataType:'json',
		success: function(response){
			$('#channel-data').html(response.html);
		}
	});
}
get_channel();
</script>
<?php
}

?>          


</div>

