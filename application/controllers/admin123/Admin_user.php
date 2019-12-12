<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	variable
		-$this->data['settings'] is array data. 
		 we set data from settings and l_setting table;
		 $this->data['settings'] is variable define in core/MY_Controller.php
		
		-$this->data['admin_link'] is admin name. define in core/MY_Controller.php
		
		-$this->data['admin_details'] is admin data from admin table
		
		-$this->data['adminLangSession'] is default  lang_id code from language table
		define in core/MY_Controller.php
*/

class Admin_user extends Admin_Controller {
	public $_table_names = 'admin';			//set table name 
	public $_subView = 'admin/admin_user/'; // set load subview path
	public $_redirect = '/admin_user';		// set admin link with controller file name
	//set msge 
	public $_msg_success = 'Employee has successfully created.';
	public $_msg_update = 'Employee has successfully updated.';
	public $_msg_delete = 'Employee has successfully deleted.';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Employee Management';
        $this->load->model('backend/admin_employee_model');

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

		$this->data['lang_id']	= $this->data['adminLangSession']['lang_id'];
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			$redirect = true;
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}

		$this->data['permissions']	= array(
										array(
											'id'=>'general_setting',
											'value'=>'Base',
										),
										array(
											'id'=>'user_manage',
											'value'=>'User Management',
										),

										array(
											'id'=>'news_manage',
											'value'=>'News Management',
										),
										array(
											'id'=>'content_manage',
											'value'=>'Content Management',
										),
								);        
	}


	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Admin';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('default'=>0,'type'=>'Organizations'),false,false,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}


    public function create(){
		//set title
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Create';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//set a new one data
		$this->data['employee'] = $this->admin_employee_model->get_new();

		$this->data['users_form'] = $this->admin_employee_model->get_new_lang();
//		$this->data['users_form'] = $this->admin_employee_model->get_lang(NULL, FALSE, $this->data['lang_id']);

        // Set up the form
        $rules = $this->admin_employee_model->create_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			//get post data from form
        	$data = $this->comman_model->array_from_post(array(
								'username','email','name'
							));
			$data['type'] = 'Organizations';
			$data['password'] = md5($this->input->post('password'));
			$data['role'] = 'employee';
			$data['date'] = date('Y-m-d H:i:s');
			$data['created'] = time();
			$data['modified'] = time();
            
			//upload image
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{}
			
			//insert data in admin table
           	$id = $this->comman_model->save($this->_table_names,$data);
			//insert admin user permission
			$post_permission = $this->input->post('permission');
			if($post_permission){
				foreach($post_permission as $key=>$value){
					if($value){
						$postPD = array(
										'value'			=> $value,
										'type'			=> $key,
										'user_id'		=> $id,
									//	'gym_id'		=> $this->data['user_details']->id
										);
						$this->db->insert('admin_permission',$postPD);
					}
				}
			}
			
			//send email to admin user
			$email_data = $this->comman_model->get_by('email',array('id'=>9),false,true);
			$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

			$email_data->message = str_replace('{user_name}', $data['username'], $email_data->message);
			$email_data->message = str_replace('{user_email}', $data['email'], $email_data->message);
			$email_data->message = str_replace('{password}', $this->input->post('password'), $email_data->message);
			$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
			$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
			$email_data->message = str_replace('{login_link}', base_url().$this->data['admin_link'], $email_data->message);
			$this->load->library('email');
			$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
			$this->email->to($this->input->post('email'));
			$this->email->subject($email_data->subject);
			$this->email->message($email_data->message);
			$this->email->send();

			if(empty($this->data['categories']->id))
	            $this->session->set_flashdata('success',$this->_msg_success);
			else
	            $this->session->set_flashdata('success',$this->_msg_update);			
            
            redirect($this->data['_cancel']);
        }
        
		$this->data['subview'] = $this->_subView.'create';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	public function edit($id = NULL){
		//set title
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    if($id)
        {
		    // Fetch a data
            $this->data['employee'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'default'=>0), FALSE, true);
           	if(!$this->data['employee']){
            redirect($this->data['_cancel']);
			}
        }
        else
        {
            redirect($this->data['_cancel']);
        }
        
        
		$this->data['type_data'] =array('Person'=>'Person','Organizations'=>'Organizations');
        // Process the form
        if($this->input->post('operation')){
            $data =array();

			//get post data from form 
        	$data = $this->comman_model->array_from_post(array('name'));
			$data['date'] = date('Y-m-d H:i:s');
			$data['created'] = time();
			$data['modified'] = time();          


			//upload image
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{}

			//update admin user
			$this->comman_model->save($this->_table_names,$data,$id);

			//insert admin user permission
			$post_permission = $this->input->post('permission');
			$this->db->delete('admin_permission', array('user_id' => $id)); 
			if($post_permission){
				foreach($post_permission as $key=>$value){
					if($value){
						$postPD = array(
										'value'			=> $value,
										'type'			=> $key,
										'user_id'		=> $id,
										);
						$this->db->insert('admin_permission',$postPD);
					}
				}
			}

			$this->session->set_flashdata('success',$this->_msg_update);			
            redirect($this->data['_cancel']);
		}
        
		//set load view
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    

    public function _unique_email($str){// check email alredy exists
        
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $categories = $this->comman_model->get('admin',false);        
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }

    public function _unique_user($str){
        // check  username alredy exists
        
        $id = $this->uri->segment(4);
        $this->db->where('username', $this->input->post('username'));
        !$id || $this->db->where('id !=', $id);
        $categories = $this->comman_model->get('admin',false);        
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_user', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }

    public function remove_image($id=false){//remove image
		$path = 'assets/uploads/users/';
		if(!$id)
			redirect($this->data['_cancel']);
		
		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if(!$check)
			redirect($this->data['_cancel']);
		$this->db->where(array('id'=>$id));
		$this->db->set('image', 'NULL', false);
		$this->db->update($this->_table_names);

		$file_dir = $path.'full/'.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		$file_dir = $path.'small/'.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		$file_dir = $path.'thumbnails/'.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		redirect($this->data['_cancel'].'/edit/'.$id);
	}

	function delete($id = false){//delete admin user
		if(!$id){
            redirect($this->data['_cancel']);
		}
		$checkEmployee = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'default'=>0), FALSE, FALSE, true);
		if(!$checkEmployee){
			$this->session->set_flashdata('error','Sorry! You can not delete employee.'); 
            redirect($this->data['_cancel']);
		}
		$this->db->delete($this->_table_names,array('id'=>$id));
		$this->db->delete('admin_permission',array('user_id'=>$id));
		$this->session->set_flashdata('success',$this->_msg_delete); 
		redirect($this->data['_cancel']);
	}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */