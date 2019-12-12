<?php
class Agent extends Admin_Controller{
	public $_table_names = 'users';		//set table name
	public $_subView = 'admin/agent/';	//set subview load 
	public $_redirect = '/agent';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		//check for employee permission


		//set left menu active on admin dashboard
		$this->data['active'] = 'Realtor Management';
        $this->load->model(array('custom_model','agent_model'));


		//set link with function name
        $this->data['_create'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['sale_type'] = array('For Sale','Price On Applicaion','Auction','For Rent','For Rent/lease','Just Listed','For Tender','For Sale/lease','Private Tender','Lottery','Expression of Interest','Offers','SOLD');
        $this->data['type_list'] = array('Residential');
        $this->data['category'] = array('House');
        $this->data['availability_list'] = array('Current');

	}
    
    public function index(){
		//set title
		$this->data['name'] = 'Realtor';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//set load datatable.js
		$this->data['table'] = true;

	    // Fetch all data
		$this->db->order_by('id','desc');
        $this->data['all_data'] = $this->comman_model->get($this->_table_names,false);

		//set lead view		
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

    public function create(){
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//set a new one
		$this->data['form_data'] = $this->agent_model->get_new();
        
        // Set validation rules for form
        $rules = $this->agent_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$postArr = array(
							'realtorName','realtorEmail','realtorCell','realtyName','realtyFixedPhone',
							'realtyStreet1','realtyStreet2','realtyCity','realtyState','realtyZip','realtyCountry');
            $data = $this->comman_model->array_from_post($postArr);
			
            if(!empty($_FILES['image']['name'])){
				$new_name = 'realtor_'.time();
				$config['file_name'] = $new_name;		
                $config['upload_path']      = 'assets/uploads/users/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['image']  = $upload_data['file_name'];
                }

            }      
			
			$data['created'] = time();
			$data['modified'] = time();
            $id = $this->comman_model->save($this->_table_names,$data);
			

			if(empty($this->data['form_data']->id))
	            $this->session->set_flashdata('success','Data has successfully created.');
			else
	            $this->session->set_flashdata('success','Data has successfully updated.');			
			//	die;
            redirect($this->data['_cancel']);
        }

		$this->data['time_data'] = $this->custom_model->get_time();
		
		$this->data['subview'] = $this->_subView.'create';
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
            $this->data['form_data'] = $this->agent_model->get_new();
        }
        
        // Set validation rules for form
        $rules = $this->agent_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$postArr = array(
							'realtorName','realtorEmail','realtorCell','realtyName','realtyFixedPhone',
							'realtyStreet1','realtyStreet2','realtyCity','realtyState','realtyZip','realtyCountry');
            $data = $this->comman_model->array_from_post($postArr);
//			printR($_POST);
			$data['modified'] = time();
		///	printR($data);
			
            if(!empty($_FILES['image']['name'])){
				$new_name = 'realtor_'.time();
				$config['file_name'] = $new_name;		
                $config['upload_path']      = 'assets/uploads/users/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['image']  = $upload_data['file_name'];
                }

            }else{
                $data['background']  = $this->data['settings']['logo'];
            }      
			
            
            //$data['price'] = round($data['staff']+$data['coach']+$data['member'],2);
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			
			if(empty($this->data['form_data']->id))
	            $this->session->set_flashdata('success','Data has successfully created.');
			else
	            $this->session->set_flashdata('success','Data has successfully updated.');			
			//	die;
            redirect($this->data['_cancel']);
        }

		if($id){
			$this->data['products_file'] = $this->comman_model->get_by('properties_image',array('property_id'=>$id),false);
		}
		$this->data['time_data'] = $this->custom_model->get_time();
		
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
       
		$this->agent_model->delete($id);
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