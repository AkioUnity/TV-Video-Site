<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class News extends Frontend_Controller {

	public $_table_name = 'news';

	public $_subView = 'templates/news/';

	public function __construct(){

		parent::__construct();

	}



	

	public function v($id = false){

		if(!$id){

			redirect('front');

		}



		//fetch data

		$this->data['news_details'] = $this->comman_model->get_by($this->_table_name,array('id'=>$id),false,true);



		//if change lang than check lang slug of page

		if(!$this->data['news_details']){

			redirect('front');

		}





		//set title data

		$this->data['title'] = $this->data['news_details']->name." | ".$this->data['settings']['site_name'];

		$this->data['seo_title'] = $this->data['news_details']->name;

/*		$this->data['seo_keywords'] = $this->data['page']->keywords;

		$this->data['seo_description'] = html_entity_decode($this->data['page']->short_description);*/

		$this->_view_count($this->data['news_details']->id);

		$this->data['comments'] = $this->comman_model->get_by('news_comment',array('news_id'=>$this->data['news_details']->id),false);

		$this->data['news_count'] = print_count('news_view',array('news_id'=>$this->data['news_details']->id));



		$string = "select * from news where id!=".$this->data['news_details']->id." and section in ('Blazers','Featured Video') and enabled =1 order by id desc limit 5";

		$this->data['related_news'] = $this->comman_model->get_query($string,false);

		//set load view

		$this->load->view($this->_subView.'index',$this->data);

		

	}

	public function news($id = false,$n_id=false){
		if($n_id){
			redirect('news/v/'.$n_id);
		}
		redirect('front');
	}

	public function _view_count($id=false){

		if($id){

			$ip_address = $this->input->ip_address();

			$check_ip = $this->comman_model->get_by('news_view',array('news_id'=>$id,'ip_address'=>$ip_address),false,false,true);

			if(!$check_ip){

				$this->comman_model->save('news_view',array('news_id'=>$id,'ip_address'=>$ip_address));

			}

		}

		return true;

	}

	

	public function ajax_comment(){

		$arr_response['status'] = 201; /* 200 */	

		$arr_response['message'] = 'Please login first!!';	

		$post_comment = $this->input->get('comment');

		$blog_id = $this->input->get('id');

		if($blog_id){

			if(isset($this->data['user_details'])){

				$arr_response['status'] = 200; /* 200 */	

				$arr_response['message'] = 'Thank you for submit comment';	

				$post_data = array(

									'user_id'	=> $this->data['user_details']->id,

									'username'		=> $this->data['user_details']->username,

									'comment'		=> $post_comment,

									'news_id'		=> $blog_id,

									'created'		=> time(),

									'modified'		=> time(),

									

								);

				$this->comman_model->save('news_comment',$post_data);

			}

		}

		else{

			$arr_response['message'] = 'There is no news!!';	

		}

        echo json_encode($arr_response);

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */