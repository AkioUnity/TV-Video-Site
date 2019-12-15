<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

class Shows extends Frontend_Controller{	
	public $_redirect = 'user/shows';

	public $_subView = 'user/shows/';
	public $_table_names = 'shows';
	public $_mainView = 'user/_new_layout';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->data['active'] = 'channel';
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = 'user';
        $this->data['_cancel'] = $this->_redirect;
        $this->data['_view'] = $this->_redirect.'/view';
        $this->perPage = 20;
		$this->data['userPermission'] = array();
		if(!empty($this->data['user_details']->permissions)){
			$this->data['userPermission'] = explode(',',$this->data['user_details']->permissions);
		}
	}

	function index(){
        $this->data['name'] = 'Shows';
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function l($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}


		$channels = $this->data['channels']  = $this->comman_model->get_by('channels',array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
		if(!$channels){
			redirect($this->data['_cancel']);
		}
		
        $this->data['name'] = 'Shows';
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function archived(){
        $this->data['tabName'] = 'Archived';
        $this->data['name'] = 'Shows';
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function drafts(){
        $this->data['tabName'] = 'Drafts';
        $this->data['name'] = 'Shows';
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function ajax_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;
		$where_clause = '';
		$url  = $this->data['_cancel'].'/ajax_list?';
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$where_clause = '';

		$g_s_date = $this->input->get('s_date');
		if($g_s_date){
			$where_clause .= 'date(on_date) >= (\''.$g_s_date.'\') and';
			$url .= 's_date='.$g_s_date.'&';
		}

        $g_e_date = $this->input->get('e_date');
		if($g_e_date){
			$where_clause .= ' date(on_date)  <= (\''.$g_e_date.'\') and';
			$url .= 'e_date='.$g_e_date.'&';
		}	

		$channel_id = $this->input->get('channel_id');
		if($channel_id){
			$url .= 'channel_id='.$channel_id.'&';
			$where_clause .= " channel_id ='".$channel_id."' and";
		}

		$show_type = $this->input->get('show_type');
		if($show_type){
			$url .= 'show_type='.$show_type.'&';
			if($show_type=='Archived'){
				$where_clause .= " is_delete=1 and";
			}
			else if($show_type=='Drafts'){
				$where_clause .= " is_delete=0 and is_draft=1  and";
			}
			else {
				$where_clause .= " is_delete=0 and";
			}
		}
		else {
			$where_clause .= " is_delete=0 and";
		}

		$sort = ' id desc';
		$output['result']= 'ok';


		$stringQuery = "SELECT *  FROM shows where user_id =".$this->data['user_details']->id;	

		$where_clause = rtrim($where_clause,'and');
		if($where_clause){
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and ".$where_clause." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." and ".$where_clause." ORDER BY $sort");
		}
		else{
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." ORDER BY $sort");
		}
			
		//echo $this->db->last_query();die;

		$output['html'] = $this->load->view($this->_subView.'ajax_list',$this->data,true);
		if(empty($output['html'])){
			$output['html'] ='';
		}

		$output['url'] =$url;
		echo json_encode($output);
		//echo $msg;	
	}

	function create($c_id=false){///not use now
		redirect($this->data['_cancel'].'/create_new');
	}
	
	function create_new(){
     	$rules = array(
        		'name' 					=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
			   );

	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');

			$post1 =array('tags','name','description','short_description','publish_date','category','series_number','episode_number','show_length','units','users','video_link','set_order','channel_id','s_date','e_date');
        	$data = $this->comman_model->array_from_post($post1);
			
			$video_file = $this->input->post('file_name');
			if(!$video_file){
				$video_file = '';
			}
			$data['video_file'] = $video_file;

			$data['is_featured']	= 0;
			if($this->input->post('is_featured')){
				$data['is_featured']	= 1;
			}

			$data['is_article']	= 0;
			if($this->input->post('is_article')){
				$data['is_article']	= 1;
			}

			$data['on_demand']	= 0;
			if($this->input->post('on_demand')){
				$data['on_demand']	= 1;
			}

			$data['is_complex']	= 0;
			if($this->input->post('is_complex')){
				$data['is_complex']	= 1;
			}
			$data['is_slider']	= 0;
			if($this->input->post('is_slider')){
				$this->db->where('channel_id',$data['channel_id']);
				$this->db->set('is_slider',0);
				$this->db->update($this->_table_names);

				$data['is_slider']	= 1;
			}

			$data['slug']			= url_title($data['name'], "dash", TRUE);
			$data['user_id'] 		= $this->data['user_details']->id;
			$data['on_date'] 		= date('Y-m-d');
			$data['rand_id'] 		= time().random_string('numeric',5);
			$data['is_draft'] 		= 0;
			if($this->input->post('draft')){
				$data['is_draft'] = 1;
			}

			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			
			$id = $this->comman_model->save($this->_table_names,$data);
			$this->session->set_flashdata('success','Data has successfully created.');
			redirect($this->data['_cancel']);
			die;
        }
		

		
		$string = "select id,channel_url,name,enabled from channels where user_id=".$this->data['user_details']->id;
		$this->data['channel_list'] = $this->comman_model->get_query($string,false);

		$string = "select id,name from shows_category where user_id=".$this->data['user_details']->id;
		$this->data['category_list'] = $this->comman_model->get_query($string,false);

		$this->data['name'] = show_static_text(1,800).'Create';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'create_new';	
		$this->load->view($this->_mainView,$this->data);
	}
	
	function edit($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$edit_form = $this->data['edit_form']  = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id,'is_delete'=>0),false,true);
		if(!$edit_form){
			redirect($this->data['_cancel']);
		}
		
     	$rules = array(
        		'name' 					=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');

			$post1 =array('tags','name','description','short_description','publish_date','category','series_number','episode_number','show_length','units','users','video_link','set_order','s_date','e_date','channel_id');
        	$data = $this->comman_model->array_from_post($post1);
			
			$video_file = $this->input->post('file_name');
			if(!$video_file){
				$video_file = '';
			}
			$data['video_file'] = $video_file;
			if (isset($data['video_link']))
                $data['video_link']=$data['video_file'];

			$data['is_featured']	= 0;
			if($this->input->post('is_featured')){
				$data['is_featured']	= 1;
			}

			$data['is_article']	= 0;
			if($this->input->post('is_article')){
				$data['is_article']	= 1;
			}

			$data['on_demand']	= 0;
			if($this->input->post('on_demand')){
				$data['on_demand']	= 1;
			}

			$data['is_draft'] 		= 0;
			if($this->input->post('draft')){
				$data['is_draft'] = 1;
			}
			
			$data['is_complex']	= 0;
			if($this->input->post('is_complex')){
				$data['is_complex']	= 1;
			}
			$data['is_slider']	= 0;
			if($this->input->post('is_slider')){
				$this->db->where('channel_id',$data['channel_id']);
				$this->db->set('is_slider',0);
				$this->db->update($this->_table_names);

				$data['is_slider']	= 1;
			}
			
			$data['slug']			= url_title($data['name'], "dash", TRUE);

			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			$this->comman_model->save($this->_table_names,$data,$edit_form->id);
			$this->session->set_flashdata('success','Data has successfully updated.');
			redirect($this->data['_cancel'].'/edit/'.$id);
			die;
        }

		$string = "select id,name from shows_category where user_id=".$this->data['user_details']->id;
		$this->data['category_list'] = $this->comman_model->get_query($string,false);


		$string = "select id,channel_url,name,enabled from channels where user_id=".$this->data['user_details']->id;
		$this->data['channel_list'] = $this->comman_model->get_query($string,false);
		
		$this->data['channels']  = $this->comman_model->get_by('channels',array('id'=>$edit_form->channel_id),false,true);
		
		$this->data['name'] = 'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view($this->_mainView,$this->data);
	}

	function edit_clone($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$edit_form = $this->data['edit_form']  = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id,'is_delete'=>0),false,true);
		if(!$edit_form){
			redirect($this->data['_cancel']);
		}
		
     	$rules = array(
        		'name' 					=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');

			$post1 =array('tags','name','description','short_description','publish_date','category','series_number','episode_number','show_length','units','users','video_link','set_order','s_date','e_date','channel_id');
        	$data = $this->comman_model->array_from_post($post1);
			
			$video_file = $this->input->post('file_name');
			if(!$video_file){
				$video_file = '';
			}
			$data['video_file'] = $video_file;

			$data['is_featured']	= 0;
			if($this->input->post('is_featured')){
				$data['is_featured']	= 1;
			}

			$data['is_article']	= 0;
			if($this->input->post('is_article')){
				$data['is_article']	= 1;
			}

			$data['on_demand']	= 0;
			if($this->input->post('on_demand')){
				$data['on_demand']	= 1;
			}

			$data['slug']			= url_title($data['name'], "dash", TRUE);
			$data['user_id'] 		= $this->data['user_details']->id;
			$data['on_date'] 		= date('Y-m-d');
			$data['rand_id'] 		= time().random_string('numeric',5);
//			$data['is_draft'] 		= 1;
			$data['is_draft'] 		= 0;
			if($this->input->post('draft')){
				$data['is_draft'] = 1;
			}

			$data['is_complex']	= 0;
			if($this->input->post('is_complex')){
				$data['is_complex']	= 1;
			}
			$data['is_slider']	= 0;
			if($this->input->post('is_slider')){
				$this->db->where('channel_id',$data['channel_id']);
				$this->db->set('is_slider',0);
				$this->db->update($this->_table_names);

				$data['is_slider']	= 1;
			}

			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			else{
				$data['image'] = $edit_form->image;
			}
			
			$this->comman_model->save($this->_table_names,$data);
			$this->session->set_flashdata('success','Data has successfully created.');
			redirect($this->data['_cancel']);
			die;
        }

		$string = "select id,name from shows_category where user_id=".$this->data['user_details']->id;
		$this->data['category_list'] = $this->comman_model->get_query($string,false);

		$string = "select id,channel_url,name,enabled from channels where user_id=".$this->data['user_details']->id;
		$this->data['channel_list'] = $this->comman_model->get_query($string,false);

		$this->data['channels']  = $this->comman_model->get_by('channels',array('id'=>$edit_form->channel_id),false,true);
		
		$this->data['name'] = 'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view($this->_mainView,$this->data);
	}

	function delete_video(){
		$arr = array('status'=>'error','msge'=>'There is no video!!');
		$id = $this->input->get('id');
		$check_image = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
		if($check_image){
			$arr = array('status'=>'ok');
			$this->db->where('id', $check_image->id);
			$this->db->set('video_file',NULL, TRUE);
			$this->db->update($this->_table_names);
			$image = 'assets/uploads/channels/'.$check_image->video_file;
			if(is_file($image))
    	    	unlink($image);
		}
		echo json_encode($arr);
	}

	function set_hero(){
		$output = array('status'=>'error','message'=>'there is no data.');

		$id = $this->input->get('id');
		if($id){
			$edit_form = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id,'is_delete'=>0),false,true);
			//printR($edit_form);
			if($edit_form){
				$output['status']  = 'ok';
				$output['message']  = '';

				$this->db->trans_start();
				$this->db->where('channel_id',$edit_form->channel_id);
				$this->db->set('is_slider',0);
				$this->db->update($this->_table_names);

				$this->db->where('id',$edit_form->id);
				if($edit_form->is_slider==1){
					$this->db->set('is_slider',0);
				}
				else{
					$this->db->set('is_slider',1);
				}
				$this->db->update($this->_table_names);
				$this->db->trans_complete();
			}
		}
		echo json_encode($output);
	}	
	
	function delete($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		$edit_form = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id,'is_delete'=>0),false,true);
		if(!$edit_form){
			redirect($this->data['_cancel']);
		}


		$this->db->trans_start();
		$this->db->where(array('id'=>$edit_form->id));
		$this->db->update($this->_table_names,array('is_delete'=>1));
		$this->db->trans_complete();

		$this->session->set_flashdata('success',show_static_text(1,297)); 
		redirect($this->data['_cancel']);
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
