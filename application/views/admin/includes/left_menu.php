<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
	});
});

</script>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            
                <li <?php echo $active=='home'?'class=" active"':'class=""'; ?> >
					<a href="<?=$admin_link?>/dashboard" target="">
					<i class="fa fa-home"></i>
					<span class="title"><?=show_static_text($adminLangSession['lang_id'],80);?></span>
					</a>
				</li>
            
<?php
if($admin_details->role=='super admin'){
?>

<li class="nav-item start <?=$active=='General Settings'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-gears"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],162);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/settings">Main</a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/email"><?=show_static_text($adminLangSession['lang_id'],163);?></a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/account/socialnetwork"><?=show_static_text($adminLangSession['lang_id'],188);?></a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/background">Background Image</a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/fb_app">Facebook App</a></li>
       <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/paypal_setting">Paypal Setting</a></li>
<!-- 
       <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/static_text"><?=show_static_text($adminLangSession['lang_id'],189);?></a></li>
       <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/backup"><?=show_static_text($adminLangSession['lang_id'],1650);?>Backup</a></li>-->
<!--        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/background">Image</a></li>-->

<!--        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/default_image"><?=show_static_text($adminLangSession['lang_id'],16500);?>Default Image</a></li>-->

    </ul>
</li>

<li class="nav-item  <?=$active=='Employee Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>Employee Management</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/admin_user'?>">Employee</a></li>
    </ul>
</li>

<li class="nav-item  <?=$active=='User Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>User Management</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/user'?>">User</a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/channel_request'?>">Channel Request</a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/concierge'?>">Concierge</a></li>
    </ul>
</li>

<li class="nav-item  <?=$active=='News Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>News Management</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/authors'?>">Authors</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/news_leader'?>">News</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/category'?>">Category</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/category_menu'?>">Category Menu</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/package'?>">Package</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/series'?>">Series</a></li>
<!--        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/tag'?>">Tag</a></li>-->
    </ul>
</li>


<li class="nav-item  <?=$active=='Content Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-code-o"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],180);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/banner'?>">Banners</a></li>
<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/page'?>"><?=show_static_text($adminLangSession['lang_id'],182);?></a></li>
<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/slider'?>"><?=show_static_text($adminLangSession['lang_id'],10063);?>Slider</a></li>

    </ul>
</li>


<?php
}
else{
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'general_setting','value'=>1))){
?>

<li class="nav-item start <?=$active=='General Settings'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-gears"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],162);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/settings">Main</a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/email"><?=show_static_text($adminLangSession['lang_id'],163);?></a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/account/socialnetwork"><?=show_static_text($adminLangSession['lang_id'],188);?></a></li>
    </ul>
</li>

<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'news_manage','value'=>1))){
?>

<li class="nav-item  <?=$active=='News Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>News Management</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/authors'?>">Authors</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/news_leader'?>">News</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/category'?>">Category</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/category_menu'?>">Category Menu</a></li>
<!--        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/tag'?>">Tag</a></li>-->
    </ul>
</li>



<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'user_manage','value'=>1))){
?>
<li class="nav-item  <?=$active=='User Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>User Management</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/user'?>">User</a></li>
    </ul>
</li>


<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'content_manage','value'=>1))){
?>
<li class="nav-item  <?=$active=='Content Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-code-o"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],180);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/page'?>"><?=show_static_text($adminLangSession['lang_id'],182);?></a></li>
<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/slider'?>"><?=show_static_text($adminLangSession['lang_id'],10063);?>Slider</a></li>

    </ul>
</li>

<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'news_manage','value'=>1))){}
?>

<?php
}
?>
            
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
                    <!-- END SIDEBAR -->
                </div>
                
