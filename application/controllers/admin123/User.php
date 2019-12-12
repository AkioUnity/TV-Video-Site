<?php
class User extends Admin_Controller{
	public $_table_names = 'users';		//set table name
	public $_subView = 'admin/users/';	//set subview load 
	public $_redirect = '/user';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		//check for employee permission


		//set left menu active on admin dashboard
		$this->data['active'] = 'User Management';
        $this->load->model(array('user_model'));


		//set link with function name
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
		$this->data['permissions']	= array( 'channel' => 'Channel','shows'=>'Shows','users'=>'Users','concierge'=>'Concierge','broadcasting'=>'Broadcasting');
        $this->perPage = 20;
	}
    
    public function index(){
		//set title
		$this->data['name'] = 'User';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

/*		$this->db->order_by('id','desc');
        $this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
*/
		//set lead view		
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function ajax_get_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;

		//$msg = 0;
		$url = $this->data['_cancel'].'/ajax_get_list?';
		$where_clause = '';
        $get_user_id = $this->input->get('user_id');
		$url .= 'user_id='.$get_user_id.'&';

        $name = $this->input->get('q');
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " (lower(first_name) like '%".strtolower($name)."%' or lower(email) like '%".strtolower($name)."%' or phone like '%".$name."%') and";
		}

		

		$this->data['list_data'] = $this->perPage;
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$sort_by = ' ORDER BY id desc ';
		
		$output['result']= 'ok';
		$stringQuery = "SELECT * from ".$this->_table_names."
						WHERE account_type= 'U' ";	

		$where_clause = rtrim($where_clause,'and');
		
		if($where_clause){
			//	echo $stringQuery." ORDER BY job_id desc limit $offset, ".$this->perPage;
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and  ".$where_clause." ".$sort_by." limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." and ".$where_clause."  ".$sort_by." ");
		}
		else{
			//	echo $stringQuery." ORDER BY job_id desc limit $offset, ".$this->perPage;
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ".$sort_by." limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." ".$sort_by." ");
		}
		//echo $this->db->last_query();die;
		$output['html'] = $this->load->view($this->_subView.'ajax_list',$this->data,true);
		$output['url']= $url;
		echo json_encode($output);
	}

	function set_user($id){
		if(!$id)
			redirect($this->data['_cancel']);
			$this->comman_model->save($this->_table_names,array('confirm'=>'confirm'),$id);
			redirect($this->data['_cancel']);		
	}


	//set a new one
	function create(){
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['users_form'] = '';

        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
	
		//set rules
        $rules = $this->user_model->create_admin;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			//get post data
			$user_post =array('first_name','last_name','phone','email','password','city','address','country','channels_create');
			
			$post_data= $this->comman_model->array_from_post($user_post);
			$post_data['admin_id'] 		= $this->data['admin_details']->id;
			$post_data['username'] 		= $post_data['first_name'].' '.$post_data['last_name'];
			$post_data['account_type'] 	= 'U';
			$post_data['type']			= 'User';
			$post_data['confirm']		= 'confirm';
			$post_data['status']		= 1;
			$post_data['created_by']	= 'admin';

			$post_data['user_checkbox'] = json_encode($this->input->post('options'));

			$post_data['permissions'] = '';
			$amenities = $this->input->post('permissions');
			if($amenities){
				$post_data['permissions'] = implode(',',$amenities);
			}


			//insert data
            $user_id = $this->comman_model->save($this->_table_names,$post_data);
			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel']);
			//die;
        }

		$this->data['subview'] = $this->_subView.'create';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	function edit($id= NULL){
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			if($this->data['admin_details']->default=='0'){
				$this->data['users_form']  = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'admin_id'=>$this->data['admin_details']->id),false,true);
			}
			else{
	            $this->data['users_form'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
			}

            if(!$this->data['users_form']){
	            redirect($this->data['_cancel']);
			}
			//$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['stores']->user_id),false,true);
        }
        else
        {
			redirect($this->data['_cancel']);
        }


        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->user_model->update_admin;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$user_post =array('first_name','last_name','phone','city','address','country','channels_create');
			
			$post_data= $this->comman_model->array_from_post($user_post);
			$post_data['username'] 		= $post_data['first_name'].' '.$post_data['last_name'];
			$post_data['user_checkbox'] = json_encode($this->input->post('options'));

			$approved_channel =$this->input->post('approved_channel');
			if($approved_channel){
				$post_data['approved_channel'] = 1;
			}
			else{
				$post_data['approved_channel'] = 0;
			}

			$post_data['permissions'] = '';
			$amenities = $this->input->post('permissions');
			if($amenities){
				$post_data['permissions'] = implode(',',$amenities);
			}
			
            $this->comman_model->save($this->_table_names,$post_data,$id);

			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edit/'.$id);
			//die;
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	//set send to user
	function send_mail($id =false){
		if(!$id){
            redirect($this->data['_cancel']);			
		}
		
	
		$checkUser = $this->comman_model->get_by('users',array('id'=>$id),false,true);
		if(!$checkUser){
			$this->session->set_flashdata('error','There is no user!!');
            redirect($this->data['_cancel']);			
			
		}

		$email_data = $this->comman_model->get_by('email',array('id'=>3),false,true);
				
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);
		
		$email_data->message = str_replace('{user_name}', $checkUser->first_name.' '.$checkUser->last_name, $email_data->message);
		$email_data->message = str_replace('{user_email}', $checkUser->email, $email_data->message);
		$email_data->message = str_replace('{password}', $checkUser->password, $email_data->message);
		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
		$email_data->message = str_replace('{login_link}', base_url(), $email_data->message);
		//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
		//echo $checkUser->email.' '.$this->data['settings']['site_email'];die;
		//echo $email_data->message;die;
		$this->load->library('email');
		$config12 = array (
		  'mailtype' => 'html',
		  'charset'  => 'utf-8',
		  'priority' => '1'
		   );
		$this->email->initialize($config12);
		//echo $email_data->subject;

		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to($checkUser->email);
		//$this->email->to('pvsysgroup01@gmail.com');
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		
		if($this->email->send()){
			$this->session->set_flashdata('success','mail has successfully sent!!');
		}
		else{
			$this->session->set_flashdata('error','There is some problem to sent mail!!');
		}

		redirect($this->data['_cancel']);			
	}

	function get_comfirm($id){
		if(!$id){
			redirect($this->data['_cancel'].'/reseller');
		}
		
		$result = $this->comman_model->save($this->_table_names,array('admin_confirm'=>1),$id);
		redirect($this->data['_cancel'].'/reseller');
	}

	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('status'=>$this->input->post('status'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}

	
	function get_set_data(){
		$msge = array();
		$msge['status']= 'error';

		
		$id = $this->input->post('id');
		$check_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if($check_data){
			if($check_data->admin_confirm==1){
				$post_data = array('admin_confirm'=>0);
			}
			elseif($check_data->admin_confirm==0){
				$post_data = array('admin_confirm'=>1);
			}
			else{
				$post_data = array('admin_confirm'=>1);
			}
			$msge['status']= 'ok';
			$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
		}
		echo json_encode($msge);
	}
	

	function delete($id = false){
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$this->db->delete($this->_table_names,array('id'=>$id));

		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect($this->data['_cancel']);		

	}

	function change_password($id=false){
		if(!$id){
			redirect($this->data['_canel']);
		}
		$checkUser = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if(!$checkUser){
			redirect($this->data['_canel']);
		}
		
		$rules = array(
//                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|callback__unique_email'),
					'password' =>array('field'=>'password','label'=>'password','rules'=>'trim|required'),
		   );

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('password'));
			$this->comman_model->save('users',$post_data,$id);
		
			$this->session->set_flashdata('success','Password has been successfully updated');
			redirect($this->data['_cancel']);
		}
				
		$this->data['form_data'] = $checkUser;
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Reset Password';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'edit_password';	
		$this->load->view('admin/_layout_main',$this->data);
	}
	function access($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$user_data = $this->comman_model->get_by('users',array('id'=>$id),false,true);
		if(!$user_data)
			redirect($this->data['_cancel']);
			$session_data = array(
							'loginType'		=> 'user',
						  	'loggedin'		=> true,				   
							'logged_by'		=> true,				   
						   	'id'			=> $user_data->id);				
		$this->session->sess_expiration = '14400'; 
		
		$this->session->set_userdata('user_session',$session_data);
		redirect('user/account');
	}

   public function remove_image($id=false){//for remove image
		$path = 'assets/uploads/users/';
		if(!$id)
			redirect($this->data['_cancel']);
		
		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if(!$check)
			redirect($this->data['_cancel']);
		$this->db->where(array('id'=>$id));
		$this->db->set('image', 'NULL', false);
		$this->db->update($this->_table_names);

		$file_dir = $path.'full/'.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		$file_dir = $path.'small/'.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		$file_dir = $path.'thumbnails/'.$check->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		redirect($this->data['_cancel'].'/edit/'.$id);
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