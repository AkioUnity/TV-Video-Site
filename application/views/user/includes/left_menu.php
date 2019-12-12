<div class="col-md-3 sidebar">
    <div class="profile-sidebar">
            
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            <img src="<?=!empty($user_details->image)?'assets/uploads/users/thumbnails/'.$user_details->image:'assets/uploads/profile.jpg'?>" class="img-responsive" alt="" style="width:128px;height:128px;">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?=$user_details->first_name.' '.$user_details->last_name;?></div>
            <p style="text-align:center;color:#666;margin-bottom:10px;"><?=show_static_text(1,140);?></p>
            <div class="profile-usertitle-job">
            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->

        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
<li class="<?=$active=='Profile'?'active':''?>"><a href="<?=$_user_link.'/account/edit_profile'?>">
<i class="fa fa-edit"></i> <?=show_static_text(1,140);?></a></li>

<li class="<?=$active=='Change Password'?'active':''?>"><a href="<?=$_user_link.'/account/change_password'?>">
<i class="fa fa-edit"></i> <?=show_static_text(1,50);?></a></li>

<li class="<?=$active=='Logout'?'active':''?>"><a href="<?=$_user_link.'/account/logout'?>">
<i class="fa fa-cog"></i> <?=show_static_text(1,57);?></a></li>

            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>
        








		
