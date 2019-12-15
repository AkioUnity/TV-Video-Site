<?php
if ($category_list) {
    foreach ($category_list as $set_data) {
        $where_condition = $where_condition_1;
        $where_condition ['category'] = $set_data->id;
        $this->db->limit(4);
        $this->db->order_by('id', 'desc');
        $this->db->select('id,video_file,video_link,image,name,short_description');
        $product_list = $this->comman_model->get_by('shows', $where_condition, false, false);
        if ($product_list) {
            ?>
            <div class="row">
                <div class="col-md-9">
                    <h3 class="block-title3 mv5 mvt0"
                        data-title="<?= $channel_data->name ?>"><?= $set_data->name ?></h3>
                </div>
                <div class="col-md-3">
                    <a href="<?= site_url($_cancel . '/' . $channel_data->channel_url . '/all?category=' . url_title(strtolower($set_data->name))); ?>"
                       class="category-more text-left">View All <img src="assets/frontends/images/arrow-right-red.png"
                                                                     alt="Arrow"></a>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="category-block articles">
                                    <?php
                                    foreach ($product_list as $set_product) {
                                        $image = 'assets/uploads/no-image.gif';
                                        if (!empty($set_product->image)) {
                                            $image = 'assets/uploads/channels/thumbnails/' . $set_product->image;
                                        }
                                        ?>
                                        <div class="col-xs-6 col-sm-6 col-md-3">
                                            <div class="post hover-light">
                                                <div class="image video-frame" data-src="<?= $image ?>"
                                                     style="background-image: url('<?= $image ?>');">
                                                    <img src="assets/frontends/images/1x1.png" alt="Proportion">
                                                    <a class="video-player video-player-small video-player-inside"
                                                       href="<?php echo $set_product->video_link?>"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mv16"></div>
            <?php
        }
    }
}
?>

<div class="mv16"></div>
<!-- New to pTV carousel -->
<div class="row">
    <div class="col-md-9">
        <h3 class="block-title3 mv5 mvt0" data-title="<?= $channel_data->name ?>">
            Everything
        </h3>
    </div>
    <div class="col-md-3">

    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="category-block articles">

                        <?php
                        if ($new_list) {
                            foreach ($new_list as $set_deta) {
                                $image = 'assets/frontends/channels/images/shows/1.jpg';
                                if (!empty($set_deta->image)) {
                                    $image = 'assets/uploads/channels/thumbnails/' . $set_deta->image;

                                }
                                ?>
                                <div class="col-xs-6 col-sm-6 col-md-3">
                                    <div class="post hover-light">
                                        <div class="image video-frame" data-src="<?= $image ?>"
                                             style="background-image: url(&quot;assets/frontends/images/news/video-small-07.jpg&quot;);">
                                            <img src="assets/frontends/images/1x1.png" alt="Proportion">
                                            <a class="video-player video-player-small video-player-inside"
                                               href="https://www.youtube.com/watch?v=Jyohsf0zPdA"></a>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <a href="<?= site_url($_cancel . '/' . $channel_data->channel_url . '/all'); ?>"
           class="category-more text-left">View All <img src="assets/frontends/images/arrow-right-red.png" alt="Arrow"></a>
    </div>


</div>
<!-- END New to Channel -->
