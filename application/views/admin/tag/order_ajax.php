<?php
echo get_ol_category($pages,$_cancel);

function get_ol_category($array,$_cancel, $child = FALSE)
{
	$str = '';
	
	if (count($array)) {
		$str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';
		
		foreach ($array as $item) {
			$str .= '<li id="list_' . $item['id'] .'">';
			$str .= '<div class="" alt="'.$item['id'].'" >'.$item['name'].'&nbsp;&nbsp;&nbsp;&nbsp;<span class="pull-right">
					<div class="btn-group btn-group-xs options">
					  <a class="btn btn-xs btn-primary" href="'.site_url($_cancel.'/edit/'.$item['id']).'"><i class="fa fa-edit"></i></a>
					  <a  class="btn btn-xs btn-danger delete" data-loading-text="'.lang('Loading...').'" href="'.$_cancel.'/delete/'.$item['id'].'"  onclick="return confirm_box();"><i class="fa fa-remove"></i></a>
					</div></span></div>';
			
			// Do we have any children?
			if (isset($item['children']) && count($item['children'])) {
				$str .= get_ol_category($item['children'],$_cancel, TRUE);
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