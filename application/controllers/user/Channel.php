<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

class Channel extends Frontend_Controller{	
	public $_redirect = 'user/channel';

	public $_subView = 'user/channels/';
	public $_table_names = 'channels';
	public $_mainView = 'user/_new_layout';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
        $this->load->model(array('upload_model'));

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
        $this->data['name'] = 'Channel';
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

		$name = $this->input->get('q');
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " (lower(name) like '%".strtolower($name)."%' or lower(id) like '%".strtolower($name)."%'  ) and";
		}


		$sort = ' id desc';
		$output['result']= 'ok';

		$stringQuery = "SELECT *  FROM channels where user_id =".$this->data['user_details']->id;	
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

	function create_new(){
		$countChannel =  print_count('channels',array('user_id'=>$this->data['user_details']->id));
		if($countChannel>=$this->data['user_details']->channels_create){
			$this->session->set_flashdata('error','Your account allows for '.$this->data['user_details']->channels_create.' channels only, please upgrade your account.'); 
			redirect($this->data['_cancel']);
		}

		
		$this->data['name'] = show_static_text(1,800).'Create';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'create_new';
		$this->load->view($this->_mainView,$this->data);
	}

	
	function ajax_limit_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'ok';
		$stringQuery = "SELECT *  FROM channels where user_id =".$this->data['user_details']->id.' limit 4';
		$this->data['all_data'] = $this->comman_model->get_query($stringQuery,false);
		$output['html'] = $this->load->view($this->_subView.'ajax_limit_list',$this->data,true);
		echo json_encode($output);
	}
	
	function ajax_create_category(){
		$output = array('status'=>'error','message'=>'There is some problem.');

		$post1 =array('name','set_order');
		$data = $this->comman_model->array_from_get($post1);
		$data['user_id'] 		= $this->data['user_details']->id;
		$data['on_date'] 		= date('Y-m-d');
		$this->comman_model->save('shows_category',$data);
		$output = array('status'=>'ok','message'=>'data has successfully created');
		echo json_encode($output);die;
	}
	
	function ajax_create(){
		$output = array('status'=>'error','message'=>'There is some problem.');
		$countChannel =  print_count('channels',array('user_id'=>$this->data['user_details']->id));
		if($countChannel>=$this->data['user_details']->channels_create){
			$output = array('status'=>'error','message'=>'Your account allows for '.$this->data['user_details']->channels_create.' channels only, please upgrade your account.');
			echo json_encode($output);die;
		}

		$post1 =array('name','tags','name','channel_url');
		$data = $this->comman_model->array_from_get($post1);
		$data['channel_url']	= strtolower(url_title($data['channel_url'], "dash", TRUE));
		
		$data['type'] 			= 'TV Channel';
		$data['user_id'] 		= $this->data['user_details']->id;
		$data['on_date'] 		= date('Y-m-d');
		$data['rand_id'] 		= time().random_string('numeric',5);
		$data['enabled'] 		= 0;
		$this->comman_model->save($this->_table_names,$data);
		$output = array('status'=>'ok','message'=>'data has successfully created');
		echo json_encode($output);die;
	}
	
	function create(){
		$countChannel =  print_count('channels',array('user_id'=>$this->data['user_details']->id));
		if($countChannel>=$this->data['user_details']->channels_create){
			$this->session->set_flashdata('error','Your account allows for '.$this->data['user_details']->channels_create.' channels only, please upgrade your account.'); 
			redirect($this->data['_cancel']);
		}
     	$rules = array(
        		'name' 					=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim'),
			   );

	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->load->library('image_lib');

			$post1 =array('type','tags','name','payoff_desc','channel_url','description','short_description','complex_name');
        	$data = $this->comman_model->array_from_post($post1);
			$data['channel_url']	= strtolower(url_title($data['channel_url'], "dash", TRUE));
			$data['user_id'] 		= $this->data['user_details']->id;
			$data['on_date'] 		= date('Y-m-d');
			$data['rand_id'] 		= time().random_string('numeric',5);
			$data['enabled'] 		= 0;

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
			
			if (!empty($_FILES['image_2']['name'])){					
				$result =$this->comman_model->do_upload('image_2','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image_2'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['logo'] = $result[1];
				}
				$this->image_lib->clear();
			}	

			if (!empty($_FILES['subscribe_image']['name'])){					
				$result =$this->comman_model->do_upload('subscribe_image','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['subscribe_image'] = $result[1];
				}
				$this->image_lib->clear();
			}	

			$data['is_draft'] = 0;
			if($this->input->post('draft')){
				$data['is_draft'] = 1;
			}
			
			$id = $this->comman_model->save($this->_table_names,$data);
			$this->session->set_flashdata('success','Data has successfully created.');
			redirect($this->data['_cancel']);
			die;
        }
		$this->data['name'] = show_static_text(1,800).'Create';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'create';	
		$this->load->view($this->_mainView,$this->data);
	}
	
	function edit($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$edit_form = $this->data['edit_form']  = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
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

			$post1 =array('type','tags','name','payoff_desc','channel_url','description','short_description','complex_name');
        	$data = $this->comman_model->array_from_post($post1);
			$data['channel_url']	= strtolower(url_title($data['channel_url'], "dash", TRUE));

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
			
			if (!empty($_FILES['image_2']['name'])){					
				$result =$this->comman_model->do_upload('image_2','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image_2'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['logo'] = $result[1];
				}
				$this->image_lib->clear();
			}

			if (!empty($_FILES['subscribe_image']['name'])){					
				$result =$this->comman_model->do_upload('subscribe_image','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['subscribe_image'] = $result[1];
				}
				$this->image_lib->clear();
			}	

			$data['is_draft'] = 0;
			$send_btn = $this->input->post('draft'); 
			if($send_btn){
				$data['is_draft'] = 1;
			}
			$this->comman_model->save($this->_table_names,$data,$edit_form->id);
			$this->session->set_flashdata('success','Data has successfully updated.');
			redirect($this->data['_cancel'].'/edit/'.$id);
			die;
        }
		$this->data['name'] = 'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view($this->_mainView,$this->data);
	}
	
	function edit_clone($id=false){
		$countChannel =  print_count('channels',array('user_id'=>$this->data['user_details']->id));
		if($countChannel>=$this->data['user_details']->channels_create){
			$this->session->set_flashdata('error','Your account allows for '.$this->data['user_details']->channels_create.' channels only, please upgrade your account.'); 
			redirect($this->data['_cancel']);
		}

		if(!$id){
			redirect($this->data['_cancel']);
		}

		$edit_form = $this->data['edit_form']  = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
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

			$post1 =array('type','tags','name','payoff_desc','channel_url','description','short_description','complex_name');
        	$data = $this->comman_model->array_from_post($post1);
			$data['channel_url']	= url_title($data['channel_url'], "dash", TRUE);
			$data['on_date'] 		= date('Y-m-d');
			$data['user_id'] 		= $this->data['user_details']->id;
			$data['rand_id'] 		= time().random_string('numeric',5);

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
			
			if (!empty($_FILES['image_2']['name'])){					
				$result =$this->comman_model->do_upload('image_2','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image_2'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			else{
				$data['image_2'] = $edit_form->image_2;
			}
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/channels');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['logo'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			else{
				$data['logo'] = $edit_form->logo;
			}
			
			$data['is_draft'] = 0;
			$send_btn = $this->input->post('draft'); 
			if($send_btn){
				$data['is_draft'] = 1;
			}
			$this->comman_model->save($this->_table_names,$data);
			$this->session->set_flashdata('success','Data has successfully created.');
			redirect($this->data['_cancel']);
			die;
        }
		$this->data['name'] = 'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view($this->_mainView,$this->data);
	}
	

	function delete($id = false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		$edit_form = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
		if(!$edit_form){
			redirect($this->data['_cancel']);
		}

		$this->db->delete($this->_table_names,array('id'=>$edit_form->id));
		$this->db->delete('shows',array('channel_id'=>$edit_form->id));

		$this->session->set_flashdata('success',show_static_text(1,297)); 
		redirect($this->data['_cancel']);		
	}	


	function set_active(){
		$output = array('status'=>'error','message'=>'there is no data.');

		$id = $this->input->get('id');
		if($id){
			$edit_form = $this->comman_model->get_by($this->_table_names,array('rand_id'=>$id,'user_id'=>$this->data['user_details']->id),false,true);
			//printR($edit_form);
			if($edit_form){
				$output['status']  = 'ok';
				$output['message']  = '';

				$this->db->trans_start();
				$this->db->where('user_id',$this->data['user_details']->id);
				$this->db->set('enabled',0);
				$this->db->update($this->_table_names);

				
				$this->db->where('id',$edit_form->id);
				if($edit_form->enabled==1){
					$this->db->set('enabled',0);
				}
				else{
					$this->db->set('enabled',1);
				}
				$this->db->update($this->_table_names);
				$this->db->trans_complete();
			}
		}
		echo json_encode($output);
	}	


	function check_channel_url(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
//			exit('No direct script access allowed');
		}
		$channel_url = $this->input->get('channel_url');
		$id = $this->input->get('id');
		if($channel_url){
			$string = "select channel_url from channels where lower(channel_url) ='".strtolower(url_title($channel_url, "dash", TRUE))."'";
			if($id){
				$string = "select channel_url from channels where lower(channel_url) ='".strtolower(url_title($channel_url, "dash", TRUE))."' and id !=".$id;
			}
			$checkUrl = $this->comman_model->get_query($string,false);
			if ($checkUrl) {
				echo json_encode(FALSE);die;
			} else {
				echo json_encode(TRUE);
			}
		}
		else{
			echo json_encode(FALSE);
		}
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
