<?php
class Category_menu extends Admin_Controller{
	public $_table_names = 'category_menu';		//set table name
	public $_subView = 'admin/category_menu/';	//set subview load 
	public $_redirect = '/category_menu';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		//check for employee permission


		//set left menu active on admin dashboard
		$this->data['active'] = 'News Management';
        $this->load->model(array('backend/category_menu_model'));


		//set link with function name
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

	}
    
    public function index(){
		//set title
		$this->data['name'] = 'Category Menu';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];


		//set lead view		
        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);
	}


    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->category_menu_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->category_menu_model->get_nested();
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    
    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
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
            $this->data['form_data'] = $this->category_menu_model->get_new();
            $this->data['form_data']->link = '';
            $this->data['form_data']->article_id = '';
			
        }
        
        // Set validation rules for form
        $rules = $this->category_menu_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$postArr = array('name','link','article_id');//'parent_id'
            $data = $this->comman_model->array_from_post($postArr);
            if($id == NULL)$data['order'] = $this->category_menu_model->max_order()+1;

            if($id == NULL){
                $data['on_date'] = date('Y-m-d');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
		///	printR($data);
			
            
            //$data['price'] = round($data['staff']+$data['coach']+$data['member'],2);
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			
			if(empty($this->data['form_data']->id))
	            $this->session->set_flashdata('success','Data has successfully created.');
			else
	            $this->session->set_flashdata('success','Data has successfully updated.');			
			//	die;
            redirect($this->data['_cancel']);
        }

		$string ="select id, name from news where section in('Featured Video','Blazers','Editorial','On The Beat') order by name asc";
		$this->data['article_data'] = $this->comman_model->get_query($string,false);
		

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
       
		$this->category_menu_model->delete($id);
            redirect($this->data['_cancel']);
	}
    
    
	
	function ajax_upload(){	//upload more img	
		$this->load->helper('string');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/properties';
		$config['allowed_types'] = '*';
		$new_name = 'properties_'.time();
		$config['file_name'] = $new_name;		
		
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '200000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('myfile')){
			$ret['result']= 'error';
			$ret['msg']= $this->upload->display_errors();
			//redirect('admin/add_coach');
		}
		else{
			$upload_info = $this->upload->data();
			$ret['result']= 'success';
			$ret['msg']= $upload_info['file_name'];
//			$ret['id'] = $this->comman_model->save('users_images', array('user_id'=>$user_id,'image'=>$upload_info['file_name']));
		}
	    echo json_encode($ret);		
	}


	//remove more image
	function delete_image(){
		$id = $this->input->post('id');
		$check_image = $this->comman_model->get_by('properties_image',array('img_id'=>$id),false,true);
		if($check_image){
			$this->comman_model->delete('properties_image',array('img_id'=>$id));
			$image = 'assets/uploads/properties/'.$check_image->filename;
			if(is_file($image))
    	    	unlink($image);
		}
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