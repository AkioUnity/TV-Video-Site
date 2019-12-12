<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Presenters extends Frontend_Controller {
	public $_table_name = 'news';
	public $_subView = 'templates/presenters/';
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$page =$this->comman_model->get_by('page',array('template'=>'presenters'),false,true); 
		if($page){
			redirect('pages/'.$page->slug);
		}
		redirect('front');
		
		die;
		//fetch data
//		$this->data['news_details'] = $this->comman_model->get_by($this->_table_name,array('id'=>$id),false,true);
		$this->data['leaders'] = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Leader','is_home'=>1,'s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('order'=>'asc'));
	$this->load->view($this->_subView.'index',$this->data);
		
	}

	public function ajax_list(){
		//fetch data
//		$this->data['news_details'] = $this->comman_model->get_by($this->_table_name,array('id'=>$id),false,true);
		$this->data['leaders'] = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Leader','is_home'=>1,'s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('order'=>'asc'));
	$this->load->view($this->_subView.'index',$this->data);
		
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */