<script>
function set_logout(){
	$.ajax({
		type: "GET",
		url: "<?=site_url('user/account/ajax_logout')?>",
		data: {id:'<?=time()?>'},
		dataType:'json',
		success: function(response){
			if(response.status='ok'){
				location.reload();
			}
		}
	});
}
</script>
<style>
</style>
<link rel='stylesheet' href="assets/frontends/vendors/weather/weather.css?v=<?=time()?>" type='text/css' media='all' />
<script src="assets/frontends/vendors/weather/jquery.simpleWeather.js"></script>
<script>
/*jQuery(document).ready(function($) {
	$.simpleWeather({
		location: 'indore, India',
		woeid: '',
		unit: 'c',
		success: function(weather) {
		//	html = '<i class="wicon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+' - '+weather.city+', '+weather.country+'';
			html = weather.temp+'˚C';
			$(".top-weather").html(html);
		},
		error: function(error) {
			$(".top-weather").html('<p>'+error+'</p>');
		}
	});
});*/

if ("geolocation" in navigator) {
  navigator.geolocation.getCurrentPosition(function(position) {
	//console.log(position);
    loadWeather(position.coords.latitude+','+position.coords.longitude); //load weather using your lat/lng coordinates
  });
//  $('.js-geolocation').show(); 
} else {
  $('.js-geolocation').hide();
}

/* Where in the world are you? */
$('.js-geolocation').on('click', function() {
  navigator.geolocation.getCurrentPosition(function(position) {
    //loadWeather(position.coords.latitude+','+position.coords.longitude); //load weather using your lat/lng coordinates
  });
});

$(document).ready(function() {
 // loadWeather('Seattle',''); //@params location, woeid
});

function loadWeather(location, woeid) {
  $.simpleWeather({
    location: location,
    woeid: woeid,
    unit: 'c',
    success: function(weather) {
//		console.log(weather.city);
		$('.current-location').html(weather.city);
		html = weather.temp+'˚C';
		$(".top-weather").html(html);
    },
    error: function(error) {
		$(".top-weather").html('<p>'+error+'</p>');
    }
  });
}


</script>    
        <header id="header" class="header-entertainment">
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="header-wrapper">

                            <div class="left-content">
                                <div class="tools">
                                    <a href="javascript:;" id="search_handler">
                                        <img src="assets/frontends/images/search-dark.png" alt="search icon">
                                    </a>
                                    <a href="javascript:;" id="burger_menu" class="burger-menu">
                                        <img src="assets/frontends/images/burger-dark.png" alt="menu icon">
                                    </a>
                                    <div class="search-panel">
                                        <form method="get" action="<?='search'?>">
                                            <img src="assets/frontends/images/search-dark.png" alt="search icon">
                                            <input type="text" name="q" placeholder="Type and press enter to search...">
                                            <button type="submit"></button>
                                        </form>
                                    </div>
                                </div>

                                <div class="site-branding">
                                    <!-- image logo -->
                                    <a href="#" rel="home" class="custom-logo-link">
                                        <img src="<?='assets/uploads/sites/'.$settings['logo']?>" alt="logo image">
                                    </a>
                                </div>
                            </div>

                            <div class="right-content">
                        
                                <div class="user-profile">

                                    <!--<a href="javascript:;" class="entry-notify">
                                        <img src="assets/frontends/images/notify.png" alt="notification image">
                                        <span>9</span>
                                    </a>-->
<?php
if(isset($user_details)){
?>
<div class="entry-name">
    <a href="javascript:;"><?=$user_details->username?></a>
    <div class="entry-dropdown">
        <a href="<?='user/account'?>">Profile</a>
        <a href="<?='user/account/change_password'?>">Change Password</a>
        <a href="<?='user/account/edit_profile'?>">Settings</a>
        <a class="border-top" href="javascript:;" onclick="set_logout()">Log out</a>
    </div>
</div>
<a href="javascript:;" class="user-avatar">
    <img src="<?=!empty($user_details->image)?'assets/uploads/users/thumbnails/'.$user_details->image:'assets/uploads/profile.jpg'?>" alt="user avatar">
</a>
<?php	
}
else{
?>
<div class="entry-name">
<a href="secure/login" class="login-menu">Login</a>
<a href="secure/register" class="login-menu">Register</a>
</div>
<?php
}
?>

                                    <div class="follow-links">
                                        <span class="visible-lg-*">Follow Us:</span>
<?php
if(!empty($settings['facebook_url'])){
?>                                
<a class="visible-lg-*" href="<?=$settings['facebook_url']?>"><i class="fa fa-facebook"></i></a>
<?php
}
if(!empty($settings['twitter_url'])){
?>                                
<a class="visible-lg-*" href="<?=$settings['twitter_url']?>"><i class="fa fa-twitter"></i></a>
<?php
}
if(!empty($settings['youtube_url'])){
?>                                
<a class="visible-lg-*" href="<?=$settings['youtube_url']?>"><i class="fa fa-youtube"></i></a>
<?php
}
if(!empty($settings['google_plus'])){
?>                                
<a class="visible-lg-*" href="<?=$settings['google_plus']?>"><i class="fa fa-google-plus"></i></a>
<?php
}
?>                                
                                        <a class="hidden-lg" href="javascript:;"><i class="fa fa-ellipsis-h"></i></a>
                                        
                                    </div>
                                </div>

                                <!--<div class="tt-el-info inline-style tt-info-weather">
                                    <h4 class="top-weather">22˚C</h4>
                                    <p class="current-location">Current location</p>
                                </div>-->

                                <div class="tt-el-info inline-style tt-info-date">
                                    <h4><?=date('d')?></h4>
                                    <p><?=date('F')?>, <?=date('l')?></p>
                                </div>
                                

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="push-menu pm-entertainment">
                <div class="pm-overlay"></div>
                <div class="pm-container">
                    <div class="pm-viewport">
                        <div class="pm-wrap">
                        
                            <a href="javascript:;" class="close-menu"></a>
                            
                            <form class="search-form" action="<?=site_url('search')?>">
                                <input type="text" name="q" placeholder="Search">
                                <button type="submit"><img src="assets/frontends/images/search-en.png" alt="search icon"></button>
                            </form>
<?php
if(isset($user_details)){
?>
<div class="author-info">
	<img src="<?=!empty($user_details->image)?'assets/uploads/users/thumbnails/'.$user_details->image:'assets/uploads/profile.jpg'?>" alt="search icon">
	<div class="auth-name">
		<h4><a href="<?='user/account'?>"><?=$user_details->username?></a></h4>
		<p><a href="javascript:;" onclick="set_logout()">Sign out</a></p>
	</div>
</div>
<?php	
}
?> 

                            <h4 class="pm-en-title">Menu</h4>

                            <nav class="big-menu">
                                <ul>
<?php
if(isset($user_details)){
?>
<li><a href="<?=site_url('user/account')?>" class="login-menu">Profile</a></li>
<li><a href="<?=site_url('user/account/edit_profile')?>" class="login-menu">Settings</a></li>
<li><a href="<?=site_url('user/subscribed')?>" class="login-menu">My Subscriptions</a></li>
<?php
}
else{
?>
<li><a href="secure/login" class="login-menu">Login</a></li>
<li><a href="secure/register" class="login-menu">Register</a></li>
<?php
}
?>
                                </ul>
                            </nav>


                            

                        </div>
                    </div>
                </div>
            </div>
        </header>
