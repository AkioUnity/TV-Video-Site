<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//for default controller file
class Front extends Frontend_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		$this->load->helper('cookie');
	}


	public function index($id = false){
		$this->data['title'] = $this->data['settings']['site_name'];
		$this->load->view($this->_subView.'index',$this->data);
	}

}
