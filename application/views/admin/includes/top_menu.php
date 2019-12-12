<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
		ajax_file();
		ajax_xml();
	});
});

function ajax_file(){
	$.ajax({
		url: "<?='api/read_xml'?>",
		type:'GET',
		success: function(data) {
		}
	});
}
function ajax_xml(){
	$.ajax({
		url: "<?='api/property_xml'?>",
		type:'GET',
		success: function(data) {
		}
	});
}
</script>
<style>
.nav-pills a{
	color:#FFF;
}
</style>
<div class="content" style="padding:0 20px 0">
    <div class="row" >
        <div class="col-md-12">
            <ul class="nav nav-pills" style="margin-bottom:0">
                <li class="<?=$active=='Home'?'active open':''; ?>"><a href="<?=$admin_link.'/account'?>">Dashboard</a></li>
                <li class="<?=$active=='Realtor Management'?'active open':''; ?>"><a href="<?=$admin_link.'/agent'?>">Realtor Management</a></li>
                <li class="<?=$active=='Properties Management'?'active open':''; ?>"><a href="<?=$admin_link.'/properties'?>">Properties Management</a></li>
                <li class="<?=$active==''?'active open':''; ?>"><a href="<?=$admin_link?>/account/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
                
