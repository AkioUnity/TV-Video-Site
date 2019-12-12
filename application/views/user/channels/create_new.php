<script src="assets/plugins/jquery.validate.js"></script>   
<div id="rootwizard" class="m-t-50">
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm" role="tablist" data-init-reponsive-tabs="dropdownfx">
<li class="nav-item">
  <a class="active" data-toggle="tab" href="#tab1" data-target="#tab1" role="tab"><i class="fa fa-wrench tab-icon"></i> <span>Your Channel</span></a>
</li>
<li class="nav-item">
  <a class="" data-toggle="tab" href="#tab2" data-target="#tab2" role="tab"><i class="fa fa-cubes tab-icon"></i> <span>Create Categories</span></a>
</li>
<li class="nav-item">
  <a class="" data-toggle="tab" href="#tab3" data-target="#tab3" role="tab"><i class="fa fa-gears tab-icon"></i> <span>Setup</span></a>
</li>
<li class="nav-item">
  <a class="" data-toggle="tab" href="#tab4" data-target="#tab4" role="tab"><i class="fa fa-check tab-icon"></i> <span>Create Your Shows</span></a>
</li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane padding-20 sm-no-padding active slide-left" id="tab1">
  <div class="row row-same-height">
    <div class="col-md-5 b-r b-dashed b-grey sm-b-b">
      <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
        <i class="fa fa-wrench fa-2x hint-text"></i>
        <h2>Let's Get You Started!</h2>
        <p>Although creating a channel on Property TV is super easy, this Wizard will help you get your first Channel up and running.</p>
        <p class="small hint-text">If you have already completed a step, you can skip to the next.</p>

        <div class="card" >
            <img src="assets/users/images/channel-480.jpg" alt="" class="image-responsive-height">
        </div>
        
      </div>
    </div>
    <div class="col-md-7">
<div class="padding-30 sm-padding-5">
<!-- Show thsi part only if a Channel Exists -->
   <h5>Channel Setup</h5>
<div class="channel-list-wp" style="display:none"   >
   <p>It seems you already have a Channel created</p>
    <table class="table table-condensed">
      <tr>
        <td class="col-lg-8 col-md-6 col-sm-7 ">
          <span class="m-l-10 font-montserrat fs-11 all-caps">Channel Name</span>
        </td>
        <td class=" col-lg-2 col-md-3 col-sm-3 text-right">
          <span>Date Created</span>
        </td>
        <td class=" col-lg-2 col-md-3 col-sm-2 text-right">

        </td>
      </tr>
<tbody id="result-data" ><tr><td colspan="3">Loading..</td></tr></tbody>
      
    </table>
</div>    
<!-- // -->
                          <br />    
        <h5>Create Channel</h5>
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'channel-form'))?>
    <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Channel Name</label>
        <span class="help">e.g. "John Smith Channel"</span>
        <input type="text" name="name" value="testing" id="ep-name" class="form-control" required="">
      </div>
    </div>
    <div class="col-lg-6">  
      <div class="form-group">
        <label>Channel TAGS</label>
        <span class="help">e.g. "Corelogic, Auction, "</span>
        <input class="tagsinput custom-tag-input form-control" name="tags" type="text" value="" style="display: none;">
      </div>
    </div>
    </div>
    <div class="row">
          <div class="col-md-12 form-group">
            <label>Channel URL</label>
            <span class="help">Shortcut to access your Channel directly</span><span class="p-l-15 p-t-5">
                  <a href="javascript:;" onclick="copyToClipboard()">
                  <i class="fa fa-copy"></i> copy url</a>
              </span>
              <div class="input-group transparent">
                <div class="input-group-prepend">
                    <span class="input-group-text transparent" style="border-right: 0px;">www.propertytv.io/channel/</span>
                </div>
                  <input type="text" name="channel_url" value="testing" placeholder="john-smith" class="form-control" id="input-copy" required="">
              </div>
              <label id="input-copy-error" class="error" for="input-copy"></label>
          </div>  
      </div>
    <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving.."><span>Create</span></button> 
    <div class="ajax-error"></div>
<?=form_close()?>
        <br>
      </div>
    </div>
  </div>
</div>
<div class="tab-pane slide-left padding-20 sm-no-padding" id="tab2">
  <div class="row row-same-height">
    <div class="col-md-5 b-r b-dashed b-grey ">
      <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
        <i class="fa fa-cubes fa-2x hint-text"></i>
        <h2>Categories</h2>
        <p>Categories are important as they sort your shows and help make it easy for the viewer to find your shows.</p>
        <p class="small hint-text">Common categories are <b>Testimonials</b>, <b>Buying Tips</b>, <b>Auctioning</b>, <b>For Sale</b>. Keep them short &amp; be creative!  </p>
        
        <div class="card" >
            <img src="assets/users/images/pTV-Reno-show.jpg" alt="" class="image-responsive-height">
        </div>
        
      </div>
    </div>
    <div class="col-md-7">
      <div class="padding-30 sm-padding-5">
        <!-- Only Show If Category Exists -->
                <h5>Category Creation</h5>
<div class="channel-cat-list-wp" style="display:none">
                <p>It seems you already have at least one Category created</p>
                <table class="table table-condensed">
                  <tr>
                    <td class="col-lg-8 col-md-6 col-sm-7 ">
                      <span class="m-l-10 font-montserrat fs-11 all-caps">Category Name</span>
                    </td>
                    <td class=" col-lg-2 col-md-3 col-sm-3 text-right">
                      <span>Date Created</span>
                    </td>
                    <td class=" col-lg-2 col-md-3 col-sm-2 text-right">
                      <span>Order</span>
                    </td>
                  </tr>
<tbody id="channel-list" ><tr><td colspan="3">Loading..</td></tr></tbody>
                  
                </table>
</div>
          <!-- // -->
          <br />
          <div class="card-body">
            <!-- Only Show If Category Is NULL -->
            <h5>Create A Category</h5>
<?php echo validation_errors();?>
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'category-form'))?>
    <div class="row">
<div class="col-lg-12">
            <div class="form-group">
                <label>Category Name</label>
                <span class="help">You will assign Shows to a Category</span>
                <input type="text" name="name" id="input-category_name" value="Selling" class="form-control" required="">
            </div>
            <div class="form-group">
                <label>Category Order</label>
                <span class="help">The order they appear down the page</span>
                <input type="number" name="set_order" value="0" class="form-control" required="">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving.."><span>Create</span></button> 
    <div class="ajax-error"></div>
<?=form_close()?>
          <!--    
          <button type="button" class="btn btn-warning btn-cons btn-animated from-top fa fa-save">
           <span>Save Draft</span>
           </button>-->
            </div>
      </div>
    </div>
  </div>
</div>
<div class="tab-pane slide-left padding-20 sm-no-padding" id="tab3">
  <div class="row row-same-height">
    <div class="col-md-5 b-r b-dashed b-grey ">
      <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
        <i class="fa fa-gears fa-2x hint-text"></i>
        <h2>Make them LIVE</h2>
        <p>Now that you have created your Channel and Categories, let's make them available to the public.</p>
        <p class="small hint-text">Double check that all your items are correct and switch them to <b>ON</b>.</p>
        
      </div>
    </div>
    <div class="col-md-7">
      <div class="padding-30 sm-padding-5">
          <h5>Check Your Work</h5>
          <p>Make sure your Channel &amp; Categories are switched <b>ON</b>. If off, click on the relevant switch below.</p>
          <table class="table table-condensed">
          <tr>
            <td class=" col-md-9">
                <span class="m-l-10"><b>Item</b></span>
            </td>
            <td class=" col-md-3 text-right">
              <b>Active?</b>
            </td>
          </tr>
          <tr>
            <td class=" col-md-9">
              <span class="m-l-10 ">Channel:</span>
              <span class="m-l-10 font-montserrat fs-11 all-caps next-channel-name"></span>
            </td>
            <td class=" col-md-3 text-right">
              <input type="checkbox" data-init-plugin="switchery" class="js-switch js-switch-s-1 " checked="checked"  />
            </td>
          </tr>
          <tr>
            <td class=" col-md-9">
              <span class="m-l-10 ">Category:</span>
              <span class="m-l-10 font-montserrat fs-11 all-caps next-category-name"></span>
              
            </td>
            <td class=" col-md-3 text-right">
              <input type="checkbox" data-init-plugin="switchery" class="js-switch js-switch-s-2" checked="checked" />
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="tab-pane slide-left padding-20 sm-no-padding" id="tab4">
  <h1>You're All Setup.</h1>
  <h2>Now can create your <b>shows</b>!</h2>
  <p>Click on the <b>Create A Show</b> button below to start creating your first show. Remember to assign your show to one of the Categories you created earlier.</p>
  <p class="small hint-text">To place the show in the very top area of your Channel, select the "Hero" switch.</p>
  <button type="button" class="btn btn-primary btn-cons m-t-10" onclick="window.location='<?=$_user_link.'/shows/create_new'?>'">Create A Show</button>      
</div>
<div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
  <ul class="pager wizard no-style">
    <li class="next">
      <button class="btn btn-primary btn-cons btn-animated from-left fa fa-truck pull-right" type="button">
        <span>Next</span>
      </button>
    </li>
    <li class="next finish hidden">
      <button class="btn btn-primary btn-cons btn-animated from-left fa fa-cog pull-right" type="button">
        <span>Finish</span>
      </button>
    </li>
    <li class="previous first hidden">
      <button class="btn btn-default btn-cons btn-animated from-left fa fa-cog pull-right" type="button">
        <span>First</span>
      </button>
    </li>
    <li class="previous">
      <button class="btn btn-default btn-cons pull-right" type="button">
        <span>Previous</span>
      </button>
    </li>
  </ul>
</div>
<div class="wizard-footer padding-20 bg-master-light">
  <p class="small hint-text pull-left no-margin">
    This Wizard is designed to help you create your first Channel. You can manually create your channel by using the left menu and selecting MyChannel, Category &amp; My Shows individually.
  </p>
  <div class="pull-right">
    <img src="assets/users/images/logo.png" alt="logo" data-src="assets/users/images/logo.png" data-src-retina="assets/users/images/logo_2x.png" width="78" height="22">
  </div>
  <div class="clearfix"></div>
</div>
</div>
</div>
<script src="<?=site_url().''?>assets/users/assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function($) {

    'use strict';

    $(document).ready(function() {

        $('#rootwizard').bootstrapWizard({
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show().removeClass('disabled hidden');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }

                var li = navigation.find('li a.active').parent();

                var btnNext = $('#rootwizard').find('.pager .next').find('button');
                var btnPrev = $('#rootwizard').find('.pager .previous').find('button');

                // remove fontAwesome icon classes
                function removeIcons(btn) {
                    btn.removeClass(function(index, css) {
                        return (css.match(/(^|\s)fa-\S+/g) || []).join(' ');
                    });
                }

                if ($current > 1 && $current < $total) {

                    var nextIcon = li.next().find('.fa');
                    var nextIconClass = nextIcon.attr('class').match(/fa-[\w-]*/).join();

                    removeIcons(btnNext);
                    btnNext.addClass(nextIconClass + ' btn-animated from-left fa');

                    var prevIcon = li.prev().find('.fa');
                    var prevIconClass = prevIcon.attr('class').match(/fa-[\w-]*/).join();

                    removeIcons(btnPrev);
                    btnPrev.addClass(prevIconClass + ' btn-animated from-left fa');
                } else if ($current == 1) {
                    // remove classes needed for button animations from previous button
                    btnPrev.removeClass('btn-animated from-left fa');
                    removeIcons(btnPrev);
                } else {
                    // remove classes needed for button animations from next button
                    btnNext.removeClass('btn-animated from-left fa');
                    removeIcons(btnNext);
                }
            },
            onNext: function(tab, navigation, index) {
                console.log("Showing next tab");
				if(index==4){
					window.location = '<?=$_cancel?>';
				}
            },
            onPrevious: function(tab, navigation, index) {
                console.log("Showing previous tab");
            },
            onInit: function() {
                $('#rootwizard ul').removeClass('nav-pills');
            }

        });

        $('.remove-item').click(function() {
            $(this).parents('tr').fadeOut(function() {
                $(this).remove();
            });
        });

    });

})(window.jQuery);
</script>

<script>

function copyToClipboard() {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val('<?=site_url('channel')?>/'+$("#input-copy").val()).select();
	document.execCommand("copy");
	$temp.remove();
}
</script>
<script>
var channel_name = '<?=print_value('channels',array('user_id'=>$user_details->id,'enabled'=>1),'name')?>';
var category_name = '<?=print_value('shows_category',array('user_id'=>$user_details->id),'name')?>';
$('.next-channel-name').html(channel_name);
$('.next-category-name').html(category_name);

$( "#channel-form" ).validate({
	rules: {
		channel_url: {
			required: true,
			remote: {
				url: "<?php echo site_url($_cancel.'/check_channel_url')?>",
				type: "GET",
				data: {
					channel_url: function(){ return $("#input-copy").val(); }
				}
			}				
		},	
	},
	messages: {
		channel_url: {
			remote: 'URL taken, please try another.'
		},
	},	
	submitHandler: function (form) {
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('#channel-form .submitBtn').prop('disabled', true);
		$('#channel-form .submitBtn').html(loadingText);
	    var data = $('#channel-form').serialize();
		$.ajax({
			type:"GET",
			url:"<?=$_cancel.'/ajax_create'?>",
			data:data,
			dataType:'json',
			success: function(response){
				var loadingText = 'Create';
				$('#channel-form .submitBtn').prop('disabled', false);
				$('#channel-form .submitBtn').html(loadingText);
				if(response.status=='ok'){
					get_data();
					//channel_name = $('#ep-name').val();
					//$('.next-channel-name').html(channel_name);
					$('#channel-form .ajax-error').html('<div class="alert alert-block alert-success ">'+response.message+'</div>');
					$("#channel-form .form-control").val('');
				}
				else if(json.status=='error'){
					$('#channel-form .ajax-error').html('<div class="alert alert-block alert-error ">'+response.message+'</div>');
				}
			}
		});
		return false;
	}
});

function copyToClipboard() {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val('<?=site_url('channel')?>/'+$("#input-copy").val()).select();
	document.execCommand("copy");
	$temp.remove();
}
</script>


<script>
$( "#category-form" ).validate({
	submitHandler: function (form) {
		var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Saving..';
		$('#category-form .submitBtn').prop('disabled', true);
		$('#category-form .submitBtn').html(loadingText);
	    var data = $('#category-form').serialize();
		$.ajax({
			type:"GET",
			url:"<?=$_cancel.'/ajax_create_category'?>",
			data:data,
			dataType:'json',
			success: function(response){
				var loadingText = 'Create';
				$('#category-form .submitBtn').prop('disabled', false);
				$('#category-form .submitBtn').html(loadingText);
				if(response.status=='ok'){
					get_channel();
					category_name = $('#input-category_name').val();
					$('.next-category-name').html(category_name);
					$('#category-form .ajax-error').html('<div class="alert alert-block alert-success ">'+response.message+'</div>');
					$("#category-form .form-control").val('');
				}
				else if(json.status=='error'){
					$('#category-form .ajax-error').html('<div class="alert alert-block alert-error ">'+response.message+'</div>');
				}
			}
		});
		return false;
	}
});

function copyToClipboard() {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val('<?=site_url('channel')?>/'+$("#input-copy").val()).select();
	document.execCommand("copy");
	$temp.remove();
}
</script>


<script>
function get_data(){
	$.ajax({
		type: 'GET',
		url : "<?php echo $_cancel.'/ajax_limit_list'?>",
		data:{id:'<?=time()?>'},
		dataType:'json',
		success: function(response){
			if(response.html!=''){
				$('.channel-list-wp').show();
				$('#result-data').html(response.html);
			}
		}
	});
}
get_data();

function set_active(id){
	$.ajax({
		type: "GET",
		url: "<?=$_cancel.'/set_active'?>", /* The country id will be sent to this file */
		data: {id:id},
		dataType:'json',
		success: function(msg){
			location.reload();
		}
	});
} 

function get_channel(){
	$.ajax({
		type: 'GET',
		url : "<?php echo $_user_link.'/category/ajax_wizard_list'?>",
		data:{id:'<?=time()?>'},
		dataType:'json',
		success: function(response){
			if(response.html!=''){
				$('.channel-cat-list-wp').show();
				$('#channel-list').html(response.html);
			}
		}
	});
}
get_channel();
</script>
<script>
var elem_s_1 = document.querySelector('.js-switch-s-1');
var init = new Switchery(elem_s_1, { size: 'small' });
var changeCheckbox = document.querySelector('.js-check-change');

var elem_s_2 = document.querySelector('.js-switch-s-2');
var init_2 = new Switchery(elem_s_2, { size: 'small' });
var changeCheckbox_2 = document.querySelector('.js-check-change');
</script>
