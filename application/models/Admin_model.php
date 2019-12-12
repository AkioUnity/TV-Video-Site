<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public $order_rules = array(
                    'subject' =>array('field'=>'subject','label'=>'Subject','rules'=>'trim|required'),
                    ); 

	public $categories_rules = array(
/*			        'slug' => array('field' => 'slug','label' => 'Slug','rules' => 'trim|required|max_length[100]|url_title|xss_clean'), */
                    'name' =>array('field'=>'name','label'=>'Name','rules'=>'trim|required'),
                    'seo_title' =>array('field'=>'seo_title','label'=>'SEO Title','rules'=>'trim|required'),
                    'seo_keyword' =>array('field'=>'seo_keyword','label'=>'SEO Keyword','rules'=>'trim|required'),
                    'description' =>array('field'=>'description','label'=>'Description','rules'=>'trim|required'),
                    ); 

	public $website_rules = array(
                    'title' =>array('field'=>'title','label'=>'title','rules'=>'trim|required'),
                    'name' =>array('field'=>'name','label'=>'Name','rules'=>'trim|required'),
                    'affilate_url' =>array('field'=>'affilate_url','label'=>'URL','rules'=>'trim|required'),
                    'seo_title' =>array('field'=>'seo_title','label'=>'SEO Title','rules'=>'trim|required'),
                    'seo_keyword' =>array('field'=>'seo_keyword','label'=>'SEO Keyword','rules'=>'trim|required'),
                    'description' =>array('field'=>'description','label'=>'Description','rules'=>'trim|required'),
                    'additional_desc' =>array('field'=>'additional_desc','label'=>'Additional Description','rules'=>'trim|required'),
                    ); 

	public $user_rules = array(
                    'username' =>array('field'=>'username','label'=>'Username','rules'=>'trim|required'),
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    //'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim'),
                    ); 

	public $employee_rules = array(
                    'username' =>array('field'=>'username','label'=>'Username','rules'=>'trim|required|callback__unique_username'),
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|callback__unique_email'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim'),
                    //'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim'),
                    ); 

	public $merchant_rules = array(
                    'username' =>array('field'=>'username','label'=>'Username','rules'=>'trim|required|callback__unique_username'),
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|callback__unique_email'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
                    //'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim'),
                    ); 

	public $coupon_rules = array(
/*			        'slug' => array('field' => 'slug','label' => 'Slug','rules' => 'trim|required|max_length[100]|url_title|xss_clean'), */
                    'coupon_title' =>array('field'=>'coupon_title','label'=>'Coupon Title','rules'=>'trim|required'),
                    'coupon_code' =>array('field'=>'coupon_code','label'=>'Coupon Code','rules'=>'trim'),
                    'badge_title' =>array('field'=>'badge_title','label'=>'Badge Title','rules'=>'trim|required'),
                    'expiry_date' =>array('field'=>'expiry_date','label'=>'Expiry Date','rules'=>'trim'),
                    'url' =>array('field'=>'url','label'=>'URL','rules'=>'trim'),
                    'description' =>array('field'=>'description','label'=>'Description','rules'=>'trim|required'),
                    ); 

	public $slider_rules = array(
                    'name' =>array('field'=>'name','label'=>'Name','rules'=>'trim|required'),
                    ); 


	public $product_rules = array(
                    'name' =>array('field'=>'name','label'=>'Name','rules'=>'trim|required'),
                    'sku' =>array('field'=>'sku','label'=>'sku','rules'=>'trim|required'),
                    'price' =>array('field'=>'price','label'=>'Price','rules'=>'trim|required|numeric'),
                    /*'weight' =>array('field'=>'weight','label'=>'Weight','rules'=>'trim|required|numeric'),*/
                    'category_id' =>array('field'=>'category_id','label'=>'category','rules'=>'trim'),
                    'description' =>array('field'=>'description','label'=>'Description','rules'=>'trim|required'),
                    ); 

    
	public $setting_rules = array(
                    'site_name' =>array('field'=>'site_name','label'=>'Site Name','rules'=>'trim|required'),
                    'site_email' =>array('field'=>'site_email','label'=>'Site Email','rules'=>'trim|required'),                    
                    ); 
    
    //email 
    public $email_rules = array(
                    'subject' =>array('field'=>'subject','label'=>'Subject','rules'=>'trim|required'),
                    'message' =>array('field'=>'message','label'=>'Message','rules'=>'trim|required'),                    
                    ); 


    public $coach_rules = array(
                    'username' =>array('field'=>'username','label'=>'User Name','rules'=>'trim|required'),
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[coach.email]'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required|match[confirm_pass]'),
                    'confirm_pass' =>array('field'=>'confirm_pass','label'=>'Confirm','rules'=>'trim|required'),
                    ); 

    public $update_coach_rules = array(
                    'username' =>array('field'=>'username','label'=>'User Name','rules'=>'trim|required'),
                    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required|match[confirm_pass]'),
                    'confirm_pass' =>array('field'=>'confirm_pass','label'=>'Confirm','rules'=>'trim|required'),
                    ); 


/*    public $= array(
                    'username' =>array('field'=>'username','label'=>'Username','rules'=>'trim|required'),
                    'message' =>array('field'=>'message','label'=>'','rules'=>'trim|required'),                    
                    ); */
					
        function __construct()
    {
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
	
						
}

// END Admin_model Class

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */