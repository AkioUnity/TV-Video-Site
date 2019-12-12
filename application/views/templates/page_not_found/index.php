<?php $this->load->view('templates/page_not_found/header'); ?>
<body>

    <!-- pTV logo on the top left -->
    <a href="#" class="logo-link" title="back home">

        <img src="assets/frontends/page_not_found/img/ptv-black-512x512transparent.png" class="logo" alt="pTV logo" />

    </a>

    <div class="content">

        <div class="content-box">

            <div class="big-content">

                <!-- Main squares for the content logo in the background -->
                <div class="list-square">
                    <span class="square"></span>
                    <span class="square"></span>
                    <span class="square"></span>
                </div>

                <!-- Main lines for the content logo in the background -->
                <div class="list-line">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>

                <!-- The animated searching tool -->
                <i class="fa fa-search" aria-hidden="true"></i>

                <!-- div clearing the float -->
                <div class="clear"></div>

            </div>

            <!-- Your text -->
            <h1>HMMMM.</h1>

            <p>It seems the page you were looking for isn't here.<br>
                You could try searching again or continue to the home page.</p>

        </div>

    </div>

    <footer class="light">

        <ul>
            <li><a href="">Home</a></li>
<?php
$bottom_menu = $this->comman_model->get_by('page',array('bottom_menu'=>1,'parent_id'=>0),array('order'=>'asc'));
if($bottom_menu){
	foreach($bottom_menu as $set_bottom_menu){
?>
<li><a href="pages/<?=$set_bottom_menu->slug?>"><?=$set_bottom_menu->name;?></a></li>
<?php
	}
}
?>        
<!--
            <li><a href="#">Search</a></li>

            <li><a href="#">Help</a></li>

            <li><a href="#">Trust & Safety</a></li>

            <li><a href="#">Sitemap</a></li>

            <li><a href="#"><i class="fa fa-facebook"></i></a></li>

            <li><a href="#"><i class="fa fa-twitter"></i></a></li>-->

<?php
if(!empty($settings['facebook_url'])){
?>                                
<li><a href="<?=$settings['facebook_url']?>"><i class="fa fa-facebook"></i></a></li>
<?php
}
if(!empty($settings['twitter_url'])){
?>                                
<li><a href="<?=$settings['twitter_url']?>"><i class="fa fa-twitter"></i></a></li>
<?php
}
if(!empty($settings['youtube_url'])){
?>                                
<li><a href="<?=$settings['youtube_url']?>"><i class="fa fa-youtube"></i></a></li>
<?php
}
if(!empty($settings['google_plus'])){
?>                                
<li><a href="<?=$settings['google_plus']?>"><i class="fa fa-google-plus"></i></a></li>
<?php
}
?> 
        </ul>

    </footer>

    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** jQuery Resources ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- Slideshow plugin -->
    <script src="assets/frontends/page_not_found/js/vegas.js?v=<?=time()?>"></script>

</body>

</html>