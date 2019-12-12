<?php
function h_my_ip_address(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
	  $ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}	

function h_get_vimeo_id($url) {
return substr(parse_url($url, PHP_URL_PATH), 1);
}
function h_videoType($url) {
    if (strpos($url, 'youtube') > 0) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } else {
        return 'unknown';
    }
}
function h_youtube_id($url){
	$youtube_id = '';
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
	if(isset($match[1])){
		$youtube_id = $match[1];
	}
	return $youtube_id;
}
function checkPermission($table,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,true);
	if($check){
		return 1;
	}
	else{
		return 0;
	}
}
if ( ! function_exists('h_gDatesByweek')){
	function h_gDatesByweek($sDate,$eDate,$week,$format){
		$arr =array();
		$endDate = strtotime($eDate);
		for($i = strtotime($week, strtotime($sDate)); $i <= $endDate; $i = strtotime('+1 week', $i)){
			$arr[] = date($format, $i);
		}
		return $arr;
	}
}
if ( ! function_exists('h_addDate')){
	function h_addDate($date,$type,$count,$format){
		$string = strtotime($date);
		if($type=='month'){
			$string =strtotime('+'.$count.' month', $string);
		}
		else{
			$string =strtotime('+'.$count.' day', $string);
		}
		$new_date = date($format,$string);
		return $new_date;
	}
};
if ( ! function_exists('h_dateFormat')){
	function h_dateFormat($date,$format){
		$new_date = date($format,strtotime($date));
		return $new_date;
	}
};
function h_orderNumber($table,$orderName,$digit){
	$CI =& get_instance();
	$CI->db->order_by('id','desc'); 
	$CI->db->limit('1'); 
	$order_num_data = $CI->comman_model->get($table,true);
/*	echo '<pre>';
print_r($order_num_data);*/
	if($order_num_data){
		$order_number =	$orderName.str_pad($order_num_data->id+1, $digit, '0', STR_PAD_LEFT);
	}else{
		$order_number = $orderName.str_pad(1, $digit, '0', STR_PAD_LEFT);
	}
	return $order_number;
}
function printR($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
	function getallDate($year){
		$list  = array();
		for($ds=1; $ds<=12; $ds++){
			for($d=1; $d<=31; $d++){
				$time=mktime(12, 0, 0, $ds, $d, $year);          
				if (date('m', $time)==$ds)       
					$list[]=date('Y-m-d', $time);
			}
		}
		return $list;
	}
function getDates($year)
{
    $dates = array();
    for($i = 1; $i <= 366; $i++){
        $month = date('m', mktime(0,0,0,1,$i,$year));
        $wk = date('W', mktime(0,0,0,1,$i,$year));
        $wkDay = date('D', mktime(0,0,0,1,$i,$year));
        $day = date('d', mktime(0,0,0,1,$i,$year));
        $dates[$month][$wk][$day] = $wkDay;
    } 
    return $dates;   
}
function numberFormat($number){
	return number_format((float)$number, 2, '.', '');
}
function sumOfArray(){	
	$sumArray = 0;	
	foreach ($myArray as $k=>$subArray) {
	  foreach ($subArray as $id=>$value) {
		$sumArray = $value+$sumArray;
	  }
	}
	return $sumArray;
}
function show_static_text($lang,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by('static_text',array('id'=>$array),false,true);
	if($check){
		return $check->name;
	}
	else{
		return '';
	}
}
function show_field_value($lang,$array){
	$CI =& get_instance();
	$check = $CI->comman_model->get_lang('field_values',$lang,NULL,$array,'field_value_id',true);
	if($check){
		return $check->title;
	}
	else{
		return '-';
	}
}
function print_lang_value($table,$lang,$array,$field_id,$show){
	$CI =& get_instance();
	$check = $CI->comman_model->get_lang($table,$lang,NULL,$array,$field_id,true);
	if($check){
		return $check->$show;
	}
	else{
		return '-';
	}
}
function print_value($table,$array,$show,$default=false){
	$CI =& get_instance();
	$check = $CI->comman_model->get_by($table,$array,false,true);
	if($check){
		return $check->$show;
	}
	else{
		if($default)
			return $default;
		else
			return '-';
	}
}
function print_count($table,$array){
	$CI =& get_instance();
	if($array)
		$CI->db->where($array);
	$CI->db->from($table);
	return $CI->db->count_all_results();
}
function print_count_query($string){
	$CI =& get_instance();
	$result = $CI->db->query($string);
	return $result->num_rows();
}
