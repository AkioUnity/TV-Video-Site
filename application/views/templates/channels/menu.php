<link rel='stylesheet' href="<?='assets/frontends/vendors/weather/weather.css?v='.time()?>" type='text/css' media='all' />
<script src="<?='assets/frontends/vendors/weather/jquery.simpleWeather.js'?>"></script>
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
$top_menu = $this->comman_model->get_by('page',array('top_menu'=>1,'parent_id'=>0),array('order'=>'asc'));
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
                </div>

                <div class="right-content">
                    <div class="user-profile">
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
                    <li class="">
                        <a href="<?=site_url('channel/'.$channel_data->channel_url)?>">Home</a>
                    </li>
                    
<?php
if($category_list){
	foreach($category_list as $set_menu){
?>   
<li><a href="<?=site_url('channel/'.$channel_data->channel_url.'/all')?>"><?=$set_menu->name?></a></li>
<?php
	}
}
?>
                </ul>


                <div class="search-panel">
                    <form method="get" action="<?='search'?>">
                        <input type="text" name="q" placeholder="Search...">
                        <button type="submit"></button>
                    </form>
                </div>

                
                <div class="right-content news-search-menu">
                   <a href="javascript:;" class="search-handler" id="search_handler">
                                        <svg class="icon-search" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 14 14" xml:space="preserve">
                                            <path d="M5.4,0C2.4,0,0,2.4,0,5.4s2.4,5.4,5.4,5.4c1.2,0,2.2-0.4,3.1-1l0,0l4,4c0.1,0.1,0.2,0.1,0.3,0l1.1-1.1c0.1-0.1,0.1-0.2,0-0.3l-4-4c0.6-0.9,1-2,1-3.1C10.9,2.4,8.4,0,5.4,0z M5.4,9.6c-2.3,0-4.2-1.9-4.2-4.2s1.9-4.2,4.2-4.2s4.2,1.9,4.2,4.2S7.7,9.6,5.4,9.6z"></path>
                                        </svg>
                                        <svg class="icon-close" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
                                            <polygon points="16,1.6 14.4,0 8,6.4 1.6,0 0,1.6 6.4,8 0,14.4 1.6,16 8,9.6 14.4,16 16,14.4 9.6,8"/>
                                        </svg>
                                    </a>
                    <!--<a href="javascript:;" class="burger-menu pm-right">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 14 12" xml:space="preserve">
                            <g>
                                <path d="M1.1,0.1h11.7c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1H1.1C0.5,2.3,0,1.8,0,1.2S0.5,0.1,1.1,0.1z"></path>
                                <path d="M1.1,4.9h11.7C13.5,4.9,14,5.4,14,6s-0.5,1.1-1.1,1.1H1.1C0.5,7.1,0,6.6,0,6S0.5,4.9,1.1,4.9z"></path>
                                <path d="M1.1,9.7h11.7c0.6,0,1.1,0.5,1.1,1.1c0,0.6-0.5,1.1-1.1,1.1H1.1c-0.6,0-1.1-0.5-1.1-1.1C0,10.2,0.5,9.7,1.1,9.7z"></path>
                            </g>
                        </svg>
                    </a>-->
                </div>
            </nav>                        </div>
    </div>
</div>
</div>
<!-- /End Navigation -->
</header>
