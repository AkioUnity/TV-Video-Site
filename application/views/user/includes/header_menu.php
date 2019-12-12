      <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar"></a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
          <div class="brand inline">
            <img src="<?=site_url('assets/users')?>/assets/img/logo.png" alt="logo" data-src="<?=site_url('assets/users')?>/assets/img/logo.png" data-src-retina="<?=site_url('assets/users')?>/assets/img/logo_2x.png" width="78" height="22">
          </div>
<a href="https://www.propertytv.io" class="search-link d-none d-lg-inline-block d-xl-inline-block" >
<i class="pg-arrow_left"></i>Back to <span class="bold">Property TV</span></a>
          
<!--          <a href="<?=$_user_link.'/shows'?>" class="btn btn-link text-primary m-l-20 d-none d-lg-inline-block d-xl-inline-block">+ Upload</a>-->
          <!--<a href="#" class="search-link d-none d-lg-inline-block d-xl-inline-block" data-toggle="search"><i class="pg-search"></i>Type anywhere to <span class="bold">search</span></a>-->
<?php
if($this->data['userPermission']&&in_array('users',$this->data['userPermission'])){
if($user_details->admin_id!=0){}
else{
	if($user_details->parent_id!=0){
		$userN = print_value('users',array('id'=>$user_details->parent_id),'username');
		if(!isset($session_data['remove_top_message'])){
?>
<a href="javascript:;" class="btn btn-link text-primary m-l-20 d-none d-lg-inline-block d-xl-inline-block" >
<div class="alert alert-info" role="alert" id="top-u-message">
  <button class="close" data-dismiss="alert" onclick="remove_top_user_message()"></button>
  <span onclick="window.location='<?=$_user_link.'/account/edit_profile'?>'"><strong>Info: </strong>This account was created by user <span><?=$userN?></span>. Click Unlink in settings to remove.</span>
</div>
</a>
<?php /*?><a href="<?=$_user_link?>" class="btn btn-link text-primary m-l-20 d-none d-lg-inline-block d-xl-inline-block"><p class="small">This account was created by user <span>#username#</span>. Click <button class="btn btn-tag  btn-tag-light m-r-20">Unlink</button> to remove.</p></a>    <?php */?>    
<?php
		}
	}
/*	else{
		$userN = $user_details->username;
	}*/
	}
}
?>
        </div>

        <!-- START TOP SETTINGS DROPDOWN -->
        <div class="d-flex align-items-center">
          <div class="pull-left p-r-10 fs-14 font-heading d-lg-inline-block d-none m-l-20">
            <span class="semi-bold"><?=$user_details->first_name?></span> <span class="text-master"><?=$user_details->last_name?></span>
          </div>
          <div class="dropdown pull-right d-lg-inline-block d-none">
              <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32  inline"><!--circular-->
              <img src="<?=!empty($user_details->image)?'assets/uploads/users/full/'.$user_details->image:'assets/uploads/profile.jpg'?>" alt="" data-src="<?=!empty($user_details->image)?'assets/uploads/users/full/'.$user_details->image:'assets/uploads/profile.jpg'?>" data-src-retina="<?=!empty($user_details->image)?'assets/uploads/users/full/'.$user_details->image:'assets/uploads/profile.jpg'?>" width="32" height="32">
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
              <a href="<?=$_user_link.'/account/edit_profile'?>" class="dropdown-item"><i class="pg-settings_small"></i> Settings</a>
              <a href="<?=$_user_link.'/account/change_password'?>" class="dropdown-item"><i class="pg-outdent"></i> Change Password</a>
<?php
if($user_details->approved_channel==1){
	if($this->data['userPermission']&&in_array('users',$this->data['userPermission'])){
?>
<a href="<?=$_user_link.'/users'?>" class="dropdown-item"><i class="fa fa-users"></i> Users</a>
<?php
	}
}
?>              
<?php
if($user_details->approved_channel==1){
	if($this->data['userPermission']&&(in_array('channel',$this->data['userPermission']))){
?>
<a href="<?=$_user_link.'/channel/create_new'?>" class="dropdown-item"><i class="pg-outdent"></i> Wizard</a>
<?php
	}
}
if($user_details->apply_channel==1&&$user_details->approved_channel==0){
?>
<a href="<?=$_user_link.'/channel_request'?>" class="dropdown-item"><i class="pg-settings_small"></i> Apply for Channel</a>
<?php
}
?>
              <a href="mailto:help@propertytv.io" class="dropdown-item"><i class="pg-signals"></i> Help</a>
              <a href="<?=$_user_link.'/account/logout'?>" class="clearfix bg-master-lighter dropdown-item">
                <span class="pull-left">Logout</span>
                <span class="pull-right"><i class="pg-power"></i></span>
              </a>
            </div>
          </div>
          <!-- END User Info-->
          
        </div>        <!-- END TOP SETTINGS DROPDOWN -->
      </div>
<script>
function remove_top_user_message(){
	$('#top-u-message').remove();
	$.ajax({
		type: "GET",
		url: "<?=$_user_link.'/account/set_remove_message'?>", /* The country id will be sent to this file */
		data: {id:<?=time()?>},
		dataType:'json',
		success: function(msg){
		}
	});
}
</script>      