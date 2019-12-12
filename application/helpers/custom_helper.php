<?php
function get_month_news(){
	$monthData =array(
						'January'		=> 0,
						'Febrary'		=> 0,
						'March'		=> 0,
						'April'		=> 0,
						'May'		=> 0,
						'June'		=> 0,
						'July'		=> 0,
						'August'		=> 0,
						'September'		=> 0,
						'October'		=> 0,
						'November'		=> 0,
						'December'		=> 0,
		);
	$CI =& get_instance();
	$string ="SELECT MONTH(on_date) AS month,
	YEAR(on_date) AS YEAR,
	COUNT(id) as total
	FROM news
	WHERE section IN('Finances','Blazers','Leader','On The Beat','Property News')
	GROUP BY MONTH(on_date)";
	$get_month_news_count = $CI->comman_model->get_query($string,false);
	if($get_month_news_count){
		foreach($get_month_news_count as $set_month){
			if($set_month->month==1){
				$monthData['January'] = $set_month->total;
			}
			else if($set_month->month==2){
				$monthData['February'] = $set_month->total;
			}
			else if($set_month->month==3){
				$monthData['March'] = $set_month->total;
			}
			else if($set_month->month==4){
				$monthData['April'] = $set_month->total;
			}
			else if($set_month->month==5){
				$monthData['May'] = $set_month->total;
			}
			else if($set_month->month==6){
				$monthData['June'] = $set_month->total;
			}
			else if($set_month->month==7){
				$monthData['July'] = $set_month->total;
			}
			else if($set_month->month==8){
				$monthData['August'] = $set_month->total;
			}
			else if($set_month->month==9){
				$monthData['September'] = $set_month->total;
			}
			else if($set_month->month==10){
				$monthData['October'] = $set_month->total;
			}
			else if($set_month->month==11){
				$monthData['December'] = $set_month->total;
			}
			else if($set_month->month==12){
				$monthData['December'] = $set_month->total;
			}
			
		}
	}
	return $monthData;
}

