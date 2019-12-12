<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	variable
		-$this->data['settings'] is array data. 
		 we set data from settings and l_setting table;
		 $this->data['settings'] is variable define in core/MY_Controller.php
	
		-$this->data['admin_details'] is admin data from admin table
		-$this->data['adminLangSession'] is default  lang_id code from language table
		define in core/MY_Controller.php
*/

class Account extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		//set left menu active on admin dashboard
        $this->data['active']= 'General Settings';

	}

    public function index(){
        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/_layout_main',$this->data);
    }

	function set_lang(){
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'login_error';		
		$id = $this->input->post('id');
		if($id){
			$check_lang = $this->comman_model->get_by('language',array('id'=>$id),false,true);
			if($check_lang){
				$this->session->set_userdata('adminLangSession',array('lang_code'=>$check_lang->code,'lang_id'=>$check_lang->id));
			}
		}
		echo json_encode($msge);
	}

	public function login(){
	
		$this->data['title'] = 'Admin Login';
	    $dashboard = $this->data['admin_link'].'/dashboard';
        $this->account_model->loggedin() == FALSE||redirect($dashboard);
        
		$rules = $this->account_model->rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run()==TRUE){
			if($this->account_model->login()==TRUE){
			    redirect($dashboard);			    
			}
            else{
                $this->session->set_flashdata('error','Invalid username or password.');
                redirect($this->data['admin_link'].'/account/login');
            }
		}
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/login',$this->data);
	}
	

	public function logout(){
	    $this->account_model->logout();
	    @session_start();
		session_destroy();
        redirect('front');		
	}
    

    public function _check_old_password($str){//check admin old pass is match from change password form
		$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('admin',array('id'=>$login['admin_session']['id'],'password'=>md5($this->input->post('old_password'))),false,true);
        if(!count($check)){
            $this->form_validation->set_message('_check_old_password',show_static_text($this->data['adminLangSession']['lang_id'],212));
            return FALSE;                    
        }
        return TRUE;
    }



	public function change_password(){			
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],50);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active_sub']= 'email';
		$login = $this->session->all_userdata();

		//set validation string in lang 
		$this->form_validation->set_message('matches',show_static_text($this->data['adminLangSession']['lang_id'],213));
		//set validation rules
		$rules = $this->account_model->rules_password;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()==TRUE){
			//update password 
			$this->comman_model->save('admin',array('password'=>md5($this->input->post('password'))),$login['admin_session']['id']);
			$this->session->set_flashdata('success', show_static_text($this->data['adminLangSession']['lang_id'],214)); 
			redirect($this->data['admin_link'].'/account/change_password');
		}
        $this->data['edit_data'] = $this->comman_model->get_by('admin',array('id'=>$login['admin_session']['id']),FALSE,TRUE);

        $this->data['subview'] = 'admin/dashboard/password';
        $this->load->view('admin/_layout_main',$this->data);               
	}

	function dashboard(){
		$this->check_lang();		
		$this->validateLogin();
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],80);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'home';	
        $this->data['subview'] = 'admin/dashboard/index';	
		$this->load->view('admin/_layout_main',$this->data);
	}
	

	function background(){// for background
		$this->checkPermissions('general_setting');
		$this->load->library('image_lib');
        $this->data['name'] = 'Background Image';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'General Settings';
        $this->data['active_sub']= 'website';
		if ($this->input->post('operation')){
            $data = array();
            if(!empty($_FILES['logo']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['background']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['background']  = $this->data['settings']['logo'];
            }      
			//update image in setting table
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],294));
            redirect($this->data['admin_link'].'/account/background');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/background';
        $this->load->view('admin/_layout_main',$this->data);       
	}
	
	function socialnetwork(){
		//check for employee permission
		$this->checkPermissions('general_setting');

		// set name and browser title 
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],188);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'General Settings';

		//set validation rules
		$this->form_validation->set_rules('google', 'Google', 'trim');
		$this->form_validation->set_rules('facebook', 'Facebook', 'trim');
		$this->form_validation->set_rules('twitter', 'twitter', 'trim');
		$this->form_validation->set_rules('instagram_url', 'Instagram', 'trim');
		$this->form_validation->set_rules('skype_id', 'Skype', 'trim');
		$this->form_validation->set_rules('linkedin', 'Linkedin', 'trim');
        if($this->form_validation->run()==TRUE){
			//get post data
	        $data = $this->settings_model->array_from_post(array('linkedin_url','youtube_url','twitter_url','facebook_url','google_plus','skype_id','instagram_url'));

			//save data in setting table 
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['admin_link'].'/account/socialnetwork');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/social';        
        $this->load->view('admin/_layout_main',$this->data);       
    }
	

    public function remove_image($id=false){//for remove logo
		$id = $this->input->post('id');
		
		$this->db->where(array('field'=>'logo'));
		$this->db->update('setting', array('value'=>''));

		redirect($this->data['admin_link'].'/setting');
		/*$file_dir ='assets/uploads/home/'.$file_name->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		*/
	}

  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			//check employee permission return value 0 or 1
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
			redirect($this->data['admin_link'].'/dashboard');
		}		
	}
	

		
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */