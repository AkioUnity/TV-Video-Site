<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_mail extends Frontend_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('email_model'));
	}

	public function send_mail_2(){
			$send_data = array('to_email'=>'pvsysgroup01@gmail.com','from_email'=>$this->data['settings']['site_email'],'from_name'=>$this->data['settings']['site_name'],'subject'=>'Test mail for testing','html'=>'This is test mail for testing');
			echo $this->email_model->send_mail_in_ci($send_data);
	}
	public function send_mail(){
		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);
		$this->email->from('info@propertytv.io', $this->data['settings']['site_name']);
		$this->email->to('pvsysgroup01@gmail.com');
		$this->email->subject('Test mail for testing');
		$this->email->message('this is test mail for testing');
		if($this->email->send()){
			echo 'send';
		}
		else{
			echo 'not send';
		}
	}

	function send_mail_1(){
		$to = "pvsysgroup01@gmail.com";
		$subject = "My subject";
		$txt = "Hello world!";
		$headers = "From: info@propertytv.io" . "\r\n";
		
		if(mail($to,$subject,$txt,$headers)){
			echo 'Sent!';
		}
		else{
			echo 'not Send!';
		}
	}
	
}

