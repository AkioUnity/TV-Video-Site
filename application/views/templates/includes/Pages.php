<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Frontend_Controller {
	public $_subView = 'templates/pages/';
	public function __construct(){
		parent::__construct();
	}

	
	public function index($id = false){
		if(!$id){
			redirect('front');
		}

		//fetch data
		$this->data['page'] = $this->comman_model->get_by('page',array('slug'=>$id),false,true);

		//if change lang than check lang slug of page
		if(!$this->data['page']){
			redirect('front');
		}


		//set title data
		$this->data['title'] = $this->data['page']->name." | ".$this->data['settings']['site_name'];
		$this->data['seo_title'] = $this->data['page']->name;
/*		$this->data['seo_keywords'] = $this->data['page']->keywords;
		$this->data['seo_description'] = html_entity_decode($this->data['page']->short_description);*/

		//set load view
		if($this->data['page']->template=='courses'){
			$this->load->view('templates/courses/search',$this->data);
		}
		else{
			$this->load->view($this->_subView.$this->data['page']->template,$this->data);
		}
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */