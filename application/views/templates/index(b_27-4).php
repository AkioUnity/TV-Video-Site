<?php $this->load->view('templates/includes/header'); ?>



<body class="entertainment-content">



    <!--<div class="tana-loader">

        <div class="loader-content">

            <div class="loader-circle"></div>

            <div class="loader-line-mask">

                <div class="loader-line"></div>

            </div>

        </div>

    </div>-->

    <div class="wrapper">

<?php $this->load->view('templates/includes/home_menu'); ?>

        



<!-- Section 1 # Slideshow -->

<?php $this->load->view('templates/includes/slider'); ?>



<!-- end of entertainment-slider -->



<div class="content-area pvt0 entertainment-layout">

	<div class="container">

		

		<!-- Section 2 # News -->

		<div class="row">

	

	<div class="col-md-12">

		

<?php $this->load->view('templates/includes/home_leader'); ?>

		<!-- /.testimonial-slider -->



<?php $this->load->view('templates/includes/home_masonry'); ?>



		

		<!-- /.section-carousel -->









	</div>

	<!-- end .col-md-12 -->



</div>

<!-- end .row -->

		<!-- Section 3 -->

		<div class="row">

	

	<div class="col-md-12">

<?php $this->load->view('templates/includes/home_featured'); ?>

		

		<!-- /.simple-tab-space -->



	</div>

	<!-- end .col-md-12 -->



</div>

<!-- end .row -->

		<!-- Section 4 # Celebrities -->

<?php $this->load->view('templates/includes/home_blazers'); ?>
<?php $this->load->view('templates/includes/home_properties'); ?>

		

<!-- end .row -->		

		<div class="mv6"></div>



	</div>

	<!-- end .container -->



		<!-- Section 5 Slider -->

<?php $this->load->view('templates/includes/home_property'); ?>



<div class="container">

		<!-- Section 5 -->

		<div class="row">

	

	<div class="col-md-12">

		

<?php $this->load->view('templates/includes/home_beat'); ?>



<?php $this->load->view('templates/includes/home_finance'); ?>

		<!-- /.boxed -->

<?php $this->load->view('templates/includes/home_editorial'); ?>



		<!-- /.section-carousel -->





	</div>

	<!-- end .col-md-12 -->



</div>

<!-- end .row -->

	</div>		

<!-- /.container-fluid -->

	<!-- end .container -->

</div>

<!-- .content-area -->





    <div class="clearfix"></div>



<?php $this->load->view('templates/includes/footer'); ?>

    

       </div>

    <!-- end .wrapper -->





</body>

</html>