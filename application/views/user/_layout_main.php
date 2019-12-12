<?php $this->load->view('templates/includes/header'); ?>  



<?php



if(isset($table)){



?>



<link href="assets/admin_temps/plugins/DataTables/css/data-table.css" rel="stylesheet" />



<script src="assets/admin_temps/plugins/DataTables/js/jquery.dataTables.js"></script>



<script>



$(document).ready(function() {



	$('#data-table').DataTable( {



		"bSort": false,



	} );



});



</script>



<?php



}



?>



<link href="assets/frontends/css/user_dashboard.css" rel="stylesheet" />

<style>



body {

     background: transparent; 

}

.mobile-menu{

	display:none;

	margin-top:0px;

	font-size:20px;

}



@media (max-width: 786px) {

.sidebar {

  background: #FFFFFF;

  padding-top: 0;

  position: absolute;

  top: 0;

  bottom:auto;

  transform: translateZ(0px);

  z-index: 1;

  border:1px solid #D3D3D4;

}

.sidebar {

	width: 100%;

	top: 264px;

	left:0;

	display:none

}



.mobile-menu{

	display:block;

}

}



@media (max-width: 420px) {

	.sidebar {

		top: 335px;

	}

}



@media (max-width: 300px) {

	.sidebar {

		top: 335px;

	}

}





</style>

<body class="home-02">



	<div class="wrapp-content">



		<!-- Header -->



		<header class="wrapp-header">



<?php $this->load->view('templates/includes/menu_news'); ?>  

		</header>







		<!-- Content -->



		<main class="content-row">



			<div class=" padding-top-20 padding-bottom-100 padding-sm-bottom-80">



				<div class="container">



<div class="row profile">

<div class="col-md-12">        

<span class="pull-right mobile-menu"><a href="javascript:;" onClick="show_menu_list();"><i class="fa fa-bars"></i></a></span>

</div>

<div style="clear:both"></div>



<?php $this->load->view('user/includes/left_menu'); ?>



		<div class="col-md-9">



<?php $this->load->view('user/includes/address'); ?>



<?php $this->load->view($subview); ?>



		</div>



	</div>                



					



				</div>



			</div>







	</main>



<?php $this->load->view('templates/includes/footer'); ?>  



		

<script>

function show_menu_list(){

	$('.sidebar').toggle('slow');

}

</script>



	</div>



	<!-- Main script -->

<!--	<script src="assets/frontends/js/main.js"></script>-->



</body>



</html>















