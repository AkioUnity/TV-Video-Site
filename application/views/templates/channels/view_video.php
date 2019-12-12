<?php $this->load->view('templates/includes/header'); ?>
<body class="">

    
    <div class="wrapper">
<?php //$this->load->view('templates/includes/menu'); ?>
<?php $this->load->view('templates/channels/menu'); ?>
        
            <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="border-line mvt0"></div>
            </div>
        </div>
        <!-- end .row -->
    </div>
    <!-- end .container -->

    <section class="section-content single">

        <div class="container">
            <div class="row">
                
                <div class="col-md-12">

                    <h2 class="block-title2 mv5" data-title="<?=$channel_data->name?>">
                        <?=$video_data->name?>
                    </h2>

                    <article class="blog-item blog-single">

                        <div class="post first text-bigger hover-dark entry-media">
                            <div class="image video-frame">
                                <img src="<?='assets/uploads/channels/full/'.$video_data->image?>" alt="Post image"/>
                                <a class="video-player video-player-center video-player-large" href="<?=$video_data->video_link?>"></a>
                            </div>
                        </div>

                        <h2 class="post-title">Buy your first home, The Top Ten Do's.</h2>



                        <div class="row">

                            <div class="col-md-2 entry-details">

                                <div class="entry-date"><?=date('F d, Y',$video_data->created)?> </div>
                                <div class="entry-author">
                                        <a href="<?=site_url('channel/'.$channel_data->channel_url)?>">
                                        <img src="assets/frontends/images/pTV.gif" style="border-radius: 50%; width: 100px; height: 100px;"></a>
                                    <h5 style="margin-top:10px;">
                                        <a href="<?=site_url('channel/'.$channel_data->channel_url)?>"><?=$channel_data->username?></a><br>
                                    </h5>
                                    
                                </div>
                                <div class="entry-views">5000 views</div>
                                <div class="entry-social">
        <a class="" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo site_url(uri_string())?>&amp;t=<?php echo urlencode($video_data->name.' - '.$channel_data->name)?>', 'facebookShare', 'width=626,height=436'); return false;"><i class="fa fa-facebook"></i></a>
        <a class="" onClick="window.open('https://plus.google.com/share?url=<?php echo site_url(uri_string())?>', 'twitterShare', 'width=626,height=436'); return false;" ><i class="fa fa-google-plus"></i></a>
        <a class="" onClick="window.open('http://twitter.com/share?text=<?php echo urlencode($video_data->name.' - '.$channel_data->name)?>&amp;url=<?php echo site_url(uri_string())?>', 'twitterShare', 'width=626,height=436'); return false;"><i class="fa fa-twitter"></i></a>
                                
                                </div>

                            </div>
                            <!-- end .entry-details -->

<div class="col-md-10 entry-content">
<?=$video_data->description?>                                
</div>                            

                        </div>
                        
                    </article>


                </div>
                <!-- end .col-md-9 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->


    </section>
    <!-- end .section-content -->


    <div class="clearfix"></div>
<?php $this->load->view('templates/channels/footer'); ?>
<script>
 $('.custom-logo-link').attr("href",'<?=site_url('channel/'.$channel_data->channel_url)?>');
</script>
<?php
/*if(!empty($channel_data->logo)){
?>
<script>
//$('.custom-logo-link img').attr("src",'assets/uploads/channels/full/<?=$channel_data->logo?>');
</script>
<?php	
}*/
?>

        </div>
    
</body>
</html>