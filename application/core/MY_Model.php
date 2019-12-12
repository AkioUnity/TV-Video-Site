<?php
class MY_Model extends CI_Model {
    
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;
    
	public function __construct(){
		parent::__construct();
	}
    
    public function get_table_name()
    {
        return $this->_table_name;
    }
    
    public function array_from_post($fields)
    {
        $data = array();
        foreach($fields as $field)
        {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }
    
    public function get_all_rules()
    {
        return array_merge($this->rules, $this->rules_lang);
    }
    
    public function get_post_fields()
    {
        $post_fields = array();
        
        foreach($this->rules as $key=>$value)
        {
            $post_fields[] = $key;
        }
        
        return $post_fields;
    }
    
    public function get_post_from_rules($rules)
    {
        $post_fields = array();
        
        foreach($rules as $key=>$value)
        {
            $post_fields[] = $key;
        }
        
        return $post_fields;
    }
    
    public function max_order()
    {
        // get max order
        $this->db->select('MAX(`order`) as `order`', FALSE);
        $row = $this->db->get($this->_table_name)->row();
        
        return (int) $row->order;
    }
    
    public function get_lang_post_fields()
    {
        $post_fields = array();
        
        if(isset($this->rules_lang)){
            foreach($this->rules_lang as $key=>$value)
            {
                $post_fields[] = $key;
            }
        }
        
        return $post_fields;
    }
    
    public function get($id = NULL, $single = FALSE)
    {
        if($id != NULL)
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_table_name.'.'.$this->_primary_key, $id);
            $method = 'row';
        }
        else if($single == TRUE)
        {
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
        if(!count($this->db->order_by($this->_order_by))) {
			$this->db->order_by($this->_order_by);
		}
        
        $query = $this->db->get($this->_table_name);
        if (is_object($query))
        {
            return $query->$method();
        }

        return array();
    }
 
     public function get_using($keyField = NULL, $key=NULL, $single = FALSE)
    {
        if($keyField != NULL)
        {
            $filter = $this->_primary_filter;
            $keyField = $filter($keyField);
            $this->db->where($this->_table_name.'.'.$key, $keyField);
            $method = 'result';
        }
        else if($single == TRUE)
        {
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
        if(!count($this->db->order_by($this->_order_by))) {
			$this->db->order_by($this->_order_by);
		}
        
        $query = $this->db->get($this->_table_name);
        
        if (is_object($query))
        {
            return $query->$method();
        }

        return array();
    }   
    public function get_array($id = NULL, $single = FALSE)
    {
        if($id != NULL)
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row_array';
        }
        else if($single == TRUE)
        {
            $method = 'row_array';
        }
        else
        {
            $method = 'result_array';
        }
        
        if(!count($this->db->order_by($this->_order_by))) {
			$this->db->order_by($this->_order_by);
		}
        
        $query = $this->db->get($this->_table_name);
        if (is_object($query))
        {
            return $query->$method();
        }

        return array();
    }
    
    public function get_form_dropdown($column, $where = FALSE, $empty=TRUE)
    {
        $filter = $this->_primary_filter;
        
        if(!count($this->db->order_by($this->_order_by))) {
			$this->db->order_by($this->_order_by);
		}
        
        if($where)
            $this->db->where($where); 
        
        $dbdata = $this->db->get($this->_table_name)->result_array();
        
        $results = array();
        if($empty)$results[''] = '';
        foreach($dbdata as $key=>$row){
            if(isset($row[$column]))
            {
                //if(lang($row[$column]) != '')$row[$column] = lang($row[$column]);
                $results[$row[$this->_primary_key]] = $row[$column];
            }
            
        }
        return $results;
    }
    
    public function get_by($where, $single = FALSE, $limit = NULL, $order_by = NULL)
    {
        if($order_by !== NULL) $this->db->order_by($order_by);
        if($limit !== NULL) $this->db->limit($limit);
        if($where !== NULL) $this->db->where($where);       
        return $this->get(NULL, $single);
    }
    
    public function save($data, $id = NULL)
    {


        // Set timestamps
        if($this->_timestamps == TRUE)
        {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        // Insert
        if($id === NULL)
        {
             
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
         //   echo $this->db->last_query();
         //   echo $id;
         //   debugger($data);
         //   debugger($this->_table_name);
         //  die;
        }
        // Update
        else
        {

            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }
        
        return $id;
    }
    
    public function delete($id)
    {
        $filter = $this->_primary_filter;
        $id = $filter($id); 
        
        if(!$id)
        {
            return FALSE;
        }
        
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);

        return true;
    }
    
    public function total()
    {
        return $this->db->count_all($this->_table_name);
    }
    
}