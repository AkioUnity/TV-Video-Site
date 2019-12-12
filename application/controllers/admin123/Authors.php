<?php
class Authors extends Admin_Controller{
	public $_table_names = 'authors';		//set table name
	public $_subView = 'admin/authors/';	//set subview load 
	public $_redirect = '/authors';			//set link with controller file name
	public function __construct(){
		parent::__construct();
		//check for employee permission
		//set left menu active on admin dashboard
		$this->data['active'] = 'News Management';
        $this->load->model(array('news_model'));
		//set link with function name
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        $this->data['lang_id'] = $this->data['adminLangSession']['lang_id'];
		$this->checkPermissions('news_manage');
	}
    
    public function index(){
		//set title
		$this->data['name'] = 'Authors';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//set load datatable.js
		$this->data['table'] = true;
	    // Fetch all data
		$this->db->order_by('id','desc');
        $this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		//set lead view		
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}
    
    public function edit($id = NULL){
	    // Fetch a data or set a new one
	    if($id){
			//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		    // Fetch a data
            $this->data['form_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, true);
            if(!$this->data['form_data'])
	            redirect($this->data['_cancel']);
        }
        else{
			//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		    //set a new one
            $this->data['form_data'] = $this->news_model->get_new();
        }
        
        // Set validation rules for form
        $rules = $this->news_model->rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');
            $data =array();
			$postArr = array('name','description');
            $data = $this->comman_model->array_from_post($postArr);
//			printR($_POST);
            if($id == NULL){
		        $data['n_rand_id'] =  time().random_string('numeric',5);
                $data['on_date'] = date('Y-m-d');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
		///	printR($data);
			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/news');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
					$this->image_lib->clear();
				}
			}	
			
			if (!empty($_FILES['cover_image']['name'])){					
				$result =$this->comman_model->do_upload('cover_image','./assets/uploads/news');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['cover_image'] = $result[1];
					$this->image_lib->clear();
				}
			}	
			
            
            //$data['price'] = round($data['staff']+$data['coach']+$data['member'],2);
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			
/*			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->db->insert('properties_image', array('property_id'=>$id,'filename'=>$value));					
				}
			}*/
			if(empty($this->data['form_data']->id))
	            $this->session->set_flashdata('success','Data has successfully created.');
			else
	            $this->session->set_flashdata('success','Data has successfully updated.');			
			//	die;
            redirect($this->data['_cancel']);
        }
/*		if($id){
			$this->data['products_file'] = $this->comman_model->get_by('properties_image',array('property_id'=>$id),false);
		}*/
	   	$this->db->order_by('name','asc');
        $this->data['categories_data'] = $this->comman_model->get_by('news_category',array('parent_id'=>0),false);
		
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
    
    public function delete($id=false){
		if(!$id)
	        redirect($this->data['_cancel']);
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
       
		$this->db->delete($this->_table_names,array('id'=>$id));
            redirect($this->data['_cancel']);
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