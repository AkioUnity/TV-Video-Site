<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	public $data = array();
	function __construct()
	{
		parent::__construct();
        $this->data['site_name'] = config_item('site_name');
		$this->data['admin_link'] = 'admin123';	
		$this->load->model(array('backend/account_model'));

        $this->load->library('S3_upload');
        $this->load->library('S3');
    }

    function ajax_upload()
    {
        $ret = array();
        $dir = dirname($_FILES["myfile"]["tmp_name"]);
        $fileName = $dir . DIRECTORY_SEPARATOR . $_FILES["myfile"]["name"];
        rename($_FILES["myfile"]["tmp_name"], $fileName);
        $upload = $this->s3_upload->upload_file($fileName);
        if (!$upload) {
            $ret['result'] = 'error';
            $ret['msg'] = $this->upload->display_errors();
        } else {
            $ret['result'] = 'success';
            $ret['msg'] = $upload;
        }
        echo json_encode($ret);
    }
} 

class Admin_Controller extends MY_Controller{
	public function __construct(){
    	parent::__construct();
		date_default_timezone_set("Asia/Kolkata"); 
		$this->load->helper(array('language'));

		$this->clear_cache();

        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');

        $this->data['settings'] = $this->settings_model->get_fields();
		$this->data['set_meta'] = '';	
		$this->data['name'] = '';	
		$this->data['active'] = 'home';	
		$this->data['active_sub'] = '';	
		$this->lang->load("admin","english");


//		$this->data['admin_link'] = 'admin';	


        $detail = $this->session->all_userdata();
        if(isset($detail['admin_session']['id'])){
            $this->data['admin_details'] =  $this->comman_model->get_by('admin',array('id'=>$detail['admin_session']['id']),FALSE,TRUE);
        }
		

		if(!isset($detail['adminLangSession'])){
/*			$lang_code = $this->language_model->get_default();
			$lang_id = $this->language_model->get_id($lang_code);*/

			//set default lang

			$lang_code = 'en';
			$lang_id = 1;
			$this->session->set_userdata('adminLangSession',array('lang_code'=>$lang_code,'lang_id'=>$lang_id));
			$this->data['adminLangSession'] = array('lang_code'=>$lang_code,'lang_id'=>$lang_id);
		}
		else{
			$this->data['adminLangSession'] = $detail['adminLangSession'];
		}
		
		$exception_uris = array(
			$this->data['admin_link'].'/account/login', 
			$this->data['admin_link'].'/account/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			$logged_in = $this->session->userdata('admin_session');
			if((!isset($logged_in['loggedin']) || $logged_in['loggedin'] != true)){
				redirect('admin123/account/login','refresh');
			}
		}

        $this->data['print_lang_menu'] = $this->language_model->get_array();

		//seo _data
       	$this->data['title'] = $this->data['settings']['site_name'];
       	$this->data['seo_title'] = '';
       	$this->data['seo_keywords'] = '';
       	$this->data['seo_description'] = '';
    }

	
	function clear_cache(){
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
} 

class Frontend_Controller extends MY_Controller{
	public function __construct(){
    	parent::__construct();
		date_default_timezone_set("Asia/Kolkata"); 
        // Load stuff
        $this->load->model(array('settings_model'));
		$this->load->helper(array('language'));
        $this->data['settings'] = $this->settings_model->get_fields();


      	$this->data['seo_title'] = $this->data['settings']['meta_title'];
       	$this->data['seo_keywords'] = $this->data['settings']['keywords'];
       	$this->data['seo_description'] = $this->data['settings']['meta_description'];
		$this->data['title'] = $this->data['settings']['site_name'];	
		$this->data['set_meta'] = '';	
		$this->data['active'] = '';
        $detail= $this->data['session_data'] = $this->session->all_userdata();

		
		if(isset($detail['user_session'])){
			$this->data['user_session'] = $detail['user_session'];
			if(isset($detail['user_session']['id'])){
				$this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,TRUE);
				if(!$this->data['user_details']){
					$this->session->unset_userdata('user_session');						
				}
			}
        }
		
   }


	function clear_cache(){

        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");

        $this->output->set_header("Pragma: no-cache");		

    }



	function mainkAthleteMembership(){}



} 



?>