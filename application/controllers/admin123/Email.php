<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends Admin_Controller {
	public $_table_names = 'email'; //set table name

	public $_mainView = 'admin/'; 	// set main admin folder in view
	public $_subView = 'admin/email/';	// set subview in views
	public $_redirect = '/email'; 		//set link 
	public function __construct(){
		parent::__construct();
		//set left menu active on admin dashboard
		$this->data['active'] = 'General Settings';

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

		//set link with function name
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
		
		//check employee permission
		$this->checkPermissions('general_setting');
		
	}

	function index(){
		//set name and title
        $this->data['name']		= 'Email Settings';
        $this->data['title'] 	= $this->data['name'].' | '.$this->data['settings']['site_name'];
		
		//get all data from email table
        $this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('deleted'=>0),FALSE,FALSE);
		
		//load view
        $this->data['subview']	= $this->_subView.'index';	
        $this->load->view($this->_mainView.'_layout_main',$this->data);               
    }
	
	function edit($id= false){
		//set name and title
        $this->data['name']= 'Email Settings';
        $this->data['title'] ='Edit Setting | '.$this->data['settings']['site_name'];

        if(!$id){
            redirect($this->data['_cancel']);
        }
        
		// fetch a data from email table
        $edit_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id),FALSE,TRUE);
        if(count($edit_data)==0){
            redirect($this->data['_cancel']);
        }
        $this->data['edit_data'] =$edit_data;

		//set rules
		$rules = array(
                    'subject' =>array('field'=>'subject','label'=>'Subject','rules'=>'trim|required'),
                    'message' =>array('field'=>'message','label'=>'Message','rules'=>'trim|required'),                    
                    ); 
		
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run()==TRUE){
			//fetch post data from form
            $post_data =$this->comman_model->array_from_post(array('subject','message')); 
			
			//update data 
            $this->comman_model->save($this->_table_names,$post_data,$id);
            $this->session->set_flashdata('success','Email has successfully updated.');
            redirect($this->data['_cancel']);
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'edit';	
        $this->load->view($this->_mainView.'_layout_main',$this->data);       
    }	
	

  	function checkPermissions($type= false,$is_redirect=false){//check employee permission
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