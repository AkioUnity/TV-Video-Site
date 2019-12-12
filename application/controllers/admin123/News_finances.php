<?php
class News_finances extends Admin_Controller{
	public $_table_names = 'news';		//set table name
	public $_subView = 'admin/news/';	//set subview load 
	public $_redirect = '/news_finances';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		//check for employee permission
		$this->checkPermissions('news_manage');


		//set left menu active on admin dashboard
		$this->data['active'] = 'News Management';
        $this->load->model(array('news_model'));
		$this->data['tab_active'] = 'Finances';


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
			//$this->db->where('admin_id',$this->data['admin_details']->id);
		}
	    // Fetch all data
		$this->db->order_by('id','desc');
        $this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('section'=>'Finances'),false);

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
            $this->data['products_file'] = $this->comman_model->get_by('news_image',array('news_id'=>$id),false,false,false);
        }
        else{
			//set title
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		    //set a new one
            $this->data['form_data'] = $this->news_model->get_new();
            $this->data['form_data']->author_id = '';
            $this->data['form_data']->tags = '';
            $this->data['form_data']->code = '';
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
			$postArr = array('name','sponsor_link','link','author_id','description','code','tags');
            $data = $this->comman_model->array_from_post($postArr);

/*			$data['tags'] = '';
			if($this->input->post('tags')){
				$data['tags']= implode(',',$this->input->post('tags'));
			}*/
			
            $data['section'] = 'Finances';

            $data['s_date'] = h_dateFormat($this->input->post('s_date'),'Y-m-d');
			$e_date = $this->input->post('e_date');
			if($e_date){
	            $data['e_date'] = h_dateFormat($e_date,'Y-m-d');
			}
			
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
					$this->image_lib->clear();
				}
			}	
			
			if(!empty($_FILES['sponsor_image']['name'])){
                $config['upload_path']      = 'assets/uploads/news/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('sponsor_image')){
                    if($_FILES['sponsor_image']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['sponsor']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

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
			
			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->db->insert('news_image', array('news_id'=>$id,'filename'=>$value));					
				}
			}

			if(empty($this->data['form_data']->id))
	            $this->session->set_flashdata('success','Data has successfully created.');
			else
	            $this->session->set_flashdata('success','Data has successfully updated.');			
			//	die;
            redirect($this->data['_cancel']);
        }


	   	$this->db->order_by('name','asc');
        $this->data['author_data'] = $this->comman_model->get_by('authors',array('enabled'=>1),false);


/*	   	$this->db->order_by('name','asc');
        $this->data['news_tag_list'] = $this->comman_model->get_by('news_tag',array('enabled'=>1),false);*/

		$this->data['subview'] = $this->_subView.'edit_finances';
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
	function delete_image(){
		$id = $this->input->get('id');
		$check_image = $this->comman_model->get_by('news_image',array('id'=>$id),false,true);
		if($check_image){
			$this->comman_model->delete('news_image',array('id'=>$id));
			$image = 'assets/uploads/news/'.$check_image->filename;
			if(is_file($image))
    	    	unlink($image);
		}
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
       
		$this->news_model->delete($id);
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