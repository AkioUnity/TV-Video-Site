<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

//ini_set( 'memory_limit', '200M' );
ini_set('memory_limit','128M');
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);


class Slider extends Admin_Controller{

	public $_table_names = 'sliders';		//set table name

	public $_subView = 'admin/sliders/';		//set subview

	public $_redirect = '/slider';		//set controller link

	

	public function __construct(){

		parent::__construct();

		

		//set active for menu

		$this->data['active'] = 'Content Management';

        $this->load->model(array('backend/slider_model'));



		//set function link

        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';

        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;

        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';



        // Get language for content id to show in administration

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();



		$this->checkPermissions('content_manage');

        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');

	}

    

    public function index()

	{

		//set title 

		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],183);

		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		

		//set load view

        $this->data['subview'] = $this->_subView.'index_order';	

		$this->load->view('admin/_layout_main',$this->data);



	}

    

    public function order_ajax ()

    {

        // Save order from ajax call

        if (isset($_POST['sortable'])) {

            $this->slider_model->save_order($_POST['sortable']);

        }

        

        // Fetch all pages

        $this->data['pages'] = $this->slider_model->get_nested($this->data['content_language_id']);

        

        // Load view

        $this->load->view('admin/sliders/order_ajax', $this->data);

    }



    

    public function edit($id = NULL)

	{

		$data = array();

	    // Fetch a data or set a new one

	    if($id)

        {

				//set title

			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);

			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];



            $this->data['page'] = $this->slider_model->get($id, FALSE, $this->data['content_language_id']);

            count($this->data['page']) || $this->data['errors'][] = 'User could not be found';

            

        }

        else

        {

				//set title

			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);

			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		    //  set a new one

            $this->data['page'] = $this->slider_model->get_new();
            $this->data['page']->link = '';

        }



       

        // Set up the form

        $rules = $this->slider_model->rules;

        $this->form_validation->set_rules($this->slider_model->get_all_rules());



        // Process the form

        if($this->form_validation->run() == TRUE){

			$this->load->library('image_lib');

			//get post data 

			$data = $this->slider_model->array_from_post(array('user_name','link','name','watch_link','article_link','description'));

			$video_file = $this->input->post('file_name');

			if(!$video_file){

				$video_file = '';

			}

			$data['video_file'] = $video_file;

            if($id == NULL)$data['order'] = $this->slider_model->max_order()+1;

            if($id == NULL){

                $data['created'] = time();

                $data['modified'] = time();

			}

			else{

                $data['modified'] = time();

			}

           

		   //upload image

			if (!empty($_FILES['logo']['name'])){					

				$result =$this->comman_model->do_upload('logo','./assets/uploads/sliders');

				if($result[0]=='error'){

					$this->session->set_flashdata('error',$result[1]); 

				}

				else if($result[0]=='success'){

					$data['image'] = $result[1];

				}

			}	

			else{

				 if($id != NULL)$data['image'] = $this->data['page']->image;

			}

			

			

			//insert or update data

            $id = $this->comman_model->save($this->_table_names,$data,$id);

			if(empty($this->data['page']->id))

	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));

			else

	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));

            redirect($this->data['_cancel'].'/edit/'.$id);

        }

        

        // Load the view

		$this->data['subview'] = $this->_subView.'edit';

        $this->load->view('admin/_layout_main', $this->data);

	}

    

	function ajax_upload(){		

		$this->load->helper('string');

		$id = $this->input->post('id');

		$ret =array();		

		$config['upload_path'] = './assets/uploads/sliders';

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

			$image = 'assets/uploads/sliders/'.$check_image->video_file;

			if(is_file($image))

    	    	unlink($image);

		}

		echo json_encode($arr);

	}





	

    public function remove_image($id=false){//for remove image

		$path = 'assets/uploads/sliders/';

		if(!$id)

			redirect($this->data['_cancel']);

		

		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);

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



	

	

    public function delete($id)

	{

		if($this->data['admin_details']->default=='0'){

            $this->session->set_flashdata('error','Sorry ! You have no permission.');

	        redirect($this->data['_cancel']);

		}

		$this->slider_model->delete($id);

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