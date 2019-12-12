<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ini_set('allow_url_fopen',1);
class Secure extends Frontend_Controller{
	public $_subView = 'templates/account/';
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('date','string'));	
		$this->load->model(array('register_model','email_model'));
		$this->load->library(array('recaptcha'));
	}
	
	function ajax_login(){
		$output= array();
		$output['status'] = 'Error';
		$this->output->set_content_type('application/json');
			$rules = array(
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    ); 
		
		$this->form_validation->set_rules($rules);
//		$this->form_validation->set_message('required', '%s required');
		if ($this->form_validation->run() == FALSE){
/*				$output['course_code'] =$this->form_validation->course_code_error;
				$output['name'] =$this->form_validation->name_error; */
//				echo validation_errors();
				$output['message'] =form_error('email');
				$output['message'] =form_error('password');
				// if(form_error('code')){
				// 	$output['message'] = 'ReCAPTCHA required';
				// }
			}
			else{
				$send = array('email' => $this->input->post('email'),'password'=>$this->input->post('password'));
				$login = $this->comman_model->get_by('users',$send,false,true);
				if(!empty($login)){
					if($login->confirm!='confirm'){
						$output['message'] ='<p class="alert alert-block alert-danger">Your email ID has not verify.</p>';
					}
					else if($login->status!=1){
						$output['message'] ='<p class="alert alert-block alert-danger">Your account has been deactived.</p>';
					}
/*					else if($login->admin_confirm!=1){
						$output['error'] ='Your email ID has not verified by admin.';
					}*/
					else{
						$output['status'] ='ok';
	
						$session_data = array(
								'loginType' => 'user',
								'loggedin' => true,				   
								'id' =>$login->id);				
						//$total = $login['bonus_balance']+10;
						$this->session->sess_expiration = '14400'; 
						$this->session->set_userdata('user_session',$session_data);
					
					}
				}
				else{
					$output['message'] ='<p class="alert alert-block alert-danger">Invalid user id or password.</p>';
				}

			}
		echo json_encode($output);
	}
			
	
	function register(){//for register 
		$this->load->library('form_validation');
		//set rules
		$rules = $this->register_model->register;
		$rules['code'] = array('field'=>'code','label'=>'Code','rules'=>'callback__check_code');

		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('matches',show_static_text(1,213));
		$this->form_validation->set_message('is_unique','You are already registered, please click here to login');
		$this->form_validation->set_message('integer',show_static_text(1,221));
		$this->form_validation->set_message('required', show_static_text(1,219));
		//process from
		if ($this->form_validation->run() == true){
			//get post data
			$post_data = $this->comman_model->array_from_post(array('first_name','last_name','email','password'));
			$checkEmail = $this->comman_model->get_by('users',array('lower(email)'=>strtolower($post_data['email'])),false,false);
			if($checkEmail){
				$this->session->set_flashdata('error','Email already in use, did you forget <a href="secure/forgot">your password?</a>');
				redirect('secure/register');
			}

			$post_data['account_type'] = 'U';
			$post_data['status'] = 1;
		
			$dynamic_code =  random_string('alnum', 16);  
			$post_data['confirm'] = $dynamic_code;
			$post_data['username'] = $post_data['first_name'].' '.$post_data['last_name'];
		
			//check email id
			$checkEmail = $this->comman_model->get_by('users',array('email'=>$post_data['email']),false,false);
			if($checkEmail){
				$this->session->set_flashdata('error','Sorry! Email already exist.');
				redirect('secure/register');
			}
			
			//insert data
			$registerForm = $this->comman_model->save('users',$post_data);
			
			//send register email verification
			$email_data = $this->comman_model->get_by('email',array('id'=>1),false,true);
						
			$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);
		
			$email_data->message = str_replace('{user_name}', $post_data['first_name'].' '.$post_data['last_name'], $email_data->message);
			$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
			$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
			$email_data->message = str_replace('{site_link}', base_url().'verify/user/'.$dynamic_code.'/'.md5($registerForm), $email_data->message);
			//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
		
			$send_data = array('to_email'=>$post_data['email'],'from_email'=>$this->data['settings']['site_email'],'from_name'=>$this->data['settings']['site_name'],'subject'=>$email_data->subject,'html'=>$email_data->message);
			$this->email_model->send_mail_in_ci($send_data);

			$this->load->library('mailchimp_library');
			$result = $this->mailchimp_library->call('lists/subscribe', array(
						'id'                => MAILCHIMPLIST_1,
						'email'             => array('email'=>$post_data['email']),
						'merge_vars'        => array('FNAME'=>$post_data['first_name'], 'LNAME'=>$post_data['last_name']),
						'double_optin'      => false,
						'update_existing'   => true,
						'replace_interests' => false,
						'send_welcome'      => false,
					));
			
			$this->session->unset_userdata('user_reg');
			$this->session->set_flashdata('success', '<b>SUCCESS!</b><br>You’ll just need to verify your account by clicking the link sent to your email address<br>((Be sure to check your junk mail folder))');
//			$this->session->set_flashdata('success', show_static_text(1,216).'<br>'.show_static_text(1,217).'<br>('.show_static_text(1,218).')');
			//$this->session->set_flashdata('success', show_static_text(1,216));
		
			redirect('secure/register');
		}
		
        $this->data['widget'] = $this->recaptcha->getWidget();
        $this->data['script'] = $this->recaptcha->getScriptTag();
		//set titile
		$this->data['title'] = 'Register | '.$this->data['settings']['site_name'];
		//set load view
		$this->load->view($this->_subView.'register',$this->data);
	}
	//for login page
	function test_login(){
/*		$this->data['set_meta'] = 'login';
		$this->data['active'] = "login";*/

		//$data['message'] = $this->session->flashdata('success');
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
			$rules = array(
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
					'code' =>array('field'=>'code','label'=>'Code','rules'=>'callback__check_code'),
                    ); 
		
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE){
			$send = array('email' => $this->input->post('email'),'password'=>$this->input->post('password'));
			$login = $this->comman_model->get_by('users',$send,false,true);
//			printR($login);die;
			if($login){
				//check email verfied or not
				if($login->confirm!='confirm'){
					$this->session->set_flashdata('error',show_static_text(1,222));
					redirect('secure/test_login');
				}
				else if($login->status!=1){
					$this->session->set_flashdata('error',show_static_text(1,223));
					redirect('secure/test_login');
				}
				else{
					//set user session
					$session_data = array(
							'loginType' => 'user',
						  	'loggedin' => true,				   
						   	'name' =>$login->username,
						   	'email' =>$login->email,
						   	'id' =>$login->id);				
					//$total = $login['bonus_balance']+10;
					$this->session->sess_expiration = '14400'; 
					$this->session->set_userdata('user_session',$session_data);					
					redirect('user/account/edit_profile','refresh');				
				}
			}
			else{
				$this->session->set_flashdata('error', show_static_text(1,224));
				redirect('secure/login');
			}
		}

        $this->data['widget'] = $this->recaptcha->getWidget();
        $this->data['script'] = $this->recaptcha->getScriptTag();
        $this->data['subview'] = $this->_subView.'login';	
		//$this->load->view('templates/_layout_main',$this->data);
		$this->load->view($this->_subView.'login_test',$this->data);
	}
	
	function login(){
/*		$this->data['set_meta'] = 'login';
		$this->data['active'] = "login";*/

		//$data['message'] = $this->session->flashdata('success');
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
			$rules = array(
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
					'code' =>array('field'=>'code','label'=>'Code','rules'=>'callback__check_code'),
                    ); 
		
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE){
			$send = array('email' => $this->input->post('email'),'password'=>$this->input->post('password'));
			$login = $this->comman_model->get_by('users',$send,false,true);
//			printR($login);die;
			if($login){
				//check email verfied or not
				if($login->confirm!='confirm'){
					$this->session->set_flashdata('error',show_static_text(1,222));
					redirect('secure/login');
				}
				else if($login->status!=1){
					$this->session->set_flashdata('error',show_static_text(1,223));
					redirect('secure/login');
				}
				else{
					//set user session
					$session_data = array(
							'loginType' => 'user',
						  	'loggedin' => true,				   
						   	'name' =>$login->username,
						   	'email' =>$login->email,
						   	'id' =>$login->id);				
					//$total = $login['bonus_balance']+10;
					$this->session->sess_expiration = '14400'; 
					$this->session->set_userdata('user_session',$session_data);					
					redirect('user/account/edit_profile','refresh');				
				}
			}
			else{
				$this->session->set_flashdata('error', show_static_text(1,224));
				redirect('secure/login');
			}
		}

        $this->data['widget'] = $this->recaptcha->getWidget();
        $this->data['script'] = $this->recaptcha->getScriptTag();
        $this->data['subview'] = $this->_subView.'login';	
		//$this->load->view('templates/_layout_main',$this->data);
		$this->load->view($this->_subView.'login',$this->data);
	}
	
	//for forget password
	function forgot(){	
		$this->data['active'] = "Forgot Password";
		$this->data['title'] = "Forgot Password | ".$this->data['settings']['site_name'];
		if($this->input->post('operation')){ 
			$send = array('email' => $this->input->post('email'));
			$login = $this->comman_model->get_by('users',$send,false,TRUE);
			if(!empty($login)){
				if($login->confirm!='confirm'){
					$this->session->set_flashdata('success', show_static_text(1,222));
					redirect('secure/forgot');
				}
				else{
					$your_message = 'Hello '.$login->first_name.' '.$login->last_name.' Your password is '.$login->password;
	
					$this->load->library('email');
					$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
					$this->email->to($this->input->post('email'));
					$this->email->subject("Forgot Password");			
					$this->email->message($your_message);
					$this->email->send();
					//end varify
					$this->session->set_flashdata('success',"We’ve sent a temporary password to your registered email address.");
					redirect('secure/forgot');
				}
			}
			else{
				$this->session->set_flashdata('error',show_static_text(1,226));
				redirect('secure/forgot');
			}
		}
        $this->data['subview'] = $this->_subView.'forgot';	
		$this->load->view($this->_subView.'forgot',$this->data);
	}

	function register_email_exists(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		if (array_key_exists('email',$_GET)) {
			if ( $this->email_exists($this->input->get('email')) == TRUE ) {
				echo json_encode(FALSE);
			} else {
				echo json_encode(TRUE);
			}
		}
	}	

	private function email_exists($email){
		$this->db->where('lower(email)', strtolower($email));
		$query = $this->db->get('users');
		if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
	}	

    public function _check_code($str){
		$recaptcha = $this->input->post('g-recaptcha-response');
		if (!empty($recaptcha)) {
			$response = $this->recaptcha->verifyResponse($recaptcha);
			if (isset($response['success']) and $response['success'] === true) {
	            return true;
			}
		}
            $this->form_validation->set_message('_check_code', 'Field required');
            return FALSE;
    }


}
