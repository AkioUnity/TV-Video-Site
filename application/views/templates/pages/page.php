<?php $this->load->view('templates/includes/header'); ?>

<body class="">

    
    <div class="wrapper">
        
<?php $this->load->view('templates/includes/menu'); ?>
<!-- Ticker -->

    <section class="section-content single">

        <div class="container">
            <div class="row">
                
                <div class="col-sm-12 with-sidebar">

<!-- Page Title -->
<!-- Use the Module Name as Data Title & Title -->
                    <h2 class="block-title mv5" >
                        <?=$page->name?>
                    </h2>
<!-- /End Page Title -->

                    <article class="blog-item blog-single">
                        
<?php
echo $page->description;
?>
                        
                        
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
<?php $this->load->view('templates/includes/footer'); ?>

</div>
    <!-- end .wrapper -->

    <script type="text/javascript" src="assets/frontends/vendors/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/typed.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/theia-sticky-sidebar.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/circles.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/jquery.parallax.columns.js"></script>
    <script type="text/javascript" src="assets/frontends/vendors/svg-morpheus.js"></script>

    <!-- Swiper -->
    <script type="text/javascript" src="assets/frontends/vendors/swiper/js/swiper.min.js"></script>

    <!-- Magnific-popup -->
    <script type="text/javascript" src="assets/frontends/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    
    <!-- Master Slider -->
    <script src="assets/frontends/vendors/masterslider/jquery.easing.min.js"></script>

    <script src="assets/frontends/vendors/masterslider/masterslider.min.js"></script>
    
        
    <script type="text/javascript" src="assets/frontends/js/scripts.js"></script>

</body>
</html>