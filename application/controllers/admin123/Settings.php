<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends Admin_Controller {
	public $_table_names = 'l_settings';
	public $_subView = 'admin/settings/';
	public $_redirect = '/Settings';
	public function __construct(){
		parent::__construct();
        $this->data['active']= 'General Settings';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->load->model(array('settings_model'));
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$this->checkPermissions('general_setting');
	}
	function index(){
		
		$this->load->library('image_lib');
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],162);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'General Settings';
        $this->data['active_sub']= 'website';
        $rules = $this->settings_model->setting_rules;
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()==TRUE){
            //$data = $this->settings_model->array_from_post($this->settings_model->get_post_from_rules($rules)+array('footer_text','phone','address'));
            $data = $this->settings_model->array_from_post(array_merge($this->settings_model->get_post_from_rules($rules),array('phone','address','gps','website_active','website_desc','analytic_code')));
            if(!empty($_FILES['logo']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['logo']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }
            }else{
                $data['logo']  = $this->data['settings']['logo'];
            }      
			if(!empty($_FILES['dark_logo']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('dark_logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['dark_logo']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }
            }      
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],294));
            redirect($this->data['_cancel']);
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/setting';        
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
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */