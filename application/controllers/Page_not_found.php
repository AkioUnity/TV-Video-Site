<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//for default controller file
class Page_not_found extends Frontend_Controller {
	public $_subView = 'templates/page_not_found/';
	public function __construct(){
		parent::__construct();
	}


	public function index($id = false){
		$this->data['title'] = $this->data['settings']['site_name'];
		$this->load->view($this->_subView.'index',$this->data);
	}

}
