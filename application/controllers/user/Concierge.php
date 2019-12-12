<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

class Concierge extends Frontend_Controller{	
	public $_redirect = 'user/concierge';

	public $_subView = 'user/concierge/';
	public $_table_names = 'users_concierge';
	public $_mainView = 'user/_new_layout';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->data['active'] = 'channel';
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$this->data['_user_link'] = 'user';
        $this->data['_cancel'] = $this->_redirect;
	}

	function index(){
		$this->data['form_data'] = $form_data = $this->comman_model->get_by('users_concierge',array('user_id'=>$this->data['user_details']->id),false,true);

     	$rules = array(
        		'first_name' 					=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
			   );

	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$post1 = array('first_name','last_name','phone','email','description');
        	$post_data = $this->comman_model->array_from_post($post1);

			$post_data['production'] = json_encode($this->input->post('production'));
			$post_data['services'] = json_encode($this->input->post('services'));

			$post_data['user_id'] 		= $this->data['user_details']->id;
			$post_data['on_date'] 		= date('Y-m-d');
			$this->db->trans_start();
			if($form_data){
				$this->comman_model->save($this->_table_names,$post_data,$form_data->id);
			}
			else{
				$this->comman_model->save($this->_table_names,$post_data);
			}
			$this->db->trans_complete();
			$this->session->set_flashdata('success','Data has successfully submitted'); 
			redirect($this->data['_cancel']);
			die;
		}

        $this->data['name'] = 'Content Concierge';
        $this->data['subview'] = $this->_subView.'index';			
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
