<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_employee_model extends MY_Model {
    protected $_table_name = 'admin';
	//set rules for change password
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

	//set rules for update
    public $update_rules = array(
        //'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
   );

	//set rules for create employee
    public $create_rules = array(
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'username' => array('field'=>'username', 'label'=>'Username', 'rules'=>'trim|required|is_unique[admin.username]'),
		'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[admin.email]'),
        'password' => array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
        //'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
   );

	//set rules for create employee
    public $create_p_rules = array(
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'l_name' => array('field'=>'name', 'label'=>'Surname', 'rules'=>'trim|required'),
        'username' => array('field'=>'username', 'label'=>'Username', 'rules'=>'trim|required|is_unique[admin.username]'),
		'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[admin.email]'),
        'password' => array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
        //'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
   );

   public $rules_lang = array();   

    function __construct(){
		parent::__construct();
        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);
                                  
        //Rules for languages
        foreach($this->languages as $key=>$value){
			$this->rules_lang["l_about_$key"] 			= array('field'=>"l_about_$key", 'label'=>'About', 'rules'=>'trim');
        }
	}

    public function get_new_lang()
	{
        $categories = new stdClass();
        
        //Add language parameters
/*		printR($this->languages);
		die;*/
        foreach($this->languages as $key=>$value)
        {
            $categories->{"l_about_$key"} = '';
        }
        
        return $categories;
	}
    


	function get_new(){
        $users = new stdClass();
        //$tags->parent_id = 0;
        $users->name	 		= '';
        $users->username 		= '';
        $users->password		= '';
        $users->email 			= '';
        
        return $users;
	}   
    
	public function get_lang($id = NULL, $single = FALSE, $lang_id=1){
        if($id != NULL)
        {
            $result = $this->get($id);
            
            $this->db->select('*');
            $this->db->from($this->_table_name.'_lang');
            $this->db->where('admin_id', $id);
            $lang_result = $this->db->get()->result_array();
            foreach ($lang_result as $row)
            {
                foreach ($row as $key=>$val)
                {
                    $result->{$key.'_'.$row['language_id']} = $val;
                }
            }
            
            foreach($this->languages as $key_lang=>$val_lang)
            {
                foreach($this->rules_lang as $r_key=>$r_val)
                {
                    if(!isset($result->{$r_key}))
                    {
                        $result->{$r_key} = '';
                    }
                }
            }
            
            return $result;
        }

      
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.admin_id');
        $this->db->where('language_id', $lang_id);
        if($single == TRUE)
        {
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
        
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
	
    public function save_with_lang($data_lang, $id = NULL)
    {
        // Save lang data
        $this->db->delete($this->_table_name.'_lang', array('admin_id' => $id));
        
        foreach($this->languages as $lang_key=>$lang_val)
        {
            if(is_numeric($lang_key))
            {
                $curr_data_lang = array();
                $curr_data_lang['language_id'] = $lang_key;
                $curr_data_lang['admin_id'] = $id;
                
                foreach($data_lang as $data_key=>$data_val)
                {
                    $pos = strrpos($data_key, "_");
                    if(substr($data_key,$pos+1) == $lang_key)
                    {
                        $curr_data_lang[substr($data_key,0,$pos)] = $data_val;
                    }
                }
                $this->db->set($curr_data_lang);
                $this->db->insert($this->_table_name.'_lang');
				//echo $this->db->last_query();
            }
        }

        return $id;
    }
	
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>