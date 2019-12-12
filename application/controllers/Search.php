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
		$where_clause_2 = "";
		$url = site_url().'search?';
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " lower(name) like '%".strtolower($name)."%' and";
			$where_clause_2 .= " (lower(name) like '%".strtolower($name)."%' or lower(tags) like '%".strtolower($name)."%') and";
		}
		$where_clause = rtrim($where_clause,'and');
		$where_clause_2 = rtrim($where_clause_2,'and');

		if($_REQUEST){
			if($where_clause){
				$output['result']= 'ok';

				$string ="SELECT id,name,image, '' as channel_url,link,section,created,'news' AS  type_search 
 FROM news WHERE section IN('Finances','Blazers','Leader','On The Beat','Property News') AND ".$where_clause." 
UNION ALL
SELECT id,name,image,channel_url,'' AS link,'' AS section,created,'channel' AS  type_search  FROM channels WHERE enabled=1 and 
".$where_clause_2." ";
               			
				$this->data['products'] = $this->comman_model->get_query($string.' order by id desc',false);
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

