<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends Frontend_Controller{	
	public $_redirect = 'user/about';

	public $_subView = 'user/pages/';
	public $_mainView = 'user/_new_layout';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->data['active'] = 'channel';
		
		$this->data['_user_link'] = 'user';
        $this->data['_cancel'] = $this->_redirect;
        $this->data['_view'] = $this->_redirect.'/view';
        $this->perPage = 20;
	}

	function index(){
        $this->data['name'] = 'About';
        $this->data['subview'] = $this->_subView.'about';			
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
