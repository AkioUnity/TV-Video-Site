<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
	            <form class="form-horizontal edit-form"  method="post" enctype="multipart/form-data" data-parsley-validate="true">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                	<input type="hidden" name="operation" value="set" />
                    <div class="form-body">
                        <div class="form-group" >
                            <label class="col-lg-2 control-label" style="padding-top:0px">Username</label>
                            <div class="col-lg-10"><?=$employee->username?></div>
                        </div>                        
                        <div class="form-group" style="padding-top:0px" >
                            <label class="col-lg-2 control-label">Email-ID</label>
                            <div class="col-lg-10"><?=$employee->email?></div>
                        </div>                                                                        

                        <div class="form-group" >
                            <label class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-6">
                                <?=form_input('name', set_value('name', $employee->{'name'}), 'class="form-control " id="" placeholder="" required')?>
                            </div>
                        </div>                        


<div class="form-group" >
			<label class="col-lg-2 col-md-2 control-label">Permissions</label>
        <div class="col-lg-10">
<ul class="main_checkbox">
<?php
echo get_ol1($permissions,$employee->id);

function get_ol1 ($array,$user_id, $child = FALSE){
	$CI =& get_instance();
	$str = '';
	if (count($array)) {
//		$str .= $child == FALSE ? '<ol class="sortable" style="margin-top:10px">' : '<ol>';
		foreach ($array as $item) {
//			echo $key.' : '.$item;
			$str .='<li>';
			$pos = checkPermission('admin_permission',array('user_id'=>$user_id,'type'=>$item['id'],'value'=>1));
			$str .=form_checkbox('permission['.$item['id'].']', '1',set_value('permission['.$item['id'].']',$pos), 'id="tall" class=""').' <label for="Review"> '.$item['value'].'</label>';
			if (isset($item['children']) && count($item['children'])) {
				$str .= '<ul class="checkbox2">'.get_ol1($item['children'],$user_id, TRUE).'</ul>';
			}
			$str .='</li>';
		}
	//	$str .= '</ol>' . PHP_EOL;

	}
	return $str;
}
?>
  

</ul>

        </div>
    </div>
	                </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
                                    <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=lang('Cancel')?></a>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                </div>
                            </div>
                        </div>
               </form>
            </div>
        </div>
    </div>
</div>





<script>
$('input[type="checkbox"]').change(function(e) {

  var checked = $(this).prop("checked"),
      container = $(this).parent(),
      siblings = container.siblings();

  container.find('input[type="checkbox"]').prop({
    indeterminate: false,
    checked: checked
  });

  function checkSiblings(el) {

    var parent = el.parent().parent(),
        all = true;

    el.siblings().each(function() {
      return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
    });

    if (all && checked) {

      parent.children('input[type="checkbox"]').prop({
        indeterminate: false,
        checked: checked
      });

      checkSiblings(parent);

    } else if (all && !checked) {

      parent.children('input[type="checkbox"]').prop("checked", checked);
      parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
      checkSiblings(parent);

    } else {

      el.parents("li").children('input[type="checkbox"]').prop({
        indeterminate: true,
        checked: false
      });

    }

  }

  checkSiblings(container);
});
</script>

<style>
ul.main_checkbox{
	padding-left:0px;
	list-style: none;
}
ul.checkbox2 { 
	padding-left:20px;
	list-style: none;
	margin: 0px 0px;
}
.checkbox input[type="checkbox"]{
}
</style>

<link href="assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript" language="javascript"></script> 
<script>
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
$(document).ready(function () {
    $(".edit-form").submit(function () {
//        $(".submitBtn").attr("disabled", true);
		$(".submitBtn").button('loading');
        return true;
    });
});
</script>

