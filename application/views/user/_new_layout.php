<?php
//$this->session->unset_userdata('popup_wizard');

if(isset($this->data['userPermission'] )){
}
else{
	$this->data['userPermission'] = array();
	if(!empty($user_details->permissions)){
		$this->data['userPermission'] = explode(',',$user_details->permissions);
	}
}
$this->data['menu_uri'] = $this->uri->segment(2);
$this->data['menu_uri_3']= $this->uri->segment(3);
?>
<?php $this->load->view('user/includes/header'); ?>  
<script src="<?=site_url('assets/users')?>/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
<?php /*?><script src="assets/frontends/js/jquery.cookie.js"></script> <?php */?> 
<style>

.recommended img {
    width: 100%;
    object-fit: cover;
}

#list-paginations {
  display: inline-block;
  padding-left: 0;
  margin: 20px 0;
  border-radius: 4px;
}
#list-paginations > li {
  display: inline;
}
#list-paginations > li > a,
#list-paginations > li > span {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.42857143;
  color: #337ab7;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
#list-paginations > li:first-child > a,
#list-paginations > li:first-child > span {
  margin-left: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
#list-paginations > li:last-child > a,
#list-paginations > li:last-child > span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
#list-paginations > li > a:hover,
#list-paginations > li > span:hover,
#list-paginations > li > a:focus,
#list-paginations > li > span:focus {
  z-index: 2;
  color: #23527c;
  background-color: #eee;
  border-color: #ddd;
}
#list-paginations > .active > a,
#list-paginations > .active > span,
#list-paginations > .active > a:hover,
#list-paginations > .active > span:hover,
#list-paginations > .active > a:focus,
#list-paginations > .active > span:focus {
  z-index: 3;
  color: #fff;
  cursor: default;
  background-color: #337ab7;
  border-color: #337ab7;
}
#list-paginations > .disabled > span,
#list-paginations > .disabled > span:hover,
#list-paginations > .disabled > span:focus,
#list-paginations > .disabled > a,
#list-paginations > .disabled > a:hover,
#list-paginations > .disabled > a:focus {
  color: #777;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}

.pace.pace-inactive{
	display:none !importantl
}
</style>
  <body class="fixed-header menu-pin">
<?php $this->load->view('user/includes/sidebar'); ?>  
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
      <!-- START HEADER -->
<?php $this->load->view('user/includes/header_menu'); ?>  
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
          
          <!-- START SHOW NAVIGATION -->  
<?php 
if($this->data['menu_uri']=='channel'){
	$this->load->view('user/channels/tab'); 
}
else if($this->data['menu_uri']=='shows'){
	$this->load->view('user/shows/tab'); 
}
else if($this->data['menu_uri']=='category'){
	$this->load->view('user/shows_category/tab'); 
}
else{
	$this->load->view('user/includes/profile'); 
}
?>  
          <!-- END SHOW NAVIGATION -->  
          
          <!-- START CONTAINER FLUID -->
<div class=" container-fluid   container-fixed-lg">
<?php $this->load->view('user/includes/address'); ?>
<?php $this->load->view($subview); ?>
</div>
          <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
            <!-- START CONTAINER FLUID -->
<?php $this->load->view('user/includes/_copyright'); ?>  
            <!-- END CONTAINER FLUID -->
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    <!-- START OVERLAY -->
<?php //$this->load->view('user/includes/_search-overlay'); ?>  
    <!-- END OVERLAY -->
    
<!-- JS -->    
    <!-- BEGIN VENDOR JS -->
<?php $this->load->view('user/includes/_js-vendors'); ?>  
<?php
if($this->data['menu_uri']=='subscribed'){
?>
<link href="<?=site_url()?>assets/users/assets/plugins/codrops-dialogFx/dialog.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=site_url()?>assets/users/assets/plugins/codrops-dialogFx/dialog-sandra.css" rel="stylesheet" type="text/css" media="screen" />
 <link href="<?=site_url()?>assets/users/assets/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=site_url()?>assets/users/assets/plugins/jquery-nouislider/jquery.nouislider.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?=site_url()?>assets/users/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<script src="<?=site_url()?>assets/users/assets/plugins/jquery-nouislider/jquery.nouislider.min.js" type="text/javascript"></script>
<script src="<?=site_url()?>assets/users/assets/plugins/jquery-nouislider/jquery.liblink.js" type="text/javascript"></script>
<script src="<?=site_url()?>assets/users/assets/plugins/jquery-isotope/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="<?=site_url()?>assets/users/assets/plugins/codrops-dialogFx/dialogFx.js" type="text/javascript"></script>
<script src="<?=site_url()?>assets/users/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
<script src="<?=site_url()?>assets/users/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?=site_url()?>assets/users/assets/js/gallery.js" type="text/javascript"></script>
<?php
}
?>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="<?=site_url('assets/users')?>/pages/js/pages.js?v=<?='1.0'?>"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="<?=site_url('assets/users')?>/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="<?=site_url('assets/users')?>/assets/js/form_elements.js" type="text/javascript"></script>
<script src="<?=site_url('assets/users')?>/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- END JS -->

<?php
$switcherySet =false;
if($this->data['menu_uri']=='users'||$this->data['menu_uri']=='shows'){
	if($this->data['menu_uri_3']=='create'||$this->data['menu_uri_3']=='edit'||$this->data['menu_uri_3']=='create_new'){
		$switcherySet =true;
	}
}
if($switcherySet){
?>
<script>
initSwitcheryPlugin = function(context) {
// Switchery - ios7 switch
$('[data-init-plugin="switchery"]', context).each(function() {
	var el = $(this);
	new Switchery(el.get(0), {
		color: (el.data("color") != null ?  $.Pages.getColor(el.data("color")) : $.Pages.getColor('success')),
		size : (el.data("size") != null ?  el.data("size") : "default")
	});
});
}
initSwitcheryPlugin();
</script>
<?php
}
?>

<?php
//echo 'ok:'.$session_data['popup_wizard'];
if($user_details->parent_id==0){
	if($this->data['userPermission']&&(in_array('channel',$this->data['userPermission']))){
		if(!isset($session_data['popup_wizard'])){
?>
<div class="pgn-wrapper" data-position="top-right" id="popup-wizard">
<div class="pgn push-on-sidebar-open pgn-flip">
<div class="alert alert-info">
<button type="button" class="close" data-dismiss="alert" onClick="set_hide_wizard()">
<span aria-hidden="true">×</span><span class="sr-only">Close</span>
</button>
<span><b>Hey there</b>!<br />
<br>We notice you are new here.
<br>Would you like to use the setup <b>Wizard</b>?<br><br />
<a href="javascript:;" onClick="set_hide_wizard()" class="text-info pull-left small"><b>Don't show anymore</b><i class="fa fa-eye-slash"></i></a>
<a href="<?=$_user_link?>/channel/create_new" class="text-info pull-right small"><b>Launch</b><i class="fa fa-rocket"></i></a>
</span>
</div>
</div>
</div>
<?php
		}
	}
}
?>
<!--<script>
cookie_wizard = $.cookie('cookie_wizard'); 
//$('#cookie-modal').modal();
if(!cookie_wizard){
	$('#popup-wizard').show();
	$.cookie('cookie_wizard', 1, { expires: 1 });
}
</script>-->    
<script>
function set_hide_wizard(){
	$('#popup-wizard').hide();
	$.ajax({
		type: "GET",
		url: "<?=$_user_link.'/account/set_popup_wizard'?>", /* The country id will be sent to this file */
		data: {id:<?=time()?>},
		dataType:'json',
		success: function(msg){
		}
	});
}

function ajax_dashboard_remove_user(){
	$.ajax({
		type: "GET",
		url: "<?=$_user_link.'/ajax_dashboard/ajax_user_remove_list'?>", /* The country id will be sent to this file */
		data: {id:<?=time()?>},
		dataType:'json',
		success: function(response){
			if(response.result=='ok'){
				html = $('#user-remove-script').html();
				html = html.replace(/%%ID%%/g, response.id);
				html = html.replace(/%%USERNAME%%/g, response.username);
				$('#dashboard-user-remove-list').html(html);
			}
		}
	});
}
ajax_dashboard_remove_user();
function set_hide_remove(id){
	$('#remove-user-li-'+id).remove();
	$.ajax({
		type: "GET",
		url: "<?=$_user_link.'/ajax_dashboard/ajax_user_remove'?>", /* The country id will be sent to this file */
		data: {id:id},
		dataType:'json',
		success: function(response){
			ajax_dashboard_remove_user();
		}
	});
}
</script>

<div id="dashboard-user-remove-list"></div>

<script id="user-remove-script" type="text/html">
<div class="pgn-wrapper" data-position="top-right" id="remove-user-li-%%ID%%">
  <div class="pgn push-on-sidebar-open pgn-flip">
      <div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" onClick="set_hide_remove(%%ID%%)">
                <span aria-hidden="true">×</span><span class="sr-only">Close</span>
            </button>
          <div>
                <div class="pgn-message">
                    <div>
                        <p class="bold">User Removed</p>
                        <p>%%USERNAME%% has removed themselves from your account</p>
                    </div>
                </div>
          </div>
      </div>
  </div>
</div>
</script>

</body>
</html>
