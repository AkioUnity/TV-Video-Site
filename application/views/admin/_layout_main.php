<?php $this->load->view('admin/includes/header'); ?>

<style>
.form-horizontal .form-actions{
	margin-top:10px;
}
</style>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
<?php $this->load->view('admin/includes/header_menu'); ?>
            
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
<?php $this->load->view('admin/includes/left_menu'); ?>
                
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
<?php $this->load->view('admin/includes/address'); ?>
<?php $this->load->view($subview); ?>
                        
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <a href="javascript:;" class="page-quick-sidebar-toggler">
                    <i class="icon-login"></i>
                </a>
                <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                    <div class="page-quick-sidebar">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
                                    <span class="badge badge-danger">2</span>
                                </a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                                <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                                    <ul class="media-list list-items">
                                        <li class="media">
                                            <!--<div class="media-status">
                                                <span class="badge badge-success">8</span>
                                            </div>-->
                                            <img class="media-object" src="assets/uploads/admin/profile.jpg" alt="...">
                                            <div class="media-body">
                                                <h4 class="media-heading">User</h4>
                                                <!--<div class="media-heading-sub"> Project Manager </div>-->
                                            </div>
                                        </li>
                                        
                                        
                                        
                                    </ul>
                                </div>
                                <div class="page-quick-sidebar-item">
                                    <div class="page-quick-sidebar-chat-user">
                                        <div class="page-quick-sidebar-nav">
                                            <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                                <i class="icon-arrow-left"></i>Back</a>
                                        </div>
                                        <div class="page-quick-sidebar-chat-user-messages">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner"><?=show_static_text($adminLangSession['lang_id'],62);?> Framework version: <?=CI_VERSION;?>
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        <!-- BEGIN QUICK NAV -->
        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/admin_temps/global/plugins/moment.min.js" type="text/javascript"></script>
<!--        <script src="assets/admin_temps/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>-->
        <script src="assets/admin_temps/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<!--        <script src="assets/admin_temps/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="assets/admin_temps/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>-->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/admin_temps/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/admin_temps/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/admin_temps/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/admin_temps/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

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
    </body>

</html>