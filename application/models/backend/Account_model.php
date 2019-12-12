<?php
class Account_Model extends CI_Model{

	protected $_table_name = 'user';
	protected $_order_by = 'username';

	//set rules for setting table for field value
	public $setting_rules = array(
                    'site_name' =>array('field'=>'site_name','label'=>'Site Name','rules'=>'trim|required'),
                    'site_email' =>array('field'=>'site_email','label'=>'Site Email','rules'=>'trim|required'),                    
                    ); 
    
	//set rules email
    public $email_rules = array(
                    'subject' =>array('field'=>'subject','label'=>'Subject','rules'=>'trim|required'),
                    'message' =>array('field'=>'message','label'=>'Message','rules'=>'trim|required'),                    
                    ); 


	//set rules 
	public $rules =  array(
              'usernam'=> array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'trim|required|xss_clean'
                  ),
              'password'=> array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ));

	//set rules for admin
    public $rules_admin =  array(
              'username'=> array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'trim|required|xss_clean'
                  ),
              'email'=> array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email|callback__unique_email|xss_clean'
                  ),
              'password'=> array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required|matches[password_confirm]'
                  ),
              'password_confirm'=> array(
                     'field'   => 'password_confirm',
                     'label'   => 'Confirm Password',
                     'rules'   => 'trim|required|matches[password]'
                  ));

	//set rules for password
    public $rules_password =  array(
              'old_password'=> array(
                     'field'   => 'old_password',
                     'label'   => 'Old Password',
                     'rules'   => 'trim|required|callback__check_old_password'
                  ),
              'password'=> array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ),
              'password_confirm'=> array(
                     'field'   => 'password_confirm',
                     'label'   => 'Confirm Password',
                     'rules'   => 'trim|required|matches[password]'
                  ));

	function __construct(){
    	parent::__construct();
		$this->load->model('comman_model', 'comman');
    }

	//fetch data from admin table and set admin session
	public function login(){
		$user = $this->comman->get_by('admin',array(
					'username'=>$this->input->post('username'),
					'password'=>md5($this->input->post('password')),
					),false,TRUE);
				//echo $this->db->last_query();die;
		if(count($user)){
			//log in user
			$data = array(
					'username'=>$user->username,
					'email'=>$user->email,
					'id'=>$user->id,
					'logged_type'=>'admin',
					'loggedin'=>TRUE);
			$this->session->set_userdata('admin_session',$data);
		}
	}

	public function logout(){
        $this->session->sess_destroy();
	}

	public function loggedin(){
        //echo (bool) $this->session->userdata('loggedin');die;
        if(!$this->session->userdata('admin_session')){
	        return (bool)FALSE; 
		}
        return (bool) $this->session->userdata['admin_session']['loggedin']; 
	}

    public function get_new(){
        $user = new stdClass();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        return $user;        
    }
    
    public function hash($string){
        //echo hash('sha512', $string . config_item('encryption_key'));
        return hash('sha512', $string . config_item('encryption_key'));
    }
} 

?>