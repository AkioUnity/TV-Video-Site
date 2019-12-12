<?php
class Properties extends Admin_Controller{
	public $_table_names = 'properties';		//set table name
	public $_subView = 'admin/properties/';	//set subview load 
	public $_redirect = '/properties';			//set link with controller file name

	public function __construct(){
		parent::__construct();
		//check for employee permission


		//set left menu active on admin dashboard
		$this->data['active'] = 'Properties Management';
        $this->load->model(array('properties_model','custom_model'));


		//set link with function name
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
		$this->data['name'] = 'Properties';
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
            $this->data['form_data'] = $this->properties_model->get_new();
        }
        
        // Set validation rules for form
        $rules = $this->properties_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$postArr = array(
							'name','type','sale_type','priceView','priceSearch','priceCurrency','category','bedroom','bathroom','carports',
							'airconditioning','pool','alarmSystem','other_features',
							'landArea','landAreaUnit','landSize','floorArea','floorAreaUnit','landSizeUnit',
							'buildingArea','buildingAreaUnit','description',
							'socialURL','propertyLongitude','propertyLatitude','propertyTour','propertyURL','propertyVideo',
							'unitNumber','streetNumber','street','address','city','state','country','postcode','availability',
							'user_id','user_display','address_display'
//							'','','','','','','','','','','','','',
						);
            $data = $this->comman_model->array_from_post($postArr);
			if($data['airconditioning']==1){
				$data['airconditioning']=1;
			}
			else{
				$data['airconditioning']=0;
			}
			if($data['pool']==1){
				$data['pool']=1;
			}
			else{
				$data['pool']=0;
			}

			if($data['alarmSystem']==1){
				$data['alarmSystem']=1;
			}
			else{
				$data['alarmSystem']=0;
			}

			$data['dates'] = h_dateFormat($this->input->post('dates'),'Y-m-d');
//			printR($_POST);
            if($id == NULL){
		        $data['p_rand_id'] =  time().random_string('numeric',5);
                $data['on_date'] = date('Y-m-d');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
		///	printR($data);
			
            
            //$data['price'] = round($data['staff']+$data['coach']+$data['member'],2);
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			
			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->db->insert('properties_image', array('property_id'=>$id,'filename'=>$value));					
				}
			}

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

		$this->data['realtor_list'] = $this->comman_model->get_by('users',array('enabled'=>1),array('realtorName'=>'asc'),false);
		
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
       
		$this->properties_model->delete($id);
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