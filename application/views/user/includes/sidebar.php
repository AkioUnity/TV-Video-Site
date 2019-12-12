<!-- BEGIN SIDEBAR MENU ITEMS-->    
    <nav class="page-sidebar" data-pages="sidebar">
      <!-- BEGIN SIDEBAR MENU HEADER-->
        <div class="sidebar-header">
            <a href="<?=$_user_link.'/account'?>"><img src="<?=site_url('assets/users')?>/assets/img/logo_blue.png" alt="logo" data-src="<?=site_url('assets/users')?>/assets/img/logo_blue.png" data-src-retina="<?=site_url('assets/users')?>/assets/img/logo_blue_2x.png" width="78" height="22"></a>
        </div>
      <!-- END SIDEBAR MENU HEADER-->
      <!-- START SIDEBAR MENU -->
      <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
          
          <li class="m-t-50">
            <a href="<?=$_user_link.'/account'?>">
              <span class="title">Dashboard</span>
            </a>
            <span class="icon-thumbnail"><i data-feather="shield"></i></span>
          </li>
<?php
if($user_details->approved_channel==1){
if($this->data['userPermission']&&(in_array('channel',$this->data['userPermission'])||in_array('create_channel',$this->data['userPermission'])||in_array('delete_channel',$this->data['userPermission']))){
?>          
<li>
<a href="<?=$_user_link.'/channel'?>">
  <span class="title">My Channels</span>
</a>
<span class="icon-thumbnail"><i data-feather="radio"></i></span>
</li>
<?php
}
if($this->data['userPermission']&&(in_array('shows',$this->data['userPermission'])||in_array('create_shows',$this->data['userPermission'])||in_array('delete_shows',$this->data['userPermission']))){
?>          
<li>
<a href="<?=$_user_link.'/category'?>" >
  <span class="title">Categories </span></a>
  <span class="icon-thumbnail"><i class="fa fa-cube"></i></span>
</li>
<li>
<a href="<?=$_user_link.'/shows'?>" >
  <span class="title">My Shows</span></a>
  <span class="icon-thumbnail"><i data-feather="video"></i></span>
</li>
<?php
}
}
?>
<li>
<a href="<?=$_user_link.'/subscribed'?>" >
  <span class="title">Subscribed </span></a>
  <span class="icon-thumbnail"><i class="fa fa-list"></i></span>
</li>


<?php
if($user_details->approved_channel==1){
if($this->data['userPermission']&&(in_array('concierge',$this->data['userPermission'])||in_array('broadcasting',$this->data['userPermission']))){
?>          
<li><hr></li>
<li><a href="javascript:;"><span class="large-text bold">Custom Services</span></a></li>

<?php
}
if($this->data['userPermission']&&(in_array('concierge',$this->data['userPermission']))){
?>          
<li>
<a href="<?=$_user_link.'/concierge'?>" >
<span class="title disable">Concierge</span></a>
<span class="icon-thumbnail disable"><i data-feather="bell"></i></span>
</li>
<?php
}
if($this->data['userPermission']&&(in_array('broadcasting',$this->data['userPermission']))){
?>          
<li>
<a href="<?=$_user_link.'/broadcast'?>" >
<span class="title disable">Broadcasting</span></a>
<span class="icon-thumbnail disable"><i data-feather="zap"></i></span>
</li>
<?php
}
}
?>          

<!--

<li>
<a href="content.php" >
<span class="title disable">Content</span></a>
<span class="icon-thumbnail disable"><i data-feather="video"></i></span>
</li>-->


          
          <!-- <li>
            <a href="properties.php" >
              <span class="title disable">Properties</span></a>
              <span class="icon-thumbnail disable"><i data-feather="home"></i></span>
          </li> -->
        </ul>
        <div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
<div class="pull-bottom p-l-10">
<a href="<?=$_user_link.'/about'?>"><p>About <b>COICIO™</b> + <b>PropertyTV</b></p></a>
</div>
</nav>
<!-- END SIDEBAR -->