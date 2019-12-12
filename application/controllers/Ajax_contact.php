<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_contact extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','front'));	
		$this->load->library(array('form_validation','session',));
		$this->load->model(array('comman_model','settings_model'));
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();
		//date_default_timezone_set("Asia/Dubai"); 
		//date_default_timezone_set("Asia/Kolkata"); 
        $detail = $this->session->all_userdata();
		if(isset($detail['user_session'])){
			$this->data['user_session'] = $detail['user_session'];
			if(isset($detail['user_session']['loginType'])){
				if($detail['user_session']['loginType']=='user'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
				}
				if($detail['user_session']['loginType']=='reseller'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
				}
			}
        }
	}
	
	function send_contact(){
		$rel = array();
		$rel['status']= "error";
		$rel['msg']= '';
		$lang_id = 1;
		if($this->input->post('email')){
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL) === false) {
				$email_data = $this->comman_model->get_by('email',array('id'=>4),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->subject);
		
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{name}', $this->input->post('user_name'), $email_data->message);
				$email_data->message = str_replace('{phone}', $this->input->post('phone'), $email_data->message);
				//$email_data->message = str_replace('{subject}', $this->input->post('subject'), $email_data->message);
				$email_data->message = str_replace('{email}', $this->input->post('email'), $email_data->message);
				$email_data->message = str_replace('{message}', $this->input->post('messege'), $email_data->message);
				$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);
		
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->input->post('email'), $this->input->post('user_name'));
				$this->email->to($this->data['settings']['site_email']);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
							
				if($this->email->send()){
					$rel['status']= "ok";
					$rel['msg']="<p style='color:#0F0'>".show_static_text($lang_id,199)."</p>";
					//$this->session->set_flashdata('success', 'Thanks for your message- a representative will be in touch with you shortly !');			
					
				}
				else{
					$rel['status']= "error";
					$rel['msg']="<p style='color:#F00'>".show_static_text($lang_id,200)."</p>";
					//$this->session->set_flashdata('error', 'Something error in sending mail.');
				}
			}
			else{
				$rel['msg']= "<p style='color:#F00'>".show_static_text($lang_id,201)."</p>";
			}
		}
		else{
			$rel['msg']= "<p style='color:#F00'>".show_static_text($lang_id,202)."</p>";
		}
		echo json_encode($rel);
	}
	function save_newsletter(){
		$output = 0;
		$email = $this->input->post('newsEmail');
//		echo $email = 'pvsysgroup01@gmail.com';
		if(!empty($email)&&filter_var($email, FILTER_VALIDATE_EMAIL)){
			$check =$this->comman_model->get_by('users_email',array('email'=>$email),false,false);
			if($check){
				$output = '2';
			}
			else{
				$this->comman_model->save('users_email',array('email'=>$email));
				$output = '1';
			}
			$this->load->library('mailchimp_library');
			$result = $this->mailchimp_library->call('lists/subscribe', array(
						'id'                => MAILCHIMPLIST_1,
						'email'             => array('email'=>$email),
						'merge_vars'        => array('FNAME'=>'', 'LNAME'=>''),
						'double_optin'      => false,
						'update_existing'   => true,
						'replace_interests' => false,
						'send_welcome'      => false,
					));
		}
		echo $output;	
	}	
}
