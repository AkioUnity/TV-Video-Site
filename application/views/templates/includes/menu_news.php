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
    loadWeather(position.coords.latitude+','+position.coords.longitude); //load weather using your lat/lng coordinates
  });
  $('.js-geolocation').show(); 
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
  //loadWeather('Seattle',''); //@params location, woeid
});

function loadWeather(location, woeid) {
  $.simpleWeather({
    location: location,
    woeid: woeid,
    unit: 'c',
    success: function(weather) {
		console.log(weather.city);
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

<?php
//$top_menu = $this->comman_model->get_by('page',array('top_menu'=>1,'parent_id'=>0),array('order'=>'asc'));
$top_menu = $this->comman_model->get_by('news_category',array('parent_id'=>0),array('order'=>'asc'));
?>
<script>
$('#search_handler').on('click', function(){
	console.log('ok');
	$('#header').toggleClass('show-search');
	setTimeout(function(){
		$('#header .search-panel input').eq(0).focus();
	}, 100);
});

$('#header .search-panel a.close-search').on('click', function(){
	$('#header').removeClass('show-search');
});
</script>
<header id="header" class="header-news">
<div class="panel-header">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            
            <div class="header-wrapper">

                <div class="site-branding">
                    <!-- image logo -->
                    <a href="" rel="home" class="custom-logo-link">
                        <img src="<?='assets/uploads/sites/'.$settings['logo']?>" alt="Property TV">
                    </a>
                    <!-- text logo -->
                    <!--
                    <a href="index.html" rel="home" class="logo-text-link">Development Fruit</a>
                    <p class="site-description">The Awesome WordPress Theme</p>
                    -->
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
                                <a class="border-top" href="<?='user/account/logout'?>">Log out</a>
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
                            <a class="visible-lg-*" href="javascript:;"><i class="fa fa-facebook"></i></a>
                            <a class="visible-lg-*" href="javascript:;"><i class="fa fa-twitter"></i></a>
                            <a class="visible-lg-*" href="javascript:;"><i class="fa fa-youtube"></i></a>
                            <a class="visible-lg-*" href="javascript:;"><i class="fa fa-google-plus"></i></a>
                            <a class="hidden-lg" href="javascript:;"><i class="fa fa-ellipsis-h"></i></a>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</div>

<!-- Navigation -->
<!-- Make Module Names -->            
<div class="panel-menu">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <nav class="main-nav">
                <ul>
                    <li class="current-menu-item">
                        <a href="">Home</a>
                    </li>
                    
<?php
if($top_menu){
	foreach($top_menu as $set_menu){
?>   
<li><a href="<?=$set_menu->link?>"><?=$set_menu->name?></a></li>
<?php
	}
}
?>
                </ul>


                <div class="search-panel">
                    <form method="get" action="search" id="advance-search-form">
                        <input type="text" name="q" placeholder="Search..." value="<?=$this->input->get('q')?>">
                        <button type="submit"></button>
                    </form>
                </div>
                
<?php
if(isset($search_show_icon)){
?>
<div class="right-content">
<a href="javascript:;" id="search_handler">
    <img src="assets/frontends/images/search.png" alt="search icon">
</a>
</div>                
<?php
}
?>

                
            </nav>                        </div>
    </div>
</div>
</div>
<!-- /End Navigation -->
</header>
