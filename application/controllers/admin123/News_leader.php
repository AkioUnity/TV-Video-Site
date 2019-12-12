<?php
class News_leader extends Admin_Controller{
	public $_table_names = 'news';		//set table name
	public $_subView = 'admin/news/';	//set subview load 
	public $_redirect = '/news_leader';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		//check for employee permission

		$this->checkPermissions('news_manage');

		//set left menu active on admin dashboard
		$this->data['active'] = 'News Management';
        $this->load->model(array('news_model'));
		$this->data['tab_active'] = 'Leader';
		$this->data['is_set_order'] = true;


		//set link with function name
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        $this->data['lang_id'] = $this->data['adminLangSession']['lang_id'];
        $this->data['section_type'] = array('Leader','Masonry Collage','Featured Video','Blazers','Property News','On The Beat','Finances','Editorial');

	}
    
    public function index(){
		//set title
		$this->data['name'] = 'News';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//set load datatable.js
		$this->data['table'] = true;

		if($this->data['admin_details']->default==0){
		//	$this->db->where('admin_id',$this->data['admin_details']->id);
		}

	    // Fetch all data
		$this->db->order_by('id','desc');
        $this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('section'=>'Leader'),false);

		//set lead view		
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	public function orders(){
		$this->data['name'] = 'News';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['news_type'] = 'Leader';

        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);
	}

    
	public function order_ajax (){
        if (isset($_POST['sortable'])) {
            $this->news_model->save_order($_POST['sortable']);
        }
        $this->data['pages'] = $this->news_model->get_nested($this->input->post('type'));
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }    
	
    public function edit($id = NULL){
	    // Fetch a data or set a new one
	    if($id){
			//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		    // Fetch a data
            $this->data['form_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'section'=>'Leader'), FALSE, true);
            if(!$this->data['form_data'])
	            redirect($this->data['_cancel']);
        }
        else{
			//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		    //set a new one
            $this->data['form_data'] = $this->news_model->get_new();
            $this->data['form_data']->is_home = 1;
            $this->data['form_data']->is_presenter = 1;
			
            $this->data['form_data']->author_id = '';
            $this->data['form_data']->article_id = '';
            $this->data['form_data']->head_title = '';
            $this->data['form_data']->tags = '';
            $this->data['form_data']->code = '';
			
            $this->data['form_data']->description_2 = '';
            $this->data['form_data']->s_date = date('d-m-Y');
            $this->data['form_data']->e_date = h_addDate(date('d-m-Y'),'day',30,'d-m-Y');
        }
        
        // Set validation rules for form
        $rules = $this->news_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');
            $data =array();
			$postArr = array('name','link','description','description_2','code','article_id','v_link','head_title','tags');
            $data = $this->comman_model->array_from_post($postArr);

/*			$data['tags'] = '';
			if($this->input->post('tags')){
				$data['tags']= implode(',',$this->input->post('tags'));
			}*/

//            if($id == NULL)$data['order'] = $this->news_model->max_order()+1;

            $data['s_date'] = h_dateFormat($this->input->post('s_date'),'Y-m-d');
			$e_date = $this->input->post('e_date');
			if($e_date){
	            $data['e_date'] = h_dateFormat($e_date,'Y-m-d');
			}

			$data['is_home'] = 0;
			$is_home = $this->input->post('is_home');
			if($is_home==1){
				$data['is_home'] = 1;
			}

			$data['is_presenter'] = 0;
			$is_presenter = $this->input->post('is_presenter');
			if($is_presenter==1){
				$data['is_presenter'] = 1;
			}

            $data['section'] = 'Leader';
//			printR($_POST);
            if($id == NULL){
				$data['admin_id'] =  $this->data['admin_details']->id;
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
				}

				$this->image_lib->clear();
			}	
			
			if (!empty($_FILES['article_image']['name'])){					
				$result =$this->comman_model->do_upload('article_image','./assets/uploads/news');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['article_image'] = $result[1];
				}
			}	
            
            
			
            //$data['price'] = round($data['staff']+$data['coach']+$data['member'],2);
            $id = $this->comman_model->save($this->_table_names,$data,$id);
            $this->news_model->save_tag($data['tags'],$id);
			
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

/*	   	$this->db->order_by('name','asc');
        $this->data['categories_data'] = $this->comman_model->get_by('news_category',array('parent_id'=>0),false);*/
	
	   	$this->db->order_by('name','asc');
        $this->data['author_data'] = $this->comman_model->get_by('authors',array('enabled'=>1),false);

		$string ="select id, name from news where section in('Featured Video','Blazers','Editorial','On The Beat') order by name asc";
		$this->data['article_data'] = $this->comman_model->get_query($string,false);
		

/*	   	$this->db->order_by('name','asc');
        $this->data['news_tag_list'] = $this->comman_model->get_by('news_tag',array('enabled'=>1),false);*/

		$this->data['subview'] = $this->_subView.'edit_leader';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
    
    public function delete($id=false){
		if(!$id)
	        redirect($this->data['_cancel']);

		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
       
		$this->news_model->delete($id);
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