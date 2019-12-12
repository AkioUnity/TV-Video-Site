<?php

echo get_product($pages,$_cancel);

function get_product ($array,$_cancel, $child = FALSE)
{
	$str = '';
	 $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('comman_model');	
	if (count($array)) {
		$str .= $child == FALSE ? '<ol class="sortable" style="margin-top:10px">' : '<ol>';
		
		foreach ($array as $item) {
			$str .= '<li id="list_' . $item['id'] .'">';			
			if(!empty($item['image'])){
				$image = base_url('assets/uploads/banners').'/'.$item['image']; 
			}
			else if(!empty($item['image_link'])){
		   		$image = $item['image_link'];
			}
			else{
		   		$image = "assets/uploads/no-image.gif";
			}
			$str .= '<div class="" alt="'.$item['id'].'" ><img src="'.$image.'" class="img-rounded" style="width:30px;height:30px"> '.$item['name'].'&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="label label-sm label-success">'.$item['template'].'</span>
				<span class="pull-right">
					<div class="btn-group btn-group-xs options"><a class="btn btn-xs btn-primary" href="'.site_url($_cancel.'/edit/'.$item['id']).'"><i class="fa fa-edit"></i></a>
					  <a  class="btn btn-xs btn-danger delete"  href="'.$_cancel.'/delete/'.$item['id'].'"  onclick="return confirm_box();"><i class="fa fa-remove"></i></a></div></span></div>';
			
			// Do we have any children?
			if (isset($item['children']) && count($item['children'])) {
				$str .= get_product($item['children'],$_cancel, TRUE);
			}
			
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ol>' . PHP_EOL;
	}
	
	return $str;
}
?>

<script>
$(document).ready(function(){

    $('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        maxLevels: 1
    });

});
</script>