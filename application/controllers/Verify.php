<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify extends frontend_Controller {

 	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model'));


	}

	function user($key=false,$id= false){
		if($key && $id){

			//check $id : id by md5 and key : comfirm field data from users table
			
			$show = $this->user_model->check_user($id,$key);
			if($show=='error'){//sometime error
				$this->session->set_flashdata('error', 'Sorry You have something mistake');
			}
			else if($show=='verified'){//already verified
				$this->session->set_flashdata('error', 'You have already verified.');				
				redirect('secure/login');
			}
			else {
				$this->session->set_flashdata('success', 'Your application has been received. An accounts specialist will be in touch with you shortly!');				
				redirect('secure/login');
			}
			redirect('secure/login');
		}
	}
}
