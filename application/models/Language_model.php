<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Language_model extends MY_Model {    
    protected $_table_name = 'language';
    protected $_order_by = 'default DESC, id';
    public $rules_admin = array(
        'code' => array('field'=>'code', 'label'=>'lang:Code', 'rules'=>'trim|required|xss_clean'),
        'language' => array('field'=>'language', 'label'=>'lang:Language', 'rules'=>'trim|required|xss_clean'),
		'currency' => array('field'=>'currency', 'label'=>'Currency', 'rules'=>'trim|required'),
		'unit' => array('field'=>'unit', 'label'=>'Unit', 'rules'=>'trim|required'),
        'default' => array('field'=>'default', 'label'=>'lang:Default', 'rules'=>'trim'),
    );

   // public $backend_languages = array('hr'=>'Croatian', 'en'=>'English');
    
	public function __construct(){
		parent::__construct();
        
/*        $this->backend_languages = array();
        
        $langDirectory = opendir(APPPATH.'language');
        // get each lang
        while($langName = readdir($langDirectory)) {
            if ($langName != "." && $langName != "..") {
                $this->backend_languages[$langName] = lang($langName)==''?$langName:lang($langName);
            }
        }
*/
	}
    
    public function get_new()
	{
        $language = new stdClass();
        $language->code = '';
        $language->language = '';
        $language->unit = 1;
        $language->currency = '';
		
        $language->default = 0;
        return $language;
	}
    
	//fetch default =1  from language table return id
    public function get_content_lang()
    {
        $query = $this->db->get_where($this->_table_name, array('language' => $this->config->item('language')), 1);
		//echo $this->db->last_query();die;
        
        if ($query->num_rows() > 0)
        {
            return $query->row()->id;
        }
        else
        {
            $query = $this->db->get_where($this->_table_name, array('default' => 1), 1);
            return $query->row()->id;
        }

        return 2;
    }

	//fetch default =1  from language table return id
    public function get_defualt_lang(){
		return 1;
		//for get lang id by default =1
/*        $query = $this->db->get_where($this->_table_name, array('default' => 1), 1);
        
        if ($query->num_rows() > 0)
        {
            return $query->row()->id;
        }
        else
        {
	        return 2;
        }*/
    }

    public function get_current_lang()
    {
        $query = $this->db->get_where($this->_table_name, array('language' => $this->config->item('language')), 1);
        
        if ($query->num_rows() > 0)
        {
            return $query->row()->id;
        }
        else
        {
            $query = $this->db->get_where($this->_table_name, array('default' => 1), 1);
            return $query->row()->id;
        }

        return 2;
    }

	//fetch default a data return code
    public function get_default()
    {
        $query = $this->db->get_where($this->_table_name, array('default' => 1), 1);
        return $query->row()->code;
    }
    
	//fetch default a data return currency
	public function get_default_currency()
    {
        $query = $this->db->get_where($this->_table_name, array('default' => 1), 1);
        return $query->row()->currency;
    }

	//fetch default a data return unit
    public function get_default_unit()
    {
        $query = $this->db->get_where($this->_table_name, array('default' => 1), 1);
        return $query->row()->unit;
    }
    
	//fetch default a data return id
    public function get_default_id()
    {
        $query = $this->db->get_where($this->_table_name, array('default' => 1), 1);
        return $query->row()->id;
    }


    public function get_id($code)
    {
        $query = $this->db->get_where($this->_table_name, array('code' => $code), 1);
        return $query->row()->id;
    }
    public function get_unit($code)
    {
        $query = $this->db->get_where($this->_table_name, array('code' => $code), 1);
        return $query->row()->unit;
    }
    
    public function get_code($id)
    {
        $query = $this->db->get_where($this->_table_name, array('id' => $id), 1);
        return $query->row()->code;
    }
    public function get_currency($code)
    {
        $query = $this->db->get_where($this->_table_name, array('code' => $code), 1);
        return $query->row()->currency;
    }
    
    public function get_name($code)
    {
        $query = $this->db->get_where($this->_table_name, array('code' => $code), 1);
        return $query->row()->language;
    }
    
    public function save($data, $id = NULL)
    {
        if($data['default'] == 1)
        {
            $this->db->set(array('default'=>'0'));
            $this->db->update($this->_table_name);
        }
        
        return parent::save($data, $id);
    }
    
    public function delete($id)
    {
        $this->db->where('language_id', $id);
        $this->db->delete('page_lang');
        
        $this->db->where('language_id', $id);
        $this->db->delete('static_text_lang');              
        
        $this->db->where('language_id', $id);
        $this->db->delete('categories_lang');
        return parent::delete($id);
    }

}



