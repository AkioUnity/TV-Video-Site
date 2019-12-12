<?php $this->load->view('templates/includes/header'); ?>  
<link rel="stylesheet" type="text/css" href="assets/frontends/css/custom.css?v=<?=time()?>">
<style>
@media (min-width: 1200px) {
.content-row .container {
    width: 678px;
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

		<main class="content-row" style="margin-top:30px;margin-bottom:30px;">

			<div class="content-box-01 padding-top-93 padding-bottom-100 padding-sm-bottom-80">

				<div class="container">

<div class="row">

       <div class="col-md-12" >

<?php

if($this->session->flashdata('success')) {

$msg = $this->session->flashdata('success');

?>

<div class="alert alert-success"><?php echo $msg;?></div>

<?php	

}

if($this->session->flashdata('error')) {

$msg = $this->session->flashdata('error');

?>

<div class="alert alert-danger"><?php echo $msg;?></div>

<?php

}   

?>

<div class="">
<h4>SPECIAL ACCESS</h4>
<p>Please enter your unique passphrase to access</p>
<form method="post" action="" id="customer_login" accept-charset="UTF-8">
<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
<input type="hidden" name="operation" value="set"  /> 
  <div class="form-group">
	<input type="text" class="form-control" name="pass" value="" required="" >
	<span style="color:#F00;"><?php echo form_error('pass'); ?></span>
</div>
<button type="submit" class="btn btn-c-red ">Submit</button>
<div style="clear:both"></div>


                  

                  

              </form>

          </div><!--//row//-->    

    </div>

     </div>					

				</div>

			</div>

			

			

		</main>

<?php $this->load->view('templates/includes/footer'); ?>  

		

	</div>



</body>

</html>





