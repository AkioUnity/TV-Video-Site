<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends Admin_Controller{
	public $_table_names = 'banners';			//set table name
	public $_subView = 'admin/banners/';		//set subview
	public $_redirect = '/banner';				//set controller link
    public $_current_revision_id;
	
	public function __construct(){
		parent::__construct();
		
		//set left menu active on admin dashboard
		$this->data['active'] = 'Content Management';
        $this->load->model(array('backend/banner_model'));

		//set link with function name
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
	}
    
    public function index()
	{
		//set title
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],319);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//set load view
        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);

	}
    
    
    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->banner_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->banner_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view('admin/banners/order_ajax', $this->data);
    }

    
    public function edit($id = NULL)
	{
	    // Fetch a data or set a new one
	    if($id)
        {
			//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['page'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, true);
			if(!$this->data['page']){
				redirect($this->data['_cancel']);
			}
        }
        else
        {
			//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			// set a new one
            $this->data['page'] = $this->banner_model->get_new();
        }

		//set type slider show
        $this->data['templates_page'] = $this->banner_model->get_templates();

        // Set up the form
        $rules = $this->banner_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){

			// get post data from form	
			$data = $this->banner_model->array_from_post(array('template', 'name','link','desc'));
            if($id == NULL)$data['order'] = $this->banner_model->max_order()+1;
           
		   	///update image
            if(!empty($_FILES['logo'])){
                $config['upload_path']      = 'assets/uploads/banners/';
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
			
			//create or update data
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			if(empty($this->data['page']->id))
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
		//set load view
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
 
     public function remove_image($id=false){//for remove image
		$path = 'assets/uploads/banners/';
		if(!$id)
			redirect($this->data['_cancel']);
		
		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if(!$check)
			redirect($this->data['_cancel']);
		$this->db->where(array('id'=>$id));
		$this->db->set('image', 'NULL', false);
		$this->db->update($this->_table_names);

		$file_dir = $path.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		redirect($this->data['_cancel'].'/edit/'.$id);
	}
   
    public function delete($id)	{//delete data
		$this->banner_model->delete($id);
		redirect($this->data['_cancel']);
	}
    
    
}