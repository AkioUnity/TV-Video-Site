<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

class Broadcast extends Frontend_Controller{	
	public $_redirect = 'user/broadcast';

	public $_subView = 'user/broadcast/';
	public $_table_names = 'users_channels_request';
	public $_mainView = 'user/_new_layout';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->data['active'] = 'channel';
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$this->data['_user_link'] = 'user';
        $this->data['_cancel'] = $this->_redirect;
	}

	function index(){
        $this->data['name'] = 'Broadcasting';
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
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
