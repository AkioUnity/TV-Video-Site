<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings_model extends MY_Model {
    
    protected $_table_name = 'setting';
    protected $_order_by = 'id';
    
	public $setting_rules = array(
				'site_name' =>array('field'=>'site_name','label'=>'Site Name','rules'=>'trim|required'),
				'home_title' =>array('field'=>'home_title','label'=>'Home Title','rules'=>'trim|required'),
				'site_email' =>array('field'=>'site_email','label'=>'Site Email','rules'=>'trim|required'),                    
				'meta_title' =>array('field'=>'meta_title','label'=>'Meta Title','rules'=>'trim'),
				'keywords' =>array('field'=>'keywords','label'=>'keywords','rules'=>'trim'),
				'meta_description' =>array('field'=>'meta_description','label'=>'meta_description','rules'=>'trim'),
				//'footer_text' =>array('field'=>'footer_text','label'=>'footer_text','rules'=>'trim'),
				); 

    public $rules_contact = array(
        'address' => array('field'=>'address', 'label'=>'lang:Address', 'rules'=>'trim'),
        'gps' => array('field'=>'gps', 'label'=>'lang:Gps', 'rules'=>'trim'),
        'email' => array('field'=>'email', 'label'=>'lang:ContactMail', 'rules'=>'trim'),
        'phone' => array('field'=>'phone', 'label'=>'lang:Phone', 'rules'=>'trim'),
        'fax' => array('field'=>'fax', 'label'=>'lang:Fax', 'rules'=>'trim'),
        'address_footer' => array('field'=>'address_footer', 'label'=>'lang:Address Footer', 'rules'=>'trim'),
    );
    
    public $rules_template = array(
        'template' => array('field'=>'address', 'label'=>'lang:Template', 'rules'=>'trim'),
        'tracking' => array('field'=>'gps', 'label'=>'lang:Tracking', 'rules'=>'trim'),
    );

    public function get_new()
	{
        $setting = new stdClass();
        $setting->field = '';
        $setting->value = '';
        
        return $setting;
	}
    
    public function get_fields($where = false)
    {
        if($where){
            $this->db->where('field',$where);
        }
        $query = $this->db->get($this->_table_name);

        $data = array();
        foreach($query->result() as $key=>$setting)
        {
            $data[$setting->field] = $setting->value;
        }
        
        return $data;
    }
    
    public function save_settings($post_data){
        $this->delete_fields($post_data);
   //     debugger($post_data);
   //     die;
        $data = array();
        foreach($post_data as $key=>$value)
        {
            $data[] = array(
               'field' => $key,
               'value' => $value
            );
        }
        
        $this->db->insert_batch($this->_table_name, $data); 
    }
    
    public function delete_fields($fields = array())
    {
     //   debugger(array_flip($fields));
        $this->db->where_in('field', array_keys($fields));
        //$this->db->where_in('field', array_flip($fields));
    //    $this->db->where_in('field', $fields);
        $this->db->delete($this->_table_name);

       
    }
    
}



