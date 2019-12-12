<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author extends Frontend_Controller {
	public $_table_name = 'authors';
	public $_subView = 'templates/authors/';
	public function __construct(){
		parent::__construct();
	}

	
	public function v($id = false){
		if(!$id){
			redirect('front');
		}

		//fetch data
		$checkNews = $this->data['author_data'] = $this->comman_model->get_by($this->_table_name,array('id'=>$id),false,true);

		//if change lang than check lang slug of page
		if(!$this->data['author_data']){
			redirect('front');
		}

		$this->_view_count($checkNews->id);
		$string = "select * from news where author_id=".$this->data['author_data']->id." and section in ('Blazers','Featured Video','Editorial') and enabled =1 and s_date <= '".date('Y-m-d')."' AND e_date>= '".date('Y-m-d')."' order by id desc limit 15";
		$this->data['related_news'] = $this->comman_model->get_query($string,false);
		$this->data['title'] = $this->data['author_data']->name." | ".$this->data['settings']['site_name'];
		$this->data['seo_title'] = $this->data['author_data']->name;
		$this->load->view($this->_subView.'index',$this->data);
	}
	
	public function _view_count($id=false){
		if($id){
			$ip_address = $this->input->ip_address();
			$check_ip = $this->comman_model->get_by('authors_view',array('author_id'=>$id,'ip_address'=>$ip_address),false,false,true);
			if(!$check_ip){
				$this->comman_model->save('authors_view',array('author_id'=>$id,'ip_address'=>$ip_address));
			}
		}
		return true;
	}	
}

