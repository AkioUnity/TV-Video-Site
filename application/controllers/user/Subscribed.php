<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribed extends Frontend_Controller{	
	public $_redirect = 'user/subscribed';

	public $_subView = 'user/subscribed/';
	public $_table_names = 'users_channels_subscribe';
	public $_mainView = 'user/_new_layout';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->data['active'] = 'channel';
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$this->data['_user_link'] = 'user';
        $this->data['_cancel'] = $this->_redirect;
        $this->data['_view'] = $this->_redirect.'/view';
        $this->perPage = 20;
		$this->data['userPermission'] = array();
		if(!empty($this->data['user_details']->permissions)){
			$this->data['userPermission'] = explode(',',$this->data['user_details']->permissions);
		}
	}

	function index(){
        $this->data['name'] = 'My Subscribed Channels';


		$where_clause = '';
		$name = $this->input->get('q');
		if($name){
			$where_clause .= " (lower(channels.name) like '%".strtolower($name)."%' or lower(channels.tags) like '%".strtolower($name)."%' ) and";
		}

		$category = $this->input->get('category');
		if($category){
			$g_user_id = print_value('shows_category',array('id'=>$category),'user_id','no');
			if($g_user_id!='no'){
				$where_clause .= " channels.user_id ='".$g_user_id."' and";
			}
		}
		$get_sort = $this->input->get('filter');
		$sort = ' users_channels_subscribe.id desc';
		if($get_sort){
			if($get_sort=='name'){
				$sort = ' lower(channels.name) asc';
			}
			else if($get_sort=='new'){
				$sort = ' channels.id desc';
			}
			else if($get_sort=='viewed'){
				$sort = ' channels.view_count desc';
			}
		}

$stringQuery = "SELECT users_channels_subscribe.id as subscribe_id, users_channels_subscribe.created as subscribe_date, channels.* FROM users_channels_subscribe 
join channels on channels.id = users_channels_subscribe.channel_id
where users_channels_subscribe.user_id =".$this->data['user_details']->id;

		$where_clause = rtrim($where_clause,'and');
		if($where_clause){
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and ".$where_clause." order by ".$sort,false);
		}
		else{
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." order by ".$sort,false);
		}
		
		$string = "SELECT DISTINCT(shows_category.id),shows_category.user_id,shows_category.name FROM  users_channels_subscribe 
JOIN channels ON users_channels_subscribe.channel_id = channels.id
JOIN shows_category  ON channels.user_id =  shows_category.user_id where users_channels_subscribe.user_id =".$this->data['user_details']->id." limit 4";
		$this->data['channel_category_list'] = $this->comman_model->get_query($string,false);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function ajax_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;
		$where_clause = '';
		$url  = $this->data['_cancel'].'/ajax_list?';
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$where_clause = '';

		$sort = ' users_channels_subscribe.id desc';
		$output['result']= 'ok';

$stringQuery = "SELECT users_channels_subscribe.id as subscribe_id, users_channels_subscribe.created as subscribe_date, channels.* FROM users_channels_subscribe 
join channels on channels.id = users_channels_subscribe.channel_id
where users_channels_subscribe.user_id =".$this->data['user_details']->id;	
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

		$output['html'] = $this->load->view($this->_subView.'ajax_list',$this->data,true);
		if(empty($output['html'])){
			$output['html'] ='';
		}

		$output['url'] =$url;
		echo json_encode($output);
		//echo $msg;	
	}
	
	function ajax_channel(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['status']= 'error';
		$output['message']= 'There is no channel';
		$id = $this->input->get('id');
		if($id){
$stringQuery = "SELECT users_channels_subscribe.id as subscribe_id, users_channels_subscribe.created as subscribe_date, channels.* FROM users_channels_subscribe 
join channels on channels.id = users_channels_subscribe.channel_id
where users_channels_subscribe.user_id =".$this->data['user_details']->id." and users_channels_subscribe.id = ".$id;	
			$this->data['channel_list'] = $this->comman_model->get_query($stringQuery,true);
			if($this->data['channel_list']){
				$output['html'] = $this->load->view($this->_subView.'ajax_channel',$this->data,true);
				$output['status']= 'ok';
				$output['message']= '';
			}
		}
		echo json_encode($output);
		//echo $msg;	
	}

	

	function delete($id = false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		$edit_form = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
		if(!$edit_form){
			redirect($this->data['_cancel']);
		}

		$this->db->delete($this->_table_names,array('id'=>$edit_form->id));
		$this->session->set_flashdata('success',show_static_text(1,297)); 
		redirect($this->data['_cancel']);		
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
			redirect('secure/login');
		}
	}


}
