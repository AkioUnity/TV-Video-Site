<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class paypal_setting extends Admin_Controller {
	public $_table_names = 'paypal_setting';
	public $_subView = 'admin/paypal_setting/';
	public $_redirect = '/paypal_setting';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'admin';
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
		
		$this->data['active'] = 'General Settings';
		$this->checkPermissions('general_setting');

    }
	

	//  Landing page of admin section.
	function index(){
	    // Fetch a page or set a new one
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],2540).'Paypal Setting';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['paypal']  = $this->comman_model->get_by($this->_table_names,array('id'=>1),false,true);
        
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('signature','Signature','trim|required');
/*        $this->form_validation->set_rules('bingo_price','Slot Price','numeric|trim|required');
        $this->form_validation->set_rules('bingo_price','Bingo Price','trim|required');*/

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$post1 =array('username','signature','sandbox','password');

        	$data = $this->comman_model->array_from_post($post1);
            $id = $this->comman_model->save($this->_table_names,$data,1);



			if(empty($this->data['paypal']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
            redirect($this->data['_cancel']);
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}


  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */