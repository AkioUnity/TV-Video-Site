<?php
class Episodes extends Admin_Controller{
	public $_table_names = 'series_episode';		//set table name
	public $_subView = 'admin/episodes/';	//set subview load 
	public $_redirect = '/episodes';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		//check for employee permission


		//set left menu active on admin dashboard
		$this->data['active'] = 'News Management';
        $this->load->model(array('news_model','custom_model'));
		$this->data['tab_active'] = 'Episodes';

		//set link with function name
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        $this->data['lang_id'] = $this->data['adminLangSession']['lang_id'];
        $this->data['section_type'] = array('Leader','Masonry Collage','Featured Video','Blazers','Property News','On The Beat','Finances','Editorial');
        $this->data['length_type'] = array('sec','min','hours');
		$this->checkPermissions('news_manage');
	}
    
    public function index(){
		//set title
		$this->data['name'] = 'Episode manager';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//set load datatable.js
		$this->data['table'] = true;

		if($this->data['admin_details']->default==0){
		//	$this->db->where('admin_id',$this->data['admin_details']->id);
		}
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
            $this->data['form_data']->author_id = '';
            $this->data['form_data']->package_id = '';
            $this->data['form_data']->label = '';
            $this->data['form_data']->tags = '';
            $this->data['form_data']->meta = $this->data['form_data']->is_draft = '';
            $this->data['form_data']->episode = '';
            $this->data['form_data']->s_time = '';
            $this->data['form_data']->e_time = '';
            $this->data['form_data']->is_password = '';
            $this->data['form_data']->password = '';
            $this->data['form_data']->dates = date('d-m-Y');
			
            $this->data['form_data']->length = '0';
            $this->data['form_data']->length_type = '';
            $this->data['form_data']->is_top_pick = '';
			
			

            $this->data['form_data']->summary = '';
            $this->data['form_data']->video_link = '';
            $this->data['form_data']->is_featured_show = '';
            $this->data['form_data']->is_featured_video = '';
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
			$postArr = array('name','package_id','series_id','video_file','author_id','category','description','label','link','tags','video_link','s_time','e_time','episode','length','length_type','summary');
            $data = $this->comman_model->array_from_post($postArr);


            $data['s_date'] = h_dateFormat($this->input->post('s_date'),'Y-m-d');
			$e_date = $this->input->post('e_date');
			if($e_date){
	            $data['e_date'] = h_dateFormat($e_date,'Y-m-d');
			}

            $data['dates'] = h_dateFormat($this->input->post('dates'),'Y-m-d');

			$is_secure = $this->input->post('is_password');
            $data['is_password'] = 0;
            $data['password'] =  '';
			if($is_secure==1){
	            $data['password'] =  $this->input->post('password');
	            $data['is_password'] = 1;
			}


			$is_draft = $this->input->post('is_draft');
            $data['is_draft'] = 0;
			if($is_draft==1){
	            $data['is_draft'] = 1;
			}



			$is_feature = $this->input->post('is_featured_video');
            $data['is_featured_video'] = 0;
			if($is_feature==1){
	            $data['is_featured_video'] = 1;
			}


			$featured_show = $this->input->post('is_featured_show');
            $data['is_featured_show'] = 0;
			if($featured_show==1){
	            $data['is_featured_show'] = 1;
			}

			$is_top_pick = $this->input->post('is_top_pick');
            $data['is_top_pick'] = 0;
			if($is_top_pick==1){
	            $data['is_top_pick'] = 1;
			}

//			printR($_POST);
            if($id == NULL){
				$data['admin_id'] =  $this->data['admin_details']->id;
                $data['on_date'] = date('Y-m-d');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
		///	printR($data);
			if (!empty($_FILES['featured_video_image']['name'])){					
				$result =$this->comman_model->do_upload('featured_video_image','./assets/uploads/news');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['featured_video_image'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			
			if (!empty($_FILES['featured_image']['name'])){					
				$result =$this->comman_model->do_upload('featured_image','./assets/uploads/news');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['featured_image'] = $result[1];
				}
				$this->image_lib->clear();
			}	

			if (!empty($_FILES['square_image']['name'])){					
				$result =$this->comman_model->do_upload('square_image','./assets/uploads/news');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['square_image'] = $result[1];
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
          //  $this->news_model->save_tag($data['tags'],$id);
			
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


	   	$this->db->order_by('name','asc');
        $this->data['series_list'] = $this->comman_model->get_by('series',array('enabled'=>1),false);


	   	$this->db->order_by('name','asc');
        $this->data['packages_list'] = $this->comman_model->get_by('packages',array('enabled'=>1),false);

	   	$this->db->order_by('name','asc');
        $this->data['authors_list'] = $this->comman_model->get_by('authors',array('enabled'=>1),false);
		$this->data['time_data'] = $this->custom_model->get_time();

/*	   	$this->db->order_by('name','asc');
        $this->data['news_tag_list'] = $this->comman_model->get_by('news_tag',array('enabled'=>1),false);*/

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
    
	function ajax_upload(){		
		$this->load->helper('string');
		$id = $this->input->post('id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/news';
		$config['allowed_types'] = '*';
		
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '200000000000';
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
			
		}
	    echo json_encode($ret);		
	}

	
	function delete_video(){
		$arr = array('status'=>'error','msge'=>'There is no video!!');
		$id = $this->input->post('id');
		$check_image = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if($check_image){
			$arr = array('status'=>'ok');
			$this->db->where('id', $id);
			$this->db->set('video_file',NULL, TRUE);
			$this->db->update($this->_table_names);
			$image = 'assets/uploads/news/'.$check_image->video_file;
			if(is_file($image))
    	    	unlink($image);
		}
		echo json_encode($arr);
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