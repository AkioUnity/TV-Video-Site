<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
    public $email_rules = array(
                    'subject' =>array('field'=>'subject','label'=>'Subject','rules'=>'trim|required'),
                    'message' =>array('field'=>'message','label'=>'Message','rules'=>'trim|required'),                    
                    ); 

					
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	
	    
//  Function to verify the user login credentials.
	function verifyUserLogin($user_name, $user_password)
	{
		
		 $query = $this->db->get_where('admin',array('adminname'=>$user_name ,'password'=>md5($user_password), 'status'=>1));
		//echo $this->db->last_query();die;
		return $query->row_array();
	}

	function update_password($old_pass,$new_pass,$id){
		$array = array('id' =>$id,'password'=>md5($old_pass));
		$update = array('password'=>md5($new_pass));
		$query = $this->db->get_where('admin',$array);
		//echo $this->db->last_query();die;
		if($query->row_array()){
			$this->db->where('id', $id);
			$this->db->update('admin', $update); 
			return 'yes';
		}
		else{
			return 'no';
		}
	}


	public function send_mail_in_ci($data){
		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);

		$this->email->from($data['from_email'],  $data['from_name']);
		$this->email->to($data['to_email']);
		
		$this->email->subject( $data['subject']);
		$this->email->message( $data['html']);
		if(isset($data['files'])){
			$img = $data['files'];
			if(is_file($img)){
				$this->email->attach($img);
			}
		}
		if($this->email->send()){
			return 'sent';
		}
		else{
			return 'error';
		}
	}
		
	public function send_mail_in_smtp($data,$test=false){
		$this->load->library('email');
		$config = array (
			  'mailtype' =>'html',
			  'charset'  =>'utf-8',
			  'protocol'  =>'smtp',
			  'smtp_host' => C_SMTP_HOST,
			  'smtp_user' => C_SMTP_USER,
			  'smtp_pass' => C_SMTP_PASS,
			  'smtp_port' => C_SMTP_PORT,
			  'smtp_crypto' =>'tls',
			  '_smtp_auth' => TRUE,
			  'newline' =>"\r\n",
			  'priority' =>'1'
		   );
			   
		$this->email->initialize($config);
		$this->email->SMTPAuth = true;
		$this->email->from($data['from_email'],  $data['from_name']);
		if(isset($data['cc'])){
			$this->email->bcc($data['cc']);
		}
		$this->email->to($data['to_email']);
		
		$this->email->subject( $data['subject']);
		$this->email->message( $data['html']);
		if($this->email->send()){
			return 'sent';
		}
		else{
			if($test)
				echo $this->email->print_debugger();
			return 'error';
		}
		
	}
						
}
