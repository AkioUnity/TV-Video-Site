<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	public $page_login = array(
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    
                    ); 

	public $create_admin = array(
                    'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
                    'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|integer|required'),
                    'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim'),
                    'city' =>array('field'=>'city','label'=>'City','rules'=>'trim'),
                    'country' =>array('field'=>'country','label'=>'Country','rules'=>'trim'),
                    );
    
	public $update_admin = array(
                    'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
                    'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
                    'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|integer|required'),
                    'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim'),
                    'city' =>array('field'=>'city','label'=>'City','rules'=>'trim'),
                    'country' =>array('field'=>'country','label'=>'Country','rules'=>'trim'),
                    );
    

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

    public $update_rules = array(
			'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
			'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
			'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|required|integer'),
			'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim'),
			'city' =>array('field'=>'city','label'=>'City','rules'=>'trim'),
   );

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	function check_user($id,$confirm){
		$check_confirm = $this->user_valid('users',$id);
		if($check_confirm==0){
			$this->db->where('md5(id)',$id);
			$this->db->where('confirm',$confirm);
			$query = $this->db->get('users');
			//echo $this->db->last_query();die;
			if($query->num_rows()==1){
				$this->db->where('md5(id)',$id);
				$this->db->update('users', array('confirm'=>'confirm')); 
				return $query->row_array();
			}
			else{
				return 'error';
					
			}
		}
		else{
			return 'verified';
		}
	}

	function user_valid($table,$id){
		$check = $this->db->get_where($table,array('md5(id)'=>$id,'confirm'=>'confirm'));
		return $check->num_rows();
	}
					

}







/* End of file super_admin_model.php */

/* Location: ./system/application/models/super_admin_model.php */

?>