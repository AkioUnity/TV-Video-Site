<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Frontend_Controller{	
	public $_redirect = 'user/category';

	public $_subView = 'user/shows_category/';
	public $_table_names = 'shows_category';
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
	}

	function index(){
        $this->data['name'] = 'Category';
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function ajax_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
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


		$sort = ' set_order asc';
		$output['result']= 'ok';

		$stringQuery = "SELECT *  FROM shows_category where user_id =".$this->data['user_details']->id;	
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
	
	function ajax_wizard_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'ok';

		$sort = ' id desc';
		$output['result']= 'ok';
		$stringQuery = "SELECT *  FROM shows_category where user_id =".$this->data['user_details']->id;	
		$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ORDER BY $sort limit 4 ",false);
		//echo $this->db->last_query();die;

		$output['html'] = $this->load->view($this->_subView.'ajax_wizard_list',$this->data,true);
		echo json_encode($output);
	}

	function create(){
		
     	$rules = array(
        		'name' 					=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim'),
			   );

	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');

			$post1 =array('name','set_order');
        	$data = $this->comman_model->array_from_post($post1);
			$data['user_id'] 		= $this->data['user_details']->id;
			$data['on_date'] 		= date('Y-m-d');

			$id = $this->comman_model->save($this->_table_names,$data);
			$this->session->set_flashdata('success','Data has successfully created.');
			redirect($this->data['_cancel']);
			die;
        }
		

    	$this->data['set_order']  = print_count($this->_table_names,array('user_id'=>$this->data['user_details']->id))+1;
		$this->data['name'] = show_static_text(1,800).'Create';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'create';	
		$this->load->view($this->_mainView,$this->data);
	}
	
	function edit($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$edit_form = $this->data['edit_form']  = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
		if(!$edit_form){
			redirect($this->data['_cancel']);
		}
		
     	$rules = array(
        		'name' 					=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$post1 =array('name','set_order');
        	$data = $this->comman_model->array_from_post($post1);
			
			$this->comman_model->save($this->_table_names,$data,$edit_form->id);
			$this->session->set_flashdata('success','Data has successfully updated.');
			redirect($this->data['_cancel']);
			die;
        }
		$this->data['name'] = 'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view($this->_mainView,$this->data);
	}

	function delete($id=false){
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
