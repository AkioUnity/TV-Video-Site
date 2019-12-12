<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Frontend_Controller{	
	public $_redirect = 'user/users';

	public $_subView = 'user/users/';
	public $_table_names = 'users';
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
        $this->load->model(array('custom_model'));
		
	}

	function index(){
        $this->data['name'] = 'Users';
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

		$sort = ' id desc';
		$output['result']= 'ok';

		$stringQuery = "SELECT * FROM users where parent_id =".$this->data['user_details']->id;	
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

	function create(){
     	$rules = array(
        		'first_name' 					=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
			   );

	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');

			$post1 =array('first_name','last_name','email','phone','password','address','city','country');
        	$post_data = $this->comman_model->array_from_post($post1);
			$checkEmail = $this->comman_model->get_by('users',array('lower(email)'=>strtolower($post_data['email'])),false,false);
			if($checkEmail){
				$this->session->set_flashdata('error','Email already in use');
				redirect($this->data['_cancel'].'/create');
			}

			$post_data['account_type']	= 'U';
			$post_data['parent_id']		= $this->data['user_details']->id;
			$post_data['social_media']	= json_encode($this->input->post('social_media'));
			$post_data['username']		= $post_data['first_name'].' '.$post_data['last_name'];
			$post_data['confirm'] 		= 'confirm';
			$post_data['status'] 		= 1;

			$post_data['permissions'] = '';
			$amenities = $this->input->post('permissions');
			if($amenities){
				$post_data['permissions'] = implode(',',$amenities);
			}

			$id = $this->comman_model->save($this->_table_names,$post_data);
			$this->session->set_flashdata('success','Data has successfully created.');
			redirect($this->data['_cancel']);
			die;
        }

        $this->data['country_list'] = $this->custom_model->get_country_name();

		$this->data['name'] = show_static_text(1,800).'Create';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'create';	
		$this->load->view($this->_mainView,$this->data);
	}
	
	function edit($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$edit_form = $this->data['edit_form']  = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id),false,true);
		if(!$edit_form){
			redirect($this->data['_cancel']);
		}
		
     	$rules = array(
        		'first_name' 					=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$post1 =array('first_name','last_name','address','phone','city','country');
        	$post_data = $this->comman_model->array_from_post($post1);
			$post_data['social_media']	= json_encode($this->input->post('social_media'));
			$post_data['username']		= $post_data['first_name'].' '.$post_data['last_name'];
			$post_data['permissions'] = '';
			$amenities = $this->input->post('permissions');
			if($amenities){
				$post_data['permissions'] = implode(',',$amenities);
			}
			$this->comman_model->save($this->_table_names,$post_data,$edit_form->id);
			$this->session->set_flashdata('success','Data has successfully updated.');
			redirect($this->data['_cancel'].'/edit/'.$id);
			die;
        }

        $this->data['social_arr'] = json_decode($edit_form->social_media);
        $this->data['country_list'] = $this->custom_model->get_country_name();

		$this->data['name'] = 'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view($this->_mainView,$this->data);
	}
	
	function add_back($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$edit_form =$this->comman_model->get_by('users_parent_remove',array('id'=>$id,'parent_id'=>$this->data['user_details']->id),false,true);
		if(!$edit_form){
			$this->session->set_flashdata('error','There is no data.');
			redirect($this->data['_cancel']);
		}
		
		$this->db->trans_start();
		$this->db->delete('users_parent_remove',array('id'=>$edit_form->id));
		
		$this->db->where(array('id'=>$edit_form->user_id));
		$this->db->update('users',array('parent_id'=>$this->data['user_details']->id));
		$this->db->trans_complete();
		redirect($this->data['_cancel']);
	}
	
	
	function delete($id = false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		$edit_form = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id),false,true);
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
