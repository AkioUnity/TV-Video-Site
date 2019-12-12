<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register_model extends CI_Model {
	public $page_login = array(
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    
                    ); 


	public $register = array(
                    'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required|max_length[20]'),
                    'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required|max_length[20]'),
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|max_length[40]|is_unique[users.email]'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    'confirm' =>array('field'=>'confirm','label'=>'Confirm','rules'=>'trim|required|matches[password]'),
                  //  'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|integer|required'),
/*                    'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
                    'city' =>array('field'=>'city','label'=>'City','rules'=>'trim|required'),
                    'country' =>array('field'=>'country','label'=>'Country','rules'=>'trim|required'),*/
                    );
    
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	   
					
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>