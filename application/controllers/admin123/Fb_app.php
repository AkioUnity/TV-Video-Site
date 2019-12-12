<?php
class Fb_app extends Admin_Controller{
	public $_table_names = 'home_images';
	public $_subView = 'admin/default_image/';
	public $_redirect = '/fb_app';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'General Settings';
        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$this->checkPermissions('general_setting');
	}
	function index(){
		$rules = array(
					'fb_app' =>array('field'=>'fb_app','label'=>'fb_app','rules'=>'trim|required'),
				   );

		$this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post1 =array('fb_app');
        	$post_data = $this->comman_model->array_from_post($post1);
	        $this->settings_model->save_settings($post_data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],294));
            redirect($this->data['_cancel']);
		}
        $this->data['name'] = 'FB App';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'General Settings';
        $this->data['subview'] = 'admin/dashboard/fb_app';
        $this->load->view('admin/_layout_main',$this->data);       
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