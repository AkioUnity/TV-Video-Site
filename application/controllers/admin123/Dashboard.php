<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard extends Admin_Controller {



	public function __construct(){

    	parent::__construct();
        $this->data['title'] = 'Dashboard | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'home';	

		$this->data['active'] = 'home';	

    }



    public function index() {
        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/_layout_main', $this->data);

    }

    

    public function modal() {

        $this->load->view('admin/_layout_modal', $this->data);

    }

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */