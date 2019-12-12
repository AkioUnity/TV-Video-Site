<?php
class Concierge extends Admin_Controller{
	public $_table_names = 'users_concierge';		//set table name
	public $_subView = 'admin/concierge/';	//set subview load 
	public $_redirect = '/concierge';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'User Management';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->perPage = 20;
	}
    
    public function index(){
		$this->data['name'] = 'Concierge';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function ajax_get_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;

		//$msg = 0;
		$url = $this->data['_cancel'].'/ajax_get_list?';
		$where_clause = '';
        $get_user_id = $this->input->get('user_id');
		$url .= 'user_id='.$get_user_id.'&';

        $name = $this->input->get('q');
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " (lower(first_name) like '%".strtolower($name)."%' or lower(last_name) like '%".strtolower($name)."%' ) and";
		}

		

		$this->data['list_data'] = $this->perPage;
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$sort_by = ' ORDER BY id desc ';
		
		$output['result']= 'ok';
		$stringQuery = "SELECT * from ".$this->_table_names." ";	

		$where_clause = rtrim($where_clause,'and');
		
		if($where_clause){
			//	echo $stringQuery." ORDER BY job_id desc limit $offset, ".$this->perPage;
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." where ".$where_clause." ".$sort_by." limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." where ".$where_clause."  ".$sort_by." ");
		}
		else{
			//	echo $stringQuery." ORDER BY job_id desc limit $offset, ".$this->perPage;
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ".$sort_by." limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." ".$sort_by." ");
		}
		//echo $this->db->last_query();die;
		$output['html'] = $this->load->view($this->_subView.'ajax_list',$this->data,true);
		$output['url']= $url;
		echo json_encode($output);
	}

	function set_confirm($id=false){
		if(!$id)
			redirect($this->data['_cancel']);

		$this->comman_model->save($this->_table_names,array('status'=>1),$id);
		redirect($this->data['_cancel']);		
	}

	
  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}
}