<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

class Account extends Frontend_Controller{	
	public $_redirect = 'user/account';		//set controller link

	public $_subView = 'user/';					//set subview
	public $_mainView = 'user/_new_layout';	//set mainview
	public function __construct(){
		parent::__construct();
		
		//set active for leftmenu on dasboard
		$this->data['name'] = 'Dashboard';	
        $this->load->model(array('user_model','custom_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		

		//check user logged
		$this->_checkUser();

		$this->data['_user_link'] = 'user';
        $this->data['_cancel'] = $this->_redirect;
		$this->data['userPermission'] = array();
		if(!empty($this->data['user_details']->permissions)){
			$this->data['userPermission'] = explode(',',$this->data['user_details']->permissions);
		}
	}

	function index(){
		if($this->data['userPermission']&&(in_array('channel',$this->data['userPermission'])||in_array('shows',$this->data['userPermission']))){}
		else{
			redirect($this->data['_user_link'].'/account/edit_profile');
		}
		//set title
        $this->data['name'] = show_static_text(1,80);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		
		//set load view
        $this->data['subview'] = $this->_subView.'dashboard/index';	
		$this->load->view($this->_mainView,$this->data);
	}

	//set update user profile
	function edit_profile(){	
	
		//set title
        $this->data['name'] = show_static_text(1,45);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'Profile';	


		//set rules
        $rules = $this->user_model->update_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');
			$post_data = $this->comman_model->array_from_post(array('first_name','last_name','address','city','phone','address','country','state'));
        	$post_data['username'] = $post_data['first_name'].' '.$post_data['last_name'];
			
			$post_data['social_media'] = json_encode($this->input->post('social_media'));
			$post_data['user_checkbox'] = json_encode($this->input->post('options'));
			if($this->data['user_details']->apply_channel==0){
				$apply_channel =$this->input->post('apply_channel');
				if($apply_channel){
					$post_data['apply_channel'] = 1;
				}
			}
			
			//upload crop image
		   //upload image
			if (!empty($_FILES['image']['name'])){
				$result =$this->comman_model->do_upload('image','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$post_data['image'] = $result[1];
					$this->image_lib->clear();
				}
			}	
			
			if(!empty($_FILES['logo']['name'])){
                $config['upload_path']      = 'assets/uploads/users/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo'))
                {
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else
                {
                    $upload_data    = $this->upload->data();
                //    $this->session->set_flashdata('message', 'Your file has been successfully uploaded.');
                    $post_data['logo']  = $upload_data['file_name'];
                }
            }

			//update data
			$this->comman_model->save('users',$post_data,$this->data['user_details']->id);
			if(isset($post_data['apply_channel'])){
				$checkCountApply = print_count('users_channels_request',array('user_id'=>$this->data['user_details']->id));
				if($checkCountApply==0){
					redirect($this->data['_user_link'].'/channel_request');
				}
			}
			$this->session->set_flashdata('success',show_static_text(1,211));
			redirect($this->data['_cancel'].'/edit_profile');
			die;
		}

        $this->data['country_list'] = $this->custom_model->get_country_name();
        $this->data['social_arr'] = json_decode($this->data['user_details']->social_media);

		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'profile/edit';	
		$this->load->view($this->_mainView,$this->data);
	}

    
	function dashboard(){
		$this->data['title'] = $this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'dashboard';	
		$this->load->view($this->_mainView,$this->data);
	}


	public function set_remove_owner(){
		$this->db->trans_start();
		if($this->data['user_details']->parent_id!=0){
			$this->db->insert('users_parent_remove',array('parent_id'=>$this->data['user_details']->parent_id,'user_id'=>$this->data['user_details']->id));
		}
		
		$this->db->where(array('id'=>$this->data['user_details']->id));
		$this->db->update('users',array('parent_id'=>0));
		$this->db->trans_complete();
		redirect($this->data['_cancel'].'/edit_profile');
	}
	
	public function change_password(){

        $this->data['name'] = show_static_text(1,50);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'Change Password';
        $this->form_validation->set_error_delimiters('<div class="warnings"><p>', '</p></div>');

		$rules = $this->user_model->rules_password;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', show_static_text(1,219));
		$this->form_validation->set_message('matches',show_static_text(1,213));
		if ($this->form_validation->run()==TRUE){
			
			//update password
			$this->comman_model->save('users',array('password'=>$this->input->post('password')),$this->data['user_details']->id);
			
			$this->session->set_flashdata('success',show_static_text(1,214)); 
			redirect($this->data['_cancel'].'/change_password');
		}

		//fetach user data

        $this->data['subview'] = $this->_subView.'profile/password';	
		$this->load->view($this->_mainView,$this->data);
	}

	
	//check user old password this function use in validetaion of change password
    public function _check_old_password($str){
		//$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->id,'password'=>$this->input->post('old_password')),false,false,true);
        if(!count($check)){
            $this->form_validation->set_message('_check_old_password',show_static_text(1,212));
            return FALSE;                    
        }
        return TRUE;
    }
	
	function set_popup_wizard(){
		$output = array('status'=>'ok');
		$this->session->set_userdata('popup_wizard',1);
		echo json_encode($output);
	}

	function set_remove_message(){
		$output = array('status'=>'ok');
		$this->session->set_userdata('remove_top_message',1);
		echo json_encode($output);
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
	
	function logout(){
//        $this->session->sess_destroy();
		$this->session->unset_userdata('user_session');
		redirect('secure/login');
	}

	function ajax_logout(){
		$output = array('status'=>'ok');
		$this->session->unset_userdata('user_session');
		echo json_encode($output);
	}
}

