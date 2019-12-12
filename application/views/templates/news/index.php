<?php
$article_author = array();
if ($news_details->author_id != 0) {
    $article_author = $this->comman_model->get_by('authors', array('id' => $news_details->author_id), false, true);
}
$similar_news = array();
if (!empty($news_details->tags)) {
    $newTags = str_replace(',', '|', $news_details->tags);
    $string = 'SELECT * FROM news WHERE section in("Finances","Blazers","Leader","On The Beat","Property News","Featured Video") and CONCAT(",", `tags`, ",") REGEXP ",(' . $newTags . '),"';
    $similar_news = $this->comman_model->get_query($string, false);
}


$string = "select * from banners where template = 'news right' and enabled =1 order by 'order' asc ";
$right_banner = $this->comman_model->get_query($string, false);
$string = "select * from news where id!=" . $this->data['news_details']->id . " and section in ('Blazers','Featured Video') and enabled =1 order by id desc limit 3";
$related_news_right = $this->comman_model->get_query($string, false);

$article_img = '';
if (!empty($news_details->article_image)) {
    $article_img = 'assets/uploads/news/full/' . $news_details->article_image;
} else if (!empty($news_details->image)) {
    $article_img = 'assets/uploads/news/full/' . $news_details->image;
}

$string = "select * from news where section in('Finances','Blazers','Leader','On The Beat','Property News') and id!=" . $news_details->id . " order by id desc";
$all_news_list = $this->comman_model->get_query($string, false);

?>
<?php $this->load->view('templates/includes/header'); ?>
<script src="assets/frontends/js/jquery.validate.js"></script>
<style>
    .swiper-slide img {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }
</style>


<body class="">


<div class="wrapper">

    <header id="header" class="header-news">
        <?php $this->load->view('templates/includes/menu_news'); ?>

        <!-- Ticker -->
        <!-- Take from headlines of most recent articles -->
        <div class="panel-ticker">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="tt-el-ticker">
                            <strong>Latest: </strong>
                            <span class="entry-arrows">
                        <a href="javascript:;" class="ticker-arrow-prev"><img
                                    src="assets/frontends/images/arrow-lr-left.png" alt="arrow"></a>
                        <a href="javascript:;" class="ticker-arrow-next"><img
                                    src="assets/frontends/images/arrow-lr-right.png" alt="arrow"></a>
                    </span>
                            <span class="entry-ticker">
<?php
if ($related_news) {
    foreach ($related_news as $set_news) {
        $html = strip_tags($set_news->name);
        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
        $new_html = word_limiter($html, 13);
        ?>
        <span><?= $new_html ?></span>
        <?php
    }
}
?>                    
                    </span>
                        </div>
                    </div>
                    <div class="col-sm-3 text-right phl0">
                        <div class="tt-el-info text-right">
                            <h4><?= date('d') ?></h4>
                            <p><?= date('F') ?>, <?= date('l') ?></p>
                        </div>
                        <!--<div class="tt-el-info text-right">
                            <h4 class="top-weather">32˚C</h4>
                            <p class="current-location">Current location</p>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /end ticker -->

        <section class="section-content single">

            <div class="container">
                <div class="row">

                    <div class="col-sm-9 with-sidebar">

                        <!-- Page Title -->
                        <!-- Use the Module Name as Data Title & Title -->
                        <h2 class="block-title mv5" data-title="News">News</h2>
                        <!-- /End Page Title -->

                        <article class="blog-item blog-single">

                            <!-- Video or Photo Placeholder -->
                            <!-- Use Video if available, else use Photo -->

                            <?php
                            if (!empty($news_details->v_link)) {
                                ?>
                                <div class="post first text-bigger hover-dark entry-media">
                                    <div class="image video-frame">
                                        <img src="<?= !empty($article_img) ? $article_img : 'assets/uploads/no-image.gif' ?>"
                                             alt="Post image"/>
                                        <a class="video-player video-player-center video-player-large"
                                           href="<?= $news_details->v_link ?>"></a>
                                    </div>
                                </div>
                                <!-- /End Video or Photo Placeholder -->
                                <?php
                            } else if (!empty($news_details->video_file)) {
                                ?>
                                <div class="post first text-bigger hover-dark entry-media">
                                    <div class="image video-frame">
                                        <img src="<?= !empty($article_img) ? $article_img : 'assets/uploads/no-image.gif' ?>"
                                             alt="Post image"/>
                                        <a class="video-player video-player-center video-player-large"
                                           href="assets/uploads/news/<?= $news_details->video_file ?>"></a>
                                    </div>
                                </div>
                                <!-- /End Video or Photo Placeholder -->
                                <?php
                            } elseif (!empty($article_img)) {
                                ?>
                                <div class="post first text-bigger hover-dark entry-media">
                                    <div class="image ">
                                        <img src="<?= $article_img ?>" alt="Post image"/>
                                    </div>
                                </div>
                                <?php

                            }
                            ?>

                            <h2 class="post-title"><?= $news_details->name ?></h2>


                            <div class="row">

                                <div class="col-md-2 entry-details">
                                    <!-- Article Date -->
                                    <!-- Print the Date of Article Published-->
                                    <div class="entry-date"><?= date('d F, Y', $news_details->created) ?></div>
                                    <!-- /End  Article Date -->

                                    <div class="entry-author">
                                        <?php
                                        if ($article_author) {
                                            ?>
                                            <img src="<?= !empty($article_author->image) ? 'assets/uploads/news/thumbnails/' . $article_author->image : 'assets/uploads/profile.jpg' ?>"
                                                 style="border-radius: 50%; width: 100px; height: 100px;">
                                            <?php
                                        }
                                        ?>
                                        <h5 style="margin-top:10px;">
                                            <!-- Author Name -->
                                            <!-- Print the name of the Author -->
                                            <?php
                                            if ($article_author) {
                                                ?>

                                                <a href="<?= base_url('author/v/' . $article_author->id) ?>"><?= $article_author->name ?></a>
                                                <?php
                                            } else {
                                                echo '-';
                                            } ?>

                                            <br>
                                            <!-- /End Author Name -->
                                        </h5>
                                    </div>
                                    <!-- Views Article Views -->
                                    <!-- Print the amount of views per article -->
                                    <div class="entry-views"><?= $news_count ?> views</div>
                                    <!-- /End Article Views -->
                                    <div class="entry-social">
                                        <a class="btn btn-social-icon btn-facebook"
                                           onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo site_url(uri_string()) ?>&amp;t=<?php echo urlencode($news_details->name) ?>', 'facebookShare', 'width=626,height=436'); return false;"><i
                                                    class="fa fa-facebook"></i></a>
                                        <a class="btn btn-social-icon btn-google-plus"
                                           onClick="window.open('https://plus.google.com/share?url=<?php echo site_url(uri_string()) ?>', 'twitterShare', 'width=626,height=436'); return false;"><i
                                                    class="fa fa-google-plus"></i></a>
                                        <a class="btn btn-social-icon btn-twitter"
                                           onClick="window.open('http://twitter.com/share?text=<?php echo urlencode($news_details->name) ?>&amp;url=<?php echo site_url(uri_string()) ?>', 'twitterShare', 'width=626,height=436'); return false;"><i
                                                    class="fa fa-twitter"></i></a>

                                    </div>

                                </div>
                                <!-- end .entry-details -->

                                <!-- Article Content -->
                                <!-- Print all article content -->
                                <div class="col-md-10 entry-content">
                                    <?= $news_details->description ?>

                                    <?php
                                    if (!empty($news_details->code)) {
                                        echo $news_details->code;
                                    }
                                    ?>

                                    <!--<blockquote>
                                                                        <cite>- Hugh Laurie</cite>
                                                                        <p>The concept you have about me won’t change who i am, but it can change my concept about you.</p>
                                                                    </blockquote>-->
                                </div>
                                <!-- end .entry-details -->

                            </div>

                        </article>

                    </div>
                    <!-- /End Article Content -->

                    <div class="col-sm-3 sidebar mt2 ">

                        <div class="widget no-border">
                            <!-- Most Viewed Content -->
                            <!-- Add Content most viewed -->
                            <h5 class="widget-title"><span>Most Popular</span></h5>
                            <ul>

                                <?php
                                if ($related_news_right) {
                                    foreach ($related_news_right as $set_news) {
                                        $html = strip_tags($set_news->description);
                                        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
                                        $new_html = word_limiter($html, 20);
                                        ?>
                                        <li>
                                            <div class="post">
                                                <?php /*?>		<div class="meta">
			<span class="author"><?=$set_news->name?></span>
			<span class="date"> - <?=print_value('authors',array('id'=>$set_news->author_id),'name')?></span>
		</div><?php */
                                                ?>
                                                <h4><a href="news/v/<?= $set_news->id ?>"><?= $set_news->name ?>
                                                        - <?= print_value('authors', array('id' => $set_news->author_id), 'name') ?></a>
                                                </h4>
                                                <p><?= $new_html ?>...</p>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>

                            </ul>
                            <!-- /End Most Viewed Content -->

                        </div>
                        <!-- end .widget -->


                        <div class="widget">
                            <h4>Sponsored Message</h4>
                            <?php
                            if ($right_banner) {
                                foreach ($right_banner as $set_banner) {
                                    ?>
                                    <a href="<?= $set_banner->link ?>">
                                        <img src="<?= 'assets/uploads/banners/' . $set_banner->image ?>" alt="banner">
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="fs-sidebar mt2">
                            <div class="widget">
                                <h5 class="widget-title">Latest</h5>
                                <div class="fs-recent-post">

                                    <?php
                                    if ($all_news_list) {
                                        $i = 0;
                                        foreach ($all_news_list as $set_news) {
                                            $i++;
                                            if ($i == 5) {
                                                break;
                                            }
                                            $article_type = $set_news->section;
                                            $open_link = 'news/v/' . $set_news->id;
                                            if ($set_news->section == 'Leader' || $set_news->section == 'Leader' || $set_news->section == 'Leader' || $set_news->section == 'Leader') {
                                                $open_link = $set_news->link;
                                            }

                                            ?>
                                            <div class="fs-rp-item">
                                                <div class="entry-image">
                                                    <!-- <a href="javascript:;"><img src="assets/frontends/images/blog/fs-thumb.jpg" alt="recent post"></a> -->
                                                    <a href="javascript:;"><img
                                                                src="<?= !empty($set_news->image) ? 'assets/uploads/news/full/' . $set_news->image : 'assets/uploads/no-image.gif' ?>"
                                                                alt="recent post"></a>
                                                </div>
                                                <div class="entry-rp">
                                                    <div class="entry-meta">
<span>
<a href="javascript:;"><?= date('M d, Y') ?></a>
</span>

                                                    </div>
                                                    <h4>
                                                        <a href="javascript:;"><?= $set_news->name ?></a>
                                                    </h4>
                                                    <p class="read-more">
                                                        <a href="<?= $open_link ?>">read the article</a>
                                                    </p>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                    }
                                    ?>
                                    <!--<div class="fs-rp-item no-thumb">
                                    <div class="entry-rp">
                                    <div class="entry-meta">
                                    <span>
                                    <a href="javascript:;">1:16 PM</a>
                                    </span>

                                    </div>
                                    <h4>
                                    <a href="javascript:;">What does Drake’s whiskey say about him?</a>
                                    </h4>
                                    <p class="read-more">
                                    <a href="javascript:;">read the article</a>
                                    </p>
                                    </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .sidebar -->

                </div>
                <!-- end .row -->
            </div>
            <!-- end .container -->
            <?php
            if ($similar_news) {
                ?>
                <div class="section-full pv9 pvb0">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fs-blog-carousel" data-col="4" data-row="1" data-responsive="3,2,1">
                                    <h3 class="fs-title text-center">Similar</h3>
                                    <div class="fs-pager">
            <span>
            <a href="single.html" class="fs-arrow-prev swiper-prev"><img src="assets/frontends/images/arrow-prev.png"
                                                                         alt="preview"></a>
            <i class="fs-current-index">1</i> of <i class="fs-current-total">1</i>
            <a href="single.html" class="fs-arrow-next swiper-next"><img src="assets/frontends/images/arrow-next.png"
                                                                         alt="preview"></a>
            </span>
                                    </div>
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($similar_news as $set_news) {
                                                $open_link = 'news/v/' . $set_news->id;
                                                if ($set_news->section == 'Leader' || $set_news->section == 'Leader' || $set_news->section == 'Leader' || $set_news->section == 'Leader') {
                                                    $open_link = $set_news->link;
                                                }
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="fs-blog-item">
                                                        <a href="<?= $open_link ?>">
                                                            <img src="<?= !empty($set_news->image) ? 'assets/uploads/news/full/' . $set_news->image : 'assets/uploads/no-image.gif' ?>"
                                                                 alt="portfolio image" style="">
                                                        </a>
                                                        <h4><a href="<?= $open_link ?>"><?= $set_news->name ?></a></h4>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="swiper-button-prev swiper-prev">
                                        <i class="fa fa-angle-left"></i> <span>Prev</span>
                                    </div>
                                    <div class="swiper-button-next swiper-next">
                                        <span>Next</span> <i class="fa fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-line mv3"></div>
                <!-- /End Similar Articles-->
                <?php
            }
            ?>
        </section><!-- end .section-content -->
        <div class="clearfix"></div>
        <?php $this->load->view('templates/includes/footer'); ?>
</div><!-- end .wrapper -->
</body>
</html>