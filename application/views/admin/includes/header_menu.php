<style>
.page-logo a{
  font-size: 25px;
  color: #FFF;
}

.page-logo img{
	width:162px;
	height:40px;
	
}
</style>
<div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?=base_url()?>" width="100%"><img height="40px" src="<?='assets/uploads/sites/'.$settings['logo']?>" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="assets/uploads/profile.jpg" />
                                    <span class="username username-hide-on-mobile"> Admin </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
<?php
if($admin_details->role=='super admin'){
?>
                    <li><a href="<?=$admin_link.'/settings'?>"><?=show_static_text($adminLangSession['lang_id'],162);?></a></li>
<?php
}
?>
                    <li><a href="<?=$admin_link?>/account/change_password"><?=show_static_text($adminLangSession['lang_id'],50);?></a></li>

                    <li class="divider"></li>

                    <li><a href="<?=$admin_link?>/account/logout"><?=show_static_text($adminLangSession['lang_id'],57);?></a></li>

                                </ul>

                            </li>

                            <!-- END USER LOGIN DROPDOWN -->

                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

<?php
if($admin_details->role=='super admin'){
?>
<!--      <li>				
		<a href="#menu-toggle" id="menu-toggle"><i class="fa fa-comments"></i></a>
	  </li>-->
<?php
}
elseif(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'chat','value'=>1))){}
?>      


                           <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
