			<!--<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li class="active">Dashboard</li>
			</ol>-->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
<!--			<h1 class="page-header"><?=$name;?>  </h1>-->


<?php
if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
?>
<div class="alert alert-block alert-success fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
	<?php echo $msg;?>
</div>

<?php    
}
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
<div class="alert alert-block alert-danger fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
	<?php echo $msg;?>
</div>
<?php    
}
?>            

