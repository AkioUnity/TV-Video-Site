<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Frontend_Controller {
	public $_table_name = 'news';
	public $_subView = 'templates/search/';
	public function __construct(){
		parent::__construct();
		$this->data['category_type'] = array(
											'Editorial'		=> 'Editorial',
											'Blazers'		=> 'Blazers',
											'PropertyNews'	=> 'Property News',
											'OnTheBeat'		=> 'On The Beat',
											'Finance'		=> 'Finance',
											'Leaders'		=> 'Leader',
											);
		$this->data['search_show_icon'] = true;
	}
	

	
	public function index(){
		$this->load->view($this->_subView.'index',$this->data);
	}

	function ajax($page_type=false){	
		$output = array();
		$output['result']= 'error';
		//$msg = 0;
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		if(!$limit){
			$limit= 12;
		}
		if(!$offset){
			$offset= 0;
		}
		$name = $this->input->get('q');

		$userArr =array();
		$where_clause = "";
		$url = site_url().'search?';
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " name like '%".$this->input->get('q')."%' and";
		}
		else{			
			$url .= 'q=&';
		}
		$where_clause = rtrim($where_clause,'and');

		if($_REQUEST){
			if($where_clause){
				$output['result']= 'ok';

				$string ="select * from news where section in('Finances','Blazers','Leader','On The Beat','Property News') and";
               			
				$this->data['products'] = $this->comman_model->get_query($string.$where_clause.' order by id desc',false);
				$output['content'] = $this->load->view('templates/search/ajax_search',$this->data,true);
				$output['offset'] =$offset +12;
				$output['limit'] =$limit;

			}
			else{
				$output['content'] = '';
				$output['offset'] = 12;
				$output['limit'] = 12;
			}
		}
		else{
			$output['content'] = '<div class="col-sm-12"><h4>No Results Found. Try simplifying your search</h4></div>';
		}
		$output['url']= $url;
		if($page_type=='template'){
		}
		else{
			echo json_encode($output);
		}
		//echo $msg;	
	}
}

