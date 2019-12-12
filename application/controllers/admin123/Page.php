<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');
ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);
class Page extends Admin_Controller{
	public $_table_names 	= 'page';					//set table 	
	public $_subView		= 'admin/page/';			//set subview
	public $_mainView 		= 'admin/_layout_main';		//set mainview
	public $_redirect		= '/page';					//set controller link
	
	public function __construct(){
		parent::__construct();
		//set left menu active on admin dashboard
		$this->data['active'] = 'Content Management';
        $this->load->model(array('backend/pages_model'));
		//set left menu active on admin dashboard
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
		//set link with function name
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$this->data['lang_id'] = $this->data['adminLangSession']['lang_id'];
		
		///check employee permission
		$this->checkPermissions('content_manage');
        
	}
    
    public function index()
	{
		//set title
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],182);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);
	}
    
    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->pages_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->pages_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view('admin/page/order_ajax', $this->data);
    }
	
	
    public function edit($id = NULL){
		$data = array();
	    // Fetch a page or set a new one
	    if($id){
		//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['page'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, true);
            if(!$this->data['page']) 
	            redirect($this->data['_cancel']);
            
        }
        else{
		//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			// set a new one
            $this->data['page'] = $this->pages_model->get_new();
        }
        
       
        $this->data['templates_page'] = $this->pages_model->get_templates('page_');
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->pages_model->rules;
        $this->form_validation->set_rules($this->pages_model->get_all_rules());
        // Process the form
        if($this->form_validation->run() == TRUE){
			// get post data from form	
			$data = $this->comman_model->array_from_post(array('template','top_menu','bottom_menu','name','description'));
            if($id == NULL)$data['order'] = $this->pages_model->max_order()+1;
			$data['slug'] = url_title($data['name'], "dash", TRUE);
           
		   //upload image
            if(!empty($_FILES['logo'])){
                $config['upload_path']      = 'assets/uploads/pages/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo'))
                {
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else
                {
                    $upload_data    = $this->upload->data();
                //    $this->session->set_flashdata('message', 'Your file has been successfully uploaded.');
                    $data['image']  = $upload_data['file_name'];
                }
            }else{
                $data['image']  = $this->data['page']->image;
            }      
			
			//save or update data
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			if(empty($this->data['page']->id))
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
        // Load the view
		$this->data['subview'] = 'admin/page/edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
	function ajax_upload(){	//upload more img	
		$this->load->helper('string');
		$id = $this->input->post('id');
		$page_id = $this->input->post('page_id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/pages';
		$config['allowed_types'] = '*';
		
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
			$ret['id'] = $this->comman_model->save('page_files', array('page_id'=>$page_id,'filename'=>$upload_info['file_name']));
		}
	    echo json_encode($ret);		
	}
	function refresh(){//set img html
		$id = $this->input->post('id');
		$page_id = $this->input->post('page_id');
		echo '<li class="item" id="product_image_'.$page_id.'" data-id="'.$page_id.'" >
			<div class="pi-img-wrapper">
			<img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/pages/'.$id.'"></a>
			</div>
			<div class="file-option" style="text-align:center">
			<button  class="btn btn-default" onclick="delete_image('.$page_id.')" href="javascript:void(0)" style="margin-top:10px">Delete</button>
			</div>
			</il>';
	}
	//set img order data
    public function file_order(){
		$id = $this->input->get('page_id');
		$files_order = $this->input->get('order');
        $data = array();
		$files = $this->comman_model->get_by('page_files',array('page_id' => $id),false,false,false);
		foreach($files_order as $order=>$filename){
			foreach($files as $file)
			{
				if($filename == $file->id){
					$this->comman_model->save('page_files',array('order' => $order,),$file->id);
					break;
				}
			}
		}
        echo json_encode($data);
	}
	//remove more image
	function delete_image(){
		$id = $this->input->post('id');
		$check_image = $this->comman_model->get_by('page_files',array('id'=>$id),false,false,true);
		if($check_image){
			$this->comman_model->delete('page_files',array('id'=>$id));
			$image = 'assets/uploads/pages/'.$check_image->filename;
			if(is_file($image))
    	    	unlink($image);
		}
	}
	
	//delete image
    public function remove_image($id=false){
		if(!$id)
			redirect($this->data['_cancel']);
		
		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$check)
			redirect($this->data['_cancel']);
		$this->db->where(array('id'=>$id));
		$this->db->set('image', 'NULL', false);
		$this->db->update($this->_table_names);
		$file_dir ='assets/uploads/pages/'.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		redirect($this->data['_cancel'].'/edit/'.$id);
	}
	
	//delete data
    public function delete($id)
	{
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		
		$this->pages_model->delete($id);
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