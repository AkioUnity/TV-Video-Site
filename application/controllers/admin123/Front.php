<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Front extends admin_Controller {

	public function __construct(){

		parent::__construct();



		//$this->check_lang();

	}

	public function index(){

		redirect($this->data['admin_link'].'/dashboard');

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */