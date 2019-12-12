        <nav class="navbar navbar-default bg-master-lighter sm-padding-10 full-width p-t-0 p-b-0" role="navigation">
            <div class="container-fluid full-width">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header text-center">
                <button type="button" class="navbar-toggle collapsed btn btn-link no-padding" data-toggle="collapse" data-target="#sub-nav">
                  <i class="pg pg-more v-align-middle"></i>
                </button>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="sub-nav">
                <div class="row">
                  <div class="col-sm-4">
                  		<h3><?=$name?></h3>
                  </div>
<div class="col-sm-4">
<ul class="navbar-nav d-flex flex-row">
<?php
//if($user_details->parent_id==0){}
if($this->data['userPermission']&&(in_array('channel',$this->data['userPermission'])||in_array('create_channel',$this->data['userPermission']))){
	$checkChannelCount = print_count('channels',array('user_id'=>$this->data['user_details']->id));
	if($checkChannelCount==0){
?>
<li class="nav-item"><a href="<?=$_user_link.'/channel/create_new'?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add New"><i class="fa fa-flash"></i> Wizard</a></li>
<?php
	}
}
$checkTopData = $this->comman_model->get_by('channels',array('user_id'=>$this->data['user_details']->id,'enabled'=>1),false,true);
//echo $this->db->last_query();
if($checkTopData){
?>
<li class="nav-item">
	<a href="<?=site_url().'channel/'.$checkTopData->channel_url?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="My Channel">
	<i class="fa fa-circle-o-notch"></i> My Channel </a>
</li>
<?php
}
?>
</ul>

</div>
                  
                </div>
              </div>
              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
          </nav>