<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_dashboard extends Frontend_Controller{	
	public $_redirect = 'user/ajax_dashboard';
	public $_subView = 'user/';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->data['active'] = 'channel';
        $this->data['_cancel'] = $this->_redirect;
		$this->data['_user_link'] = 'user';
        $this->perPage = 20;
	}

	function ajax_user_remove_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
$string = 'select users_parent_remove.*,users.username from users_parent_remove 
join users on users_parent_remove.user_id = users.id
where users_parent_remove.parent_id='.$this->data['user_details']->id.' and is_read=0';
		$checkRemove = $this->comman_model->get_query($string,true);
		if($checkRemove){
			$output['result']= 'ok';
			$output['id']= $checkRemove->id;
			$output['username']= $checkRemove->username;
		}
		echo json_encode($output);
	}

	function ajax_user_remove(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'ok';
		$id= $this->input->get('id');
		if($id){
			$this->db->trans_start();
			$this->db->where(array('parent_id'=>$this->data['user_details']->id,'id'=>$id));
			$this->db->update('users_parent_remove',array('is_read'=>1));
			$this->db->trans_complete();
		}
		echo json_encode($output);
	}

	function ajax_channel(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;
		$where_clause = '';
		$url  = $this->data['_cancel'].'/ajax_channel?';
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$where_clause = '';

		$g_s_date = $this->input->get('s_date');
		if($g_s_date){
			$where_clause .= 'date(on_date) >= (\''.$g_s_date.'\') and';
			$url .= 's_date='.$g_s_date.'&';
		}

        $g_e_date = $this->input->get('e_date');
		if($g_e_date){
			$where_clause .= ' date(on_date)  <= (\''.$g_e_date.'\') and';
			$url .= 'e_date='.$g_e_date.'&';
		}	

		$name = $this->input->get('q');
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " (lower(name) like '%".strtolower($name)."%' or lower(id) like '%".strtolower($name)."%'  ) and";
		}


		$sort = ' id desc';
		$output['result']= 'ok';

		$stringQuery = "SELECT *  FROM channels where user_id =".$this->data['user_details']->id;	
		$where_clause = rtrim($where_clause,'and');
		if($where_clause){
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and ".$where_clause." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." and ".$where_clause." ORDER BY $sort");
		}
		else{
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." ORDER BY $sort");
		}
			
		//echo $this->db->last_query();die;

		$output['html'] = $this->load->view($this->_subView.'channels/ajax_dashboard',$this->data,true);
		if(empty($output['html'])){
			$output['html'] ='';
		}

		$output['url'] =$url;
		echo json_encode($output);
		//echo $msg;	
	}
	
	
	function ajax_show(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;
		$where_clause = '';
		$url  = $this->data['_cancel'].'/ajax_show?';
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$where_clause = '';

		$g_s_date = $this->input->get('s_date');
		if($g_s_date){
			$where_clause .= 'date(on_date) >= (\''.$g_s_date.'\') and';
			$url .= 's_date='.$g_s_date.'&';
		}

        $g_e_date = $this->input->get('e_date');
		if($g_e_date){
			$where_clause .= ' date(on_date)  <= (\''.$g_e_date.'\') and';
			$url .= 'e_date='.$g_e_date.'&';
		}	

		$channel_id = $this->input->get('channel_id');
		if($channel_id){
			$url .= 'channel_id='.$channel_id.'&';
			$where_clause .= " channel_id ='".$channel_id."' and";
		}


		$sort = ' is_slider desc';
		$output['result']= 'ok';

		$stringQuery = "SELECT *  FROM shows where user_id =".$this->data['user_details']->id;	
		$where_clause = rtrim($where_clause,'and');
		if($where_clause){
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and ".$where_clause." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." and ".$where_clause." ORDER BY $sort");
		}
		else{
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." ORDER BY $sort");
		}
			
		//echo $this->db->last_query();die;

		$output['html'] = $this->load->view($this->_subView.'shows/ajax_dashboard',$this->data,true);
		if(empty($output['html'])){
			$output['html'] ='';
		}

		$output['url'] =$url;
		echo json_encode($output);
		//echo $msg;	
	}
	

	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='U'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			echo json_encode(array('status'=>'error','message'=>'please login first!!'));die;
		}
	}


}
