<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Frontend_Controller {
	public $_table_names = 'news';
	public $_subView = 'templates/category/';
	public function __construct(){
		parent::__construct();
		$this->data['category_type'] = array(
											'Editorial'		=> 'Editorial',
											'Blazers'		=> 'Blazers',
											'PropertyNews'	=> 'Property News',
											'OnTheBeat'		=> 'On The Beat',
											'Finance'		=> 'Finances',
											'Leaders'		=> 'Leader',
											);
		$this->data['_cancel'] ='category';	
        $this->perPage = 10;
	}

	
	public function index($id = false){
		if(!$id){
			redirect('front');
		}
		if(!array_key_exists($id,$this->data['category_type'])){
		}

		//fetch data
		$this->data['page_title'] =  $this->data['category_type'][$id];
		
		$string = "SELECT news_id, COUNT(news_id) AS news_count, news.id as id,news.name as name,news.link as link,news.image as image,news.article_image as article_image,news.section as section
					FROM news_view JOIN news ON news_view.news_id = news.id 
					GROUP BY news_id order  by news_count desc limit 30";
		$this->data['most_news_list'] = $this->comman_model->get_query($string,false);
		if($id=='Leaders'){
			$this->data['news_list'] = $this->comman_model->get_by('news',array('section'=>$this->data['page_title'],'is_home'=>1),array('id'=>'desc'));
		}
		else{
			$this->data['news_list'] = $this->comman_model->get_by('news',array('section'=>$this->data['page_title']),array('id'=>'desc'));
		}
		
		$string ="select * from news where section in('Finances','Blazers','Leader','On The Beat','Property News') order by id desc limit 5";
		$this->data['all_news_list'] = $this->comman_model->get_query($string,false);

		
		//set title data
		$this->data['title'] = $this->data['page_title']." | ".$this->data['settings']['site_name'];
		$this->data['category_id'] = $id;
		//set load view
		$this->load->view($this->_subView.'index',$this->data);
		
	}

	function ajax_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;
		//$msg = 0;
		$url  = $this->data['_cancel'].'/ajax_list?';
        $page = $this->input->get('page');
		$type =  $this->data['type'] = $this->input->get('type');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			//$offset = $page*2-2;
			$this->data['page_number'] = $page;
        }

		$where_clause = '';
		if($type){
			$url .= 'type='.$type.'&';
			if($type=='all'){
				$where_clause .= " section in('Finances','Blazers','Leader','On The Beat','Property News') and";
			}
			elseif($type=='Finances'){
				$where_clause .= " section in('Finances') and";
			}
			elseif($type=='Blazers'){
				$where_clause .= " section in('Blazers') and";
			}
			elseif($type=='Leader'){
				$where_clause .= " section in('Leader') and";
			}
			elseif($type=='On The Beat'){
				$where_clause .= " section in('On The Beat') and";
			}
			elseif($type=='Property News'){
				$where_clause .= " section in('Property News') and";
			}
		}
		
		$sort = 'id desc';
		$output['result']= 'ok';
		$where_clause = rtrim($where_clause,'and');

		$stringQuery ="select * from news where enabled =1 ";
		if($where_clause){
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and ".$where_clause." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." and ".$where_clause." ORDER BY $sort");
		}
		else{
			//echo $stringQuery." ORDER BY $sort limit $offset, ".$this->perPage;
			$this->data['all_data'] = array();
			$this->data['total'] = $output['total'] = 0;
		}
		//echo $this->db->last_query();die;

		$output['html'] = $this->load->view($this->_subView.'ajax_list',$this->data,true);
		if(empty($output['html'])){
			$output['html'] ='';
		}

		$output['url'] =$url;
		echo json_encode($output);
		//echo $msg;	
	}
}

