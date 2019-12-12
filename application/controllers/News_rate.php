<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_rate extends Frontend_Controller {
	public $_table_name = 'news';
	public $_subView = 'templates/news/';
	public function __construct(){
		parent::__construct();
		if(!isset($this->data['user_details'])){
			$output =array();
			$output['status'] = '201';
			$output['html'] = 'Login first!!';
			echo json_encode($output);die;
		}
	}


	function ajax_modal(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output =array();
		$output['status'] = '201';
		$output['html'] = 'There is no data';

		$id = $this->input->get('id');
		if($id){
			$products = $this->data['products'] = $this->comman_model->get_by('news',array('id'=>$id),false,true);
			if($products){
				//check review already set
				$review_data = $this->comman_model->get_by('news_rate',array('user_id'=>$this->data['user_details']->id,'news_id'=>$id),false,true);			
				if($review_data){
					$output['html'] = 'You already set!!';
				}
				else{
					$output['html'] = $this->load->view($this->_subView.'ajax_rate_form',$this->data,true);
				}
			}
		}

		
		echo json_encode($output);
	}
	
	function ajax_update_review(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output =array();
		$output['status'] = '201';
		$output['message'] = 'There is no data';
		$id = $this->input->get('news_id');
		$rate = $this->input->get('rate');
		if($rate){
			if($id){
				$products = $this->data['products'] = $this->comman_model->get_by('news',array('id'=>$id),false,true);
				if($products){
					//check review already set
					$review_data = $this->comman_model->get_by('news_rate',array('user_id'=>$this->data['user_details']->id,'news_id'=>$id),false,true);			
					if($review_data){
						$output['message'] = 'You already set!!';
					}
					else{
						//save data
						$post_arr = array(
											'news_id'		=> $id,
											'user_id'		=> $this->data['user_details']->id,
											'rate'			=> $rate,
											'on_date'		=> date('Y-m-d'),
											'created'		=> time(),
									);
						$this->comman_model->save('news_rate',$post_arr);									
						$output['status'] = '200';
						$output['message'] = 'Data has successfully submitted!!';
						$stringQuery = "SELECT AVG(rate)AS rate FROM news_rate where news_id  =".$id;
						$rating = $this->comman_model->get_query($stringQuery,true);
						if($rating&&!empty($rating->rate)){			
							$totalRating = round($rating->rate,1);
						}
						else{
							$totalRating = 0;
						}
						$output['rating'] = $totalRating;
						$output['news_id'] = $id;
					}
					
				}
			}
		}
		else{
			$output['message'] = 'Please enter rating!!';
		}
		
		echo json_encode($output);
	}	
}
